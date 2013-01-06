<?php

class ep_ktr_invoice_view extends MY_Model {

    public $table = 'EP_KTR_INVOICE';
    public $elements_conf = array(
//        'KODE_KONTRAK'=>array('type'=>'dropdown', 'options'=>array()),
//        'KODE_KANTOR',
//        'KODE_VENDOR',
        'NAMA_VENDOR',
        'KODE_INVOICE',
        'TGL_INVOICE',
        'AKUN_BANK',
        'DETAIL_KONTRAK',
//        'TGL_BUAT',
//        'STATUS',
//        'POSISI_PERSETUJUAN',
//        'TGL_DISETUJUI',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();
        
//        $this->attributes['KODE_VENDOR'] = $this->session->userdata('user_id');
        
        // set dropdown value for KODE_KONTRAK
//        $sql = "select distinct b.kode_kontrak as KEY, b.no_kontrak as VAL
//                from ep_ktr_jangka_kontrak a
//                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak
//                where a.status_bastp = 'O'
//                group by b.kode_kontrak, b.no_kontrak";
//        
//        $query = $this->db->query($sql);
//        $rows = $query->result_array();
//        $options = array(''=>'');
//        foreach($rows as $val){
//             $options[$val['KEY']] = $val['VAL'];//array($val['KEY'] => $val['VAL']);
//        }
//        $this->elements_conf['KODE_KONTRAK']['options'] = $options;
        
        
//        if(isset($_REQUEST['KODE_KONTRAK']) && $_REQUEST['KODE_KONTRAK'] != ""){
//            $this->elements_conf['KODE_KONTRAK']['value'] = $_REQUEST['KODE_KONTRAK'];
//            
//            $row = $this->db->query("select * 
//                    from ep_ktr_kontrak 
//                    where kode_kontrak = '" . $_REQUEST['KODE_KONTRAK'] . "'")->row_array();
//            $this->attributes['KODE_VENDOR'] = $row['KODE_VENDOR'];
//            $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
//            $this->attributes['KODE_KANTOR'] = $row['KODE_KANTOR'];
//
//        }
        
        $wkf = new Workflow();
        $kode_wkf = 6; //contract flow
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf");
            
        $sql = "select a.*, x.kode_proses 
            from ep_ktr_kontrak a
            inner join (
                $pivot_query
            ) x on x.KODE_KONTRAK = a.KODE_KONTRAK and x.KODE_TENDER = a.KODE_TENDER and x.kode_kantor = a.kode_kantor and x.kode_vendor = a.kode_vendor
            where a.kode_kontrak='".$_REQUEST['KODE_KONTRAK']."'
            and a.kode_kantor='".$_REQUEST['KODE_KANTOR']."'
            and a.kode_vendor='".$_REQUEST['KODE_VENDOR']."'";
        
        $row = $this->db->query($sql)->row_array();
        $this->attributes['DETAIL_KONTRAK'] = $row['KODE_KONTRAK'] . "&nbsp;&nbsp;&nbsp;<button href='".(site_url('contract/contract/view_popup?KODE_PROSES='. $row['KODE_PROSES'] .'&KODE_KONTRAK=' . $row['KODE_KONTRAK'] .'&KODE_KANTOR=' .$row['KODE_KANTOR']. '&KODE_VENDOR=' . $row['KODE_VENDOR']. '&KODE_TENDER=' . $row['KODE_TENDER'] .'&'))."' onclick='window.open($(this).attr(\"href\"), \"xx\", \"width=800,height=500\"); return false;'> [lihat detail] </button>";
    }

}

?>