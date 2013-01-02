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
class Ep_pgd_tender_evaluasi_view extends MY_Model {

    public $table = "VW_PGD_TENDER_EVALUASI";
 	
 
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>0) 
                                 ,'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0)  
				 ,'KODE_VENDOR'  =>array('hidden'=>true, 'width'=>0) 								 
				 ,'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>20) 
        			 ,'ADM' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_TEKNIS' =>array('hidden'=>false, 'width'=>10, 'align'=>'right')
        			 ,'PASSING_GRADE' =>array('hidden'=>false, 'width'=>10,'align'=>'right')
                                 ,'LULUS' =>array('hidden'=>false, 'width'=>10,'align'=>'center')
                                 ,'HARGA' =>array('hidden'=>false, 'width'=>10, 'align'=>'right')
                                 ,'NILAI_HARGA' =>array('hidden'=>false, 'width'=>10, 'align'=>'right')
                                 ,'NILAI_BOBOT' =>array('hidden'=>false, 'width'=>10,'align'=>'right')
                                 ,'NILAI_TOTAL' =>array('hidden'=>false, 'width'=>10,'align'=>'right')
                                 ,'PERINGKAT' =>array('hidden'=>false, 'width'=>10,'align'=>'center') 
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
                                                         ROWNUM AS PERINGKAT
                                                          ,  '' as \"BTN_NILAI_TEKNIS\"
                                                           ,  '' as \"BTN_NILAI_HARGA\"
			 			  FROM 	 VW_PGD_TENDER_EVAL_PERINGKAT
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

                $this->sql_select  = $this->sql_select . " AND KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . "  ORDER BY NILAI_TOTAL DESC )";  
            
          //  echo $this->sql_select; 
        
    }
    
  
	function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
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