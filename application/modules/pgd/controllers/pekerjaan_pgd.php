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
                           
                        echo $sql;
                        
                        $this->db->simple_query($sql);
                          
                }
                
            }
            
            
              print_r($_POST); 
            
            
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
            $sql .= " WHERE KODE_TENDER=" . $this->input->post("KODE_TENDER") ;
            $sql .= " AND KODE_KANTOR='" . $this->input->post("KODE_KANTOR") . "'" ;
            
            if ($this->db->simple_query($sql)) {
                echo "1";
                
            } else {
                echo $sql;
                echo "0";
                
            }
        }
        
        function update_penata_pelaksana() {
            
            print_r($_POST);
            
            $arr = explode("-",$this->input->post("NAMA_PELAKSANA"));
            
            $sql = "UPDATE EP_PGD_TENDER ";
            $sql .= " SET NAMA_PELAKSANA = '" . $arr[1] . "' ";
            $sql .= " , KODE_JAB_PELAKSANA = '" . $arr[0] . "' ";
            $sql .= " WHERE KODE_TENDER=" . $this->input->post("KODE_TENDER") ;
            $sql .= " AND KODE_KANTOR='" . $this->input->post("KODE_KANTOR") . "'" ;
            
            if ($this->db->simple_query($sql)) {
                echo "1";
                
            } else {
                echo $sql;
                echo "0";
                
            }
        }
        
        
        function update_item_tender() {
            
            print_r($_POST);
            
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
        
        
        function do_upload()
	{
		$config['upload_path'] = './uploaded_test/';
		 $config['allowed_types'] = 'gif|jpg|png';
		 $config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			// echo $error; 
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
                          return  $data['upload_data']['file_name'] ;
			// $this->load->view('upload_success', $data);
		}
	}
        
        
        function add_dokumen() {
             print_r($_POST);
            
            $str_file =  $this->do_upload();
            
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

                        echo $sql;
                        if ($this->db->simple_query($sql)){
                            $this->urut->set_plus("ALL","TENDERDOKUMEN");	
                            echo $urut;

                        }


                    }
            
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
             
             $data["rs_metodetender"] = $this->opsi->getMetodeTender();
             
             
             $data["TGL_PEMBUKAAN_REG"] = "";
             $data["TGL_PENUTUPAN_REG"] = "";
             $data["TGL_PRE_LELANG"] = "";
             $data["LOKASI_PRE_LELANG"] = "";
             $data["TGL_PEMBUKAAN_LELANG"] = "";
             
             
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
                
             
             
             
             
               
             $this->layout->view("pengadaan_editor", $data);
             
            
        }
        
        function getMetodeSampul($metode_tender) {
            $result = $this->opsi->getMetodeSampul($metode_tender);
              
        }
       
        function update_Pembuatan_jadwal() {
             print_r($_POST);
              
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
                    $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";

echo $sql;
                    
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
           print_r($_POST);
            
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
                    $sql .= " , KETERANGAN_EVALUASI='" .$this->input->post("KETERANGAN_EVALUASI") . "' ";
                    $sql .= " , PTP_INQUIRY_NOTES= '" .$this->input->post("PTP_INQUIRY_NOTES") . "' ";
                    $sql .= " WHERE KODE_TENDER = '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " AND KODE_KANTOR =  '" .$this->input->post("KODE_KANTOR") . "'  ";


                    
                    if ($this->db->simple_query($sql)) {
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
                    $sql .= " ) ";
                    $sql .= " VALUES ( ";
                    $sql .= "  '" .$this->input->post("KODE_TENDER") . "' ";
                    $sql .= " , '" .$this->input->post("KODE_KANTOR") . "'  ";
                    $sql .= " , '" .$this->input->post("METODE_TENDER") . "'  ";
                    $sql .= " , '" .$this->input->post("METODE_SAMPUL") . "'  ";
                    $sql .= " , '" .$this->input->post("KODE_EVALUASI") . "' ";
                    $sql .= " , '" .$this->input->post("KETERANGAN_EVALUASI") . "' ";
                    $sql .= " , '" .$this->input->post("PTP_INQUIRY_NOTES") . "' ";
                    $sql .= " )";


                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else{
                         echo "0";

                    }

                }
                
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