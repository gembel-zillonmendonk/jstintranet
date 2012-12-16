<?php

class list_for_blacklist extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = null;
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
        
        $wkf = new Workflow();
        $kode_wkf = 52; //delisting vendor
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf and tanggal_selesai is null");
        
        $this->sql_select = "(
            select a.*, '' as ACT 
            from ep_vendor a
            left join (
                $pivot_query
            ) x on x.kode_vendor = a.kode_vendor
            where a.status = 9 and x.kode_vendor is null
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "kode_wkf=52&referer_url=/vendor/list_for_blacklist&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    var href = $site_url + "/wkf/start?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>