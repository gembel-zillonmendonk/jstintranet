<?php

class ep_ktr_kontrak_item_editor extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_ITEM';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
//        'KODE_ITEM_KONTRAK'=>array('formatter'=>'checkboxFormatter'),
//        'TIT_ID',
        'KODE_ITEM',
        'KODE_KONTRAK',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
//        'MIN_QTY',
//        'MAX_QTY',
        'SATUAN',
//        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
        'QTY',
        'ACT',
    );
    
    public $sql_select = "( select a.*, '' as qty, '' as act from EP_KTR_KONTRAK_ITEM a )";
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();

        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "KODE_BARANG_JASA=" + data[\'KODE_BARANG_JASA\'] + "&KODE_SUB_BARANG_JASA=" + data[\'KODE_SUB_BARANG_JASA\'];
                    cb = "<input type=\"checkbox\" value=\"" +param+ "\" name=\"selected_items[]\"/>";
                    qty = "<input type=\"number\" value=\"0\" name=\"selected_qty[]\"/>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{QTY:qty,ACT:cb});
		}';
        
        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//        if (isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_KONTRAK'])) {
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//
//        }
    }

}

?>