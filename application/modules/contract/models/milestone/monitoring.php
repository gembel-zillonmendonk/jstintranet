<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_JANGKA_PERKEMBANGAN';
    public $sql_select = null;
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_JANGKA',
        'KODE_KANTOR',
        'KETERANGAN',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
        'STATUS',
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'URL',
        'ACT',
    );
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $wkf = new Workflow();
        $kode_wkf = 61; //milestone
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
        
        $this->sql_select = "(
            select a.*, x.kode_proses, '' as ACT 
            from EP_KTR_JANGKA_KONTRAK a
            inner join (
                $pivot_query
            ) x on x.KODE_JANGKA = a.KODE_JANGKA and x.KODE_KONTRAK = a.KODE_KONTRAK and x.kode_kantor = a.kode_kantor
        )";

        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/contract/milestone/monitoring&KODE_PROSES=" + data[\'KODE_PROSES\'] + 
                                "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + 
                                "&KODE_JANGKA=" + data[\'KODE_JANGKA\'] + 
                                "&KODE_KANTOR=" + data[\'KODE_KANTOR\'];
                                
                    var href = $site_url + "/contract/milestone/detail?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>