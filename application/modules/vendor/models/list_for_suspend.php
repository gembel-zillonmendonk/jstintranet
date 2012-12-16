<?php

class list_for_suspend extends MY_Model {

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
        $kode_wkf = 54; //suspend vendor
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf and tanggal_selesai is null");
        
        $this->sql_select = "( 
                                select 
                                    a.KODE_VENDOR, a.NAMA_VENDOR, a.ALAMAT, a.STATUS
                                    , x.kode_proses, x.kode_wkf, x.nama, x.kode_aktifitas, x.nama_aktifitas, x.tanggal_mulai, x.tanggal_selesai, x.kode_posisi, x.kode_user, x.kode_aplikasi, x.parameter
                                    , '' as ACT 
                                from EP_VENDOR a
                                left join (
                                    $pivot_query
                                ) x on x.kode_vendor = a.kode_vendor
                                where a.status = 9 
                                and x.kode_vendor is null
                            )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/vendor/list_for_suspend&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    //var href = $site_url + "/vendor/form/form_suspend?" + param;
                    var href = $site_url + "/wkf/start?kode_wkf=54&" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">SUSPEND</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>