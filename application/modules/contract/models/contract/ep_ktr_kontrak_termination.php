<?php

class ep_ktr_kontrak_termination extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_TENDER',
        'KODE_VENDOR',
//        'STATUS' => array('type' => 'hidden'),
//        'TGL_PEMUTUSAN' => array('type' => 'hidden'),
        'ALASAN_PEMUTUSAN' => array('type' => 'dropdown', 'options' => array('SELESAI' => 'SELESAI', 'TERMINASI' => 'TERMINASI')),
        'CATATAN_PEMUTUSAN' => array('type' => 'textarea'),
        'LAMPIRAN_PEMUTUSAN' => array('type' => 'file'),
    );
    public $dir = 'contract';
    public $form_view = 'contract/contract/ep_ktr_kontrak_termination';
    public $review_rows = array();

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_TENDER']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_TENDER'] = $_REQUEST['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
        }

        $sql = "SELECT KODE_PARAM, KODE_INDUK_PARAM, KETERANGAN, NILAI, LEVEL
                FROM EP_VENDOR_PERF_MASTER
                WHERE TERLIHAT = 'FINAL REVIEW' 
                START WITH KODE_PARAM = 0000   
                CONNECT BY PRIOR KODE_PARAM = KODE_INDUK_PARAM";

        $this->review_rows = $this->db->query($sql)->result_array();
    }

    function _before_save() {
        parent::_before_save();

        $sql = "select a.kode_tender, a.kode_vendor, b.kode_barang_jasa as KODE_KEL_JASA_BARANG
                from ep_ktr_kontrak a
                inner join ep_ktr_kontrak_item b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                where a.kode_tender = '" . $this->attributes['KODE_TENDER'] . "'" .
                " and a.kode_kontrak = '" . $this->attributes['KODE_KONTRAK'] . "'" .
                " and a.kode_kantor = '" . $this->attributes['KODE_KANTOR'] . "'" .
                " and a.kode_vendor = " . $this->attributes['KODE_VENDOR'];

        $rows = $this->db->query($sql)->result_array();

        if (count($rows) > 0) {

            // insert manual by human
            foreach ($rows as $val) {
                $val['TANGGAL'] = date('d-m-Y');
                $val['TIPE_KOMODITI'] = 'M';

                $details = $_REQUEST['EP_VENDOR_KINERJA'];
                foreach ($details as $k => $v) {
                    $val['KODE_PARAM'] = $k;
                    $val['NAMA_PARAM'] = $v['NAMA_PARAM'];
                    $val['PILIHAN_PARAM'] = isset($v['PILIHAN_PARAM']) ? $v['PILIHAN_PARAM'] : 0;

                    $cek = $this->db->query("SELECT * 
                        FROM EP_VENDOR_KINERJA 
                        WHERE KODE_VENDOR='" . $val['KODE_VENDOR'] . "'
                        AND TIPE_KOMODITI='" . $val['TIPE_KOMODITI'] . "'
                        AND KODE_KEL_JASA_BARANG='" . $val['KODE_KEL_JASA_BARANG'] . "'
                        AND KODE_TENDER='" . $val['KODE_TENDER'] . "'
                        AND KODE_PARAM='" . $val['KODE_PARAM'] . "'")->result_array();

                    if (!count($cek))
                        $this->db->insert("EP_VENDOR_KINERJA", $val);
                    else
                        $this->db->update("EP_VENDOR_KINERJA", $val, array(
                            'KODE_VENDOR' => $val['KODE_VENDOR'],
                            'TIPE_KOMODITI' => $val['TIPE_KOMODITI'],
                            'KODE_KEL_JASA_BARANG' => $val['KODE_KEL_JASA_BARANG'],
                            'KODE_TENDER' => $val['KODE_TENDER'],
                            'KODE_PARAM' => $val['KODE_PARAM'],
                        ));
                }
            }

            // insert auto by system
            foreach ($rows as $val) {

                $sql = "SELECT KODE_PARAM, KETERANGAN as NAMA_PARAM, NILAI as PILIHAN_PARAM
                FROM EP_VENDOR_PERF_MASTER
                WHERE TERLIHAT is null 
                and KALKULASI is not null";

                $other_review_rows = $this->db->query($sql)->result_array();
                foreach ($other_review_rows as $v) {
                    $v['TANGGAL'] = date('d-m-Y');
                    $v['TIPE_KOMODITI'] = 'M';
                    $v['KODE_KEL_JASA_BARANG'] = $val['KODE_KEL_JASA_BARANG'];
                    $v['KODE_VENDOR'] = $val['KODE_VENDOR'];
                    $v['KODE_TENDER'] = $val['KODE_TENDER'];

                    $cek = $this->db->query("SELECT * 
                        FROM EP_VENDOR_KINERJA 
                        WHERE KODE_VENDOR='" . $v['KODE_VENDOR'] . "'
                        AND TIPE_KOMODITI='" . $v['TIPE_KOMODITI'] . "'
                        AND KODE_KEL_JASA_BARANG='" . $v['KODE_KEL_JASA_BARANG'] . "'
                        AND KODE_TENDER='" . $v['KODE_TENDER'] . "'
                        AND KODE_PARAM='" . $v['KODE_PARAM'] . "'")->result_array();

                    if (!count($cek) > 0)
                        $this->db->insert("EP_VENDOR_KINERJA", $v);
                    else
                        $this->db->update("EP_VENDOR_KINERJA", $v, array(
                            'KODE_VENDOR' => $v['KODE_VENDOR'],
                            'TIPE_KOMODITI' => $v['TIPE_KOMODITI'],
                            'KODE_KEL_JASA_BARANG' => $v['KODE_KEL_JASA_BARANG'],
                            'KODE_TENDER' => $v['KODE_TENDER'],
                            'KODE_PARAM' => $v['KODE_PARAM'],
                        ));
                }
            }
        }

        $this->attributes['TGL_PEMUTUSAN'] = date('d-m-Y');
        $this->attributes['STATUS'] = 'C';
        
        if (isset($this->attributes['LAMPIRAN_PEMUTUSAN']) && strlen($this->attributes['LAMPIRAN_PEMUTUSAN']) == 0)
            unset($this->attributes['LAMPIRAN_PEMUTUSAN']);
    }

    function _after_save() {
        parent::_after_insert();
        
//        $this->attributes['ROW_ID'] = '';
//        $this->db->query("begin 
//                PROC_EP_TO_AT_PENGADAAN_BARANG('" . $this->attributes['KODE_TENDER'] . "'); 
//            end;", FALSE, FALSE);
        
        $sql = "INSERT INTO AT_PENGADAAN_BARANG
      SELECT a.kode_tender AS kode_pengadaan,
             a.kode_tender AS kode_pengadaan_lama,
             a.kode_tender AS no_pengadaan,
             b.no_kontrak AS no_perjanjian,
             a.kode_kantor AS kode_kantor_peminta,
             a.judul_pekerjaan AS nama_pekerjaan,
             a.lingkup_pekerjaan AS desc_pekerjaan,
             a.kode_kantor_perencanaan AS kode_kantor_pengadaan,
             b.kode_vendor AS kode_rekanan,
             b.status AS status,
             0 AS batal,
             SYSDATE AS tgl_rekam,
             'EPROC' AS petugas_rekam,
             '' as TGL_UBAH,
             '' as petugas_ubah
        FROM    ep_pgd_tender a
             INNER JOIN
                ep_ktr_kontrak b
             ON     a.kode_tender = b.kode_tender
                AND a.kode_kantor = b.kode_kantor
        WHERE a.kode_tender = '" . $this->attributes['KODE_TENDER'] . "'";

        $this->db->query($sql);
        
        $sql = "INSERT INTO AT_PENGADAAN_BARANG_DETAIL
            SELECT c.kode_tender AS KODE_PENGADAAN,
             ROWNUM AS NO_URUT,
             kode_barang_jasa AS KODE_BARANG,
             kode_sub_barang_jasa AS KODE_SUB_BARANG,
             jumlah AS JUMLAH,
             b.tgl_bastp AS TGL_TERIMA,
             jumlah AS JUMLAH_TERIMA,
             satuan AS JENIS_SATUAN,
             '' AS KAP,
             keterangan AS KETERANGAN,
             '' AS MATA_ANGGARAN,
             'eproc' AS PETUGAS_REKAM,
             '' as TGL_UBAH,
             '' as petugas_ubah,
             'A' AS STATUS
        FROM ep_ktr_kontrak_item a
             INNER JOIN (  SELECT kode_kontrak,
                                  kode_kantor,
                                  MAX (tgl_bastp) AS tgl_bastp
                             FROM ep_ktr_jangka_kontrak
                         GROUP BY kode_kontrak, kode_kantor) b
                ON     a.kode_kontrak = b.kode_kontrak
                   AND a.kode_kantor = b.kode_kantor
             INNER JOIN ep_ktr_kontrak c
                ON     a.kode_kontrak = b.kode_kontrak
                   AND a.kode_kantor = b.kode_kantor
        WHERE c.kode_tender = '" . $this->attributes['KODE_TENDER'] . "'";
        
        $this->db->query($sql);
    }
}

?>