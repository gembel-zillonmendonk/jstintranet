<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga_jasa extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
	}
	
	function index() {	
                $sql = "SELECT KODE_KEL_JASA, NAMA_KEL_JASA ";
                $sql .= " FROM EP_KOM_KELOMPOK_JASA "; 
            
                $query = $this->db->query($sql);
                $data["rskel"] = $query->result();
                
		$this->layout->view('harga_jasa_list', $data );
	}	
	
        
         
        function banding() {
                $data["KODE_HARGA_BARANG"] = $this->input->get("KODE_HARGA_BARANG");
                
                $sql = "SELECT  HB.KODE_KANTOR, B.KODE_JASA , B.NAMA_JASA  
                        FROM EP_KOM_HARGA_JASA HB  
                        LEFT JOIN EP_KOM_JASA B ON HB.KODE_JASA = B.KODE_JASA   
                        LEFT JOIN EP_KOM_SUMBER_HARGA S ON HB.KODE_SUMBER = S.KODE_SUMBER ";
                $sql .= " WHERE HB.KODE_HARGA_JASA = " . $this->input->get("KODE_HARGA_JASA") . " " ;  
                
              //   echo $sql;
               
                $query = $this->db->query($sql);
                $result = $query->result();
                
                //  print_r($result);
                
                $data["KODE_JASA"] = "";
                $data["KODE_KANTOR"] = "";
                 $data["NAMA_JASA"] = "";
                    
                if (count($result)) {

                    $data["KODE_JASA"] = $result[0]->KODE_JASA;
                    $data["KODE_KANTOR"] = $result[0]->KODE_KANTOR;
                     
                    $data["NAMA_JASA"] = $result[0]->NAMA_JASA;
                     
                    
                }
                
                
                $this->layout->view('harga_jasa_banding', $data );
                
        }
       
        
        function  view(){
             
                $sql = "SELECT K.KODE_KOMENTAR , J.KODE_JASA, J.KODE_KEL_JASA, J.NAMA_JASA ";
                $sql .= " , HJ.TGL_SUMBER, HJ.KODE_KANTOR,  HJ.MATA_UANG, HJ.HARGA, HJ.NAMA_VENDOR, HJ.CATATAN, HJ.LAMPIRAN ";
                $sql .= " , S.NAMA_SUMBER ";
                $sql .= " FROM EP_KOM_KOMENTAR K ";
                $sql .= " LEFT JOIN EP_KOM_HARGA_JASA HJ ON K.KODE_HARGA = HJ.KODE_HARGA_JASA ";
                $sql .= " LEFT JOIN EP_KOM_JASA J ON K.KODE_JASA_BARANG = J.KODE_JASA ";
              
                $sql .= " LEFT JOIN EP_KOM_SUMBER_HARGA S ON HJ.KODE_SUMBER = S.KODE_SUMBER ";
                $sql .= " WHERE K.KODE_KOMENTAR = '" . $this->input->get("KODE_KOMENTAR") . "' " ;  
 
               // echo $sql;
                
                $query = $this->db->query($sql);
                $result = $query->result();
                
               //  print_r($result);
                
                $data["KODE_JASA"] = "";
                $data["KODE_KANTOR"] = "";
                $data["KODE_KEL_JASA"] = "";
                $data["NAMA_JASA"] = "";
                $data["TGL_SUMBER"] = "";
                $data["NAMA_SUMBER"] = "";
                $data["MATA_UANG"] = "";
                $data["HARGA"] = "";
                $data["NAMA_VENDOR"] = "";
                $data["CATATAN"] = "";
                $data["LAMPIRAN"] = "";
                
                if (count($result)) {

                    $data["KODE_JASA"] = $result[0]->KODE_JASA;
                    $data["KODE_KANTOR"] = $result[0]->KODE_KANTOR;
                    $data["KODE_KEL_JASA"] = $result[0]->KODE_KEL_JASA;
                    $data["NAMA_JASA"] = $result[0]->NAMA_JASA;
                    $data["TGL_SUMBER"] = $result[0]->TGL_SUMBER;
                    $data["NAMA_SUMBER"] = $result[0]->NAMA_SUMBER;
                    $data["MATA_UANG"] = $result[0]->MATA_UANG;
                    $data["HARGA"] = $result[0]->HARGA;
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
		
		$data["kode_alurkerja"] = 2;
                 
		$this->load->view('harga_jasa_view', $data );
	 
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
	
	 
		if ($this->input->post("kode_jasa")) {
                        $str_file =  $this->do_upload();
			$urut = $this->urut->get("ALL","HARGAJASA");
			 
                        $arrTglSumber = explode("-",$this->input->post("TGL_SUMBER"));
			 
                        $tgl_sumber = $arrTglSumber[0] . "-" . $arrTglSumber[1] .  "-" . $arrTglSumber[2];
                        
			 $sql = "INSERT INTO EP_KOM_HARGA_JASA (KODE_HARGA_JASA, KODE_JASA, KODE_KANTOR, KODE_SUMBER , MATA_UANG, HARGA, NAMA_VENDOR, CATATAN, LAMPIRAN, TGL_SUMBER,  TGL_REKAM, PETUGAS_REKAM ) ";
			 $sql .= " VALUES (".$urut.",'". $this->input->post("kode_jasa")."','" . $this->input->post("kode_kantor"). "'," . $this->input->post("kode_sumber"). " , '" . $this->input->post("mata_uang"). "' ";
			 $sql .= " ," .str_replace(",","",$this->input->post("harga")). " ";
                         $sql .= " ,'" .str_replace(",","",$this->input->post("nama_vendor")). "' ";
                         $sql .= " ,'" .str_replace(",","",$this->input->post("catatan")). "' ";
                         $sql .= " ,'" .$str_file . "' ";
                         $sql .= " ,   TO_DATE('" . $tgl_sumber . "','DD-MM-YYYY') ";
			 $sql .= " ,   TO_DATE('" . date("d-m-Y") . "','DD-MM-YYYY')  ";
                         $sql .= " ,'" .$this->session->userdata("kode_user") . "') ";
			 
			    
			 if ($this->db->simple_query($sql)) {
				$this->urut->set_plus( "ALL","HARGAJASA") ;
				echo $urut;
			 }	else {
                                //echo $sql;  
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
		
		$data["kode_alurkerja"] = 2;
                 
		$this->layout->view('harga_jasa_add', $data );
	}

}	