<?php

class ep_ktr_kontrak_jaminan extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $elements_conf = array(
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_TENDER',
//        'NO_KONTRAK',
//        'USER_PEMINTA',
//        'JABATAN_PEMINTA',
//        'KODE_VENDOR',
//        'NAMA_VENDOR',
//        'TGL_TTD',
//        'TGL_MULAI',
//        'TGL_AKHIR',
//        'TGL_BUAT',
//        'JUDUL_PEKERJAAN',
//        'TIPE_KONTRAK',
//        'JENIS_KONTRAK',
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
        'NILAI_JAMINAN' => array('pattern' => '^((\d+)|(\d{1,3})(\,\d{3}|)*)(\.\d{2}|)$'),
        'NILAI_MINIMAL_JAMINAN',
        'BANK_JAMINAN',
        'NO_JAMINAN',
        'TGL_MULAI_JAMINAN',
        'TGL_AKHIR_JAMINAN',
        'LAMPIRAN_JAMINAN' => array('type' => 'file'),
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
    public $validation = array(
        'NILAI_JAMINAN' => array('required' => 'true'),
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
        if (isset($_REQUEST['KODE_KONTRAK'])) {
            $sql = "SELECT NILAI_KONTRAK * 0.05 as NILAI_KONTRAK
                        FROM EP_KTR_KONTRAK
                        WHERE KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "' 
                            AND KODE_VENDOR = '" . $_REQUEST['KODE_VENDOR'] . "' 
                            AND KODE_TENDER = '" . $_REQUEST['KODE_TENDER'] . "' 
                            AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'";

            $row = $this->db->query($sql)->row_array();

            if (count($row)) {
//            $this->attributes['NILAI_JAMINAN'] = $row['TOTAL_JAMINAN'] * 1;
                $this->attributes['NILAI_MINIMAL_JAMINAN'] = $row['NILAI_KONTRAK'] * 1;
                $this->validation['NILAI_JAMINAN']['min'] = $row['NILAI_KONTRAK'] * 1;
            }
        } else if (isset($_REQUEST['KODE_TENDER']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_TENDER'] = $_REQUEST['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];

            $sql = "SELECT KODE_VENDOR,
                                KODE_TENDER,
                                KODE_KANTOR,
                                SUM (HARGA * JUMLAH) * 0.05 AS TOTAL_JAMINAN
                        FROM EP_PGD_ITEM_PENAWARAN
                        WHERE KODE_VENDOR = '" . $_REQUEST['KODE_VENDOR'] . "' 
                            AND KODE_TENDER = '" . $_REQUEST['KODE_TENDER'] . "' 
                            AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "' 
                        GROUP BY KODE_VENDOR, KODE_TENDER, KODE_KANTOR";

            $row = $this->db->query($sql)->row_array();

//            $this->attributes['NILAI_JAMINAN'] = $row['TOTAL_JAMINAN'] * 1;
            $this->attributes['NILAI_MINIMAL_JAMINAN'] = $row['TOTAL_JAMINAN'] * 1;
            $this->validation['NILAI_JAMINAN']['min'] = $row['TOTAL_JAMINAN'] * 1;
        }
    }

}

?>