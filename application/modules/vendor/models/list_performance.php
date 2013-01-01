<?php

class list_performance extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( 
        select a.*, b.kode_barang_jasa, b.nama_barang_jasa, '' as ACT 
        from EP_VENDOR a 
        inner join (
            select kode_vendor, kode_barang as kode_barang_jasa, nama_barang as nama_barang_jasa
            from EP_VENDOR_BARANG 
            union all
            select kode_vendor, kode_jasa as kode_barang_jasa, nama_jasa as nama_barang_jasa
            from EP_VENDOR_JASA
        ) b on a.kode_vendor = b.kode_vendor
        where status = 9 
        )";
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'ALAMAT',
        'STATUS',
        'KODE_BARANG_JASA',
        'NAMA_BARANG_JASA',
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
                    
                    var param = "referer_url=/vendor/list_performance&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    var href = $site_url + "/vendor/view_performance?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope() {
        parent::_default_scope();
        //http://192.168.0.109:8888/jstintranet/index.php/vendor/grid/vendor.list_performance?TIPE_KOMODITI=&KODE_BARANG=C01&KODE_WILAYAH=&GOLONGAN_KEUANGAN=&oper=grid&_search=false&nd=1356870078754&rows=15&page=1&sidx=&sord=asc
        
        if(isset($_REQUEST['KODE_BARANG'])) {
            $TIPE_KOMODITI = isset($_REQUEST['TIPE_KOMODITI']) && strlen($_REQUEST['TIPE_KOMODITI']) ? $_REQUEST['TIPE_KOMODITI'] : '';
            $KODE_BARANG = isset($_REQUEST['KODE_BARANG']) && strlen($_REQUEST['KODE_BARANG']) ? $_REQUEST['KODE_BARANG'] : '';
            $KODE_WILAYAH = isset($_REQUEST['KODE_WILAYAH']) && strlen($_REQUEST['KODE_WILAYAH']) ? $_REQUEST['KODE_WILAYAH'] : '';
            $GOLONGAN_KEUANGAN = isset($_REQUEST['GOLONGAN_KEUANGAN']) && strlen($_REQUEST['GOLONGAN_KEUANGAN']) ? $_REQUEST['GOLONGAN_KEUANGAN'] : '';

            $where = array();
            $where[] = strlen($KODE_BARANG) ? "KODE_BARANG_JASA='$KODE_BARANG'" : "1=1";
            $where[] = strlen($KODE_WILAYAH) ? "KODE_WILAYAH='$KODE_WILAYAH'" : "1=1";
            $where[] = strlen($GOLONGAN_KEUANGAN) ? "GOLONGAN_KEUANGAN='$GOLONGAN_KEUANGAN'" : "1=1";

            return implode(" AND ", $where);
        } else {
            return " 1 <> 1";
        }
    }
}

?>