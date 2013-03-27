<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penawaran_history extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("penawaran_history");
	}
        
        function view() {
                
         
            
        $sql = "SELECT    KODE_TENDER";
        $sql .= " , KODE_KANTOR";
        $sql .= " , KODE_VENDOR";
        $sql .= " , NO_PENAWARAN";
        $sql .= " , TIPE";
        $sql .= " , BID_BOND";
        $sql .= " , KANDUNGAN_LOKAL";
        $sql .= " , WAKTU_PENGIRIMAN";
        $sql .= " , UNIT";
        $sql .= " , TO_CHAR(BERLAKU_HINGGA , 'DD-MM-YYYY') AS BERLAKU_HINGGA";
        $sql .= " , LAMPIRAN";
        $sql .= " , KETERANGAN ";
        $sql .= " FROM EP_PGD_HIST_PENAWARAN ";
        
        $sql .= " WHERE KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->input->get("KODE_VENDOR") . " ";
        $sql .= " AND KODE_HIST_PENAWARAN =  " . $this->input->get("KODE_HIST_PENAWARAN") . " ";
        
        
         $query = $this->db->query($sql);
         $result = $query->result();
        
         
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
         
        
        $data["NO_PENAWARAN"] = "";
        $data["TIPE"] = "";
        $data["BID_BOND"] = "";
        $data["KANDUNGAN_LOKAL"] = "";
        $data["WAKTU_PENGIRIMAN"] = "";
        $data["UNIT"] = "";
        $data["BERLAKU_HINGGA"] = "";
        $data["LAMPIRAN"] = "";
        $data["KETERANGAN"] = "";
            
        if (count($result)) {
            $data["NO_PENAWARAN"] = $result[0]->NO_PENAWARAN;
            $data["TIPE"] = $result[0]->TIPE;
            $data["BID_BOND"] = $result[0]->BID_BOND;
            $data["KANDUNGAN_LOKAL"] = $result[0]->KANDUNGAN_LOKAL;
            $data["WAKTU_PENGIRIMAN"] = $result[0]->WAKTU_PENGIRIMAN;
            $data["UNIT"] = $result[0]->UNIT;
            $data["BERLAKU_HINGGA"] = $result[0]->BERLAKU_HINGGA;
            $data["LAMPIRAN"] = $result[0]->LAMPIRAN;
            $data["KETERANGAN"] = $result[0]->KETERANGAN;
        }
         
        
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR, COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR AND D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) = 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->input->get("KODE_VENDOR"). " ";
        
        
       // echo $sql;
        
        $query = $this->db->query($sql);
        $data["rsadm"] = $query->result();
       
         
        
         
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR,     COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR   AND   D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) != 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->input->get("KODE_VENDOR") . " ";
       
                $query = $this->db->query($sql);
                $data["rsteknis"] = $query->result();
                
// echo $sql;
                
           //     print_r($data["rsteknis"]);
        
       // print_r( $data["rsadm"]);
                
               $sql = "SELECT T.KODE_BARANG_JASA  
                        , T.KODE_BARANG_JASA
                        , T.KODE_SUB_BARANG_JASA
                        , T.KETERANGAN
                        , T.UNIT
                        , T.JUMLAH
                        , T.HARGA 
                        , P.HARGA_PENAWARAN 
                        , P.JUMLAH_PENAWARAN 
                        , P.KETERANGAN AS KETERANGAN_PENAWARAN
                FROM EP_PGD_ITEM_TENDER T 
                LEFT JOIN ( 
                           SELECT     KODE_KANTOR
                           , KODE_TENDER
                           , KODE_VENDOR
                           , KODE_BARANG_JASA
                           , KODE_SUB_BARANG_JASA
                           , KETERANGAN
                           , JUMLAH AS JUMLAH_PENAWARAN
                           , HARGA AS HARGA_PENAWARAN
                           FROM EP_PGD_ITEM_PENAWARAN ";
                $sql .= " WHERE  KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND  KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND  KODE_VENDOR =  " . $this->input->get("KODE_VENDOR")  . "  ";
                $sql .= " ) P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR AND T.KODE_BARANG_JASA = P.KODE_BARANG_JASA  AND T.KODE_SUB_BARANG_JASA = P.KODE_SUB_BARANG_JASA ";
                $sql .= " WHERE T.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND T.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                 
                // echo $sql;
                
                $query = $this->db->query($sql);
                $data["rskomersial"] = $query->result();
                
              //  print_r($data["rskomersial"]);
            
            
                $this->load->view("penawaran_history", $data);
        }
	
	
	 
}	