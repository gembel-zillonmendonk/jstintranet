<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_total extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function total() {
           
            
            $sql = "SELECT KODE_TENDER ";
            $sql .= " , KODE_KANTOR ";
            $sql .= " , PAGU_ANGGARAN ";
            $sql .= " , SISA_ANGGARAN ";
            $sql .= " , HPS_TOTAL ";
            $sql .= " , HPS_NON_PPN ";
            $sql .= " , HPS_KENA_PPN ";
            $sql .= " , PPN ";
            $sql .= " , HPS_PPN ";
            $sql .= " FROM (SELECT T.KODE_TENDER
		, T.KODE_KANTOR
		, PAGU_ANGGARAN
		, SISA_ANGGARAN
                , HPS_NON_PPN
                , HPS_KENA_PPN
		, HPS_TOTAL
		, PPN
		, HPS_PPN
FROM  EP_PGD_TENDER T
LEFT JOIN (SELECT KODE_KANTOR, KODE_PERENCANAAN, SUM(PAGU_ANGGARAN)  AS PAGU_ANGGARAN, SUM(SISA_ANGGARAN) AS SISA_ANGGARAN
 		 FROM EP_PGD_PERENCANAAN_ANGGARAN
		 GROUP BY  KODE_KANTOR, KODE_PERENCANAAN) SA ON T.KODE_PERENCANAAN = SA.KODE_PERENCANAAN AND T.KODE_KANTOR_PERENCANAAN = SA.KODE_KANTOR
LEFT JOIN (SELECT  IT.KODE_TENDER
		, IT.KODE_KANTOR
                , SUM(COALESCE(IT.JUMLAH,0) * 
                 CASE
                    WHEN PPN = 'T' THEN COALESCE(IT.HARGA,0)
                    ELSE 0
                 END    
                 ) AS HPS_NON_PPN
                , SUM(COALESCE(IT.JUMLAH,0) * 
                 CASE
                    WHEN PPN = 'Y' THEN COALESCE(IT.HARGA,0)
                    ELSE 0
                 END    
                 ) AS HPS_KENA_PPN
		, SUM(COALESCE(IT.JUMLAH,0) * COALESCE(IT.HARGA,0)) AS HPS_TOTAL
		, SUM(COALESCE(IT.JUMLAH,0) * 
                 CASE
                    WHEN PPN = 'Y' THEN COALESCE(IT.HARGA,0)
                    ELSE 0
                 END    
                 ) * 0.10 AS PPN
		, (SUM(COALESCE(IT.JUMLAH,0) * 
                 CASE
                    WHEN PPN = 'T' THEN COALESCE(IT.HARGA,0)
                    ELSE 0
                 END    
                 )) +  (SUM(COALESCE(IT.JUMLAH,0) * 
                 CASE
                    WHEN PPN = 'Y' THEN COALESCE(IT.HARGA,0)
                    ELSE 0
                 END    
                 ) * 1.1 )  AS HPS_PPN
FROM EP_PGD_ITEM_TENDER IT
GROUP BY IT.KODE_TENDER , IT.KODE_KANTOR ) SIT ON SIT.KODE_TENDER = T.KODE_TENDER  AND SIT.KODE_KANTOR = T.KODE_KANTOR 
)  VW_TOTAL_HPS ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR"). "' ";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            $data["PAGU_ANGGARAN"] = 0;
            $data["SISA_ANGGARAN"] = 0;
            $data["HPS_TOTAL"] = 0;
            $data["PPN"] = 0;
            $data["HPS_PPN"] = 0;
            $data["HPS_KENA_PPN"] = 0;
            $data["HPS_NON_PPN"] = 0;
            
            if (count($result)) {
                $data["PAGU_ANGGARAN"] = $result[0]->PAGU_ANGGARAN;
                $data["SISA_ANGGARAN"] = $result[0]->SISA_ANGGARAN;
                $data["HPS_TOTAL"] =  $result[0]->HPS_TOTAL;
                $data["PPN"] =  $result[0]->PPN;
                $data["HPS_PPN"] =  $result[0]->HPS_PPN;
                $data["HPS_KENA_PPN"] = $result[0]->HPS_KENA_PPN;
                $data["HPS_NON_PPN"] = $result[0]->HPS_NON_PPN;
                
            }
            
            
            
		$this->load->view("item_total", $data);
	}
	 
        
        function total_pembelian() {
            
            $sql = "SELECT SUM(COALESCE(HARGA,0) * COALESCE(JUMLAH,0)) AS BELI FROM EP_PGD_PEMBELIAN_DETAIL";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR"). "' ";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            
            $data["BELI_TOTAL"] = 0;
            $data["PPN"] = 0;
            $data["BELI_PPN"] = 0;
            
            if (count($result)) {

                $data["BELI_TOTAL"] = $result[0]->BELI;
                $data["PPN"] =  $result[0]->BELI * 0.1 ;
                $data["BELI_PPN"] = $result[0]->BELI * 1.1;

            }
            
            
            $this->load->view("item_total_pembelian", $data);
        }
        
	
}	