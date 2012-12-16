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
class Ep_pgd_tender_evaluasi extends MY_Model {

    public $table = "VW_PGD_TENDER_EVALUASI";
 	
 
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>0) 
                                 ,'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0)  
				 ,'KODE_VENDOR'  =>array('hidden'=>true, 'width'=>0) 								 
				 ,'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>20) 
        			 ,'ADM' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_TEKNIS' =>array('hidden'=>false, 'width'=>10)
        			 ,'PASSING_GRADE' =>array('hidden'=>false, 'width'=>10)
                                 ,'LULUS' =>array('hidden'=>false, 'width'=>10)
                                 ,'HARGA' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_HARGA' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_BOBOT' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_TOTAL' =>array('hidden'=>false, 'width'=>10)
                                 ,'PERINGKAT' =>array('hidden'=>false, 'width'=>10)
                                 ,   'BTN_NILAI_TEKNIS'  =>array('hidden'=>false, 'width'=>10)  
                                 ,   'BTN_NILAI_HARGA'  =>array('hidden'=>false, 'width'=>10)   
                     		 					 );
	
	
    public $sql_select = "(SELECT  
							 KODE_TENDER ,
							 KODE_KANTOR ,
							 KODE_VENDOR ,
							 NAMA_VENDOR ,
                                                         ADM,
                                                         NILAI_TEKNIS,
                                                         PASSING_GRADE,
                                                         LULUS,
                                                         HARGA,
                                                         NILAI_HARGA,
                                                         NILAI_BOBOT,
                                                         NILAI_TOTAL,
                                                         PERINGKAT
                                                          ,  '' as \"BTN_NILAI_TEKNIS\"
                                                           ,  '' as \"BTN_NILAI_HARGA\"
			 			  FROM 	 VW_PGD_TENDER_EVALUASI
						 
						)";
	
  
	function __construct() {
        parent::__construct();
        $this->init();	 
        
         $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnNilaiTeknis(\'"+cl+"\');\"  >NILAI TEKNIS</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{BTN_NILAI_TEKNIS:be});
                        be = "<button onclick=\"fnNilaiHarga(\'"+cl+"\');\"  >NILAI HARGA</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{BTN_NILAI_HARGA:be});
		}';
      	
         }
	
}	