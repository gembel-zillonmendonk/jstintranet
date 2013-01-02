<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pilih_pemenang extends MY_Controller {
 	
	function __construct(){
        parent::__construct();		  
	}
        

	function add() { 
                 
                $sql = "SELECT KODE_VENDOR, NAMA_VENDOR ";
                $sql .= " FROM VW_PGD_TENDER_EVALUASI";
                $sql .= " WHERE ADM = 'LULUS' ";
                $sql .= " AND LULUS = 'LULUS' ";
                $sql .= " AND KODE_KANTOR = '" .$this->input->get("KODE_KANTOR") . "' ";
                $sql .= " AND KODE_TENDER = '" .$this->input->get("KODE_TENDER") . "' ";
                
                $query = $this->db->query($sql);
                $data["rs_calon"] = $query->result();
                $data["KODE_TENDER"] =  $this->input->get("KODE_TENDER");
                $data["KODE_KANTOR"] =  $this->input->get("KODE_KANTOR");
                 
		$this->load->view("pilih_pemenang", $data);
	}
	
         
	
}	