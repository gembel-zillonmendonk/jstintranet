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
class Ep_pgd_panitia_view extends MY_Model {

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
								 'NAMA_PANITIA'  =>array('hidden'=>false, 'width'=>100) 								 
								  
			 					 );
	
	
    public $sql_select = "(SELECT  
							E.KODE_PANITIA ,
                                                        E.KODE_KANTOR ,
							E.NAMA_PANITIA 
                                                    FROM 	 EP_MS_KELOMPOK_PANITIA E
						)";
	
  
	function __construct() {
        parent::__construct();
        $this->init();	 
        
      	
         }
	
}	