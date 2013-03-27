<?php

class ep_ktr_kontrak_dok extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_DOK';
    public $elements_conf = array(
//        'KODE_DOKUMEN',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_KATEGORI'=>array('type'=>'dropdown','options'=>array(
            'KONTRAK_UTAMA'=>'KONTRAK UTAMA',
            'PERSYARATAN_KHUSUS'=>'PERSYARATAN KHUSUS',
            'LINGKUP_PEKERJAAN'=>'LINGKUP PEKERJAAN',
            'HARGA_PEMBAYARAN'=>'HARGA & PEMBAYARAN',
            'LAINNYA'=>'LAINNYA',
            )),
        'KETERANGAN',
        'NAMA_FILE'=>array('type'=>'file'),
//        'STATUS',
        'STATUS_PUBLISH'=>array('type'=>'checkbox', 'options'=>'1'),
    );
    public $columns_conf = array(
        'KODE_DOKUMEN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
//        'STATUS',
        'STATUS_PUBLISH',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
        
        if (isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
        {
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//            $this->elements_conf['STATUS_PUBLISH']['value'] = (isset($_REQUEST['STATUS_PUBLISH']) && $_REQUEST['STATUS_PUBLISH'] > 0 ? 1 : 0);
        }
    }

    function _default_scope()
    {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return " KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'" .
                   " AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'";
    }
    
    public function _before_save() {
        parent::_before_save();
        
        if (isset($this->attributes['NAMA_FILE']) && strlen($this->attributes['NAMA_FILE']) == 0)
            unset($this->attributes['NAMA_FILE']);
    }
    
    public function _before_update() {
        parent::_before_update();
        $this->attributes['STATUS_PUBLISH'] = (isset($_REQUEST['EP_KTR_KONTRAK_DOK']['STATUS_PUBLISH']) && $_REQUEST['EP_KTR_KONTRAK_DOK']['STATUS_PUBLISH'] > 0 ? 1 : 0);
    }
    
    public function _before_insert() {
        parent::_before_insert();
        // set auto increament
        if ($this->attributes['KODE_DOKUMEN'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_KONTRAK_DOK'")->row_array();
            $this->attributes['KODE_DOKUMEN'] = $row['NEXT_ID'];
        }
    }
    
    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_KTR_KONTRAK_DOK'");
    }
}

?>