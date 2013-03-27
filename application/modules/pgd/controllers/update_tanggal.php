<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_tanggal extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->layout->view("update_tanggal_list");
	}
        
        function editor() {
             
            
             $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            
            $data["TGL_PEMBUKAAN_REG"] = "";
             $data["TGL_PENUTUPAN_REG"] = "";
             $data["TGL_PRE_LELANG"] = "";
             $data["LOKASI_PRE_LELANG"] = "";
             $data["TGL_PEMBUKAAN_LELANG"] = "";
             $data["TGL_MULAI_PENAWARAN"] = "";
             
             
             $sql = "SELECT TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG, TGL_PRE_LELANG, LOKASI_PRE_LELANG, TGL_PEMBUKAAN_LELANG, TGL_MULAI_PENAWARAN  ";
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
                        $data["TGL_MULAI_PENAWARAN"] = $result[0]->TGL_MULAI_PENAWARAN;
                     
                     
                 }
                 
                 
             }
            
            
           $this->layout->view("update_tanggal", $data);
        }
        
	
        function update_Pembuatan_jadwal() {
   //          print_r($_POST);
              
            if (strlen($this->input->post("TGL_PEMBUKAAN_REG"))) {
                $sql  = " SELECT KODE_TENDER FROM EP_PGD_PERSIAPAN_TENDER ";
                $sql .= " WHERE KODE_TENDER =   '" .$this->input->post("KODE_TENDER") . "' ";
                $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    $sql = "UPDATE EP_PGD_PERSIAPAN_TENDER ";
                    $sql .= " SET  TGL_PEMBUKAAN_REG ='" .$this->input->post("TGL_PEMBUKAAN_REG") . "'  ";
                    $sql .= " , TGL_PENUTUPAN_REG='" .$this->input->post("TGL_PENUTUPAN_REG") . "'  ";
                    $sql .= " , TGL_PRE_LELANG='" .$this->input->post("TGL_PRE_LELANG") . "' ";
                    $sql .= " , LOKASI_PRE_LELANG='" .$this->input->post("LOKASI_PRE_LELANG") . "' ";
                    $sql .= " , TGL_PEMBUKAAN_LELANG= '" .$this->input->post("TGL_PEMBUKAAN_LELANG") . "' ";
                    $sql .= " , TGL_MULAI_PENAWARAN= '" .$this->input->post("TGL_MULAI_PENAWARAN") . "' ";
                    $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";

// echo $sql;
                    
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else{
                         echo "0";

                    }   
                    
                }   else {
                    
                    echo "0";
                }
            }
        }
        
}	