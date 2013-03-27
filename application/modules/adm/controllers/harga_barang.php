<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga_barang extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
	}
	
	function index() {		
                $sql = "SELECT KODE_SUBKELOMPOK, NAMA_SUBKELOMPOK ";
                $sql .= " FROM MS_SUBKELOMPOK_BARANG "; 
            
                $query = $this->db->query($sql);
                $data["rskel"] = $query->result();
            
                
		$this->layout->view('harga_barang_list', $data );
	}	
	
        
        function banding() {
                $data["KODE_HARGA_BARANG"] = $this->input->get("KODE_HARGA_BARANG");
                
                $sql = "SELECT  HB.KODE_KANTOR, B.KODE_BARANG, B.KODE_SUB_BARANG , B.NAMA_BARANG  
                        FROM EP_KOM_HARGA_BARANG HB  
                        LEFT JOIN MS_BARANG B ON HB.KODE_BARANG = B.KODE_BARANG AND HB.KODE_SUB_BARANG = B.KODE_SUB_BARANG 
                        LEFT JOIN EP_KOM_SUMBER_HARGA S ON HB.KODE_SUMBER = S.KODE_SUMBER ";
                $sql .= " WHERE HB.KODE_HARGA_BARANG = '" . $this->input->get("KODE_HARGA_BARANG") . "' " ;  
                
              //   echo $sql;
               
                $query = $this->db->query($sql);
                $result = $query->result();
                
                //  print_r($result);
                
                $data["KODE_BARANG"] = "";
                $data["KODE_KANTOR"] = "";
                $data["KODE_SUB_BARANG"] = "";
                $data["NAMA_BARANG"] = "";
                    
                if (count($result)) {

                    $data["KODE_BARANG"] = $result[0]->KODE_BARANG;
                    $data["KODE_KANTOR"] = $result[0]->KODE_KANTOR;
                    $data["KODE_SUB_BARANG"] = $result[0]->KODE_SUB_BARANG;
                    $data["NAMA_BARANG"] = $result[0]->NAMA_BARANG;
                     
                    
                }
                
                
                $this->layout->view('harga_barang_banding', $data );
                
        }
        
         function  view(){
             
                $sql = "SELECT K.KODE_KOMENTAR , B.KODE_BARANG, B.KODE_SUB_BARANG , B.NAMA_BARANG , HB.TGL_SUMBER, HB.KODE_KANTOR, HB.MATA_UANG, HB.HARGA, HB.NAMA_VENDOR, HB.CATATAN, HB.LAMPIRAN , S.NAMA_SUMBER 
                        , HB.DISKON,  HB.BIAYA_PENANGANAN, HB.BIAYA_ASURANSI, HB.BIAYA_KARGO, HB.BEA_PAJAK, HB.TOTAL_BIAYA
                        FROM EP_KOM_KOMENTAR K 
                        LEFT JOIN EP_KOM_HARGA_BARANG HB ON K.KODE_HARGA = HB.KODE_HARGA_BARANG 
                        LEFT JOIN MS_BARANG B ON K.KODE_JASA_BARANG = B.KODE_BARANG AND K.KODE_SUB_BARANG = B.KODE_SUB_BARANG 
                        LEFT JOIN EP_KOM_SUMBER_HARGA S ON HB.KODE_SUMBER = S.KODE_SUMBER ";
                $sql .= " WHERE K.KODE_KOMENTAR = '" . $this->input->get("KODE_KOMENTAR") . "' " ;  
                
              //   echo $sql;
               
                $query = $this->db->query($sql);
                $result = $query->result();
                
                //  print_r($result);
                
                $data["KODE_BARANG"] = "";
                $data["KODE_KANTOR"] = "";
                $data["KODE_SUB_BARANG"] = "";
                $data["NAMA_BARANG"] = "";
                $data["TGL_SUMBER"] = "";
                $data["NAMA_SUMBER"] = "";
                $data["MATA_UANG"] = "";
                $data["HARGA"] = "";
                $data["NAMA_VENDOR"] = "";
                $data["CATATAN"] = "";
                $data["LAMPIRAN"] = "";
                $data["BIAYA_PENANGANAN"] = 0;
                $data["BIAYA_ASURANSI"] = 0;
                $data["BIAYA_KARGO"] = 0;
                $data["BEA_PAJAK"] = 0;
                $data["TOTAL_BIAYA"] = 0;
                $data["DISKON"] = 0;
                    
                if (count($result)) {

                    $data["KODE_BARANG"] = $result[0]->KODE_BARANG;
                    $data["KODE_KANTOR"] = $result[0]->KODE_KANTOR;
                    $data["KODE_SUB_BARANG"] = $result[0]->KODE_SUB_BARANG;
                    $data["NAMA_BARANG"] = $result[0]->NAMA_BARANG;
                    $data["TGL_SUMBER"] = $result[0]->TGL_SUMBER;
                    $data["NAMA_SUMBER"] = $result[0]->NAMA_SUMBER;
                    $data["MATA_UANG"] = $result[0]->MATA_UANG;
                    $data["HARGA"] = $result[0]->HARGA;
                    $data["BIAYA_PENANGANAN"] = $result[0]->BIAYA_PENANGANAN;
                    $data["BIAYA_ASURANSI"] = $result[0]->BIAYA_ASURANSI;
                    $data["BIAYA_KARGO"] = $result[0]->BIAYA_KARGO;
                    $data["BEA_PAJAK"] = $result[0]->BEA_PAJAK;
                    $data["TOTAL_BIAYA"] = $result[0]->TOTAL_BIAYA;
                    $data["DISKON"] = $result[0]->DISKON;
                    $data["NAMA_VENDOR"] = $result[0]->NAMA_VENDOR;
                    $data["CATATAN"] = $result[0]->CATATAN;
                    $data["LAMPIRAN"] = $result[0]->LAMPIRAN;
                    
                    
                }
                
                
		$sql = "SELECT KODE_KANTOR , NAMA_KANTOR FROM MS_KANTOR ";
		$query = $this->db->query($sql);
		$data["arr_kantor"] = $query->result_array();
		
		$sql = "SELECT KODE_SUMBER , NAMA_SUMBER FROM EP_KOM_SUMBER_HARGA ";
		$query = $this->db->query($sql);
		$data["arr_sumber"] = $query->result_array();
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
                
                $data["kode_alurkerja"] = 3;
              
		$this->load->view('harga_barang_view', $data );
                  
                  
        }
       
        
        function do_upload()
	{
		$config['upload_path'] = './uploaded_test/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

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
                        /*
                        if (isset( $str)) {
                              $this->do_ftp($data['upload_data']['file_name']);
                         
                        }
                         */
                          return  $data['upload_data']['file_name'] ;
			// $this->load->view('upload_success', $data);
		}
	}
        
        
        
	function add(){
	
             
	 
		if ($this->input->post("kode_barang")) {
		 	$str_file =  $this->do_upload();
			$urut = $this->urut->get("ALL","HARGABARANG");
			 
		 
			 
			 
			 
			 $sql = "INSERT INTO EP_KOM_HARGA_BARANG (KODE_HARGA_BARANG, KODE_BARANG, KODE_SUB_BARANG, KODE_KANTOR, KODE_SUMBER , MATA_UANG";
                         $sql .= ", HARGA "; 
                         $sql .= ", BIAYA_PENANGANAN "; 
                         $sql .= ", BIAYA_ASURANSI "; 
                         $sql .= ", BIAYA_KARGO "; 
                         $sql .= ", BEA_PAJAK "; 
                         $sql .= ", DISKON "; 
                         $sql .= ", TOTAL_BIAYA "; 
                         $sql .= ", NAMA_VENDOR ";
                         $sql .= ", CATATAN ";
                         $sql .= ", LAMPIRAN ";
                         $sql .= ", TGL_REKAM, PETUGAS_REKAM ) ";
			 $sql .= " VALUES (".$urut.",'". $this->input->post("kode_barang")."','". $this->input->post("kode_sub_barang")."','" . $this->input->post("kode_kantor"). "'," . $this->input->post("kode_sumber"). " , '" . $this->input->post("mata_uang"). "' ";
			 $sql .= "," .str_replace(",","",$this->input->post("harga")). " ";
                         $sql .= ", " . str_replace(",", "", $this->input->post("biaya_penanganan"));
                         $sql .= ", " . str_replace(",", "", $this->input->post("biaya_asuransi"));
                         $sql .= ", " . str_replace(",", "", $this->input->post("biaya_kargo"));
                         $sql .= ", " . str_replace(",", "", $this->input->post("bea_pajak"));
                         $sql .= ", " . str_replace(",", "", $this->input->post("diskon"));
                         $sql .= ", " . str_replace(",", "", $this->input->post("total_biaya"));
                         $sql .= ", '" . $this->input->post("nama_vendor") . "'" ;
                         $sql .= ", '" . $this->input->post("catatan") . "'" ;
                         $sql .= ", '" . $str_file . "'" ;
                         
			 $sql .= ",   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD'), '" . $this->session->userdata("kode_user") . "') ";
			 
			  
			  
			 if ($this->db->simple_query($sql)) {
				$this->urut->set_plus( "ALL","HARGABARANG") ;
				echo $urut;
			 }	else {
				echo "0";
			 }
			
			return;
		
		}
	
		$sql = "SELECT KODE_KANTOR , NAMA_KANTOR FROM MS_KANTOR ";
		$query = $this->db->query($sql);
		$data["arr_kantor"] = $query->result_array();
		
		$sql = "SELECT KODE_SUMBER , NAMA_SUMBER FROM EP_KOM_SUMBER_HARGA ";
		$query = $this->db->query($sql);
		$data["arr_sumber"] = $query->result_array();
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
		
		$data["kode_alurkerja"] = 3;
                
		$this->layout->view('harga_barang_add', $data );
	}

}	