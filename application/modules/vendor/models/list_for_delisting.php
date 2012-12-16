<?php

class list_for_delisting extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = null;
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'ALAMAT',
        'KODE_KEL_JASA_BARANG',
        'NAMA_SUB_BARANG_JASA',
        'NILAI',
        'FLAG',
        'ACT',
    );

    function __construct() {
        parent::__construct();
        $this->init();
        
        $wkf = new Workflow();
        $kode_wkf = 56; //delisting vendor
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf and tanggal_selesai is null");
        
        $this->sql_select = "(
            select y.*, z.nama_vendor, '' as ACT 
            from (
                select x.*, ROW_NUMBER() OVER(PARTITION BY kode_vendor, kode_kel_jasa_barang ORDER BY nilai ASC) rn 
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
            ) x on x.kode_vendor = y.kode_vendor and x.kode_barang_jasa = y.kode_kel_jasa_barang
            where rn = 1 and z.status = 9 and x.kode_vendor is null
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "kode_wkf=56&referer_url=/vendor/list_for_delisting&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_BARANG_JASA=" + data[\'KODE_KEL_JASA_BARANG\'];
                    //var href = $site_url + "/vendor/form_delisting?" + param;
                    var href = $site_url + "/wkf/start?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>