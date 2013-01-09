<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of periode
 *
 * @author  
 */
class Opsi extends CI_Model  {
    //put your code here
    
    
    function __construct() {
        parent::__construct();
        
		//echo $this->_module;
    }
    
    function getOpsiSwakelola() {
        $arr_swakelola = array();
        
        $arr_swakelola[0] = 0; 
        $arr_swakelola[1] = 1; 
        
        return $arr_swakelola;
    }
     
    function getTipeKontrak() {
        $arr_tipekontrak = array();
        
        $arr_tipekontrak["RENTAL SERVICE"] = "RENTAL SERVICE"; 
        $arr_tipekontrak["LUMPSUM"] = "LUMPSUM";
        $arr_tipekontrak["HARGA SATUAN"] = "HARGA SATUAN";
        
        
        return $arr_tipekontrak;
    }
    
    function getDokumenKategori() {
        $sql = "SELECT KATEGORI ";
        $sql .= "FROM EP_PGD_DOKUMEN_KATEGORI ";
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        return $result;
        
        
        
    }
    
    function getPenataPerencana() {
         $arr_perencana = array();
          
         $sql = "SELECT KODE_JABATAN, NAMA_JABATAN from MS_JABATAN where nama_jabatan like 'PENATA PERENCANAAN%' ";
         $query = $this->db->query($sql); 
         $result = $query->result();
         
         foreach($result as $row){
             $arr_perencana[$row->KODE_JABATAN] = $row->NAMA_JABATAN; 
         } 
         
         
         return $arr_perencana;
         
    }
    
    function getPenataPelaksana() {
         $arr_pelaksana = array();
          
          
         
         $sql = "SELECT KODE_JABATAN, NAMA_JABATAN from MS_JABATAN where nama_jabatan like 'PENATA PELAKSANAAN PENGADAAN NON PELELANGAN%' ";
         $query = $this->db->query($sql); 
         $result = $query->result();
         
         foreach($result as $row){
             $arr_pelaksana[$row->KODE_JABATAN] = $row->NAMA_JABATAN; 
         } 
         
         return $arr_pelaksana;
         
    }
    
    
    function getMetodeTender() {
        $sql = "SELECT METODE_TENDER, NAMA_METODE_TENDER";
        $sql .= " FROM EP_PGD_METODE ";
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        return $result;
    }
 
    function getMetodeSampul($metode_tender) {
        $sql = "SELECT MS.METODE_SAMPUL, S.NAMA_METODE_SAMPUL ";
        $sql .= " FROM EP_PGD_METODE_SAMPUL MS ";
        $sql .= " LEFT JOIN EP_PGD_SAMPUL S ON MS.METODE_SAMPUL = S.METODE_SAMPUL ";
        $sql .= " WHERE MS.METODE_TENDER = " .$metode_tender;
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
        $str = "<option value='' >--</option>";
        foreach ($result as $row) {
            $str .= "<option value=".$row->METODE_SAMPUL." >".$row->NAMA_METODE_SAMPUL."</option>";
            
        } 
        
        echo $str;
    }
    
    
}

?>
