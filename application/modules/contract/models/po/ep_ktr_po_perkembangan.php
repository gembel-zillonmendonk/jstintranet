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
        
        $wkf = new Workflow();
        $kode_wkf = 6; //contract flow
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
            
        $sql = "select a.*, x.kode_proses 
            from ep_ktr_kontrak a
            inner join (
                $pivot_query
            ) x on x.KODE_KONTRAK = a.KODE_KONTRAK and x.KODE_TENDER = a.KODE_TENDER and x.kode_kantor = a.kode_kantor and x.kode_vendor = a.kode_vendor
            where a.kode_kontrak='".$_REQUEST['KODE_KONTRAK']."'
            and a.kode_kantor='".$_REQUEST['KODE_KANTOR']."'
            and a.kode_vendor='".$_REQUEST['KODE_VENDOR']."'";
        
        $row = $this->db->query($sql)->row_array();
        $this->attributes['DETAIL_KONTRAK'] = $row['KODE_KONTRAK'] . "&nbsp;&nbsp;&nbsp;<button href='".(site_url('contract/contract/view_popup?KODE_PROSES='. $row['KODE_PROSES'] .'&KODE_KONTRAK=' . $row['KODE_KONTRAK'] .'&KODE_KANTOR=' .$row['KODE_KANTOR']. '&KODE_VENDOR=' . $row['KODE_VENDOR']. '&KODE_TENDER=' . $row['KODE_TENDER'] .'&'))."' onclick='window.open($(this).attr(\"href\"), \"xx\", \"width=800,height=500\"); return false;'> [lihat detail] </button>";
    }

}

?>