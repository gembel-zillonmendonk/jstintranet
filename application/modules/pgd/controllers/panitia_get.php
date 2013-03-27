<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panitia_get extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("panitia_list_popup");
	}
	
	
	 
}	