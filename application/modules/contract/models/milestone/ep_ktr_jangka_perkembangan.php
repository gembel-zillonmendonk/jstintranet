<?php

class ep_ktr_jangka_perkembangan extends MY_Model {

    public $table = 'EP_KTR_JANGKA_PERKEMBANGAN';
    public $elements_conf = array(
//        'KODE_PERKEMBANGAN',
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
//        'STATUS',
        'KETERANGAN',
    );
    public $columns_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
//        'STATUS',
        'KETERANGAN',
    );
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();

        if (isset($_REQUEST['KODE_JANGKA']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR'])) {
            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
        }
    }

    function _default_scope() {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR'])
                && isset($_REQUEST['KODE_JANGKA']))
            return " KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'"
                    . " AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'"
                    . " AND KODE_JANGKA = '" . $_REQUEST['KODE_JANGKA'] . "'";
    }

    public function _before_insert() {
        parent::_before_insert();

        $sql = "SELECT sum(PERSENTASI) as PERSEN FROM " . $this->table .
                " WHERE KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'"
                . " AND KODE_JANGKA = '" . $this->attributes['KODE_JANGKA'] . "'"
                . " AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'";

        $query = $this->db->query($sql);
        $row = $query->row_array();
        if ($row['PERSEN'] + $this->attributes['PERSENTASI'] > 100)
            show_error("PERSENTASI tidak boleh lebih dari 100");
    }

}

?>