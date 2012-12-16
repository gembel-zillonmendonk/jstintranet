<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan_evaluasi extends MY_Controller {
 	
	function __construct()
        {
            parent::__construct();		  
	}

	function teknis() {
		$this->load->view("pengadaan_evaluasi_teknis");
	}
        
        function harga() {
		$this->load->view("pengadaan_evaluasi_harga");
	}
         
}	