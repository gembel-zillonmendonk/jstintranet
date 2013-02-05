<?php

class ep_ktr_perubahan_jangka extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_JANGKA';
    public $elements_conf = array(
//        'KODE_PERUBAHAN',
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'PERSENTASI',
        'JUMLAH_UANG',
        'TGL_TARGET',
        'KETERANGAN',
    );
    
    public $columns_conf = array(
//        'KODE_PERUBAHAN',
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'PERSENTASI',
        'JUMLAH_UANG',
        'TGL_TARGET',
        'KETERANGAN',
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();
        
        if(isset($_REQUEST['KODE_PERUBAHAN']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
        {
            $this->attributes['KODE_PERUBAHAN'] = $_REQUEST['KODE_PERUBAHAN'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
        }
    }

    function _default_scope() {
        parent::_default_scope();
        
        return " kode_kontrak = '".$_REQUEST['KODE_KONTRAK']."'";
    }
}

?>