<?php

class list_all extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( select a.*, '' as ACT from EP_VENDOR a where status is not null )";
    public $columns_conf = array(
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'ALAMAT',
        'STATUS',
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
                    
                    var param = "referer_url=/vendor/list_all&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    var href = $site_url + "/vendor/view?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>