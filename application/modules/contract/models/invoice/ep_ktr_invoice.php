<?php

class ep_ktr_invoice extends MY_Model {

    public $table = 'EP_KTR_INVOICE';
    public $elements_conf = array(
//        'KODE_KONTRAK'=>array('type'=>'dropdown', 'options'=>array()),
//        'KODE_KANTOR',
//        'KODE_VENDOR',
        'NAMA_VENDOR',
        'KODE_INVOICE',
        'TGL_INVOICE',
        'AKUN_BANK',
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
        
    }

}

?>