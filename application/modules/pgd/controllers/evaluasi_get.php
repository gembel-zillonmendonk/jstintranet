<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluasi_get extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("evaluasi_list_popup");
	}
	
	
	 
}	