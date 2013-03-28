<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MX_Controller {
 	
	function __construct() {
            parent::__construct();
            $this->load->model('Nomorurut','urut');
            
        }
	
	function index() {
            $urut = $this->urut->get("ALL","TENDER");
            echo $urut;
            $this->urut->set_plus("ALL","TENDER");
            $urut = $this->urut->get("ALL","TENDER");
            echo $urut;
            echo "TEST NOMOR URUT";
        } 
        
        
        function pengadaan_ulang($kode_tender, $kode_kantor) {
            $this->load->model('Pengadaan_ulang','ulang');
            
            $this->ulang('201302.44A.00004', '44A');
            
            
        }
	 
}	
	