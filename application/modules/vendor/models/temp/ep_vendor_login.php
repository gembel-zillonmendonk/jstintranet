<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_login extends MY_Model
{
    public $table = "EP_VENDOR_TEMP";
    public $elements_conf = array(
        'KODE_LOGIN',
        'ALAMAT_EMAIL',
    );

    public $dir = "temp";
    function __construct()
    {
        parent::__construct();
        $this->init();
        
        // set default value here
        $CI =& get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('user_id');
    }
}
?>
