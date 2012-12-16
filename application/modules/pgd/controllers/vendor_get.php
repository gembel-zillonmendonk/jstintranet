<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_get extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            
            
            
		 $this->load->view("vendor_list_popup", $data);
	}
	
	
	 
}	