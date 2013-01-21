<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_siup extends MY_Model
{
	public $dir = "temp";
    public $table = "EP_VENDOR_TEMP";
    public $elements_conf = array(
        'SIUP_DITERBITKAN_OLEH',
        'NO_SIUP',
        'TIPE_SIUP'=> array('label' => 'JENIS SIUP', 'type' => 'dropdown', 'options' => array('KECIL'=>'KECIL','MENENGAH'=>'MENENGAH','BESAR' => 'BESAR','TBK' => 'TBK')),
        'DARI_TGL_SIUP',
        'SAMPAI_TGL_SIUP',
    );
    public $validation = array(
        'SIUP_DITERBITKAN_OLEH' => array('required' => true),
        'NO_SIUP' => array('required' => true),
        'TIPE_SIUP' => array('required' => true),
        'DARI_TGL_SIUP' => array('required' => true),
        'SAMPAI_TGL_SIUP' => array('required' => true),
    );
    public $columns_conf = array(
        'SIUP_DITERBITKAN_OLEH',
        'NO_SIUP',
        'TIPE_SIUP',
        'DARI_TGL_SIUP' => array('formatter' => 'date', 'formatoptions' => array('srcformat'=>'d-m-Y H:i:s', 'newformat'=>'d-m-Y')),
        'SAMPAI_TGL_SIUP' => array('formatter' => 'date', 'formatoptions' => array('srcformat'=>'d-m-Y H:i:s', 'newformat'=>'d-m-Y')),
    );
    public $sql_select = "(select * from EP_VENDOR_TEMP)";

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
