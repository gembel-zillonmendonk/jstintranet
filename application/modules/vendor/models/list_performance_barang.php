<?php

class list_performance_barang extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( 
        select a.KODE_VENDOR, b.nama_barang_jasa, b.kode_barang_jasa, z.nilai, z.flag, '' as ACT 
        from EP_VENDOR a 
        inner join (
            select kode_vendor, kode_barang as kode_barang_jasa, nama_barang as nama_barang_jasa
            from EP_VENDOR_BARANG 
            union all
            select kode_vendor, kode_jasa as kode_barang_jasa, nama_jasa as nama_barang_jasa
            from EP_VENDOR_JASA
        ) b on a.kode_vendor = b.kode_vendor
        inner join (
            select count(*) as cnt, kode_vendor, kode_kel_jasa_barang 
            from EP_VENDOR_KINERJA
            group by kode_vendor, kode_kel_jasa_barang 
        ) c on b.kode_barang_jasa = c.kode_kel_jasa_barang
        inner join (
            select y.*, z.nama_vendor from (
                select x.*, ROW_NUMBER() OVER(PARTITION BY kode_vendor, kode_kel_jasa_barang1 ORDER BY nilai ASC) rn 
                from (
                    select A.*
                        , FN_VENDOR_PERF_FLAG(A.KODE_VENDOR, A.KODE_KEL_JASA_BARANG1, A.KODE_PARAM1, A.KODE_TENDER) as FLAG
                        , FN_VENDOR_PERF_POINT(A.KODE_VENDOR, A.KODE_KEL_JASA_BARANG2, A.KODE_PARAM2, A.KODE_TENDER) as NILAI
                    from(
                        select a.kode_vendor, a.kode_tender, a.KODE_PARAM as KODE_PARAM1, a.KODE_PARAM as KODE_PARAM2, a.kode_kel_jasa_barang as kode_kel_jasa_barang1, a.kode_kel_jasa_barang as kode_kel_jasa_barang2, b.nama_sub_barang_jasa
                        from ep_vendor_kinerja a
                        inner join (
                            select kode_vendor, kode_barang as kode_sub_barang_jasa1, kode_barang as kode_sub_barang_jasa2, nama_barang as nama_sub_barang_jasa from ep_vendor_barang
                            union all
                            select kode_vendor, kode_jasa as kode_jasa1, kode_jasa as kode_jasa2, nama_jasa from ep_vendor_jasa
                        ) b on a.kode_kel_jasa_barang = b.kode_sub_barang_jasa1
                    ) A
                ) x
            ) y
            inner join ep_vendor z on y.kode_vendor = z.kode_vendor
            where rn = 1 and z.status = 9 
        ) z on z.kode_vendor = a.kode_vendor and z.kode_kel_jasa_barang1 = kode_barang_jasa
    )";
    
    
    public $columns_conf = array(
        'KODE_VENDOR',
        'KODE_BARANG_JASA',
        'NAMA_BARANG_JASA',
        'NILAI',
        'FLAG',
        'ACT',
    );
    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/vendor/list_performance&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_BARANG_JASA=" + data[\'KODE_BARANG_JASA\'];
                    var href = $site_url + "/vendor/view_performance?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>