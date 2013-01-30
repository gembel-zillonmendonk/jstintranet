<?php

class generate_bidder_list extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( 
        select a.*, b.KODE2_WILAYAH, b.WILAYAH, e.kode_barang, d.nama_subkelompok, e.nama_barang, c.terdaftar, 'M' as TIPE_KOMODITI, 0 as win, 0 as invited, 0 as reg, 0 as quote, '' as ACT 
        from EP_VENDOR a 
        left join EP_VENDOR_WILAYAH b on a.kode_vendor = b.kode_vendor
        left join EP_VENDOR_BARANG c on c.kode_vendor = b.kode_vendor
        left join MS_SUBKELOMPOK_BARANG d on c.kode_barang = d.kode_barang
        left join MS_BARANG e on d.kode_barang = e.kode_barang
        where a.status = 9 )";
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'KODE_BARANG',
        'KODE2_WILAYAH',
        'WILAYAH',
        'NAMA_SUBKELOMPOK',
        'NAMA_BARANG',
        'TIPE_KOMODITI',
        'STATUS',
        'GOLONGAN_KEUANGAN',
        'WIN',
        'INVITED',
        'REG',
        'QUOTE',
        'TERDAFTAR',
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
                    
                    var param = "referer_url=/vendor/generate_bidder_list&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_BARANG=" + data[\'KODE_BARANG\'] + "&TIPE_KOMODITI=" + data[\'TIPE_KOMODITI\'];
                    var href = $site_url + "/vendor/grid_form/vendor.ep_vendor_negosiasi_his?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope() {
        parent::_default_scope();

        $where = array();
        
        if(isset($_REQUEST['KODE_BARANG']) && strlen($_REQUEST['KODE_BARANG']) > 0)
            $where[] = ' KODE_BARANG = \'' .$_REQUEST['KODE_BARANG'] . '\'';        
        if(isset($_REQUEST['TYPE']) && strlen($_REQUEST['TYPE']) > 0)
            $where[] = ' TYPE = \'' .$_REQUEST['TYPE'] . '\'';
        if(isset($_REQUEST['KODE_WILAYAH']) && strlen($_REQUEST['KODE_WILAYAH']) > 0)
            $where[] = ' KODE_WILAYAH = \'' .$_REQUEST['KODE_WILAYAH'] . '\'';
        if(isset($_REQUEST['GOLONGAN_KEUANGAN']) && strlen($_REQUEST['GOLONGAN_KEUANGAN']) > 0)
            $where[] = ' GOLONGAN_KEUANGAN = \'' .$_REQUEST['GOLONGAN_KEUANGAN'] . '\'';
        
        if(count($where) > 0)
            return implode (' AND ', $where);
        
//        if (isset($_REQUEST['KODE_BARANG']) &&
//                isset($_REQUEST['TYPE']) &&
//                isset($_REQUEST['KODE_WILAYAH']) &&
//                isset($_REQUEST['GOLONGAN_KEUANGAN'])
//        ) {
//            return ' KODE_BARANG = \'' . $_REQUEST['KODE_BARANG'] . '\'' .
//                    ' AND TYPE = \'' . $_REQUEST['TIPE_KOMODITI'] . '\'' .
//                    ' AND KODE_WILAYAH = ' . $_REQUEST['KODE_WILAYAH'] .
//                    ' AND GOLONGAN_KEUANGAN = \'' . $_REQUEST['GOLONGAN_KEUANGAN'] . '\'';
//        }
    }

}

?>