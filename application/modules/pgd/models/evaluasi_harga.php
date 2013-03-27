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
class Evaluasi_harga extends CI_Model {

    var $KODE_TENDER;
    var $KODE_KANTOR;
     
    
    
    function __construct() {
        parent::__construct();
    }

    function setNilaiHarga($kode_tender, $kode_kantor) {
        $this->KODE_TENDER = $kode_tender;
        $this->KODE_KANTOR = $kode_kantor;
        
        $min_val =  $this->minimal_harga();
        
        $sql = "UPDATE EP_PGD_TENDER_EVALUASI E
                            SET E.NILAI_HARGA =  
                            (SELECT   (100 * COALESCE(" .$min_val." ,0)) / SUM( COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS NILAI_HARGA 
                            FROM   EP_PGD_ITEM_PENAWARAN  P
                            WHERE  E.KODE_TENDER = P.KODE_TENDER AND E.KODE_KANTOR  = P.KODE_KANTOR AND E.KODE_VENDOR = P.KODE_VENDOR )";
          
                    $sql .= " WHERE E.KODE_KANTOR = '" .$_POST["KODE_KANTOR"]. "'";
                    $sql .= " AND E.KODE_TENDER = '" .$_POST["KODE_TENDER"]. "'";

                   
                    
                   $this->db->simple_query($sql);

                    
                      
        
    }
    
    
    function minimal_harga() {
        $sql = "SELECT KODE_VENDOR,  SUM(COALESCE(HARGA,0) * COALESCE(JUMLAH,0)) AS TOTAL_HARGA";
        $sql .= " FROM EP_PGD_ITEM_PENAWARAN ";
        $sql .= " WHERE KODE_TENDER = '". $this->KODE_TENDER ."'";
        $sql .= " AND KODE_KANTOR = '". $this->KODE_KANTOR ."'";
        $sql .= " GROUP BY  KODE_VENDOR ";
        $sql .= " ORDER BY TOTAL_HARGA ";
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        $val = 1;
        if (count($result)) {
            $val  =  $result[0]->TOTAL_HARGA ;
            
        }
        return $val; 
        
        
        
        
        
        
        
    }
    
}	