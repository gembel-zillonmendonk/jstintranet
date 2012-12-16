<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan_evaluasi extends MY_Controller {
 	
	function __construct()
        {
            parent::__construct();		  
	}

        
    
        
        
        function komentar_teknis($kode_vendor, $nama_vendor){
            
            if ($this->input->post("KODE_VENDOR")) {
                
                
                $this->load->model('Nomorurut','urut');
                $urut = $this->urut->get("ALL","KOMENTAREVALUASI");
                 
                $sql = "INSERT INTO EP_PGD_KOMENTAR_EVALUASI (KODE_KOMENTAR";
                $sql .= ", KODE_TENDER ";
                $sql .= ", KODE_KANTOR ";
                $sql .= ", KODE_VENDOR ";
                $sql .= ", NAMA ";
                $sql .= ", NAMA_VENDOR ";
                $sql .= ", KOMENTAR ";
                $sql .= ", TANGGAL ";
                $sql .= ", KOMENTAR_MODE ";
                $sql .= ", TGL_REKAM ";
                $sql .= ", PETUGAS_REKAM )";
                $sql .= " VALUES (" . $urut  ;
                $sql .= ",'" . $this->input->post("KODE_TENDER") . "' ";
                $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                $sql .= ", " . $this->input->post("KODE_VENDOR") . "  ";
                $sql .= ", '" . $this->session->userdata("user_id") . "'  ";
                $sql .= ",'" . $this->input->post("NAMA_VENDOR") . "' ";
                $sql .= ",'" . $this->input->post("KOMENTAR_EVALUASI") . "' ";
                $sql .= ", TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ",'T' ";
                $sql .= ", TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ", '" . $this->session->userdata("user_id") . "')  ";
                
                echo $sql;
                
                if ($this->db->simple_query($sql)){
                       $this->urut->set_plus( "ALL","KOMENTAREVALUASI") ;
                    echo "1";
                } else {
                    
                    echo $sql;
                    
                }
                      print_r($_POST);
                     exit();
            }       
            
            
            
            
            
            $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
            $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
            $data["KODE_VENDOR"] = $kode_vendor;
            $data["NAMA_VENDOR"] = $nama_vendor;
             
            
            
            
            $this->load->view("pengadaan_komentar_teknis", $data);
            
            
        }
        
        
        function komentar_harga($kode_vendor, $nama_vendor){
              
            if ($this->input->post("KODE_VENDOR")) {
                
                
                $this->load->model('Nomorurut','urut');
                $urut = $this->urut->get("ALL","KOMENTAREVALUASI");
                 
                $sql = "INSERT INTO EP_PGD_KOMENTAR_EVALUASI (KODE_KOMENTAR";
                $sql .= ", KODE_TENDER ";
                $sql .= ", KODE_KANTOR ";
                $sql .= ", KODE_VENDOR ";
                $sql .= ", NAMA ";
                $sql .= ", NAMA_VENDOR ";
                $sql .= ", KOMENTAR ";
                $sql .= ", TANGGAL ";
                $sql .= ", KOMENTAR_MODE ";
                $sql .= ", TGL_REKAM ";
                $sql .= ", PETUGAS_REKAM )";
                $sql .= " VALUES (" . $urut  ;
                $sql .= ",'" . $this->input->post("KODE_TENDER") . "' ";
                $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                $sql .= ", " . $this->input->post("KODE_VENDOR") . "  ";
                $sql .= ", '" . $this->session->userdata("user_id") . "'  ";
                $sql .= ",'" . $this->input->post("NAMA_VENDOR") . "' ";
                $sql .= ",'" . $this->input->post("KOMENTAR_EVALUASI") . "' ";
                $sql .= ", TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ",'C' ";
                $sql .= ", TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ", '" . $this->session->userdata("user_id") . "')  ";
                
                echo $sql;
                
                if ($this->db->simple_query($sql)){
                       $this->urut->set_plus( "ALL","KOMENTAREVALUASI") ;
                    echo "1";
                } else {
                    
                    echo $sql;
                    
                }
                      print_r($_POST);
                     exit();
            }       
             
            $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
            $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
            $data["KODE_VENDOR"] = $kode_vendor;
            $data["NAMA_VENDOR"] = $nama_vendor;
              
            $this->load->view("pengadaan_komentar_harga", $data);
        }
        
        
	function teknis() {
            
                
                if ($this->input->post("KODE_TENDER")) {
                    
                     print_r($_POST);
                    
                    $i=0;
                    foreach($_POST["NILAI"] as $k=>$v) {
                    
                    $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                    $sql .= " SET NILAI = " . str_replace(",","",$v);
                    $sql .= " WHERE KODE_VENDOR = " . $_POST["KODE_VENDOR"][$i];
                    $sql .= " AND KODE_KANTOR = '" .$_POST["KODE_KANTOR"]. "'";
                    $sql .= " AND KODE_TENDER = '" .$_POST["KODE_TENDER"]. "'";
                    $sql .= " AND KETERANGAN = '" .$_POST["KETERANGAN"][$i]. "'";
                    
                    $this->db->simple_query($sql);
                    
                  
                    echo $sql;
                    
                    $i++;
                    }
                    
                   $i=0;
                    foreach($_POST["KODE_VENDOR_EVAL"] as $k=>$v) {
                          $sql = "UPDATE EP_PGD_TENDER_EVALUASI ";
                            $sql .= "SET KETERANGAN_TEKNIS = '" . $_POST["KETERANGAN_TEKNIS"][$i] . "'";
                            $sql .= " WHERE KODE_VENDOR = " . $v;
                            $sql .= " AND KODE_KANTOR = '" .$_POST["KODE_KANTOR"]. "'";
                            $sql .= " AND KODE_TENDER = '" .$_POST["KODE_TENDER"]. "'";
                    
                    $this->db->simple_query($sql);
                        $i++;
                    }
                    
                    
                    $sql = "UPDATE EP_PGD_TENDER_EVALUASI E
                            SET E.NILAI_TEKNIS =  
                            (SELECT   SUM((BERAT * COALESCE(NILAI,0)) / 100) AS NILAI_TEKNIS 
                            FROM   EP_PGD_PENAWARAN_TEKNIS T
                            WHERE  E.KODE_TENDER = T.KODE_TENDER AND E.KODE_KANTOR  = T.KODE_KANTOR AND E.KODE_VENDOR = T.KODE_VENDOR )";
          
                    $sql .= " WHERE E.KODE_KANTOR = '" .$_POST["KODE_KANTOR"]. "'";
                    $sql .= " AND E.KODE_TENDER = '" .$_POST["KODE_TENDER"]. "'";

                    
                  
                    
                      $this->db->simple_query($sql);

                    
                    
                    
                    exit();
                }
                
                $sql = "SELECT BOBOT_TEKNIS, GRADE ";
                $sql .= " FROM EP_PGD_TENDER_EVALUASI ";
                $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                
                
                
                
                $query = $this->db->query($sql);
                $result = $query->result();
                
                
                $data["KODE_TENDER"] =   $this->input->get("KODE_TENDER");
                $data["KODE_KANTOR"] =   $this->input->get("KODE_KANTOR");
                
                
                $data["BOBOT_TEKNIS"] = "";
                $data["GRADE"] = "";
                if (count($result)) {
                    $data["BOBOT_TEKNIS"] = $result[0]->BOBOT_TEKNIS;
                    $data["GRADE"] = $result[0]->GRADE;
                }
                
                
                $sql = "SELECT KETERANGAN, BERAT ";
                $sql .= " FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND  COALESCE(BERAT, 0) != 0 ";
                $sql .= " GROUP BY KETERANGAN, BERAT ";
                
                $query = $this->db->query($sql);
                $data["rsitemteknis"] = $query->result();
                
                $sql = "SELECT T.KODE_VENDOR,  V.NAMA_VENDOR, T.NILAI_TEKNIS , T.KETERANGAN_TEKNIS ";
                $sql .= " FROM EP_PGD_TENDER_EVALUASI T ";
                $sql .= " LEFT JOIN EP_VENDOR V ON T.KODE_VENDOR = V.KODE_VENDOR ";
                $sql .= " WHERE T.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND T.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " GROUP BY T.KODE_VENDOR,  V.NAMA_VENDOR , T.NILAI_TEKNIS, T.KETERANGAN_TEKNIS   "; 
                $sql .= " ORDER BY T.KODE_VENDOR ";
                
                
                $query = $this->db->query($sql);
                $data["rsvendor"] = $query->result();
                
                
                $sql = "SELECT T.KODE_VENDOR, T.KETERANGAN, T.KETERANGAN_VENDOR, V.NAMA_VENDOR , T.NILAI ";
                $sql .= " FROM EP_PGD_PENAWARAN_TEKNIS T ";
                $sql .= " LEFT JOIN EP_VENDOR V ON T.KODE_VENDOR = V.KODE_VENDOR ";
                $sql .= " WHERE T.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND T.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " GROUP BY T.KODE_VENDOR, T.KETERANGAN, T.KETERANGAN_VENDOR, V.NAMA_VENDOR , T.NILAI "; 
                $sql .= " ORDER BY T.KETERANGAN, T.KODE_VENDOR ";
                
                
                
                $query = $this->db->query($sql);
                $data["rsvendorteknis"] = $query->result();
                
                
		$this->load->view("pengadaan_evaluasi_teknis", $data);
	}
        
        function harga() {
            
                    if ($this->input->post("KODE_TENDER")) {

                         $this->load->model('Evaluasi_harga','eval');
                         $this->eval->setNilaiHarga($_POST["KODE_TENDER"],$_POST["KODE_KANTOR"]);
                         
                            
                             print_r($_POST);

                             $i=0;
                    foreach($_POST["KODE_VENDOR"] as $k=>$v) {
                          $sql = "UPDATE EP_PGD_TENDER_EVALUASI ";
                            $sql .= "SET KETERANGAN_HARGA = '" . $_POST["KETERANGAN_HARGA"][$i] . "'";
                            $sql .= ", PENAWARAN = '" . (isset($_POST["PENAWARAN_" . $v]) ? $_POST["PENAWARAN_" . $v] : 0 )  . "'";
                            $sql .= ", BID_BOND = '" . (isset($_POST["BIDBOND_" . $v]) ? $_POST["BIDBOND_" . $v] : 0 )  . "'";
                            $sql .= " WHERE KODE_VENDOR = " . $v;
                            $sql .= " AND KODE_KANTOR = '" .$_POST["KODE_KANTOR"]. "'";
                            $sql .= " AND KODE_TENDER = '" .$_POST["KODE_TENDER"]. "'";
                    
                    $this->db->simple_query($sql);
                        $i++;
                    }
                    
                             
                             exit();
                    }
            
                 $data["KODE_TENDER"] =   $this->input->get("KODE_TENDER");
                 $data["KODE_KANTOR"] =   $this->input->get("KODE_KANTOR");
                 
                    
                 $this->load->model("crosstab");
                 
                 $strwhere ="P.KODE_VENDOR = V.KODE_VENDOR AND P.KODE_BARANG_JASA =  J.KODE_BARANG_JASA AND P.KODE_SUB_BARANG_JASA =  J.KODE_SUB_BARANG_JASA ";
                 $strwhere .=" AND P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND  P.KODE_BARANG_JASA =  T.KODE_BARANG_JASA AND P.KODE_SUB_BARANG_JASA =  T.KODE_SUB_BARANG_JASA " ;
                 $strwhere .=" AND P.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                 $strwhere .=" AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                 
                 
                 $sql = $this->crosstab->PivotTableSQL($this->db, "EP_PGD_ITEM_PENAWARAN P, EP_VENDOR V, VW_BARANG_JASA J, EP_PGD_ITEM_TENDER T ", "P.KODE_BARANG_JASA, J.NAMA_BARANG_JASA,  T.HARGA * T.JUMLAH ", "NAMA_VENDOR", $strwhere ,  "P.HARGA * P.JUMLAH","SUM");
        
                 //echo $sql;
                  
                 $query = $this->db->query($sql);
                 
                 $data["arrharga"] = $query->result_array(); 
                 
                 $sql = "SELECT E.KODE_VENDOR , V.NAMA_VENDOR, COALESCE(E.NILAI_HARGA,0) AS  NILAI_HARGA, E.KETERANGAN_HARGA, E.PENAWARAN, E.BID_BOND  ";
                 $sql .= " FROM EP_PGD_TENDER_EVALUASI E ";
                 $sql .= " LEFT JOIN EP_VENDOR V ON E.KODE_VENDOR = V.KODE_VENDOR  ";
                 $sql .= " WHERE E.KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
                 $sql .= " AND E.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                  
                // echo $sql;
                 
                 $query = $this->db->query($sql);
                 $data["rsevalharga"] = $query->result(); 
                 
                 
		$this->load->view("pengadaan_evaluasi_harga", $data);
	}
         
}	