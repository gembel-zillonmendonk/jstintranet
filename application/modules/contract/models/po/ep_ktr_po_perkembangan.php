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
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>