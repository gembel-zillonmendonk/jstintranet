<?php

class ep_ktr_kontrak_finalisasi extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $elements_conf = array(
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_TENDER',
//        'KODE_VENDOR',
        'NO_KONTRAK' => array('type' => 'hidden'),
//        'USER_PEMINTA',
//        'JABATAN_PEMINTA',
        
//        'NAMA_VENDOR',
        'TGL_TTD',
//        'TGL_MULAI',
//        'TGL_AKHIR',
//        'TGL_BUAT',
//        'JUDUL_PEKERJAAN',
//        'TIPE_KONTRAK',
        'JENIS_KONTRAK' => array('type' => 'hidden'),
//        'PESANAN_ULANG',
//        'MATA_UANG',
//        'NILAI_KONTRAK',
//        'PERIODE_BAYAR_SEWA',
//        'UNIT_BAYAR_SEWA',
//        'TERMIN_BAYAR_SEWA',
//        'STATUS',
//        'TGL_PEMUTUSAN',
//        'POSISI_PERSETUJUAN',
//        'JUMLAH_PERUBAHAN',
//        'TGL_AKHIR_PENAWARAN',
//        'NILAI_JAMINAN',
//        'BANK_JAMINAN',
//        'NO_JAMINAN ',
//        'TGL_MULAI_JAMINAN',
//        'TGL_AKHIR_JAMINAN',
//        'LAMPIRAN_JAMINAN',
//        'UM_PERSENTASI',
//        'UM_NILAI',
//        'JABATAN_PEMBUAT',
//        'ALASAN_PEMUTUSAN',
//        'CATATAN_PEMUTUSAN',
//        'LINGKUP_KERJA',
//        'CATATAN',
//        'DP_CATATAN',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
    );
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE TENDER',
        'NO_KONTRAK',
        'USER_PEMINTA',
        'JABATAN_PEMINTA',
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'TGL_TTD',
        'TGL_MULAI',
        'TGL_AKHIR',
        'TGL_BUAT',
        'JUDUL_PEKERJAAN',
        'TIPE_KONTRAK',
        'JENIS_KONTRAK',
        'PESANAN_ULANG',
        'MATA_UANG',
        'NILAI_KONTRAK',
        'PERIODE_BAYAR_SEWA',
        'UNIT_BAYAR_SEWA',
        'TERMIN_BAYAR_SEWA',
        'STATUS',
        'TGL_PEMUTUSAN',
        'POSISI_PERSETUJUAN',
        'JUMLAH_PERUBAHAN',
        'TGL_AKHIR_PENAWARAN',
        'NILAI_JAMINAN',
        'BANK_JAMINAN',
        'NO_JAMINAN ',
        'TGL_MULAI_JAMINAN',
        'TGL_AKHIR_JAMINAN',
        'LAMPIRAN_JAMINAN',
        'UM_PERSENTASI',
        'UM_NILAI',
        'JABATAN_PEMBUAT',
        'ALASAN_PEMUTUSAN',
        'CATATAN_PEMUTUSAN',
        'LINGKUP_KERJA',
        'CATATAN',
        'DP_CATATAN',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
        
        // set default value
        if(isset($_REQUEST['KODE_TENDER']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])){
            $this->attributes['KODE_TENDER'] = $_REQUEST['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
        }
    }

    function _before_update() {
        parent::_before_update();
        
        // set sequence number NO_KONTRAK
        $no_urut = 1;
        $ftgl_ttd = substr(str_replace("-", "", $this->attributes['TGL_TTD']), 2); // convert from 20-12-2013 to 20122013
        
        try {
            $sql = "select 
                    max(to_number(replace(regexp_substr(NO_KONTRAK, '\/(.*?)\/'), '/' , ''))) + 1 as next_id
                    from ep_ktr_kontrak
                    where to_char(tgl_ttd, 'MMYYYY') = '".$ftgl_ttd."'";
            $row = $this->db->query($sql)->row_array();
        } catch( Exception $e) { }
        
        $this->attributes['NO_KONTRAK'] = sprintf('%1$s/%2$05s/%3$06d', $this->attributes['JENIS_KONTRAK'], count($row) > 0 ? $row['NEXT_ID'] : $no_urut, $ftgl_ttd);
        
    }
}

?>