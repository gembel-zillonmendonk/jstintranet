<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panitia extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 $this->session->set_userdata('user_id', '7827400');
		$this->load->model('Nomorurut','urut');
		
		 
	}
	
	
	public function index()
	{
			$this->layout->view('ep_ms_kelompok_panitia_list' );
 
	}
	
        public function delete_kelompok(){

             
            $sql = "DELETE FROM EP_MS_KELOMPOK_PANITIA ";
            $sql .= " WHERE KODE_PANITIA=" . $_GET["KODE_PANITIA"] ;
            $sql .= " AND KODE_KANTOR= '" . $_GET["KODE_KANTOR"]. "' ";
              
            $this->db->simple_query($sql);
             
            redirect(base_url() . "index.php/adm/panitia");
            
        }        
        
        public function delete(){
            // print_r($_GET); 
            
            $sql = "DELETE FROM EP_MS_ANGGOTA_PANITIA ";
            $sql .= " WHERE KODE_PANITIA=" . $_GET["KODE_PANITIA"] ;
            $sql .= " AND KODE_KANTOR= '" . $_GET["KODE_KANTOR"]. "' ";
            $sql .= " AND KODE_JABATAN= '" . $_GET["KODE_JABATAN"]. "' ";
             
            $this->db->simple_query($sql);
             
            redirect(base_url() . "index.php/adm/panitia/edit?KODE_PANITIA=" . $_GET["KODE_PANITIA"] . "&KODE_KANTOR=" . $_GET["KODE_KANTOR"]);
        }
        
	public function add() {
	
		if ($this->input->post("nama_panitia")) {
			 // echo $this->input->post("nama_panitia");
			 $urut = $this->urut->get($this->input->post("kode_kantor"),"PANITIA");
			 
			 
			 $sql = "INSERT INTO EP_MS_KELOMPOK_PANITIA (KODE_PANITIA, NAMA_PANITIA, KODE_KANTOR, TGL_REKAM ) ";
			 $sql .= " VALUES (".$urut.",'" . $this->input->post("nama_panitia"). "','" .$this->input->post("kode_kantor"). "',  TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) ";
			 
			// echo $sql;
			 
			 if ($this->db->simple_query($sql)) {
			 
				$this->urut->set_plus($this->input->post("kode_kantor"),"PANITIA");
				echo  $urut ;
				// echo $sql;
			 } else {
				// echo $sql;
				echo "0";
			 }
			 return;
			 
			//redirect(base_url() . "index.php/panitia");
		}
	
		$sql = "SELECT  KODE_JABATAN,NAMA_JABATAN FROM MS_JABATAN ";
		$rs = $this->db->query($sql);
		$data["kode_jabatan"] = $rs->result_array();
		
		$sql = "SELECT  KODE_KANTOR,NAMA_KANTOR FROM MS_KANTOR ";
		$rs = $this->db->query($sql);
		$data["kode_kantor"] = $rs->result_array();
		
		
		
		
		$this->layout->view('ep_ms_kelompok_panitia_add', $data);
	}
	
	public function edit() {
		
		//print_r($_POST);
		
		if ($this->input->post("add_type") == "add_anggota") {
			 
                    //print_r($_POST);
                    if ($this->input->post("status_pemimpin")  ) {
                        $status_pemimpin = "1";
                        
                        $sql = "UPDATE EP_MS_ANGGOTA_PANITIA ";
                        $sql .= " SET STATUS_PEMIMPIN = '0' ";
                        $sql .= " WHERE KODE_PANITIA=" . $this->input->post("kode_panitia_key") ;
                        $sql .= " AND KODE_KANTOR= '" . $this->input->post("kode_kantor_key"). "' ";

                        $this->db->simple_query($sql);
                         
                        
                    } else {
                        $status_pemimpin = "0";
                        
                    }
                    
                    
			$sql = "INSERT INTO EP_MS_ANGGOTA_PANITIA (KODE_PANITIA,  KODE_KANTOR, KODE_JABATAN, STATUS_PEMIMPIN,   TGL_REKAM ) ";
			 $sql .= " VALUES ( " . $this->input->post("kode_panitia_key") . ",'" .$this->input->post("kode_kantor_key"). "', '" . $this->input->post("kode_jabatan"). "',  '" . $status_pemimpin . "',  TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) ";
			 
			 
                         
			 //echo $this->session->userdata("kode_panitia");
			 
			 $this->db->simple_query($sql);
			 //return;
                         
                          
		}
		
		if (  $this->input->get("KODE_PANITIA") ) {
			 
			$this->session->set_userdata("kode_panitia", $this->input->get("KODE_PANITIA"));
			$this->session->set_userdata("kode_kantor_panitia", $this->input->get("KODE_KANTOR"));
			
		}
		$sql = "SELECT KODE_PANITIA, NAMA_PANITIA FROM EP_MS_KELOMPOK_PANITIA ";
		$sql .= " WHERE KODE_PANITIA = " .  $this->session->userdata("kode_panitia"); 
                $sql .= " AND KODE_KANTOR = '" .  $this->session->userdata("kode_kantor_panitia") . "'"; 
                
            

	 
		
		$query = $this->db->query($sql);
		$result = $query->result();
		
		$data["nama_panitia"] = "";
		if (count($result)) {
			$data["val_nama_panitia"] = $result[0]->NAMA_PANITIA;
		
		}
		
		$kode_kantor = $this->input->get("KODE_KANTOR") ? $this->input->get("KODE_KANTOR") : $this->input->post("kode_kantor_key");
		$kode_panitia =  $this->input->get("KODE_PANITIA") ? $this->input->get("KODE_PANITIA") : $this->input->post("kode_panitia_key");
		
		$data["kode_panitia"] = $kode_panitia;
		$data["kode_kantor_key"] = $kode_kantor;
		
		$this->session->set_userdata('kode_panitia', $kode_panitia );
		
		// echo $kode_kantor;
		$sql = "SELECT  KODE_JABATAN,NAMA_JABATAN FROM MS_JABATAN ";
		$rs = $this->db->query($sql);
		$data["kode_jabatan"] = $rs->result_array();
		
		$sql = "SELECT  KODE_KANTOR,NAMA_KANTOR FROM MS_KANTOR ";
		$rs = $this->db->query($sql);
		$data["kode_kantor"] = $rs->result_array();
		
		 
		$this->layout->view('ep_ms_kelompok_panitia_edit', $data);
	}
	 
}
