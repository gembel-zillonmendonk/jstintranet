<?php

class ep_ktr_po_item extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM';
    public $elements_conf = array(
//        'KODE_PO_ITEM',
//        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
//        'KODE_BARANG_JASA',
//        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA'=>array('type'=>'hidden'),
        'QTY',
//        'SATUAN',
//        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
        'KODE_PO_ITEM',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
    }

    function _before_save() {
        parent::_before_save();
        $this->attributes['SUB_TOTAL'] = $this->attributes['QTY'] * $this->attributes['HARGA'];
    }
    function _default_scope() {
        parent::_default_scope();
        return " kode_po = '".$_REQUEST['KODE_PO']."'";
    }
}

?>