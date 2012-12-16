<?php

class ep_ktr_kontrak_dok extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_DOK';
    public $elements_conf = array(
//        'KODE_DOKUMEN',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
        'STATUS_PUBLISH',
    );
    public $columns_conf = array(
        'KODE_DOKUMEN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
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
        }
    }

    function _default_scope()
    {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return " KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'" .
                   " AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'";
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