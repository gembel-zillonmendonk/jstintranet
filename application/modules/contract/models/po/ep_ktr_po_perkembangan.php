<?php

class ep_ktr_po_perkembangan extends MY_Model {

    public $table = 'EP_KTR_PO_PERKEMBANGAN';
    public $elements_conf = array(
//        'KODE_PERKEMBANGAN',
//        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'TGL_BUAT',
        'PEMBUAT',
        'NAMA_PEMBUAT',
//        'STATUS',
        'PERSENTASI_PERKEMBANGAN',
//        'POSISI_PERSETUJUAN',
        'KETERANGAN',
        'DETAIL_KONTRAK',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
        
        $sql = "select * from ep_ktr_kontrak
            where kode_kontrak='".$_REQUEST['KODE_KONTRAK']."'
            and kode_kantor='".$_REQUEST['KODE_KANTOR']."'
            and kode_vendor='".$_REQUEST['KODE_VENDOR']."'";
        
        $row = $this->db->query($sql)->row_array();
        $this->attributes['DETAIL_KONTRAK'] = $row['KODE_KONTRAK'] . "&nbsp;&nbsp;&nbsp;<button href='".(site_url('contract/contract/view_popup?KODE_PROSES='. (isset($_REQUEST['KODE_PROSES']) ? $_REQUEST['KODE_PROSES'] : 0) .'&KODE_KONTRAK=' . $row['KODE_KONTRAK'] .'&KODE_KANTOR=' .$row['KODE_KANTOR']. '&KODE_VENDOR=' . $row['KODE_VENDOR']. '&KODE_TENDER=' . $row['KODE_TENDER'] .'&'))."' onclick='window.open($(this).attr(\"href\") + window.location.search.substring(1), \"xx\", \"width=800,height=500\"); return false;'> [lihat detail] </button>";
    }

}

?>