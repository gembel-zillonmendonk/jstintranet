<?php

class ep_ktr_jangka_kontrak_view extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KONTRAK';
    public $elements_conf = array(
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
        'KETERANGAN' => array('type' => 'textarea'),
//        'KETERANGAN_BASTP',
        'DETAIL_KONTRAK',
        'JUDUL_PEKERJAAN',
    );
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
        'KETERANGAN',
//        'KETERANGAN_BASTP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
    );
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];

        if (isset($_REQUEST['KODE_JANGKA']))
            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];

//        if (isset($_REQUEST['KODE_JANGKA']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
//        {
//            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//        }

        $wkf = new Workflow();
        $kode_wkf = 61; //milestone flow
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");


        // copy default value from ep_ktr_kontrak
        $sql = "select x.kode_proses, a.JUDUL_PEKERJAAN, a.nama_vendor, a.nilai_kontrak, a.kode_tender, a.kode_vendor, a.kode_kontrak, a.kode_kantor
                from ep_ktr_kontrak a
                inner join (
                    $pivot_query
                ) x on x.KODE_KONTRAK = a.KODE_KONTRAK and x.kode_kantor = a.kode_kantor "
                . " where a.kode_kontrak = '" . $this->attributes['KODE_KONTRAK'] . "'"
                . " and a.kode_kantor = '" . $this->attributes['KODE_KANTOR'] . "'";

        $row = $this->db->query($sql)->row_array();
        if (count($row) > 0) {
            $this->attributes['DETAIL_KONTRAK'] = $row['KODE_KONTRAK'] . "&nbsp;&nbsp;&nbsp;<button href='" . (site_url('contract/contract/view_popup?KODE_PROSES=' . $row['KODE_PROSES'] . '&KODE_KONTRAK=' . $row['KODE_KONTRAK'] . '&KODE_KANTOR=' . $row['KODE_KANTOR'] . '&KODE_VENDOR=' . $row['KODE_VENDOR'] . '&KODE_TENDER=' . $row['KODE_TENDER'] . '&')) . "' onclick='window.open($(this).attr(\"href\"), \"xx\", \"width=800,height=500\"); return false;'> [lihat detail] </button>";
            $this->attributes['JUDUL_PEKERJAAN'] = $row['JUDUL_PEKERJAAN'];
        }
    }

    function _default_scope() {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return " KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'" .
                    " AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'";
    }

    public function _before_insert() {
        parent::_before_insert();
        // set auto increament
        if ($this->attributes['KODE_JANGKA'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_JANGKA_KONTRAK'")->row_array();
            $this->attributes['KODE_JANGKA'] = $row['NEXT_ID'];
        }

        $sql = "SELECT sum(PERSENTASI) as PERSEN FROM " . $this->table .
                " WHERE KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'" .
                " AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'";

        $query = $this->db->query($sql);
        $row = $query->row_array();
        if ($row['PERSEN'] + $this->attributes['PERSENTASI'] > 100)
            show_error("PERSENTASI tidak boleh lebih dari 100");
    }

    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_KTR_JANGKA_KONTRAK'");
    }

}

?>