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
class Rpt_pgd_kinerja_pengadaan_per_pelaksana extends MY_Model {
 
        public $table = "EP_PGD_TENDER";
    //public $table = "EP_NOMORURUT";
    
        public $tahun ;
	 	
		
    public $columns_conf = array(
                                'NAMA_PELAKSANA' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),
                                'NAMA_METODE_TENDER' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),
        'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),	
                                'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),	
                                'KODE_TENDER' =>array('hidden'=>false, 'width'=>5) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0) ,
        
				
                                'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),	
                                'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>10, 'align'=>'left'),	
                                'HPS'  =>array('hidden'=>false, 'width'=>10, 'align'=>'right'),         
                                'REALISASI'  =>array('hidden'=>false, 'width'=>10, 'align'=>'right'),  
                                'SELISIH_HARI_KALENDER'  =>array('hidden'=>false, 'width'=>10, 'align'=>'right')  
        
								 );
	
	
    public $sql_select = "(SELECT      T.NAMA_PELAKSANA 							  
				,T.KODE_KANTOR
                                , T.KODE_TENDER
				, K.NAMA_KANTOR
				, T.JUDUL_PEKERJAAN
								, SV.NAMA_VENDOR
                                , PT.METODE_SAMPUL
                                , M.NAMA_METODE_TENDER
                                , MS.NAMA_METODE_SAMPUL
                                , (SELECT SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) * 1.1
                                       FROM EP_PGD_ITEM_TENDER
                                       WHERE KODE_TENDER = T.KODE_TENDER AND KODE_KANTOR= T.KODE_KANTOR) AS HPS
                                , (SELECT SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) * 1.1
                                       FROM EP_PGD_ITEM_PENAWARAN P
                                       INNER JOIN EP_PGD_TENDER_VENDOR_STATUS S ON P.KODE_TENDER = S.KODE_TENDER AND P.KODE_KANTOR = S.KODE_KANTOR AND P.KODE_VENDOR = S.KODE_VENDOR
                                       WHERE S.PEMENANG = 1 AND P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR= T.KODE_KANTOR AND T.STATUS =  1901  ) AS REALISASI
                                       ,T.TGL_SELESAI
                                       ,T.TGL_REKAM
                                       , TRUNC(T.TGL_SELESAI) - TRUNC(T.TGL_REKAM) AS SELISIH_HARI_KALENDER
                     FROM EP_PGD_TENDER T
					 LEFT JOIN MS_KANTOR K ON T.KODE_KANTOR = K.KODE_KANTOR
                     INNER JOIN EP_PGD_PERSIAPAN_TENDER PT ON T.KODE_TENDER = PT.KODE_TENDER AND T.KODE_KANTOR = PT.KODE_KANTOR
                     INNER JOIN EP_PGD_METODE M ON PT.METODE_TENDER = M.METODE_TENDER
                     INNER JOIN EP_PGD_SAMPUL MS ON PT.METODE_SAMPUL = MS.METODE_SAMPUL
					 LEFT JOIN (SELECT S.KODE_TENDER, S.KODE_KANTOR, V.NAMA_VENDOR FROM EP_PGD_TENDER_VENDOR_STATUS S
					 	  	    INNER JOIN EP_VENDOR V ON S.KODE_VENDOR = V.KODE_VENDOR 
								WHERE PEMENANG = '1') SV ON T.KODE_TENDER = SV.KODE_TENDER AND T.KODE_KANTOR = SV.KODE_KANTOR )";
      
	
      
     function setParam() {
         $this->sql_select  = $this->sql_select . "  " .  $this->tahun ;
         $this->sql_select  = $this->sql_select . " ) X
					 GROUP BY X.KODE_KANTOR ) J ON K.KODE_KANTOR = J.KODE_KANTOR
                 	 WHERE K.KODE_KELAS != '0' 
               )";  
     }
    
    function __construct() {
        parent::__construct();
        $this->init();
        $this->tahun = $_GET["TAHUN"];
       // $this->setParam();
    }

}

?>
