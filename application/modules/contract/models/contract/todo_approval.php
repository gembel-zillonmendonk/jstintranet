<?php

class todo_approval extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    
    public $sql_select = "( select x.*, y.*, z.NAMA_PELAKSANA, '' as \"ACT\" from (
                                select a.* ,c.NAMA_AKTIFITAS, b.url, d.value as KODE_KONTRAK_VALUE 
                                from EP_WKF_PROSES a
                                inner join (
                                    select rtrim(xmlagg(xmlelement(e, '&' || key || '=' || value )).extract('//text()').extract('//text()') ,',') url, kode_proses 
                                    from EP_WKF_PROSES_VARS
                                    group by KODE_PROSES
                                ) b on a.kode_proses = b.kode_proses
                                inner join EP_WKF_AKTIFITAS c on A.KODE_AKTIFITAS = C.KODE_AKTIFITAS
                                inner join EP_WKF_PROSES_VARS d on a.kode_proses = d.kode_proses and d.key = 'KODE_KONTRAK'
                                where kode_wkf = 6 and tanggal_selesai is null
                            ) x
                            inner join EP_KTR_KONTRAK y on y.KODE_KONTRAK = x.KODE_KONTRAK_VALUE
                            inner join EP_PGD_TENDER z on y.KODE_TENDER = z.KODE_TENDER and y.KODE_KANTOR = z.KODE_KANTOR )";
    
    public $columns_conf = array(
        'KODE_PROSES' => array('hidden' => true),
        'NAMA_AKTIFITAS',
        'KODE_TENDER' => array('hidden' => true),
        'KODE_VENDOR' => array('hidden' => true),
        'KODE_KONTRAK' => array('hidden' => true),
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'JUDUL_PEKERJAAN',
        'LINGKUP_KERJA',
        'NAMA_PELAKSANA',
        'NILAI_KONTRAK',
        'STATUS',
        'URL' => array('hidden' => true),
        'ACT',
    );
    public $dir = 'contract';
    
    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    //alert(data[\'KODE_PROSES\']);
                    
                    var param = "referer_url=/contract/todo&kode_proses=" + data[\'KODE_PROSES\'] + data[\'URL\'];
                    var href = $site_url + "/wkf/run?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>