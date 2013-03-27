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
class Ep_pgd_penawaran_history extends MY_Model {

    public $table = "EP_PGD_HIST_PENAWARAN";
 
    public $elements_conf = array('KODE_TENDER',
							'KODE_KANTOR',
							'KODE_VENDOR',
							'NO_PENAWARAN',
							'TIPE',
							'BID_BOND',
							'KANDUNGAN_LOKAL',
							'WAKTU_PENGIRIMAN',
							'UNIT',
							'BERLAKU_HINGGA',
							'LAMPIRAN',
							'KETERANGAN',
							 );
			 
    public $columns_conf = array('KODE_HIST_PENAWARAN' =>array('hidden'=>true, 'width'=>0) ,
                                    'KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
								 'KODE_VENDOR'  =>array('hidden'=>true, 'width'=>10),
								 'NAMA_VENDOR'  =>array('hidden'=>false, 'width'=>60),
                                                                 'NO_PENAWARAN'  =>array('hidden'=>false, 'width'=>20),
								 'TGL_REKAM'  =>array('hidden'=>false, 'width'=>10),
        							 'TOTAL'  =>array('hidden'=>false, 'width'=>10,'align'=>'right'),
                                                                 'DETAIL'  =>array('hidden'=>false, 'width'=>10)
                                                                    
								 );
	
	
    public $sql_select = "(SELECT  P.KODE_HIST_PENAWARAN,
                                    P.KODE_TENDER ,
                                    P.KODE_KANTOR ,
                                    P.KODE_VENDOR ,
                                    V.NAMA_VENDOR,
                                    P.NO_PENAWARAN ,
                                    P.TIPE ,
                                    P.BID_BOND ,
                                    P.KANDUNGAN_LOKAL ,
                                    P.WAKTU_PENGIRIMAN ,
                                    P.UNIT ,
                                    P.TGL_REKAM ,
                                    P.LAMPIRAN ,
                                    P.KETERANGAN,
                                    (SELECT TO_CHAR(1.1 * SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0))  ,'999G999G999G999') FROM   EP_PGD_HIST_ITEM_PENAWARAN  WHERE KODE_HIST_PENAWARAN = P.KODE_HIST_PENAWARAN) AS TOTAL,
                                    '' AS \"DETAIL\"
                             FROM 	 EP_PGD_HIST_PENAWARAN P
                             LEFT JOIN EP_VENDOR V ON P.KODE_VENDOR = V.KODE_VENDOR
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

                $this->sql_select  = $this->sql_select . " AND  P.KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND  P.KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";  
        
    }
	
	
	function __construct() {
        parent::__construct();
        $this->init();
        $this->setParam();
        
                $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnDetailPenawaranHistory(\'"+cl+"\');\"  >DETAIL</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{DETAIL:be});
		}';
        
    }
	
}	