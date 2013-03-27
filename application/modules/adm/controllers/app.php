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
            $sql .= " FROM MS_JABATAN WHERE KODE_JABATAN ";
            $sql .= " IN (SELECT DISTINCT KODE_JABATAN FROM EP_MS_MENU_JABATAN )  ";
            $sql .= " ORDER BY NAMA_JABATAN ";
            
            
            $query = $this->db->query($sql);
            $data["rsjabatan"] = $query->result();
             
            $this->load->view("login", $data);
             
            // $this->load->view("blank" );
                 
	} 
	
        
        function signin() {
            
            $kode_kantor = $this->uri->segment(4); 
            $kode_fungsi = $this->uri->segment(5);
            
            
            $sql = "SELECT KODE_JABATAN FROM EP_MS_FUNGSI_JABATAN WHERE KODE_FUNGSI = " . $kode_fungsi;
            
            
            $query = $this->db->query($sql);
            $result = $query->result();
            if (count($result)) {
                $kode_jabatan = $result[0]->KODE_JABATAN;
            }
            
            
            if  (strlen($kode_kantor) == 0){
                $this->logout();  
                exit();
            }
        
            // DECRYPT DULU 
            
            $sql = "SELECT p_hr_crypt_exim.fn_decrypt('" . $this->uri->segment(6) . "') as KODE_USER ";
            $sql .= " FROM DUAL "; 

            
            
            $query = $this->db->query($sql);
            $result = $query->result();
            
            /*
             * 
             * 
             *  ex. url http://localhost:8888/jstintranet/index.php/adm/app/signin/81/325/F5249F9F8462A20D/01072013
             * SELECT p_hr_crypt_exim.fn_encrypt('UC')
                FROM DUAL

                SELECT p_hr_crypt_exim.fn_decrypt('F5249F9F8462A20D')
                FROM DUAL
             * 
             */
            
            $kode_user =  $result[0]->KODE_USER; // $this->uri->segment(6); 
            $waktu_login = $this->uri->segment(7); 
            
            
            /*
            echo "<br/>kode_kantor:"  . $kode_kantor;
            echo "<br/>kode_jabatan:" . $kode_jabatan;
            echo "<br/>kode_user:" . $kode_user;
            echo "<br/>waktu_login:" . $waktu_login;
             */
             
            $sql = "SELECT KODE_KANTOR, NAMA_KANTOR FROM MS_KANTOR ";
		$sql .= " WHERE KODE_KANTOR = '" . $kode_kantor . "' ";
		
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
                
                 
		if(count($result)) {
			$this->session->set_userdata("kode_user", $kode_user );
			$this->session->set_userdata("user_id", $kode_user );
			$this->session->set_userdata("kode_kantor", $kode_kantor );
			$this->session->set_userdata("nama_kantor", $result[0]->NAMA_KANTOR);
			
		} 
		$sql = "SELECT KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN ";
		$sql .= " WHERE KODE_JABATAN = '" . $kode_jabatan . "' ";
		
               // echo $sql;
                
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
                // print_r($result);
                
		if(count($result)) {  
			$this->session->set_userdata("kode_jabatan", $kode_jabatan );
			$this->session->set_userdata("nama_jabatan", $result[0]->NAMA_JABATAN);
		}
                
              //  print_r($this->session->userdata );
                
                  redirect(base_url(). "index.php/adm/welcome")  ;
			
            
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