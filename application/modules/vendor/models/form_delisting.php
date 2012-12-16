<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class form_delisting extends MY_Model {

    
    public $table = "EP_VENDOR";
    
    public $elements_conf = array('KODE_VENDOR', 'NAMA_VENDOR', 'NAMA_BARANG_JASA','KODE_BARANG_JASA');

    function __construct() {
        parent::__construct();
        $this->init();
        
        
        if(isset($_REQUEST['KODE_VENDOR']) && isset($_REQUEST['KODE_BARANG_JASA'])){
            $sql = "
                    select a.NAMA_VENDOR, b.*
                    from ep_vendor a
                    inner join (
                        select kode_vendor, kode_barang as kode_barang_jasa, nama_barang as nama_barang_jasa from ep_vendor_barang
                        union all
                        select kode_vendor, kode_jasa, nama_jasa from ep_vendor_jasa    
                    ) b on a.kode_vendor = b.kode_vendor
                    where a.kode_vendor = '".$_REQUEST['KODE_VENDOR']."'
                        and b.kode_barang_jasa = '".$_REQUEST['KODE_BARANG_JASA']."'
            ";
            $row = $this->db->query($sql)->row_array();
            if($row){
                $this->attributes['KODE_VENDOR'] = $row['KODE_VENDOR'];
                $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
                $this->attributes['KODE_BARANG_JASA'] = $row['KODE_BARANG_JASA'];
                $this->attributes['NAMA_BARANG_JASA'] = $row['NAMA_BARANG_JASA'];
                
                
            }
        }
        
    }

}

?>
