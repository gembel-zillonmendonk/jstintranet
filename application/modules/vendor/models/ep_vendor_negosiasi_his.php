<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_negosiasi_his extends MY_Model {

    public $table = "EP_VENDOR_NEGOSIASI_HIS";
    public $elements_conf = array(
//        'KODE_NEGOSIASI',
        'KODE_VENDOR',
        'TIPE_KOMODITI',
        'PROD_EXP_ID',
        'KETERANGAN',
        'STATUS' => array('type' => 'dropdown', 'options' => array('LISTED' => 'LISTED', 'NOT LISTED' => 'NOT LISTED')),
    );
    public $validation = array(
        'KODE_VENDOR' => array('required' => true),
        'TIPE_KOMODITI' => array('required' => true),
        'PROD_EXP_ID' => array('required' => true),
        'KETERANGAN' => array('required' => true),
        'STATUS' => array('required' => true),
    );
    public $columns_conf = array(
        'KODE_NEGOSIASI',
        'KODE_VENDOR',
        'TIPE_KOMODITI',
        'PROD_EXP_ID',
        'TANGGAL',
        'KETERANGAN',
        'STATUS',
    );
    public $sql_select = "(select * from EP_VENDOR_NEGOSIASI_HIS)";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();

        if (isset($_REQUEST['KODE_VENDOR']) && isset($_REQUEST['TIPE_KOMODITI']) && isset($_REQUEST['KODE_BARANG'])) {
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
            $this->attributes['TIPE_KOMODITI'] = $_REQUEST['TIPE_KOMODITI'];
            $this->attributes['PROD_EXP_ID'] = $_REQUEST['KODE_BARANG'];
        }

    }

    function _default_scope() {
        return ' KODE_VENDOR = ' . $this->attributes['KODE_VENDOR'] .
                //' AND TIPE_KOMODITI = \'' . $this->attributes['TIPE_KOMODITI'] . '\'' .
                ' AND PROD_EXP_ID = \'' . $this->attributes['PROD_EXP_ID'] . '\'';
    }

    function _before_insert() {
        parent::_before_insert();

        $this->attributes['TANGGAL'] = date('Y-m-d H:i:s');
        $this->attributes['USERNAME'] = $this->session->userdata('user_id');

        // set auto increament
        if (!isset($this->attributes['KODE_NEGOSIASI'])) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID from ep_nomorurut where kode_nomorurut = 'EP_VENDOR_NEGOSIASI_HIS'")->row_array();
            $this->attributes['KODE_NEGOSIASI'] = $row['NEXT_ID'];
        }
    }

    function _after_insert() {
        parent::_after_insert();
        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_VENDOR_NEGOSIASI_HIS'");
    }

}

?>
