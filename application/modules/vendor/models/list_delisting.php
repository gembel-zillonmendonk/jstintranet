<?php

class list_delisting extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( 
        select a.*, b.kode_barang_jasa, b.nama_barang_jasa, '' as ACT 
        from EP_VENDOR a 
        inner join (
            select kode_vendor, kode_barang as kode_barang_jasa, nama_barang as nama_barang_jasa, terdaftar from ep_vendor_barang
            union all
            select kode_vendor, kode_jasa, nama_jasa, terdaftar from ep_vendor_jasa
        ) b on a.KODE_VENDOR = b.KODE_VENDOR
        where status is not null 
        and terdaftar = '0')";
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'ALAMAT',
        'STATUS',
        'NAMA_BARANG_JASA',
        'KODE_BARANG_JASA',
        'ACT',
    );

    function __construct() {
        parent::__construct();
        $this->init();

        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "kode_wkf=57&referer_url=/vendor/list_delisting&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_BARANG_JASA=" + data[\'KODE_BARANG_JASA\'];
                    //var href = $site_url + "/vendor/form_undelisting?" + param;
                    var href = $site_url + "/wkf/start?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope() {
        parent::_default_scope();
//        echo $_REQUEST['NAMA_VENDOR'];
        return " NAMA_VENDOR = '" . (isset($_REQUEST['NAMA_VENDOR']) ? $_REQUEST['NAMA_VENDOR'] : '') . "'";
    }

}

?>