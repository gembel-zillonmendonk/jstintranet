<?php

class ep_ktr_kontrak extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $elements_conf = array(
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_TENDER',
//        'NO_KONTRAK',
//        'USER_PEMINTA',
//        'JABATAN_PEMINTA',
//        'KODE_VENDOR',
        'NAMA_VENDOR',
//        'TGL_TTD',
        'TGL_MULAI',
        'TGL_AKHIR',
//        'TGL_BUAT',
        'JUDUL_PEKERJAAN',
        'TIPE_KONTRAK',
        'JENIS_KONTRAK'=>array('type'=>'dropdown', 'options'=>array('SPK'=>'SPK','PERJANJIAN'=>'PERJANJIAN')),
//        'PESANAN_ULANG',
//        'MATA_UANG',
        'NILAI_KONTRAK',
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
        'LINGKUP_KERJA',
        'CATATAN'=>array('type'=>'textarea'),
//        'DP_CATATAN',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
        'TGL_PENETAPAN_PEMENANG',
        'NILAI_HPS',
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

    public $validation = array(
        'NILAI_JAMINAN' => array('required'=>'true'),
        );
    
    function __construct() {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_TENDER']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_TENDER'] = $_REQUEST['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];

            $sql = "SELECT a.KODE_TENDER, a.KODE_KANTOR, a.JUDUL_PEKERJAAN, a.TGL_SELESAI
                    , a.LINGKUP_PEKERJAAN, a.TIPE_KONTRAK, c.KODE_VENDOR, c.NAMA_VENDOR  
                    , x.TOTAL_HARGA
                    , y.TOTAL_HARGA_HPS
                FROM EP_PGD_TENDER a
                INNER JOIN EP_PGD_TENDER_VENDOR_STATUS b ON a.KODE_TENDER = b.KODE_TENDER
                INNER JOIN EP_VENDOR c ON b.KODE_VENDOR = c.KODE_VENDOR
                INNER JOIN (  
                        SELECT KODE_VENDOR,
                                KODE_TENDER,
                                KODE_KANTOR,
                                SUM (HARGA * JUMLAH) AS TOTAL_HARGA
                        FROM EP_PGD_ITEM_PENAWARAN
                        GROUP BY KODE_VENDOR, KODE_TENDER, KODE_KANTOR
                ) x ON b.KODE_VENDOR = x.KODE_VENDOR AND x.KODE_TENDER = b.KODE_TENDER AND x.KODE_KANTOR = b.KODE_KANTOR
                INNER JOIN (  
                        SELECT KODE_KANTOR,
                                KODE_TENDER,
                                SUM (HARGA * JUMLAH) AS TOTAL_HARGA_HPS
                        FROM EP_PGD_ITEM_TENDER
                        GROUP BY KODE_KANTOR, KODE_TENDER
                ) y ON a.KODE_KANTOR = y.KODE_KANTOR AND y.KODE_TENDER = a.KODE_TENDER
                LEFT OUTER JOIN EP_KTR_KONTRAK d ON a.KODE_TENDER = d.KODE_TENDER
                WHERE COALESCE (b.pemenang, '0') = '1'
                AND COALESCE (a.pembuatan_kontrak, '0') = '0'
                AND d.KODE_TENDER IS NULL 
                AND a.KODE_TENDER = '" . $this->attributes['KODE_TENDER'] . "'" .
                    " and a.KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'" .
                    " and b.KODE_VENDOR = " . $this->attributes['KODE_VENDOR'];

            $query = $this->db->query($sql);
            $row = $query->row_array();
//echo $sql;
//        print_r($row);
            if ($row) {
                $this->attributes['KODE_TENDER'] = $row['KODE_TENDER'];
                $this->attributes['KODE_KANTOR'] = $row['KODE_KANTOR'];
                $this->attributes['KODE_VENDOR'] = $row['KODE_VENDOR'];
                $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
                $this->attributes['JUDUL_PEKERJAAN'] = $row['JUDUL_PEKERJAAN'];
                $this->attributes['LINGKUP_KERJA'] = $row['LINGKUP_PEKERJAAN'];
                $this->attributes['TIPE_KONTRAK'] = $row['TIPE_KONTRAK'];
                $this->attributes['NILAI_KONTRAK'] = $row['TOTAL_HARGA'];
                $this->attributes['NILAI_HPS'] = $row['TOTAL_HARGA_HPS'];
                $this->attributes['TGL_PENETAPAN_PEMENANG'] = $row['TGL_SELESAI'];
                
            }
            else
            {
                $sql = "SELECT a.KODE_KANTOR,
                                a.KODE_TENDER,
                                SUM (HARGA * JUMLAH) AS TOTAL_HARGA_HPS,
                                b.TGL_SELESAI
                        FROM EP_PGD_ITEM_TENDER a
                        inner join EP_PGD_TENDER b on a.KODE_TENDER = b.KODE_TENDER and a.KODE_KANTOR = b.KODE_KANTOR 
                        where a.KODE_TENDER = '" . $this->attributes['KODE_TENDER'] . "'" .
                        " and a.KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'" .
                        " group by a.KODE_KANTOR, a.KODE_TENDER, b.TGL_SELESAI";
                
                $query = $this->db->query($sql);
                $row = $query->row_array();
                
                $this->attributes['NILAI_HPS'] = $row['TOTAL_HARGA_HPS'];
                $this->attributes['TGL_PENETAPAN_PEMENANG'] = $row['TGL_SELESAI'];
            }
//            print_r($this->attributes);
        }
    }

    public function _before_insert() {
        parent::_before_insert();
        // set auto increament
        if ($this->attributes['KODE_KONTRAK'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_KONTRAK'")->row_array();
            $this->attributes['KODE_KONTRAK'] = $row['NEXT_ID'];
        }
    }
    
    public function _after_insert() {
        parent::_after_insert();

        if (isset($this->attributes['KODE_TENDER']) != "" &&
                isset($this->attributes['KODE_KANTOR']) != "" &&
                isset($this->attributes['KODE_VENDOR']) != "") {

            $sql = "INSERT INTO EP_KTR_KONTRAK_ITEM  (KODE_KONTRAK, KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, JUMLAH)
                    SELECT '".$this->attributes['KODE_KONTRAK']."' as \"KODE_KONTRAK\", KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, JUMLAH  
                    FROM EP_PGD_ITEM_PENAWARAN
                    WHERE 
                        KODE_TENDER = '" . $this->attributes['KODE_TENDER'] . "'
                        AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'
                        AND KODE_VENDOR = " . $this->attributes['KODE_VENDOR'];
            
            $query = $this->db->query($sql);
        }
        
        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_KONTRAK'");
    }

}

?>