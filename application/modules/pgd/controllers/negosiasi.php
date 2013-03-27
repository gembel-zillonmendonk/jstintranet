<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negosiasi extends MY_Controller {
 	
	function __construct(){
        parent::__construct();		  
	}
        

	function add() { 
                if($this->input->post("KODE_TENDER")) {
                    print_r($_POST);
                  
                   if($this->input->post("KODE_VENDOR_PESAN"))  {
                         $v =  $this->input->post("KODE_VENDOR_PESAN");

                          $this->load->model('Nomorurut','urut');
         
                        $urut = $this->urut->get("ALL","PESANTENDER");
                         
                        $sql = "INSERT INTO EP_PGD_PESAN_TENDER (KODE_PESAN_TENDER";
                        $sql .= " , KODE_TENDER ";
                        $sql .= " , KODE_KANTOR ";
                        $sql .= " , KODE_VENDOR ";
                        $sql .= " , NAMA_AKTIFITAS ";
                        
                        $sql .= " , TGL_PESAN ";
                        $sql .= " , MODE_PESAN ";
                        $sql .= " , PESAN ";
                        $sql .= " , TGL_REKAM ";
                        $sql .= " , PETUGAS_REKAM ";
                        $sql .= " ) ";
                        $sql .= " VALUES ( " . $urut;
                        $sql .= " ,'" . $this->input->post("KODE_TENDER") . "'";
                        $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'";
                        $sql .= " , " . $v . "";
                        $sql .= " , 'NEGOSIASI' ";
                        $sql .= " ,  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
                        $sql .= " , 0 ";
                        $sql .= " , '" . $this->input->post("PESAN_". $v) . "'";
                        
                        $sql .= " ,  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
                        $sql .= " ,'" . $this->session->userdata("kode_user") . "')";

                   
                    
                        if($this->db->simple_query($sql)){
                             $this->urut->set_plus( "ALL","PESANTENDER") ;

                             $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS ";
                             $sql .= " SET STATUS = 10 ";
                             $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'"; 
                             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR_PESAN");

                             
                             $this->db->simple_query($sql);
                             echo "1";
                        } else {
                            echo $sql; 
                        }


                    }  else {
                        echo "0";
                    }
                     
                    
                    
                    exit();
                    
                    
                    
                }
                
                $sql = "SELECT KODE_VENDOR, NAMA_VENDOR ";
                $sql .= " FROM (SELECT E.KODE_TENDER
	   , E.KODE_KANTOR
	   ,  V.KODE_VENDOR
	   , V.NAMA_VENDOR
	   , CASE
	   	 	 WHEN PTVS.TEKNIKAL_STATUS = 1 THEN 'LULUS'
			 ELSE 'TIDAK LULUS'
	   	 END AS ADM
	   , E.NILAI_TEKNIS AS NILAI_TEKNIS
	   ,   E.GRADE AS PASSING_GRADE
	   , CASE
	   	 	 WHEN E.NILAI_TEKNIS >=  E.GRADE THEN 'LULUS'
			 ELSE 'TIDAK LULUS'
	   	 END AS  LULUS
	   , H.TOTAL  AS HARGA
	   , E.NILAI_HARGA AS NILAI_HARGA
	   , 'Teknis: ' || COALESCE(E.BOBOT_TEKNIS * E.NILAI_TEKNIS / 100, 0) || '<br/>' || 'Harga: ' || COALESCE(E.BOBOT_HARGA * E.NILAI_HARGA / 100, 0)   AS NILAI_BOBOT
	   , COALESCE(E.BOBOT_TEKNIS * E.NILAI_TEKNIS / 100, 0)
                      + COALESCE(E.BOBOT_HARGA * E.NILAI_HARGA / 100, 0) AS NILAI_TOTAL
	   , 0 AS PERINGKAT
FROM   EP_PGD_TENDER_EVALUASI E
INNER JOIN EP_VENDOR V ON E.KODE_VENDOR = V.KODE_VENDOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON E.KODE_TENDER = PTVS.KODE_TENDER AND E.KODE_KANTOR = PTVS.KODE_KANTOR AND E.KODE_VENDOR =PTVS.KODE_VENDOR
LEFT JOIN (SELECT KODE_TENDER, KODE_KANTOR ,KODE_VENDOR, SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS TOTAL FROM EP_PGD_ITEM_PENAWARAN
	 GROUP BY  KODE_TENDER, KODE_KANTOR,KODE_VENDOR ) H
	 	  ON 	  H.KODE_TENDER = PTVS.KODE_TENDER AND H.KODE_KANTOR = PTVS.KODE_KANTOR AND H.KODE_VENDOR =PTVS.KODE_VENDOR 
) VW_PGD_TENDER_EVALUASI";
                $sql .= " WHERE KODE_KANTOR = '" .$this->input->get("KODE_KANTOR") . "' ";
                $sql .= " AND KODE_TENDER = '" .$this->input->get("KODE_TENDER") . "' ";
                
                $query = $this->db->query($sql);
                $data["rs_nego"] = $query->result();
                $data["KODE_TENDER"] =  $this->input->get("KODE_TENDER");
                $data["KODE_KANTOR"] =  $this->input->get("KODE_KANTOR");
                 
		$this->load->view("negosiasi", $data);
	}
	
         
	
}	