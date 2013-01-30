<?php

class list_for_blacklist extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = null;
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'ALAMAT',
        'STATUS',
        'NILAI',
        'FLAG',
        'ACT',
    );
    function __construct() {
        parent::__construct();
        $this->init();
        
        $wkf = new Workflow();
        $kode_wkf = 52; //delisting vendor
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf and tanggal_selesai is null");
        
        $this->sql_select = "(
            select a.*, '' as ACT 
            from ep_vendor a
            left join (
                $pivot_query
            ) x on x.kode_vendor = a.kode_vendor
            where a.status = 9 and x.kode_vendor is null
        )";
        
        $this->sql_select = "(
            select y.*, z.nama_vendor, z.status, z.alamat, '' as ACT 
            from (
                select x.*, ROW_NUMBER() OVER(PARTITION BY kode_vendor ORDER BY nilai ASC) rn 
                from (
                    select a.kode_vendor, a.kode_kel_jasa_barang, b.nama_sub_barang_jasa
                            , FN_VENDOR_PERF_POINT(A.KODE_VENDOR, A.KODE_KEL_JASA_BARANG, A.KODE_PARAM, A.KODE_TENDER) as NILAI
                            , FN_VENDOR_PERF_FLAG(A.KODE_VENDOR, A.KODE_KEL_JASA_BARANG, A.KODE_PARAM, A.KODE_TENDER) as FLAG

                    from ep_vendor_kinerja a
                    inner join (
                        select kode_vendor, kode_barang as kode_sub_barang_jasa, nama_barang as nama_sub_barang_jasa, terdaftar from ep_vendor_barang
                        union all
                        select kode_vendor, kode_jasa, nama_jasa, terdaftar from ep_vendor_jasa
                    ) b on a.kode_kel_jasa_barang = b.kode_sub_barang_jasa
                    where b.terdaftar = '1'
                ) x
            ) y
            inner join ep_vendor z on y.kode_vendor = z.kode_vendor
            left join (
                $pivot_query
            ) x on x.kode_vendor = y.kode_vendor
            where rn = 1 and z.status = 9 and x.kode_vendor is null and flag = 'BLACK'
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "kode_wkf=52&referer_url=/vendor/list_for_blacklist&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    var href = $site_url + "/wkf/start?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>