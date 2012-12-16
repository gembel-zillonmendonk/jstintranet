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
class Ep_pgd_evaluasi_view extends MY_Model {

    public $table = "EP_PGD_EVALUASI_MODEL";
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'EVALUASI';
	
 
    public $elements_conf = array( 
								'KODE_TIPE'  => array('type' => 'dropdown', 'options' => array()) ,
								'NAMA',
								'TINGKAT',
								'BOBOT_TEKNIS',
								'BOBOT_HARGA',

							 );
			 
    public $columns_conf = array('KODE_EVALUASI' =>array('hidden'=>true, 'width'=>0) ,
								 'KODE_TIPE' =>array('hidden'=>true, 'width'=>0), 
								 'NAMA'  =>array('hidden'=>false, 'width'=>50),								 
								 'NAMA_TIPE' =>array('hidden'=>false, 'width'=>40) ,
			 					 );
	
	
    public $sql_select = "(SELECT  
							E.KODE_EVALUASI ,
							E.KODE_TIPE,
							T.NAMA_TIPE AS NAMA_TIPE,
							E.NAMA  
			 			  FROM 	 EP_PGD_EVALUASI_MODEL E
						  LEFT JOIN EP_PGD_EVALUASI_TIPE T ON E.KODE_TIPE = T.KODE_TIPE
						)";
	
  
	function __construct() {
        parent::__construct();
        $this->init();	 
        
      	
         }
	
}	