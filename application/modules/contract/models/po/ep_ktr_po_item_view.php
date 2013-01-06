<?php

class ep_ktr_po_item_view extends MY_Model {

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
//        'KODE_PO_ITEM',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'MIN_QTY',
        'MAX_QTY',
        'JUMLAH_ORDER',
        'SATUAN',
        'SUB_TOTAL',
        'PPN',
        'TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->sql_select = "(
            select a.*, a.qty as jumlah_order, b.min_qty, b.max_qty, a.sub_total * 0.10 as ppn, a.sub_total - (a.sub_total * 0.10) as total
            from ep_ktr_po_item a
            inner join ep_ktr_kontrak_item b on a.kode_kontrak = b.kode_kontrak and a.kode_barang_jasa = b.kode_barang_jasa and a.kode_sub_barang_jasa = b.kode_sub_barang_jasa
        )";
        
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