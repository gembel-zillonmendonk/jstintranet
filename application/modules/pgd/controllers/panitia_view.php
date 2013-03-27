<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panitia_view extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
                 $sql = "SELECT NAMA_PANITIA FROM EP_MS_KELOMPOK_PANITIA ";
                 $sql .= " WHERE KODE_PANITIA = " .  $this->input->get("KODE_PANITIA") . " ";
                 $sql .= " AND KODE_KANTOR = '" .  $this->input->get("KODE_KANTOR") . "' ";
                
                 $query = $this->db->query($sql);
                 $result = $query->result();
            
                $data["NAMA_PANITIA"] = "";
                if (count($result)) {
                    $data["NAMA_PANITIA"] = $result[0]->NAMA_PANITIA;
                }
                
                 
                 
                $data["KODE_PANITIA"] = $this->input->get("KODE_PANITIA");
                 $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
                 
                 
                 
            
		 $this->load->view("panitia_view", $data);
	}
	
	
	 
}	