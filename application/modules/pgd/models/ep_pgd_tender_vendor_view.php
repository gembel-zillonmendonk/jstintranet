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
class Ep_pgd_tender_vendor_view extends MY_Model {

    public $table = "EP_PGD_TENDER_VENDOR";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'KODE_VENDOR',
                            );
			 
    public $columns_conf = array( 
                            'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>50)    
                            , 'STATUS' =>array('hidden'=>false, 'width'=>50)    
        
                            );

	
    public $sql_select = "(SELECT KODE_TENDER ,  KODE_KANTOR,   KODE_VENDOR,  NAMA_VENDOR, STATUS
                           FROM VW_PGD_TENDER_VENDOR_STATUS 
                            ";
    function setParam() {
                         if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            } 
            
                 $this->sql_select  = $this->sql_select . " WHERE   KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND  KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'   "; 
     
            
                
            $this->sql_select  = $this->sql_select . "    )";  
    }
		
    
function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
    }
	
}	