<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends MY_Controller {
 	
	function __construct() {
            parent::__construct();		  
	}

	function index() {
            $this->layout->view("tool_list");
	}
        
        function batalkan() {
            $this->layout->view("tool_batalkan_list");
	}
        
        
        function batalkan_pengadaan(){
              
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            
              $data["kode_aktifitas"] = 1210;
              $data["kode_komentar"] =  0;
              $data["kode_alurkerja"] =  0;    
            
           $this->layout->view("pengadaan_batalkan", $data);
        }
        
        
        function update_tanggal() {
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            
            
             $sql = "SELECT TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG, TGL_PRE_LELANG, LOKASI_PRE_LELANG, TGL_PEMBUKAAN_LELANG  ";
             $sql .= "FROM EP_PGD_PERSIAPAN_TENDER ";
             $sql .= " WHERE KODE_TENDER =  '" . $data["kode_tender"] . "'" ;
             $sql .= " AND KODE_KANTOR =  '" . $data["kode_kantor"] . "' " ;
              
             $query = $this->db->query($sql);
             $result = $query->result(); 
             
             if (count($result)) {
                 if (strlen($result[0]->TGL_PEMBUKAAN_REG) > 0) {
                        $data["TGL_PEMBUKAAN_REG"] = $result[0]->TGL_PEMBUKAAN_REG;
                        $data["TGL_PENUTUPAN_REG"] = $result[0]->TGL_PENUTUPAN_REG;
                        $data["TGL_PRE_LELANG"] = $result[0]->TGL_PRE_LELANG;
                        $data["LOKASI_PRE_LELANG"] = $result[0]->LOKASI_PRE_LELANG;
                        $data["TGL_PEMBUKAAN_LELANG"] = $result[0]->TGL_PEMBUKAAN_LELANG;

                     
                     
                 }
                 
                 
             }
             
            
            $this->layout->view("pengadaan_update_tanggal", $data);
        }
         
        
        
        
}	