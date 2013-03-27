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
class Ep_pgd_tender_vendor_klas extends MY_Model {

    public $table = "EP_PGD_TENDER_VENDOR";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'KODE_VENDOR',
                            );
			 
    public $columns_conf = array( 'NAMA_VENDOR' =>array('hidden'=>true, 'width'=>0),
                            'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>100)    
                            );

    function setParam() {
                         if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            } 
            
            $this->sql_select  = $this->sql_select . " LEFT JOIN EP_PGD_TENDER_KLASIFIKASI K ON V.GOLONGAN_KEUANGAN = K.KODE_KLAS_VENDOR ";
                $this->sql_select  = $this->sql_select . " AND K.KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND K.KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'   "; 
     
            
                
            $this->sql_select  = $this->sql_select . "  WHERE   K.KODE_KLAS_VENDOR IS NOT NULL  AND V.STATUS = 9 )";  
    }
	
    public $sql_select = "(SELECT   V.KODE_VENDOR, V.NAMA_VENDOR
                            FROM  EP_VENDOR V  
                             ";
    
                          
	
    function __construct() {
        parent::__construct();
        $this->init();
        $this->setParam();
    }
	
}	