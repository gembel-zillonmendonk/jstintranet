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
                            'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>100)    
                            );

	
    public $sql_select = "(SELECT T.KODE_TENDER , T.KODE_KANTOR, T.KODE_VENDOR, V.NAMA_VENDOR
                           FROM EP_PGD_TENDER_VENDOR T  
                           LEFT JOIN EP_VENDOR V ON T.KODE_VENDOR = V.KODE_VENDOR
                            ";
    function setParam() {
                         if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            } 
            
                 $this->sql_select  = $this->sql_select . " WHERE  T.KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND T.KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'   "; 
     
            
                
            $this->sql_select  = $this->sql_select . "    )";  
    }
		
    
function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
    }
	
}	