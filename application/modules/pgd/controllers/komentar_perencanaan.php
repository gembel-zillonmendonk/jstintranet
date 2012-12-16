<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komentar_perencanaan extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
                $this->load->model('alurkerja','alur');
                $this->alur->setDebug(0);
	}
 
	
	function update() {
		// print_r($_POST);
                  
                 $this->alur->mulai($this->input->post("kode_alurkerja"));
                 
                 
                 $this->alur->setKodeKomentar($this->input->post("kode_komentar"));
                 //if ($this->input->post("kode_transisi")==287) {
                        $arr = array();
                        $arr["KODE_KOMENTAR"] =  $this->input->post("kode_komentar");
                        $arr["KODE_TENDER"] =  $this->input->post("KODE_TENDER");
                         

                        $this->alur->setParamInitial($arr);
                 //}
              
                 $this->alur->setKomentar($this->input->post("komentar"));
                 $this->alur->setAttachment('attachment');
                 
                 $this->alur->getAktifitasKe($this->input->post("kode_transisi"));
                
                 
                
	
	}
         
	
	
}	
	