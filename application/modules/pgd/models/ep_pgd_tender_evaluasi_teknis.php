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
class Ep_pgd_tender_evaluasi_teknis extends MY_Model {

    public $table = "EP_NOMORURUT";
 	
 
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>0) 
                                 ,'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0)  
				 ,'KODE_VENDOR'  =>array('hidden'=>true, 'width'=>0) 								 
				 ,'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>20) 
        			 ,'ADM' =>array('hidden'=>false, 'width'=>10)
                                 ,'NILAI_TEKNIS' =>array('hidden'=>false, 'width'=>10, 'align'=>'right')
        			 ,'PASSING_GRADE' =>array('hidden'=>false, 'width'=>10,'align'=>'right')
                                 ,'LULUS' =>array('hidden'=>false, 'width'=>10,'align'=>'center')  
                                 , 'CATATAN'   =>array('hidden'=>false, 'width'=>30,'align'=>'left')  
                                 ,   'BTN_NILAI_TEKNIS'  =>array('hidden'=>false, 'width'=>10)   
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
                                                         CATATAN           ,
                                                         ROWNUM AS PERINGKAT
                                                          ,  '' as \"BTN_NILAI_TEKNIS\" 
			 			  FROM 	 (SELECT ROWNUM AS PERINGKAT,  KODE_TENDER, KODE_KANTOR , KODE_VENDOR,  NAMA_VENDOR, ADM, NILAI_TEKNIS, PASSING_GRADE, LULUS , NILAI_BOBOT, HARGA, NILAI_HARGA, KETERANGAN_TEKNIS AS CATATAN  , NILAI_TOTAL
	FROM (
	SELECT E.KODE_TENDER
	   , E.KODE_KANTOR
	   ,  V.KODE_VENDOR
	   , V.NAMA_VENDOR
	   , CASE
	   	 	 WHEN PTVS.TEKNIKAL_STATUS = 1 THEN 'LULUS'
			 ELSE 'TIDAK LULUS'
	   	 END AS ADM
	   , E.NILAI_TEKNIS AS NILAI_TEKNIS
	   ,   E.GRADE AS PASSING_GRADE
	   , CASE
	   	 	 WHEN E.NILAI_TEKNIS >=  E.GRADE THEN 'LULUS'
			 ELSE 'TIDAK LULUS'
	   	 END AS  LULUS
	   , H.TOTAL  AS HARGA
	   , E.NILAI_HARGA AS NILAI_HARGA
	   , 'Teknis: ' || COALESCE(E.BOBOT_TEKNIS * E.NILAI_TEKNIS / 100, 0) || '<br/>' || 'Harga: ' || COALESCE(E.BOBOT_HARGA * E.NILAI_HARGA / 100, 0)   AS NILAI_BOBOT
	   , COALESCE(E.BOBOT_TEKNIS * E.NILAI_TEKNIS / 100, 0)
                      + COALESCE(E.BOBOT_HARGA * E.NILAI_HARGA / 100, 0) AS NILAI_TOTAL
           , E.KETERANGAN_TEKNIS AS KETERANGAN_TEKNIS           
	   , 0 AS PERINGKAT
FROM   EP_PGD_TENDER_EVALUASI E
INNER JOIN EP_VENDOR V ON E.KODE_VENDOR = V.KODE_VENDOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON E.KODE_TENDER = PTVS.KODE_TENDER AND E.KODE_KANTOR = PTVS.KODE_KANTOR AND E.KODE_VENDOR =PTVS.KODE_VENDOR
LEFT JOIN (SELECT KODE_TENDER, KODE_KANTOR ,KODE_VENDOR, SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS TOTAL FROM EP_PGD_ITEM_PENAWARAN
	 GROUP BY  KODE_TENDER, KODE_KANTOR,KODE_VENDOR ) H
	 	  ON 	  H.KODE_TENDER = PTVS.KODE_TENDER AND H.KODE_KANTOR = PTVS.KODE_KANTOR AND H.KODE_VENDOR =PTVS.KODE_VENDOR
		   ORDER BY NILAI_TOTAL DESC
		 ) X 
) VW_PGD_TENDER_EVAL_PERINGKAT
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
            
                
            $this->sql_select  = $this->sql_select . " ORDER BY NILAI_TOTAL DESC )";  
            
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
                        
		}';
      	
         }
	
}	