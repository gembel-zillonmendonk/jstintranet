<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan_monitor extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function index() {
		$this->layout->view("pengadaan_monitor_list");
	}
        
        function view(){
            
            
            $data["kode_tender"] = $this->input->get("KODE_TENDER");
            $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
            
           $this->load->view("pengadaan_monitor", $data);
           
        }
        
        
        function header() {
            
                $sql = "SELECT T.JUDUL_PEKERJAAN, T.LINGKUP_PEKERJAAN, T.TIPE_KONTRAK, K.NAMA_KANTOR, T.NAMA_PEMOHON, K1.NAMA_KANTOR AS NAMA_KANTOR_KIRIM  ";
                $sql .= " FROM EP_PGD_TENDER T ";
                $sql .= " LEFT JOIN MS_KANTOR K ON T.KODE_KANTOR = K.KODE_KANTOR ";
                 $sql .= " LEFT JOIN MS_KANTOR K1 ON T.KODE_KANTOR_KIRIM = K1.KODE_KANTOR ";
                
                $sql .= " WHERE T.KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
                $sql .= " AND T.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
                
                $query = $this->db->query($sql);
                $result = $query->result();
                $data["judul_pekerjaan"] = "";
                $data["lingkup_pekerjaan"] = "";
                $data["tipe_kontrak"] = "";
                
                
                if (count($result)) {
                    $data["judul_pekerjaan"] = $result[0]->JUDUL_PEKERJAAN; 
                    $data["lingkup_pekerjaan"] = $result[0]->LINGKUP_PEKERJAAN; 
                    $data["tipe_kontrak"] = $result[0]->TIPE_KONTRAK; 
                    $data["nama_kantor"] = $result[0]->NAMA_KANTOR;
                    $data["nama_pemohon"] = $result[0]->NAMA_PEMOHON;
                    $data["nama_kantor_kirim"] = $result[0]->NAMA_KANTOR_KIRIM;
                    
                    
                } 
		$this->load->view("pengadaan_monitor_header", $data);            
        }
        
        
        function metode_pengadaan() {
            $sql = "SELECT P.METODE_TENDER,M.NAMA_METODE_TENDER,  P.METODE_SAMPUL, S.NAMA_METODE_SAMPUL , P.KODE_EVALUASI, P.KETERANGAN_EVALUASI ";
            $sql .= " , P.TGL_PEMBUKAAN_REG, P.TGL_PENUTUPAN_REG, P.TGL_PRE_LELANG, P.LOKASI_PRE_LELANG, P.TGL_PEMBUKAAN_LELANG , P.PTP_INQUIRY_NOTES ";
            $sql .= " FROM EP_PGD_PERSIAPAN_TENDER P "; 
            $sql .= " LEFT JOIN EP_PGD_METODE M ON P.METODE_TENDER = M.METODE_TENDER ";
            $sql .= " LEFT JOIN EP_PGD_SAMPUL S ON P.METODE_SAMPUL = S.METODE_SAMPUL ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_TIPE TE ON E.KODE_TIPE = TE.KODE_TIPE ";
            $sql .= " WHERE P.KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND P.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
                
            $data["nama_metode_tender"] = "";
            $data["nama_metode_sampul"] = "";
            $data["metode_evaluasi"] = "";
            $data["template_evaluasi"] = "";
             $data["keterangan_tambahan"] =  "";
            $data["tgl_pembukaan_reg"] = "";
            $data["tgl_penutupan_reg"] = "";
            $data["tgl_pre_lelang"] = "";
            $data["lokasi_pre_lelang"] = "";
            $data["tgl_pembukaan_lelang"] = "";
            
            $data["kode_klas_vendor_K"] = "";
            $data["kode_klas_vendor_M"] = "";
            $data["kode_klas_vendor_B"] = "";
            

            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                $data["nama_metode_tender"] = $result[0]->NAMA_METODE_TENDER;
                $data["nama_metode_sampul"] = $result[0]->NAMA_METODE_SAMPUL;
                $data["metode_evaluasi"] = "";
                $data["template_evaluasi"] = $result[0]->KETERANGAN_EVALUASI;
                 $data["keterangan_tambahan"] = $result[0]->PTP_INQUIRY_NOTES;
                $data["tgl_pembukaan_reg"] = $result[0]->TGL_PEMBUKAAN_REG;
                $data["tgl_penutupan_reg"] = $result[0]->TGL_PENUTUPAN_REG;
                $data["tgl_pre_lelang"] = $result[0]->TGL_PRE_LELANG;
                $data["lokasi_pre_lelang"] = $result[0]->LOKASI_PRE_LELANG;
                $data["tgl_pembukaan_lelang"] = $result[0]->TGL_PEMBUKAAN_LELANG;

                
            }
            
            $sql  = "SELECT KODE_TENDER ";
            $sql .= " FROM EP_PGD_TENDER_KLASIFIKASI "; 
            $sql .= " WHERE KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND KODE_KLAS_VENDOR = 'K' ";
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                 $data["kode_klas_vendor_K"] = "K";
            }  
            $sql  = "SELECT KODE_TENDER ";
            $sql .= " FROM EP_PGD_TENDER_KLASIFIKASI "; 
            $sql .= " WHERE KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND KODE_KLAS_VENDOR = 'M' ";
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                 $data["kode_klas_vendor_M"] = "M";
            }  
            $sql  = "SELECT KODE_TENDER ";
            $sql .= " FROM EP_PGD_TENDER_KLASIFIKASI "; 
            $sql .= " WHERE KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND KODE_KLAS_VENDOR = 'B' ";
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                 $data["kode_klas_vendor_B"] = "B";
            }  
            
                
             $this->load->view("pengadaan_monitor_metode_pengadaan", $data);         
            
            
        }
        
        
        
        function metode_jadwal() {
            $sql = "SELECT P.METODE_TENDER,M.NAMA_METODE_TENDER,  P.METODE_SAMPUL, S.NAMA_METODE_SAMPUL , P.KODE_EVALUASI, P.KETERANGAN_EVALUASI ";
            $sql .= " , P.TGL_PEMBUKAAN_REG, P.TGL_PENUTUPAN_REG, P.TGL_PRE_LELANG, P.LOKASI_PRE_LELANG, P.TGL_PEMBUKAAN_LELANG, P.PTP_INQUIRY_NOTES ";
            $sql .= " FROM EP_PGD_PERSIAPAN_TENDER P "; 
            $sql .= " LEFT JOIN EP_PGD_METODE M ON P.METODE_TENDER = M.METODE_TENDER ";
            $sql .= " LEFT JOIN EP_PGD_SAMPUL S ON P.METODE_SAMPUL = S.METODE_SAMPUL ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_TIPE TE ON E.KODE_TIPE = TE.KODE_TIPE ";
            
            $sql .= " WHERE P.KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND P.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
                
            $data["nama_metode_tender"] = "";
            $data["nama_metode_sampul"] = "";
            $data["metode_evaluasi"] = "";
            $data["template_evaluasi"] = "";
            $data["keterangan_tambahan"] = "";
            
            $data["tgl_pembukaan_reg"] = "";
            $data["tgl_penutupan_reg"] = "";
            $data["tgl_pre_lelang"] = "";
            $data["lokasi_pre_lelang"] = "";
            $data["tgl_pembukaan_lelang"] = "";
            

            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                $data["nama_metode_tender"] = $result[0]->NAMA_METODE_TENDER;
                $data["nama_metode_sampul"] = $result[0]->NAMA_METODE_SAMPUL;
                $data["metode_evaluasi"] = "";
                $data["template_evaluasi"] = $result[0]->KETERANGAN_EVALUASI;
                $data["keterangan_tambahan"] = $result[0]->PTP_INQUIRY_NOTES;
                $data["tgl_pembukaan_reg"] = $result[0]->TGL_PEMBUKAAN_REG;
                $data["tgl_penutupan_reg"] = $result[0]->TGL_PENUTUPAN_REG;
                $data["tgl_pre_lelang"] = $result[0]->TGL_PRE_LELANG;
                $data["lokasi_pre_lelang"] = $result[0]->LOKASI_PRE_LELANG;
                $data["tgl_pembukaan_lelang"] = $result[0]->TGL_PEMBUKAAN_LELANG;

                
            }
            
                
                
             $this->load->view("pengadaan_monitor_metode_jadwal", $data);         
                 
            
        }
	
         
        
        
        
}	