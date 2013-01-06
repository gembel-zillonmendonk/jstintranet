<?php

class monitoring_progress extends MY_Model {

    public $table = 'EP_KTR_PO';
    
    public $sql_select = "( select a.*, '' as act from EP_KTR_PO a )";
    
    public $columns_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'CATATAN_PO',
        'PERSENTASI_PERKEMBANGAN_VENDOR',
        'STATUS_PERKEMBANGAN',
        'KODE_PROSES',
        'ACT',
    );
    public $dir = 'po';
    
    function __construct() {
        parent::__construct();
        $this->init();
        
        $wkf = new Workflow();
        $kode_wkf = 64; //work order
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
        
        $this->sql_select = "(
            select a.*, b.kode_perkembangan, b.persentasi_perkembangan as persentasi_perkembangan_vendor, x.kode_proses, '' as ACT 
            from EP_KTR_PO a
            inner join EP_KTR_PO_PERKEMBANGAN b on a.kode_po = b.kode_po and a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
            inner join (
                $pivot_query
            ) x on x.KODE_PO = a.KODE_PO and x.KODE_KONTRAK = a.KODE_KONTRAK and x.kode_kantor = a.kode_kantor and x.kode_vendor = a.kode_vendor
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    //alert(data[\'KODE_PROSES\']);
                    
                    var param = "referer_url=/contract/po/monitoring&KODE_PROSES=" + data[\'KODE_PROSES\'] + "&KODE_PERKEMBANGAN=" + data[\'KODE_PERKEMBANGAN\'] + "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + "&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_KANTOR=" + data[\'KODE_KANTOR\'] + "&KODE_PO=" + data[\'KODE_PO\'];
                    var href = $site_url + "/contract/po/detail_progress?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>