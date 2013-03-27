<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Ep_pgd_komentar_evaluasi_teknis extends MY_Model {

    public $table = "EP_PGD_KOMENTAR_EVALUASI";
  
    public $columns_conf = array(
                                'KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
                                'KODE_VENDOR' =>array('hidden'=>true, 'width'=>0),
                                'NAMA'  =>array('hidden'=>false, 'width'=>20),
                                'NAMA_VENDOR'  =>array('hidden'=>false, 'width'=>20),
                                'TANGGAL'  =>array('hidden'=>false, 'width'=>20),
                                'KOMENTAR'  =>array('hidden'=>false, 'width'=>40)  
                                );
    
    
    public $sql_select = "(SELECT  KODE_TENDER ,
                                   KODE_KANTOR ,
                                   KODE_VENDOR  ,
                                   TANGGAL,
                                   NAMA,
                                   NAMA_VENDOR ,
				   KOMENTAR  
                            FROM EP_PGD_KOMENTAR_EVALUASI       
                            WHERE KOMENTAR_MODE = 'T'
		 ";
	
    function setParam() {
            if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            }

            $this->sql_select  = $this->sql_select . " AND KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
            $this->sql_select  = $this->sql_select . " AND  KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";  
        
    }
	
    function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
             
    }
	
}	