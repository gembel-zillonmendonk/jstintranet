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
class Ep_pgd_dokumen extends MY_Model {

    public $table = "EP_PGD_DOKUMEN";
 
    public $elements_conf = array('KODE_DOKUMEN',
                                   'KODE_TENDER',
                                            'KODE_KANTOR',
						'KATEGORI',
						'KETERANGAN',
						'NAMA_FILE'  );
			 
    public $columns_conf = array(
                                'KODE_DOKUMEN' =>array('hidden'=>true, 'width'=>0),
                                'KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
                                'KATEGORI'  =>array('hidden'=>false, 'width'=>20),
                                'KETERANGAN'  =>array('hidden'=>false, 'width'=>50),
                                'NAMA_FILE'  =>array('hidden'=>false, 'width'=>20 )
                                 
                                );
    
    
    public $sql_select = "(SELECT  KODE_DOKUMEN  ,
                                   KODE_TENDER ,
                                   KODE_KANTOR ,
                                   KATEGORI ,
				   KETERANGAN ,
				   '<a href=\"' || NAMA_FILE || '\" >' || NAMA_FILE || '</a>' AS NAMA_FILE 
                                  
                            FROM EP_PGD_DOKUMEN       
                            WHERE 1 = 1
		 ";
	
    function setParam() {
                 if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            }

                $this->sql_select  = $this->sql_select . " AND KODE_TENDER = " .  $this->session->userdata("KODE_TENDER"). "  ";
                $this->sql_select  = $this->sql_select . " AND  KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";  
        
    }
	
	
	function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();

             
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnDownloadDokumen(\'"+cl+"\');\"  >DOWNLOAD</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{DOWNLOAD:be});
                         
		}';


            
    }
	
}	