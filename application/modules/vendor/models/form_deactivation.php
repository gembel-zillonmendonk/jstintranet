<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class form_deactivation extends MY_Model {

    public $table = "EP_VENDOR_WILAYAH";
    public $elements_conf = array(
        'KODE_VENDOR'=>array('type'=>'hidden'),
        'NAMA_VENDOR',
        'ALAMAT',
        'KODE_WILAYAH'=>array('type'=>'hidden'),
//        'WILAYAH',
        'STATUS_AKTIF'=>array('type'=>'dropdown', 'options'=>array('0'=>'NON AKTIF', '1'=>'AKTIF')),
    );

    //public $sql_select = "select b.*, a.nama_vendor, b.alamat from ep_vendor a inner join EP_VENDOR_WILAYAH b on a.kode_vendor = b.kode_vendor";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_VENDOR']) && isset($_REQUEST['KODE_WILAYAH'])) {
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
            $this->attributes['KODE_WILAYAH'] = $_REQUEST['KODE_WILAYAH'];

            $row = $this->db->query("select nama_vendor, alamat from ep_vendor where kode_vendor = " . $this->attributes['KODE_VENDOR'])->row_array();
            $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
            $this->attributes['ALAMAT'] = $row['ALAMAT'];
        }
    }

    public function _default_scope() {
        parent::_default_scope();
        return " a.kode_vendor = " . $this->attributes['KODE_VENDOR'] .
                " and b.kode_wilayah = " . $this->attributes['KODE_WILAYAH'];
    }

    public function _before_save() {
        parent::_before_save();
        unset($this->attributes['NAMA_VENDOR']);
        unset($this->attributes['ALAMAT']);
    }

}

?>
