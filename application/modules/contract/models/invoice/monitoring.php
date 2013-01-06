<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_INVOICE';
    public $sql_select = null;
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_INVOICE',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'AKUN_BANK',
        'NAMA_VENDOR',
        'TGL_INVOICE',
        'STATUS',
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'URL',
        'ACT',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();

        $wkf = new Workflow();
        $kode_wkf = 62; //invoice
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
        
        $this->sql_select = "(
            select a.*, x.kode_proses, x.nama_aktifitas, x.url, '' as ACT 
            from EP_KTR_INVOICE a
            inner join (
                $pivot_query
            ) x on x.KODE_INVOICE = a.KODE_INVOICE and x.KODE_KONTRAK = a.KODE_KONTRAK and x.KODE_KANTOR = a.KODE_KANTOR and x.KODE_VENDOR = a.KODE_VENDOR
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/contract/milestone/monitoring&KODE_PROSES=" + data[\'KODE_PROSES\'] + 
                                "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + 
                                "&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + 
                                "&KODE_INVOICE=" + data[\'KODE_INVOICE\'] + 
                                "&KODE_KANTOR=" + data[\'KODE_KANTOR\'];
                                
                    var href = $site_url + "/contract/invoice/detail?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>