<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class form_suspend extends MY_Model {

    
    public $table = "EP_VENDOR";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array(
        'KODE_VENDOR', 
        'NAMA_VENDOR', 
        'ALAMAT',
        'BERAKHIR_DARI',
        'BERAKHIR_SAMPAI',
        );

    function __construct() {
        parent::__construct();
        $this->init();
        
        if(isset($_REQUEST['KODE_VENDOR'])){
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
        }
    }
    
    function _before_save() {
        parent::_before_save();
        
        $this->attributes['DIAKHIRI_OLEH'] = $this->session->userdata['user_id'];
    }

}

?>
