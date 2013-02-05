<?php

class ep_ktr_perubahan_compare extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN';
    public $elements_conf = array(
//        'KODE_PERUBAHAN',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'TGL_MULAI' => array('type' => 'label'),
        'TGL_AKHIR' => array('type' => 'label'),
        'NILAI_KONTRAK' => array('type' => 'label'),
        
        'TGL_MULAI_SEBELUM' => array('type' => 'label'),
        'TGL_AKHIR_SEBELUM' => array('type' => 'label'),
        'NILAI_KONTRAK_SEBELUM' => array('type' => 'label'),
        
        'TGL_PERUBAHAN' => array('type' => 'label'),
        'MATA_UANG' => array('type' => 'label'),
//        'STATUS',
//        'POSISI_PERSETUJUAN',
        'TIPE_KONTRAK' => array('type' => 'label'),
        'JENIS_KONTRAK' => array('type' => 'label'),
        'NO_KONTRAK' => array('type' => 'label'),
//        'PERIODE_BAYAR_SEWA',
//        'UNIT_BAYAR_SEWA',
//        'TERMIN_BAYAR_SEWA',
        'KET_PERUBAHAN' => array('type' => 'label'),
        'ALASAN_PERUBAHAN' => array('type' => 'label'),
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();

        if (isset($_REQUEST['KODE_KONTRAK'])) {
            
//            $this->elements_conf['KODE_KONTRAK']['value'] = $_REQUEST['KODE_KONTRAK'];
//            
//            $row = $this->db->query("select * 
//                from EP_KTR_PERUBAHAN 
//                where KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'")->row_array();
//
//            if (!count($row)) {
//                // get default selected
//                $row = $this->db->query("select * 
//                    from EP_KTR_KONTRAK 
//                    where KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'")->row_array();
//            } else {
//                $this->attributes['KODE_PERUBAHAN'] = $row['KODE_PERUBAHAN'];
//            }
            
//            $this->attributes['KODE_KONTRAK'] = $row['KODE_KONTRAK'];
//            $this->attributes['KODE_KANTOR'] = $row['KODE_KANTOR'];
//            $this->attributes['TIPE_KONTRAK'] = $row['TIPE_KONTRAK'];
//            $this->attributes['TGL_MULAI'] = $row['TGL_MULAI'];
//            $this->attributes['TGL_AKHIR'] = $row['TGL_AKHIR'];
//            $this->attributes['JENIS_KONTRAK'] = $row['JENIS_KONTRAK'];
//            $this->attributes['NO_KONTRAK'] = $row['NO_KONTRAK'];
//            $this->attributes['MATA_UANG'] = $row['MATA_UANG'];
//            $this->attributes['NILAI_KONTRAK'] = $row['NILAI_KONTRAK'];
        }

    }


}
?>