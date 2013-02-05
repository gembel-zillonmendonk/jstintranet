<?php

class ep_ktr_perubahan_item extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_ITEM';
    public $elements_conf = array(
//        'KODE_PERUBAHAN',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_BARANG_JASA',
//        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
//        'SATUAN',
//        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
//        'KODE_PERUBAHAN',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
//        'SATUAN',
        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
    );
    public $dir = 'ammend';
    public $toolbar = true;
    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->js_grid_completed = '
                var total = 0;
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    total += Number(data[\'SUB_TOTAL\']);
		}
                
                $("#t_grid_' . strtolower(get_class($this)) . '").css({"text-align":"right", "width":"100%"}).html("TOTAL : " + total + "&nbsp;&nbsp;");
        ';
        
        if(isset($_REQUEST['KODE_PERUBAHAN']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
        {
            $this->attributes['KODE_PERUBAHAN'] = $_REQUEST['KODE_PERUBAHAN'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
        }
    }
    
    function _default_scope() {
        parent::_default_scope();
        
        return " kode_kontrak = '".$_REQUEST['KODE_KONTRAK']."'";
    }
    
    function _before_save() {
        parent::_before_save();
        
        $this->attributes['SUB_TOTAL'] = $this->attributes['HARGA'] * $this->attributes['JUMLAH'];
    }
}

?>