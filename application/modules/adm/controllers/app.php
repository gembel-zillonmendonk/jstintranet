<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MX_Controller {
 	
	function __construct()
    {
        parent::__construct();
		// $this->load->model('App_security'); 
		// echo $this->App_security->login();

		
		  $this->load->model('App_security','sec' , true);
		
		// print_r($sec);		
	}
	
	
	function index() {
            $sql = "SELECT KODE_JABATAN, NAMA_JABATAN ";
            $sql .= " FROM MS_JABATAN ";
            $sql .= " ORDER BY NAMA_JABATAN ";
            
            
            $query = $this->db->query($sql);
            $data["rsjabatan"] = $query->result();
            
            
            
		 $this->load->view("login", $data);
	} 
	
	function login() {
		 
		if($this->sec->login()) {
			//echo $this->session->userdata("kode_kantor");
			 
			 $this->sec->getMenuAkses($this->session->userdata("kode_jabatan"));
			 echo $this->session->userdata("menu");
			 echo strlen($this->session->userdata("menu"));
			 
			 $this->session->set_userdata("sesi", "xxx");
			 // die();
			 
			 
			 
			 redirect(base_url(). "index.php/adm/welcome")  ;
		} else {
		 	redirect(base_url() . "index.php/adm/app");
		} 
	}
	
	function logout() {
			$this->session->sess_destroy();
			redirect(base_url() . "index.php/adm/app");
	}
	
	

}	