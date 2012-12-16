<?php

class list_update_number_smk extends MY_Model {

    public $table = 'EP_VENDOR_WILAYAH';
    public $dir = 'vendor';
    public $sql_select = "( select a.*, b.KODE_WILAYAH, b.WILAYAH, b.NO_SMK, b.TGL_SMK, b.BERLAKU_SMK, b.STATUS_AKTIF, '' as ACT 
        from EP_VENDOR a 
        inner join EP_VENDOR_WILAYAH b on a.KODE_VENDOR = b.KODE_VENDOR
        where a.status in (9, -2) )";
    
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'TGL_REKAM',
        'KODE_WILAYAH',
        'WILAYAH',
        'NO_SMK',
        'TGL_SMK',
        'BERLAKU_SMK',
        'STATUS_AKTIF',
        'ACT',
    );
    
    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/vendor/list_update_number_smk&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_WILAYAH=" + data[\'KODE_WILAYAH\'];
                    var href = $site_url + "/vendor/form/form_update_smk?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">UPDATE</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>