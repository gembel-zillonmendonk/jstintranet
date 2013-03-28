<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan_pgd extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
        $this->load->model("opsi", "opsi");
        
	}
	
	function index(){
		 $this->layout->view("pekerjaan_pgd_list");
	}
	
        
        function update_peringkat() {
             
            $sql = "UPDATE EP_PGD_TENDER_EVALUASI ";
            $sql .= " SET USULAN_PERINGKAT = " . $this->input->post("USULAN_PERINGKAT");
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";         
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";         
            $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR") ;       
            
            if ($this->db->simple_query($sql) ) {
                echo "1";
            } else {
                echo $sql;
            }
            
            
        }
        
        function verifikasi_admin_vendor(){
         
                 
            // Update check Vendor Admin
            
            $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
            $sql .= " SET STATUS_CEK = NULL ";
            $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER"). "'";
            $sql .= " AND KODE_KANTOR = '" .$this->input->post("KODE_KANTOR"). "'";
            $sql .= " AND KODE_VENDOR =  " .$this->input->post("KODE_VENDOR"). "";
            
            $this->db->simple_query($sql);
            
            foreach($_POST as $k=>$v) {
                if (substr($k,0,9) == 'chkverify' ) {
                     $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                        $sql .= " SET STATUS_CEK =  " . $v;
                        $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER"). "'";
                        $sql .= " AND KODE_KANTOR = '" .$this->input->post("KODE_KANTOR"). "'";
                        $sql .= " AND KODE_VENDOR =  " .$this->input->post("KODE_VENDOR"). "";
                        $sql .= " AND KETERANGAN =  '" .  str_replace("_"," ", substr($k,11)). "'";
                           
                     //   echo $sql;
                        
                        $this->db->simple_query($sql);
                          
                }
                
            }
            
            $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS ";
            $sql .= " SET KETERANGAN_TEKNIKAL = '" . $this->input->post("KETERANGAN") . "'";
            $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER"). "'";
            $sql .= " AND KODE_KANTOR = '" .$this->input->post("KODE_KANTOR"). "'";
            $sql .= " AND KODE_VENDOR =  " .$this->input->post("KODE_VENDOR"). "";
           
                        $this->db->simple_query($sql);
            // echo $sql;
            $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS S 
                    SET STATUS = (SELECT   

                                             CASE 
                                                      WHEN MIN (COALESCE(T.STATUS_CEK,0)) = 0 AND COALESCE(P.METODE_SAMPUL,0) > 0 THEN -4
                                                      WHEN MIN (COALESCE(T.STATUS_CEK,0)) = 0 AND COALESCE(P.METODE_SAMPUL,0) = 0 THEN -7
                                                      WHEN MIN (COALESCE(T.STATUS_CEK,0)) = 1 AND COALESCE(P.METODE_SAMPUL,0) > 0 THEN 4
                                                      WHEN MIN (COALESCE(T.STATUS_CEK,0)) = 1 AND COALESCE(P.METODE_SAMPUL,0) = 0 THEN 7
                                                      

                                            END AS STS	  		  

                                    FROM EP_PGD_PENAWARAN_TEKNIS T
                                    INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER =  P.KODE_TENDER AND  T.KODE_KANTOR= P.KODE_KANTOR
                                    WHERE  T.KODE_TENDER =  S.KODE_TENDER AND  T.KODE_KANTOR= S.KODE_KANTOR AND T.KODE_VENDOR = S.KODE_VENDOR AND T.BERAT IS NULL
                                    GROUP BY T.KODE_TENDER, T.KODE_KANTOR, T.KODE_VENDOR,P.METODE_SAMPUL)  ";
                        $sql .= " WHERE S.KODE_TENDER = '" .$this->input->post("KODE_TENDER"). "'";
                        $sql .= " AND S.KODE_KANTOR = '" .$this->input->post("KODE_KANTOR"). "'";
             if ($this->db->simple_query($sql) ) {
                 echo "1";
                 echo $sql;
             } else {
                 echo $sql;
             }
                        
             //echo $sql;
            
            
             //  print_r($_POST); 
            
            
        }
        
        
        function delete_tender_item() {
                    $sql = "DELETE FROM EP_PGD_ITEM_TENDER  ";
                    $sql .= "WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND  KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND  KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "'";
                    $sql .= " AND  KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "'";
                     
                   // echo $sql;
                    
                    $this->db->simple_query($sql);
                    echo "1";
            
        }
        
        
        function delete_vendor() {
            if ($this->input->post("KODE_TENDER")) {
                $arr = explode("," , $this->input->post("KODE_VENDOR"));
               
                foreach ($arr as $k=>$v) {
                    $sql = "DELETE FROM EP_PGD_TENDER_VENDOR  ";
                    $sql .= "WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND  KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND  KODE_VENDOR = " . $v . "";
                    
                   // echo $sql;
                    
                    $this->db->simple_query($sql);
                    
                    
                    
                    
                }
                echo "1";
            }
        }   
            
        
        function add_vendor() {
            if ($this->input->post("KODE_TENDER")) {
                $sql = "SELECT TV.KODE_TENDER FROM EP_PGD_TENDER_VENDOR TV ";
                $sql .= " INNER JOIN EP_PGD_PERSIAPAN_TENDER PT ON TV.KODE_TENDER = PT.KODE_TENDER AND TV.KODE_KANTOR = PT.KODE_KANTOR ";
                $sql .= " WHERE PT.KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND PT.KODE_KANTOR  = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND PT.METODE_TENDER = 0 ";    
                
                
                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                    echo "0";
                    exit();
                }
                
                $arr = explode("," , $this->input->post("KODE_VENDOR"));
                
                $sql = "SELECT PT.KODE_TENDER FROM EP_PGD_PERSIAPAN_TENDER PT ";
                $sql .= " WHERE PT.KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND PT.KODE_KANTOR  = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND PT.METODE_TENDER = 0 ";    
                
                
                $query = $this->db->query($sql);
                $result = $query->result();
                if (count($result)) {
                    if(count($arr) > 1) {
                    
                        echo "0";
                        exit();
                    }
                }
                
                
                
                
                
                
                
                $arr = explode("," , $this->input->post("KODE_VENDOR"));
                foreach ($arr as $k=>$v) {
                    $sql = "INSERT INTO EP_PGD_TENDER_VENDOR (";
                    $sql .= "KODE_TENDER ";
                    $sql .= ", KODE_KANTOR "; 
                    $sql .= ", KODE_VENDOR ";
                    $sql .= ", TGL_REKAM ";
                    $sql .= ", PETUGAS_REKAM ";
                    $sql .= ") VALUES  ( ";
                    $sql .= "'" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= ",'" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= ", " . $v . "";
                    
                    $sql .= ", TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')";
                    $sql .= ", '".$this->session->userdata("user_id")."')";
                
                    // echo $sql;
                    
                    $this->db->simple_query($sql);
                    
                    
                    
                    
                }
                echo "1";
            }
            
            
            
        }
        
        function update_penata_perencana() {
            
            print_r($_POST);
            
            $arr = explode("-",$this->input->post("NAMA_PERENCANA"));
            
            $sql = "UPDATE EP_PGD_TENDER ";
            $sql .= " SET NAMA_PERENCANA = '" . $arr[1] . "' ";
            $sql .= " , KODE_JAB_PERENCANA = '" . $arr[0] . "' ";
            $sql .= " WHERE KODE_TENDER= '" . $this->input->post("KODE_TENDER") . "'" ;
            $sql .= " AND KODE_KANTOR='" . $this->input->post("KODE_KANTOR") . "'" ;
            
            if ($this->db->simple_query($sql)) {
                echo "1";
                
            } else {
                echo $sql;
                echo "0";
                
            }
        }
        
        
        function update_pemenang() {
            $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS ";
            $sql .= " SET PEMENANG = '1' ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND   KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND   KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
            
            
            if ($this->db->simple_query($sql)) {
                echo "1";
                
            } else {
                 
                echo "0";
                
            }
            
        }
        
        
        function update_penata_pelaksana() {
            
            // print_r($_POST);
            
            $arr = explode("-",$this->input->post("NAMA_PELAKSANA"));
            
            $sql = "UPDATE EP_PGD_TENDER ";
            $sql .= " SET NAMA_PELAKSANA = '" . $arr[1] . "' ";
            $sql .= " , KODE_JAB_PELAKSANA = '" . $arr[0] . "' ";
            $sql .= " WHERE KODE_TENDER='" . $this->input->post("KODE_TENDER") . "' " ;
            $sql .= " AND KODE_KANTOR='" . $this->input->post("KODE_KANTOR") . "'" ;
            
            if ($this->db->simple_query($sql)) {
                echo "1";
                
            } else {
                 
                echo "0";
                
            }
        }
        
        
        function update_item_tender() {
            
            // print_r($_POST);
            
             if ($this->input->post("KODE_BARANG_JASA")) {
                
                
              //   print_r($_POST);
                
               $sql = "SELECT KODE_TENDER ";
               $sql .= " FROM EP_PGD_ITEM_TENDER ";
               $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
               $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
               $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
               $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                 
               
               
               $query = $this->db->query($sql);
               $result = $query->result();
               
               if (count($result)) { 
                        $sql = "UPDATE EP_PGD_ITEM_TENDER ";
                        $sql .= " SET KETERANGAN = '" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= ", JUMLAH = " . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= ", UNIT = '" . $this->input->post("UNIT") . "' ";
                        $sql .= ", PPN = '" . $this->input->post("PPN") . "' ";
                        $sql .= ", HARGA = " . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= ", TGL_UBAH = TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_user") . "'";    
                        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                
               } else {

                        $sql = "INSERT INTO EP_PGD_ITEM_TENDER (
                            KODE_TENDER
                            , KODE_KANTOR
                            , KODE_BARANG_JASA
                            , KODE_SUB_BARANG_JASA
                            , KETERANGAN
                            , JUMLAH
                            , UNIT
                            , HARGA
                            , PPN
                            , TGL_REKAM
                            , PETUGAS_REKAM ) ";
                        $sql .= " VALUES (";
                        $sql .= "'" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= "," . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= ",'" . $this->input->post("UNIT") . "' ";
                        $sql .= "," . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= ",'" . $this->input->post("PPN") . "' ";
                        $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ",'" . $this->session->userdata("kode_user") . "'";    
                        $sql .= ")";
                       }
               // echo $sql; 
                if ($this->db->simple_query($sql)) {
                    echo "1"    ;
                } else {
                    echo "0";
                } 
                
                return;
                
            }
        
            /*
            $sql = "UPDATE EP_PGD_ITEM_TENDER ";
            $sql .= "SET JUMLAH = " . str_replace( ",",".",$this->input->post("JUMLAH"));
            $sql .= ", UNIT = '" . $this->input->post("UNIT"). "'";
            $sql .= ", HARGA = " . str_replace( ",",".",$this->input->post("HARGA"));
            
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER"). "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR"). "'";
            $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA"). "'";
            $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA"). "'";
            
            if ($this->db->simple_query($sql)) {
                
                echo "1";
            } else {
                echo $sql;
            }
             */
            
            
        }            

        function do_ftp($strfile) {
            $this->load->library('ftp');

            $config['hostname'] = '127.0.0.1';
            $config['username'] = 'uc';
            $config['password'] = 'uc';
            $config['port']     = 21;
            $config['passive']  = FALSE;
            $config['debug']    = TRUE;

            $this->ftp->connect($config);
            $this->ftp->upload('./uploaded_test/' . $strfile , $strfile );
            $this->ftp->close();
        }
        
        
        
        
       function do_uploadftp($file, $key) {
            $config = $this->config->item('ftp');

            if ($config['enable']) {
                $name = str_replace(" ", "_", $file[$key]['name']);
                $tmp_name = $file[$key]["tmp_name"];
                $size = $file[$key]['size'];
                $type = $file[$key]['type'];

                try {
                    // check file size
                    if ($size > $config['max_filesize'])
                        return false;

                    $this->load->library('ftp');
                    $this->ftp->connect($config);
                    $this->ftp->upload($tmp_name, $config['target_dir'] . $name);
                    $this->ftp->close();

                    return true;
                } catch (Exception $e) {
                    return false;
                }
            }
            return true;
        }
        
    //public function do_upload($file, $key) {
        public function do_upload() {
   /*
        $config = $this->config->item('ftp');

        if ($config['enable']) {
            $name = $file['name'][$key];
            $tmp_name = $file["tmp_name"][$key];
            $size = $file['size'][$key];
            $type = $file['type'][$key];

            try {
                // check file size
                if ($size > $config['max_filesize'])
                    return false;

                $this->load->library('ftp');
                $this->ftp->connect($config);
                $this->ftp->upload($tmp_name, $config['target_dir'] . $name);
                $this->ftp->close();

                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        return true;
 */
            
           
		$config['upload_path'] = './uploaded_test/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
                
                 $data = array('upload_data' => $this->upload->data());
                if ($this->do_uploadftp($_FILES, "userfile")) {
                    return  str_replace(" ", "",$data['upload_data']['file_name']) ; 
                } else {
                    return "";
                }
                
/*
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//echo $error; 
                        return ''; 
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
                         //print_r($data['upload_data']);
                        $str = './uploaded_test/' . $data['upload_data']['file_name'];
                          
                        
                      
                         if (isset( $str)) {
                            $this->do_ftp($data['upload_data']['file_name']);
                         
                        }
                         
                          
			// $this->load->view('upload_success', $data);
		}
  */
                
	}
        
        
        
        function add_item_tender(){
            if ($this->input->post("KODE_BARANG_JASA")) {
                
                
              //   print_r($_POST);
                
               $sql = "SELECT KODE_TENDER ";
               $sql .= " FROM EP_PGD_ITEM_TENDER ";
               $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
               $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
               $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
               $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                 
               
               
               $query = $this->db->query($sql);
               $result = $query->result();
               
               if (count($result)) { 
                        $sql = "UPDATE EP_PGD_ITEM_TENDER ";
                        $sql .= " SET KETERANGAN = '" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= ", JUMLAH = " . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= ", UNIT = '" . $this->input->post("UNIT") . "' ";
                        $sql .= ", HARGA = " . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= ", TGL_UBAH = TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_user") . "'";    
                        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                
               } else {

                        $sql = "INSERT INTO EP_PGD_ITEM_TENDER (
                            KODE_TENDER
                            , KODE_KANTOR
                            , KODE_BARANG_JASA
                            , KODE_SUB_BARANG_JASA
                            , KETERANGAN
                            , JUMLAH
                            , UNIT
                            , HARGA
                            , TGL_REKAM
                            , PETUGAS_REKAM ) ";
                        $sql .= " VALUES (";
                        $sql .= "'" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= "," . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= ",'" . $this->input->post("UNIT") . "' ";
                        $sql .= "," . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ",'" . $this->session->userdata("kode_user") . "'";    
                        $sql .= ")";
                       }
               // echo $sql; 
                if ($this->db->simple_query($sql)) {
                    echo "1"    ;
                } else {
                    echo "0";
                } 
                
                return;
                
            }
        }
        
        function update_pembelian() {
            
            print_r($_POST);
            
            $sql = "SELECT KODE_TENDER FROM EP_PGD_PEMBELIAN ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
            $sql .= " AND  KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'"; 
            
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                $sql = "UPDATE EP_PGD_PEMBELIAN ";
                $sql .= "SET  NAMA_VENDOR  = '" . $this->input->post("NAMA_VENDOR") . "'"; 
                $sql .= ",  TGL_PEMBELIAN  = TO_DATE('" . substr($this->input->post("TGL_PEMBELIAN"),0,10) . "','YYYY-MM-DD' )   ";
                $sql .= ",  PPN  = " . $this->input->post("PPN") . "";
                $sql .= ",  KETERANGAN  = '" . $this->input->post("KETERANGAN") . "'";
                $sql .= ",  TGL_UBAH = TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ",  PETUGAS_UBAH =  '" . $this->session->userdata("kode_user") . "'";
                $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
                $sql .= " AND  KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'"; 
              
            } else {
                   $sql = "INSERT INTO EP_PGD_PEMBELIAN (KODE_TENDER, KODE_KANTOR, NAMA_VENDOR,TGL_PEMBELIAN, PPN, KETERANGAN, TGL_REKAM, PETUGAS_REKAM ) ";
                   $sql .= " VALUES( '" . $this->input->post("KODE_TENDER") . "' ";
                   $sql .= ", '" . $this->input->post("KODE_KANTOR") . "' ";
                   $sql .= ", '" . $this->input->post("NAMA_VENDOR") . "' ";
                   $sql .= ",  TO_DATE('" . substr($this->input->post("TGL_PEMBELIAN"),0,10) . "','YYYY-MM-DD' )   ";
                   $sql .= ", " . $this->input->post("PPN") . "";
                   $sql .= ", '" . $this->input->post("KETERANGAN") . "'";
                   $sql .= ", TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                   $sql .= ", '" . $this->session->userdata("kode_user") . "') ";
            
                   
            } 
            
           //  echo $sql;
            if ($this->db->simple_query($sql)) {
                echo "1"; 
            } else {
                echo "0";
            }
            
        }
        
        
        function delete_dokumen(){
             
                $sql = "DELETE EP_PGD_DOKUMEN ";
                $sql .= "WHERE KODE_DOKUMEN = " . $this->input->post("KODE_DOKUMEN");
            
                        
                if ($this->db->simple_query($sql)) {
                    echo "1"    ;
                } else {
                    echo "0";
                } 
                
        }
        
        function add_dokumen() {
           //  print_r($_POST); 
            $str_file ="";
               
                if ($this->do_uploadftp($_FILES, "userfile")) {
                    $str_file =   str_replace(" ", "_",$_FILES["userfile"]['name']) ; 
                }  
               
                 
            if (strlen( $str_file)) {
                
            
                    if ($this->input->post("KATEGORI")) {
                        $this->load->model('Nomorurut','urut');	 
                        $urut = $this->urut->get("ALL","TENDERDOKUMEN");	


                        $sql = "INSERT INTO EP_PGD_DOKUMEN ( ";
                        $sql .= "KODE_DOKUMEN ";
                        $sql .= ", KODE_TENDER";
                        $sql .= ", KODE_KANTOR";
                        $sql .= ", KATEGORI";
                        $sql .= ", KETERANGAN";
                        $sql .= ", NAMA_FILE ";
                        $sql .= ", TGL_REKAM";
                        $sql .= ", PETUGAS_REKAM )";
                        $sql .= " VALUES ( ";
                        $sql .=  $urut;
                        $sql .= ", '" . $this->input->post("KODE_TENDER") . "'";
                        $sql .= ", '" . $this->input->post("KODE_KANTOR") . "'";

                        $sql .= ", '" . $this->input->post("KATEGORI") . "'";
                        $sql .= ", '" . $this->input->post("KETERANGAN") . "'";
                        $sql .= ", '".$str_file."'";
                        $sql .= ", TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')";
                        $sql .= ", '".$this->session->userdata("user_id")."')";

                        // echo $sql;
                        if ($this->db->simple_query($sql)){
                            $this->urut->set_plus("ALL","TENDERDOKUMEN");	
                            echo $urut;

                        }


                    }
            
            }
            
        }
        
        
        
         
        function update_item_pembelian() {
            
            // print_r($_POST);
            
             if ($this->input->post("KODE_BARANG_JASA")) {
                
                
              //   print_r($_POST);
                
               $sql = "SELECT KODE_TENDER ";
               $sql .= " FROM EP_PGD_PEMBELIAN_DETAIL ";
               $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
               $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
               $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
               $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                 
               
               
               $query = $this->db->query($sql);
               $result = $query->result();
               
               if (count($result)) { 
                        $sql = "UPDATE EP_PGD_PEMBELIAN_DETAIL ";
                        $sql .= " SET KETERANGAN = '" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= ", JUMLAH = " . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= ", HARGA = " . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= ", TGL_UBAH = TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_user") . "'";    
                        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= " AND KODE_BARANG_JASA = '" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= " AND KODE_SUB_BARANG_JASA = '" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                
               } else {

                        $sql = "INSERT INTO EP_PGD_PEMBELIAN_DETAIL (
                            KODE_TENDER
                            , KODE_KANTOR
                            , KODE_BARANG_JASA
                            , KODE_SUB_BARANG_JASA
                            , KETERANGAN
                            , JUMLAH
                            , HARGA
                            , TGL_REKAM
                            , PETUGAS_REKAM ) ";
                        $sql .= " VALUES (";
                        $sql .= "'" . $this->input->post("KODE_TENDER") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                        $sql .= ",'" . $this->input->post("KETERANGAN") . "' ";
                        $sql .= "," . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                        $sql .= "," . str_replace(",","",$this->input->post("HARGA")) . "  ";
                        $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                        $sql .= ",'" . $this->session->userdata("kode_user") . "'";    
                        $sql .= ")";
                       }
                // echo $sql; 
                if ($this->db->simple_query($sql)) {
                    echo "1"    ;
                } else {
                    echo "0";
                } 
                
                return;
                
            }
             
        }            

        
        function editor(){
              $kode_aktifitas = 0;
              $sql = "SELECT K.KODE_AKTIFITAS, A.NAMA_AKTIFITAS, K.KODE_TENDER, K.KODE_KANTOR ";
              $sql .= "FROM EP_PGD_KOMENTAR_TENDER K ";
              $sql .= "LEFT JOIN  EP_ALURKERJA_AKTIFITAS A ON A.KODE_AKTIFITAS= K.KODE_AKTIFITAS ";
              
              
              $sql .= "WHERE K.KODE_KOMENTAR =  " . $this->input->get("KODE_KOMENTAR") ;
               
              
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    $kode_aktifitas = $result[0]->KODE_AKTIFITAS;
                    $data["kode_aktifitas"] = $result[0]->KODE_AKTIFITAS;
                    $data["nama_aktifitas"] = $result[0]->NAMA_AKTIFITAS;
                    
                    $data["kode_komentar"] =$this->input->get("KODE_KOMENTAR");
                    
                    $data["kode_tender"] = $result[0]->KODE_TENDER;
                    $data["kode_kantor"] = $result[0]->KODE_KANTOR;
                    
                  
                } 
              
              $sql = "SELECT KODE_PERENCANAAN,   KODE_KANTOR_PERENCANAAN ";
              $sql .= "FROM EP_PGD_TENDER ";
              $sql .= " WHERE KODE_TENDER =  '" . $data["kode_tender"] . "'" ;
              $sql .= " AND KODE_KANTOR =  '" . $data["kode_kantor"] . "' " ;
              
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    
                     $data["kode_perencanaan"] = $result[0]->KODE_PERENCANAAN;
                    $data["kode_kantor_perencanaan"] = $result[0]->KODE_KANTOR_PERENCANAAN;
                    
                    
                    $this->session->set_userdata("KODE_PERENCANAAN", $data["kode_perencanaan"]);
                    $this->session->set_userdata("KODE_KANTOR_PERENCANAAN", $data["kode_kantor_perencanaan"]);
                    
                  // echo  $result[0]->KODE_PERENCANAAN  . '-' . $result[0]->KODE_KANTOR_PERENCANAAN;
                  
                }   
                
            
              $this->load->model('alurkerja','alur');
              $this->alur->mulai(5);
              $data["arr_antarmuka"] = $this->alur->getAntarMuka($kode_aktifitas);
              
               
             
             $data["rs_dokumenkategori"] = $this->opsi->getDokumenKategori();
              
             $data["arr_penataperencana"] = $this->opsi->getPenataPerencana();
             
             $data["arr_penatapelaksana"] = $this->opsi->getPenataPelaksana();
             
             $data["arr_penatapelaksanalelang"] = $this->opsi->getPenataPelaksanaLelang();
             
             $data["rs_metodetender"] = $this->opsi->getMetodeTender();
             
             
             $data["TGL_PEMBUKAAN_REG"] = "";
             $data["TGL_PENUTUPAN_REG"] = "";
             $data["TGL_PRE_LELANG"] = "";
             $data["LOKASI_PRE_LELANG"] = "";
             $data["TGL_PEMBUKAAN_LELANG"] = "";
             $data["TGL_MULAI_PENAWARAN"] = "";
             $data["TGL_AANWIJZING2"] = "";
             $data["LOKASI_AANWIJZING2"] = "";
             
             
             $sql = "SELECT LOKASI_AANWIJZING2, TGL_AANWIJZING2, TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG, TGL_PRE_LELANG, LOKASI_PRE_LELANG, TGL_PEMBUKAAN_LELANG, TGL_MULAI_PENAWARAN  ";
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
                
              $sql = "SELECT  KODE_TENDER, KODE_KANTOR, NAMA_VENDOR,TGL_PEMBELIAN, PPN, KETERANGAN FROM EP_PGD_PEMBELIAN  ";
              $sql .= " WHERE KODE_TENDER = '" . $data["kode_tender"] . "' ";
              $sql .= " AND  KODE_KANTOR = '" . $data["kode_kantor"] . "'"; 
            
              $data["PEMBELIAN_NAMA_VENDOR"] = "";
              $data["PEMBELIAN_TGL_PEMBELIAN"] = "";
              $data["PEMBELIAN_PPN"] = "";
              $data["PEMBELIAN_KETERANGAN"] = "";
              $query = $this->db->query($sql);
              $result = $query->result(); 
              
              if (count($result)) {
                    $data["PEMBELIAN_NAMA_VENDOR"] = $result[0]->NAMA_VENDOR;
                    $data["PEMBELIAN_TGL_PEMBELIAN"] = $result[0]->TGL_PEMBELIAN;
                    $data["PEMBELIAN_PPN"] = $result[0]->PPN;
                    $data["PEMBELIAN_KETERANGAN"] = $result[0]->KETERANGAN;
                  
              }
              
              $this->load->model("opsi", "opsi");
              $data["arr_tipekontrak"] = $this->opsi->getTipeKontrak();
            
              
              $data["dl_hps"] = 0;
              $sql = "SELECT KODE_TENDER";
              $sql .= " FROM EP_PGD_TENDER ";
              $sql .= " WHERE KODE_TENDER =  '" . $data["kode_tender"] . "'" ;
              $sql .= " AND KODE_KANTOR =  '" . $data["kode_kantor"] . "' " ;
              $sql .= " AND ( KODE_JAB_PERENCANA =  '" . $this->session->userdata("kode_jabatan") . "'  " ;
              $sql .= " OR 136 =   " . $this->session->userdata("kode_jabatan")  ; 
              $sql .= " OR 81 =   " . $this->session->userdata("kode_jabatan") . "  )" ;
              
              $query = $this->db->query($sql);
              $result = $query->result(); 
              
              $data["dl_hps"] = count($result);
              
              $sql = "SELECT KODE_VENDOR  FROM EP_PGD_TENDER_EVALUASI  ";
               $sql .= " WHERE KODE_TENDER = '" . $data["kode_tender"] . "' ";
              $sql .= " AND  KODE_KANTOR = '" . $data["kode_kantor"] . "'"; 
             
              $query = $this->db->query($sql);
              $result = $query->result(); 
              
              $data["max_rangking"] = count($result);
               
             $this->layout->view("pengadaan_editor", $data);
             
            
        }
        
        function download( $kode_dokumen) {
            $sql = "SELECT NAMA_FILE FROM EP_PGD_DOKUMEN WHERE KODE_DOKUMEN = " . $kode_dokumen;
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                redirect( base_url() . "index.php/pgd/dokumen/download/" . $result[0]->NAMA_FILE);
            }
             
        }
        
        
        function download_komentar( $kode_dokumen) {
             $sql = "SELECT ATTACHMENT FROM EP_PGD_KOMENTAR_TENDER WHERE KODE_KOMENTAR = " . $kode_dokumen;
            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                redirect( base_url() . "index.php/pgd/dokumen/download/" . $result[0]->ATTACHMENT);
            }
             
        }
        
        
        function getMetodeSampul($metode_tender) {
            $result = $this->opsi->getMetodeSampul($metode_tender);
              
        }
     
        function fn_batalkan_pengadaan() {
            print_r($_POST);
            
            // Komentar 
            
            $sql = "UPDATE EP_PGD_KOMENTAR_TENDER ";
            $sql .= " SET KODE_AKTIFITAS = 1902 ";
            $sql .= " , KODE_TRANSISI = 436 ";
            $sql .= " , NAMA_TRANSISI = 'BATALKAN PENGADAAN' ";
            $sql .= " , TGL_BERAKHIR =  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND TGL_BERAKHIR IS NULL ";
            
            $this->db->simple_query($sql);
            
            
            
            $sql = "UPDATE EP_PGD_TENDER ";
            $sql .= " SET STATUS = 1902 ";
            $sql .= " , TGL_SELESAI =  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
             
            $this->db->simple_query($sql);
            
            
            $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS ";
            $sql .= " SET STATUS = 26 ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
             
            $this->db->simple_query($sql);
          
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else{
                         echo "0";

                    }   
            
            
        }
       
        
         function update_Pembuatan_jadwal2() {
   //          print_r($_POST);
              
            if (strlen($this->input->post("TGL_AANWIJZING2"))) {
                $sql  = " SELECT KODE_TENDER FROM EP_PGD_PERSIAPAN_TENDER ";
                $sql .= " WHERE KODE_TENDER =   '" .$this->input->post("KODE_TENDER") . "' ";
                $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    $sql = "UPDATE EP_PGD_PERSIAPAN_TENDER ";
                    $sql .= " SET  TGL_AANWIJZING2 ='" .$this->input->post("TGL_AANWIJZING2") . "'  ";
                    $sql .= " , LOKASI_AANWIJZING2='" .$this->input->post("LOKASI_AANWIJZING2") . "'  "; 
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
        
        
        
        function update_metode_pengadaan() {
             
            if (strlen($this->input->post("METODE_TENDER"))) {
                $sql  = " SELECT KODE_TENDER FROM EP_PGD_PERSIAPAN_TENDER ";
                $sql .= " WHERE KODE_TENDER =   '" .$this->input->post("KODE_TENDER") . "' ";
                $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {

                    $sql = "UPDATE EP_PGD_PERSIAPAN_TENDER ";
                    $sql .= " SET  METODE_TENDER ='" .$this->input->post("METODE_TENDER") . "'  ";
                    $sql .= " , METODE_SAMPUL='" .$this->input->post("METODE_SAMPUL") . "'  ";
                    $sql .= " , KODE_EVALUASI='" .$this->input->post("KODE_EVALUASI") . "' ";
                    
                    if ($this->input->post("PANITIA") > 0 ) {
                        $sql .= " , KODE_PANITIA= " .$this->input->post("KODE_PANITIA") . "  ";
                        $sql .= " , KODE_KANTOR_PANITIA ='" .$this->input->post("KODE_KANTOR_PANITIA") . "' ";
                    }  else {
                        $sql .= " , KODE_PANITIA= 0   ";
                        $sql .= " , KODE_KANTOR_PANITIA ='" .$this->input->post("KODE_KANTOR_PANITIA") . "' ";
                    }
                     
                    $sql .= " , KETERANGAN_EVALUASI='" .$this->input->post("KETERANGAN_EVALUASI") . "' ";
                    $sql .= " , PTP_INQUIRY_NOTES= '" .$this->input->post("PTP_INQUIRY_NOTES") . "' ";
                    $sql .= " , PANITIA=  " .$this->input->post("PANITIA") . "  ";
                    $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";


                    
                    if ($this->db->simple_query($sql)) {
                        $sql = "UPDATE EP_PGD_TENDER ";
                        $sql .= " SET TIPE_KONTRAK = '" . $this->input->post("TIPE_KONTRAK") . "'";
                        $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                        $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";
    
                        $this->db->simple_query($sql);
                          
                        echo "1";

                    } else{
                         echo "0";

                    }

                    
                } else {
                


                    $sql = "INSERT INTO EP_PGD_PERSIAPAN_TENDER (";
                    $sql .= " KODE_TENDER ";
                    $sql .= " , KODE_KANTOR ";
                    $sql .= " , METODE_TENDER ";
                    $sql .= " , METODE_SAMPUL ";
                    $sql .= " , KODE_EVALUASI ";
                    $sql .= " , KETERANGAN_EVALUASI ";
                    $sql .= " , PTP_INQUIRY_NOTES ";
                    $sql .= " , PANITIA ";
                   // if ($this->input->post("METODE_TENDER") == 2 ) {
                        $sql .= " , KODE_PANITIA  ";
                        $sql .= " , KODE_KANTOR_PANITIA   ";
                   // } 
                    $sql .= " ) ";
                    $sql .= " VALUES ( ";
                    $sql .= "  '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " , '" .$this->input->post("KODE_KANTOR") . "'  ";
                    $sql .= " , '" .$this->input->post("METODE_TENDER") . "'  ";
                    $sql .= " , '" .$this->input->post("METODE_SAMPUL") . "'  ";
                    $sql .= " , '" .$this->input->post("KODE_EVALUASI") . "' ";
                    $sql .= " , '" .$this->input->post("KETERANGAN_EVALUASI") . "' ";
                    $sql .= " , '" .$this->input->post("PTP_INQUIRY_NOTES") . "' ";
                    $sql .= " ,  " .$this->input->post("PANITIA") . "  ";
                    if ($this->input->post("PANITIA") > 0 ) {
                        $sql .= " , " .$this->input->post("KODE_PANITIA") . "  ";
                        $sql .= " , '" .$this->input->post("KODE_KANTOR_PANITIA") . "' ";
                    } else {
                        $sql .= " , 0"  ;
                        $sql .= " , '" .$this->input->post("KODE_KANTOR_PANITIA") . "' ";
                    }
                    $sql .= " )";


                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else{
                        
                        
                        
                         echo "0";
                        //  echo $sql;   
                    }
                      
                }
                
                //   echo $sql;    
                
                $sql = "DELETE FROM EP_PGD_TENDER_KLASIFIKASI ";
                $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";

                
                
                 $this->db->simple_query($sql);
                 
                 
                if ($this->input->post("VENDOR_TIPE_K")) {  
                    $sql = "INSERT INTO EP_PGD_TENDER_KLASIFIKASI (KODE_TENDER, KODE_KANTOR, KODE_KLAS_VENDOR) ";
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "','K') ";
                
                    $this->db->simple_query($sql);

                }
                if ($this->input->post("VENDOR_TIPE_M")) {  
                    $sql = "INSERT INTO EP_PGD_TENDER_KLASIFIKASI (KODE_TENDER, KODE_KANTOR, KODE_KLAS_VENDOR) ";
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "','M') ";
                
                    $this->db->simple_query($sql);

                }
                if ($this->input->post("VENDOR_TIPE_B")) {  
                    $sql = "INSERT INTO EP_PGD_TENDER_KLASIFIKASI (KODE_TENDER, KODE_KANTOR, KODE_KLAS_VENDOR) ";
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "','B') ";
                
                    $this->db->simple_query($sql);

                }
                
                
                
                
            }
            
        }
	 
}	