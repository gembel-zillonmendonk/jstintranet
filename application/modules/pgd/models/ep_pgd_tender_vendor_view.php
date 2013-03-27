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
class Ep_pgd_tender_vendor_view extends MY_Model {

    public $table = "EP_PGD_TENDER_VENDOR";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'KODE_VENDOR',
                            );
			 
    public $columns_conf = array( 
                            'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>40)    
                            , 'STATUS' =>array('hidden'=>false, 'width'=>20)    
                            , 'KETERANGAN' =>array('hidden'=>false, 'width'=>40)    
        
                            );

	
    public $sql_select = "(SELECT KODE_TENDER ,  KODE_KANTOR,   KODE_VENDOR,  NAMA_VENDOR, STATUS, KETERANGAN
                           FROM (SELECT
	TV.KODE_TENDER
	,TV.KODE_VENDOR
	, TV.KODE_KANTOR
	, V.NAMA_VENDOR
	, CASE PTVS.TEKNIKAL_STATUS
		WHEN   0 THEN 'DISQUALIFIED'
		WHEN   1 THEN 'QUALIFIED'
		WHEN   -1 THEN '-'
		ELSE 'BELUM DIVERIFIKASI'
	 END  TEKNIKAL_STATUS
	, CASE PTVS.KOMERSIAL_STATUS
		WHEN   0 THEN 'DISQUALIFIED'
		WHEN   1 THEN 'QUALIFIED'
		WHEN   -1 THEN '-'
		ELSE 'BELUM DIVERIFIKASI'
	 END  KOMERSIAL_STATUS
	, PTVS.KETERANGAN_TEKNIKAL
	, PTVS.KETERANGAN_KOMERSIAL
	, COALESCE(S.KODE_STATUS,1) AS KODE_STATUS
	, COALESCE(S.NAMA_STATUS,'BELUM_MENDAFTAR' ) AS  STATUS
        , PTVS.KETERANGAN_TEKNIKAL AS KETERANGAN
FROM EP_PGD_TENDER_VENDOR TV
INNER JOIN EP_VENDOR V ON TV.KODE_VENDOR = V.KODE_VENDOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR =PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
LEFT JOIN (SELECT KODE_TENDER, KODE_KANTOR ,KODE_VENDOR, SUM(COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS TOTAL FROM EP_PGD_ITEM_PENAWARAN
	 GROUP BY  KODE_TENDER, KODE_KANTOR,KODE_VENDOR ) H
	 	  ON 	  H.KODE_TENDER = PTVS.KODE_TENDER AND H.KODE_KANTOR = PTVS.KODE_KANTOR AND H.KODE_VENDOR = PTVS.KODE_VENDOR
) VW_PGD_TENDER_VENDOR_STATUS 
                            ";
    function setParam() {
                         if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            } 
            
                 $this->sql_select  = $this->sql_select . " WHERE   KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND  KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'   "; 
     
            
                
            $this->sql_select  = $this->sql_select . "    )";  
    }
		
    
function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
    }
	
}	