<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kel_barang extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
	 
	}
	
	function index() {
			$this->layout->view('kel_barang_list' );
	}	
	 
	
	
}	
	