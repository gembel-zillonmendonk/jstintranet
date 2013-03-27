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
class Ep_pgd_tender_vendor_status extends MY_Model {

    public $table = "EP_PGD_TENDER_VENDOR";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'KODE_VENDOR',
                            );
			 
    public $columns_conf = array( 
                            'KODE_TENDER' =>array('hidden'=>true, 'width'=>0)
                            , 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0)
                            , 'KODE_VENDOR' =>array('hidden'=>true, 'width'=>0)
                            ,'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>90)    
         ,   'EDIT'  =>array('hidden'=>false, 'width'=>10)                    
        );

	
    public $sql_select = "(SELECT T.KODE_TENDER , T.KODE_KANTOR, T.KODE_VENDOR, V.NAMA_VENDOR
                            ,  '' as \"EDIT\"
                           FROM EP_PGD_TENDER_VENDOR_STATUS T  
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
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnVerifikasiVendor(\'"+cl+"\');\"  >VERIFIKASI</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{EDIT:be});
		}';

    }
	
}	