<?php

class ep_ktr_po_item_perkembangan_view extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM_PERKEMBANGAN';
    public $elements_conf = array(
//        'KODE_ITEM_PERKEMBANGAN',
//        'KODE_PERKEMBANGAN',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_PO_ITEM',
//        'QTY_PERKEMBANGAN',
        'QTY_DISETUJUI',
    );
    
    public $columns_conf = array(
//        'KODE_ITEM_PERKEMBANGAN'=>array('hidden'=>'true'),
//        'KODE_PERKEMBANGAN'=>array('hidden'=>'true'),
//        'KODE_PO'=>array('hidden'=>'true'),
//        'KODE_KONTRAK'=>array('hidden'=>'true'),
//        'KODE_KANTOR'=>array('hidden'=>'true'),
//        'KODE_PO_ITEM'=>array('hidden'=>'true'),
        
        'KODE_BARANG_JASA',
        'NAMA_BARANG_JASA',
        'SATUAN',
        'JUMLAH_PO',
        'JUMLAH_ITEM_TEKIRIM',
//        'QTY_DISETUJUI',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->sql_select = "(
            select a.*, a.QTY_PERKEMBANGAN as JUMLAH_ITEM_TEKIRIM, b.satuan, b.qty as jumlah_po, b.kode_barang_jasa, b.keterangan as nama_barang_jasa
            from EP_KTR_PO_ITEM_PERKEMBANGAN a
            right join EP_KTR_PO_ITEM b on 
                    a.kode_po_item = b.kode_po_item
                and a.kode_po = b.kode_po
                and a.kode_kontrak = b.kode_kontrak
                and a.kode_kantor = b.kode_kantor
        )";
    }

    function _default_scope() {
        parent::_default_scope();
        
        if(isset($_REQUEST['KODE_PO']) 
            && isset($_REQUEST['KODE_KANTOR']) 
            && isset($_REQUEST['KODE_KONTRAK'])
            && isset($_REQUEST['KODE_PERKEMBANGAN']))
        return " KODE_PO = '".$_REQUEST['KODE_PO']."'
                AND KODE_KANTOR = '".$_REQUEST['KODE_KANTOR']."'
                AND KODE_KONTRAK = '".$_REQUEST['KODE_KONTRAK']."'
                AND KODE_PERKEMBANGAN = '".$_REQUEST['KODE_PERKEMBANGAN']."'";
    }
}

?>