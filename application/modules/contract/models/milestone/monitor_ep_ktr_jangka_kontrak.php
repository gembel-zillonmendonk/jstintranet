<?php

class monitor_ep_ktr_jangka_kontrak extends MY_Model
{
    public $table = 'EP_KTR_JANGKA_KONTRAK';
    public $elements_conf = array(
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'PERSENTASI' => array('name' => 'BOBOT'),
        'TGL_TARGET',
//        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
        'KETERANGAN'=>array('type'=>'textarea'),
//        'KETERANGAN_BASTP',
    );
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
        'KETERANGAN',
//        'KETERANGAN_BASTP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
//        'KODE_PERKEMBANGAN',
//        'PROGRESS',
        'KODE_PROSES',
        'ACT',
    );
    public $dir = 'milestone';

    function __construct()
    {
        parent::__construct();
        $this->init();

        $wkf = new Workflow();
        $kode_wkf = 61; //kontrak
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
        
        $this->sql_select = "(
            select a.*, x.kode_proses,  '' as ACT
            from EP_KTR_JANGKA_KONTRAK a
            left join (
                $pivot_query
            ) x on x.kode_kontrak = a.kode_kontrak and x.kode_jangka = a.kode_jangka and x.kode_kantor = a.kode_kantor
        ) ";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    
                    var param = "referer_url=/contract/monitoring&KODE_PERKEMBANGAN=" + data[\'KODE_PERKEMBANGAN\'] + "&KODE_PROSES=" + data[\'KODE_PROSES\'] + "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + "&KODE_KANTOR=" + data[\'KODE_KANTOR\'] + "&KODE_JANGKA=" + data[\'KODE_JANGKA\'] ;
                    var href = $site_url + "/contract/milestone/view_popup?" + param;
                    
                    be = "<button onclick=\"javascript:window.open(\'" +href+ "\', \'xx\', \'width=800,height=500\')\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
        
        //<button href="http://localhost:8888/jstintranet/index.php/contract/contract/view_popup?KODE_PROSES=181&amp;KODE_KONTRAK=24&amp;KODE_KANTOR=44A&amp;KODE_VENDOR=22&amp;KODE_TENDER=24&amp;" onclick="window.open($(this).attr(&quot;href&quot;), &quot;xx&quot;, &quot;width=800,height=500&quot;); return false;"> [lihat detail] </button>

        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
        
        if (isset($_REQUEST['KODE_JANGKA']))
            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];

//        if (isset($_REQUEST['KODE_JANGKA']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
//        {
//            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//        }
        
    }

    function _default_scope()
    {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return " KODE_KONTRAK = '" . $_REQUEST['KODE_KONTRAK'] . "'" .
                   " AND KODE_KANTOR = '" . $_REQUEST['KODE_KANTOR'] . "'" ;
    }

    public function _before_insert() {
        parent::_before_insert();
        // set auto increament
        if ($this->attributes['KODE_JANGKA'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_JANGKA_KONTRAK'")->row_array();
            $this->attributes['KODE_JANGKA'] = $row['NEXT_ID'];
        }
        
        $sql = "SELECT sum(PERSENTASI) as PERSEN FROM " .$this->table. 
                " WHERE KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'" .
                " AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'";
        
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if($row['PERSEN'] + $this->attributes['PERSENTASI'] > 100)
            show_error("PERSENTASI tidak boleh lebih dari 100");
        
    }
    
    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_KTR_JANGKA_KONTRAK'");
    }
}
?>