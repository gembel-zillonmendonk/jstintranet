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
class form_unsuspend extends MY_Model {

    
    public $table = "EP_VENDOR";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_VENDOR', 'NAMA_VENDOR', 'ALAMAT','ALAMAT_EMAIL');
    

    function __construct() {
        parent::__construct();
        $this->init();
        
    }

}

?>
