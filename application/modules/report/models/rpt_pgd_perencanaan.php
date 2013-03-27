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
class Rpt_pgd_perencanaan extends MY_Model {
 
        public $table = "EP_PGD_PERENCANAAN";
    //public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
    public $elements_conf = array('KODE_PERENCANAAN', 
			'KODE_KANTOR'  => array('type' => 'dropdown', 'options' => array()),
			 'JUDUL_PEKERJAAN',  
			 'LINGKUP_PEKERJAAN',
			 'RENCANA_KEBUTUHAN',  
			 'RENCANA_PELAKSANAAN',  
			 'SWAKELOLA' => array(
            'type' => 'dropdown', 'options' => array(
                '0' => 'TIDAK',
                '1' => 'YA'
        )) );
		
		
    public $columns_conf = array('KODE_PERENCANAAN' =>array('hidden'=>true, 'width'=>0) ,
				'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>20),				   
								 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>30) ,
								 'LINGKUP_PEKERJAAN' =>array('hidden'=>false, 'width'=>30) ,
								 'RENCANA_PELAKSANAAN' =>array('hidden'=>false, 'width'=>10, 'align'=>'center'),
        							 'PLAFON_ANGGARAN' =>array('hidden'=>false, 'width'=>10, 'align'=>'center'),
                                                                 'MATA_ANGGARAN' =>array('hidden'=>false, 'width'=>10, 'align'=>'center'),
 								 'PETUGAS_REKAM' =>array('hidden'=>false, 'width'=>15)
								 );
	
	
    public $sql_select = "(SELECT P.PERENCANA, P.KODE_PERENCANAAN ,  K.KODE_KANTOR, P.JUDUL_PEKERJAAN, P.LINGKUP_PEKERJAAN,  K.NAMA_KANTOR, P.RENCANA_KEBUTUHAN, P.RENCANA_PELAKSANAAN
        , CASE  
          WHEN P.STATUS = 1 THEN 'TELAH DISETUJUI' 
          ELSE 'BELUM DISETUJUI'
          END AS STATUS 
        ,  '' AS PLAFON_ANGGARAN
        , '' AS MATA_ANGGARAN
        , P.PETUGAS_REKAM  
		FROM EP_PGD_PERENCANAAN P
		LEFT JOIN MS_KANTOR K ON P.KODE_KANTOR = K.KODE_KANTOR
                LEFT JOIN EP_ALURKERJA_AKTIFITAS A ON P.STATUS_AKTIFITAS = A.KODE_AKTIFITAS
                WHERE P.STATUS = 1
               )";
      
 
    function __construct() {
        parent::__construct();
        $this->init();
	     
    }

}

?>
