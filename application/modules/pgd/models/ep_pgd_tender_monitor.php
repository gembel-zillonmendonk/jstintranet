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
class Ep_pgd_tender_monitor extends MY_Model {

    public $table = "EP_PGD_TENDER";
	
	
    public $elements_conf = array('KODE_TENDER',
'KODE_KANTOR',
'KODE_TENDER_SEBELUM',
'KODE_TENDER_SESUDAH',
'NAMA_PEMOHON',
'KODE_JAB_PEMOHON',
'NAMA_PERENCANA',
'KODE_JAB_PERENCANA',
'NAMA_PELAKSANA',
'KODE_JAB_PELAKSANA',
'TGL_PEMBUATAN',
'JUDUL_PEKERJAAN',
'LINGKUP_PEKERJAAN',
'WAKTU_PENGIRIMAN',
'UNIT_PENGIRIMAN',
'NAMA_PEMBELI',
'KODE_JAB_PEMBELI',
'MATA_UANG',
'TIPE_KONTRAK',
'NAMA_JAB_PESERTA',
'KODE_JAB_PESERTA',
'PEMBUATAN_KONTRAK',
'STATUS',
'TGL_SELESAI',
'KODE_PERENCANAAN',
'KODE_KANTOR_PERENCANAAN' 
	
		);
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>false, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10),  
								 'NAMA_PEMOHON'  =>array('hidden'=>false, 'width'=>10),
								 'JUDUL_PEKERJAAN'  =>array('hidden'=>false, 'width'=>40),
								 'STATUS'  =>array('hidden'=>false, 'width'=>20),
								 'PELAKU_PROSES'  =>array('hidden'=>false, 'width'=>10),
        							 'LIHAT'  =>array('hidden'=>false, 'width'=>5)
        
								 );
	
	
    public $sql_select = "(SELECT T.KODE_TENDER, T.KODE_KANTOR , T.NAMA_PEMOHON, T.JUDUL_PEKERJAAN, A.NAMA_AKTIFITAS AS STATUS, '' AS PELAKU_PROSES, '' AS \"LIHAT\"
		FROM EP_PGD_TENDER T
                LEFT JOIN (SELECT KODE_AKTIFITAS, NAMA_AKTIFITAS FROM EP_ALURKERJA_AKTIFITAS ) A ON T.STATUS = A.KODE_AKTIFITAS
		)";
	
    function __construct() {
            parent::__construct();
            $this->init();	 

              $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
                    for(var i=0;i < ids.length;i++){
                        var cl = ids[i];

                        be = "<button onclick=\"fnTenderMonitor(\'"+cl+"\');\"  >LIHAT</button>"; 
                        jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{LIHAT:be}); 
                    }';
      }
  
}