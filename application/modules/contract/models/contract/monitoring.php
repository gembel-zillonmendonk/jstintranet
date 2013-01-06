<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    public $sql_select = null;
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_TENDER',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'NO_KONTRAK',
        'JUDUL_PEKERJAAN',
        'LINGKUP_KERJA',
        'TIPE_KONTRAK',
        'JENIS_KONTRAK',
        'TGL_MULAI',
        'TGL_AKHIR',
        'NILAI_KONTRAK',
        'STATUS',
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'ACT',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();

        $wkf = new Workflow();
        $kode_wkf = 6; //kontrak
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");

        $this->sql_select = "(
            select a.*, x.kode_proses, x.nama_aktifitas, '' as ACT 
            from EP_KTR_KONTRAK a
            inner join (
                $pivot_query
            ) x on x.kode_kontrak = a.kode_kontrak and x.kode_tender = a.kode_tender and x.kode_kantor = a.kode_kantor and x.kode_vendor = a.kode_vendor
        )";


        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    //alert(data[\'KODE_PROSES\']);
                    
                    var param = "referer_url=/contract/monitoring&KODE_PROSES=" + data[\'KODE_PROSES\'] + "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + "&KODE_KANTOR=" + data[\'KODE_KANTOR\'] + "&KODE_TENDER=" + data[\'KODE_TENDER\'] + "&KODE_VENDOR=" + data[\'KODE_VENDOR\'];
                    var href = $site_url + "/contract/view?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope() {
        parent::_default_scope();
        
        $condition = array(
            'eq' => '=',
            'gt' => '>=',
            'lt' => '<=',
            'ne' => '<>',
        );
        
        $where = "";
        if (isset($_REQUEST['EXPIRED_CONDITION']) && isset($_REQUEST['EXPIRED_VALUE'])) {
            $where .= " to_char(TGL_AKHIR, 'YYYYMM') " . $condition[$_REQUEST['EXPIRED_CONDITION']] . " to_char(add_months(SYSDATE, " . $_REQUEST['EXPIRED_VALUE'] . "), 'YYYYMM') ";
        }

        return $where;
    }

}

?>