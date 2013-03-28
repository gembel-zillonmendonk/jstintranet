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
class Rpt_pgd_kinerja_pengadaan extends MY_Model {
 
        public $table = "EP_PGD_TENDER";
    //public $table = "EP_NOMORURUT";
    
        public $tahun ;
	 	
		
    public $columns_conf = array('KODE_KANTOR' =>array('hidden'=>true, 'width'=>0) ,
				'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>40, 'align'=>'left'),	
                                'JUMLAH_PENGADAN'  =>array('hidden'=>false, 'width'=>20, 'align'=>'right'), 
                                'JUMLAH_HPS'  =>array('hidden'=>false, 'width'=>20, 'align'=>'right'),         
                                'JUMLAH_REALISASI'  =>array('hidden'=>false, 'width'=>20, 'align'=>'right'),         
								 );
	
	
    public $sql_select = "(SELECT 
                		   K.KODE_KANTOR
                		   , K.NAMA_KANTOR 
						   , TO_CHAR(COALESCE(J.JUMLAH_PENGADAN,0) ,'999G999G999G999') AS JUMLAH_PENGADAN
						   , TO_CHAR(COALESCE(J.JUMLAH_HPS,0) ,'999G999G999G999')  AS JUMLAH_HPS
						   , TO_CHAR(COALESCE(J.JUMLAH_REALISASI,0) ,'999G999G999G999') AS JUMLAH_REALISASI
						    
                    FROM MS_KANTOR K
					LEFT JOIN 
					(SELECT X.KODE_KANTOR
						   , COUNT(X.KODE_TENDER) AS JUMLAH_PENGADAN
						   , SUM(X.HPS) AS JUMLAH_HPS
						   , SUM(X.REALISASI) AS JUMLAH_REALISASI
					FROM (
					
					SELECT T.KODE_KANTOR
                                , T.KODE_TENDER
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
                     INNER JOIN EP_PGD_PERSIAPAN_TENDER PT ON T.KODE_TENDER = PT.KODE_TENDER AND T.KODE_KANTOR = PT.KODE_KANTOR
                     INNER JOIN EP_PGD_METODE M ON PT.METODE_TENDER = M.METODE_TENDER
                     INNER JOIN EP_PGD_SAMPUL MS ON PT.METODE_SAMPUL = MS.METODE_SAMPUL
                     WHERE EXTRACT(YEAR FROM T.TGL_REKAM) = ";
      
	
      
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
        $this->setParam();
    }

}

?>
