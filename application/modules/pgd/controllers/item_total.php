<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_total extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function total() {
           
            
            $sql = "SELECT KODE_TENDER ";
            $sql .= " , KODE_KANTOR ";
            $sql .= " , PAGU_ANGGARAN ";
            $sql .= " , SISA_ANGGARAN ";
            $sql .= " , HPS_TOTAL ";
            $sql .= " , PPN ";
            $sql .= " , HPS_PPN ";
            $sql .= " FROM VW_TOTAL_HPS ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR"). "' ";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            $data["PAGU_ANGGARAN"] = 0;
            $data["SISA_ANGGARAN"] = 0;
            $data["HPS_TOTAL"] = 0;
            $data["PPN"] = 0;
            $data["HPS_PPN"] = 0;
            
            if (count($result)) {
                $data["PAGU_ANGGARAN"] = $result[0]->PAGU_ANGGARAN;
                $data["SISA_ANGGARAN"] = $result[0]->SISA_ANGGARAN;
                $data["HPS_TOTAL"] =  $result[0]->HPS_TOTAL;
                $data["PPN"] =  $result[0]->PPN;
                $data["HPS_PPN"] =  $result[0]->HPS_PPN;
                
            }
            
            
            
		$this->load->view("item_total", $data);
	}
	 
	
}	