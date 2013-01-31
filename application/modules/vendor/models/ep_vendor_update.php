<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_update extends MY_Model
{
    public $table = "EP_VENDOR";
    public $elements_conf = array(
        'NAMA_VENDOR' => array('type' => 'label'),
        'ALAMAT_EMAIL' => array('type' => 'email'),
    );
    public $validation = array(
        'ALAMAT_EMAIL' => array('required' => true),
    );
    public $columns_conf = array(
        'ALAMAT_EMAIL',
        'NAMA_VENDOR',
    );

    //public $sql_select = "(select * from EP_VENDOR)";


    function __construct()
    {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
    }
}
?>
