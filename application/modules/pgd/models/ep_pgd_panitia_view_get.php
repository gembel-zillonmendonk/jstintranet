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
class Ep_pgd_panitia_view_get extends MY_Model {

    public $table = "EP_MS_KELOMPOK_PANITIA";
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'EVALUASI';
	
 
    public $elements_conf = array( 
								'KODE_TIPE'  => array('type' => 'dropdown', 'options' => array()) ,
								'NAMA',
								'TINGKAT',
								'BOBOT_TEKNIS',
								'BOBOT_HARGA',

							 );
			 
    public $columns_conf = array('KODE_PANITIA' =>array('hidden'=>true, 'width'=>0) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0), 
								 'NAMA_PANITIA'  =>array('hidden'=>false, 'width'=>80), 								 
								 'LIHAT'  =>array('hidden'=>false, 'width'=>10), 								 
                                                                  'PILIH'  =>array('hidden'=>false, 'width'=>10) 								 
			 					 );
	
	
    public $sql_select = "(SELECT  
							E.KODE_PANITIA ,
                                                        E.KODE_KANTOR ,
							E.NAMA_PANITIA 
                                                        ,  '' as \"LIHAT\"
                                                        ,  '' as \"PILIH\" 
                                                    FROM 	 EP_MS_KELOMPOK_PANITIA E
						)";
	
  
	function __construct() {
        parent::__construct();
        $this->init();	 
        
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnLihatPanitia(\'"+cl+"\');\"  >LIHAT</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{LIHAT:be});
                    bx = "<button onclick=\"fnPilihPanitia(\'"+cl+"\');\"  >PILIH</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PILIH:bx});
                        
		}';
      	
         }
	
}	