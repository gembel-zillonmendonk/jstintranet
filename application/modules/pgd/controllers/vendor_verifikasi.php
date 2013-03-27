<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_verifikasi extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
            
            
            
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            $data["kode_vendor"] = $this->input->get("KODE_VENDOR");
            
            
            
		 $this->load->view("vendor_verifikasi_popup", $data);
	}
	
	
	function edit(){
            
            $sql = "SELECT T.KODE_TENDER , T.KODE_KANTOR, T.KODE_VENDOR, V.NAMA_VENDOR
                           FROM EP_PGD_TENDER_VENDOR_STATUS T  
                           LEFT JOIN EP_VENDOR V ON T.KODE_VENDOR = V.KODE_VENDOR ";
            $sql .= " WHERE T.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "' ";
            $sql .= " AND T.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND T.KODE_VENDOR =  " . $this->input->get("KODE_VENDOR") . "  ";
            
            $query= $this->db->query($sql);
            $result = $query->result();
            $data["nama_vendor"] = "";
            if(count($result)) { 
                $data["nama_vendor"] = $result[0]->NAMA_VENDOR ;
                
            }
            
            $sql = "SELECT KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN, STATUS_CEK, VENDOR_CEK   ";
            $sql .= " FROM EP_PGD_PENAWARAN_TEKNIS T ";
            $sql .= " WHERE T.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "' ";
            $sql .= " AND T.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND T.KODE_VENDOR =  " . $this->input->get("KODE_VENDOR") . "  ";
            $sql .= " AND  T.BERAT IS NULL   ";
            
            $query= $this->db->query($sql);
            $data["rs_teknisadm"] = $query->result();
            
            
            $sql = "SELECT KETERANGAN_TEKNIKAL ";
            $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS T ";
            $sql .= " WHERE T.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "' ";
            $sql .= " AND T.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND T.KODE_VENDOR =  " . $this->input->get("KODE_VENDOR") . "  ";
            
            
            $query= $this->db->query($sql);
            $data["rs_status"] = $query->result();
            
            
            
           
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            $data["kode_vendor"] = $this->input->get("KODE_VENDOR");
             
            
            
            
		 $this->load->view("vendor_verifikasi_popup", $data);
	}
	
	 
}