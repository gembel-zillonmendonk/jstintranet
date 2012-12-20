<?php

class ep_ktr_po extends MY_Model {

    public $table = 'EP_KTR_PO';
    public $elements_conf = array(
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'NAMA_PEMBUAT',
//        'NAMA_LENGKAP_PEMBUAT',
//        'POSISI_PEMBUAT',
        'KODE_VENDOR' => array('type' => 'hidden'),
        'NAMA_VENDOR',
//        'MATA_UANG',
        'TGL_MULAI',
        'TGL_AKHIR',
//        'TGL_BUAT',
        'CATATAN_PO',
//        'TGL_PERSETUJUAN',
//        'STATUS',
//        'POSISI_PERSETUJUAN',
//        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'TGL_PERSETUJUAN_BASTP',
//        'KETERANGAN_BASTP',

        'NILAI_KONTRAK',
        'NILAI_WO',
        'SISA_NILAI_KONTRAK',
        'DETAIL_KONTRAK',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
        if (isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];

            // copy default value from ep_ktr_kontrak
            $sql = "select a.nama_vendor, a.nilai_kontrak, a.kode_tender, a.kode_vendor, a.kode_kontrak, a.kode_kantor, b.kode_po, coalesce(b.nilai_wo, 0) as nilai_wo, a.nilai_kontrak - coalesce(b.nilai_wo, 0) as sisa_nilai_kontrak
                    from ep_ktr_kontrak a
                    left join (
                        select x.kode_po, x.kode_kontrak, x.kode_kantor, sum(harga * QTY) as nilai_wo
                        from ep_ktr_po x
                        inner join ep_ktr_po_item y on x.kode_po = y.kode_po and x.kode_kontrak = y.kode_kontrak and x.kode_kantor = y.kode_kantor
                        where x.kode_kontrak = '" . $this->attributes['KODE_KONTRAK'] . "'
                            and x.kode_kantor = '" . $this->attributes['KODE_KANTOR'] . "'
                            and x.status = 'O'
                        group by x.kode_po, x.kode_kontrak, x.kode_kantor
                    ) b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor "
                    . " where a.kode_kontrak = '" . $this->attributes['KODE_KONTRAK'] . "'"
                    . " and a.kode_kantor = '" . $this->attributes['KODE_KANTOR'] . "'"
                    . " and a.kode_vendor = '" . $this->attributes['KODE_VENDOR'] . "'";

            $row = $this->db->query($sql)->row_array();

            if (count($row) > 0) {
                $this->attributes['KODE_PO'] = $row['KODE_PO'];
                $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
                $this->attributes['NILAI_KONTRAK'] = $row['NILAI_KONTRAK'];
                $this->attributes['NILAI_WO'] = $row['NILAI_WO'];
                $this->attributes['SISA_NILAI_KONTRAK'] = $row['SISA_NILAI_KONTRAK'];
                
                // popup detail kontrak
                $this->attributes['DETAIL_KONTRAK'] = $row['KODE_KONTRAK'] . "&nbsp;&nbsp;&nbsp;<button href='".(site_url('contract/contract/view_popup?KODE_KONTRAK=' . $row['KODE_KONTRAK'] .'&KODE_KANTOR=' .$row['KODE_KANTOR']. '&KODE_VENDOR=' . $row['KODE_VENDOR']. '&KODE_TENDER=' . $row['KODE_TENDER']))."' onclick='window.open($(this).attr(\"href\"), \"xx\", \"width=800,height=500\");'> [lihat detail] </button>";
//                $this->elements_conf['LABEL_KODE_KONTRAK'] = array(
//                    'type'=>'anchor_popup'
//                    , 'value' => 'xxx'
//                    , 'url' => site_url('contract/contract/view_popup?KODE_KONTRAK=' . $row['KODE_KONTRAK'] .'&KODE_KANTOR=' .$row['KODE_KANTOR']. '&KODE_VENDOR=' . $row['KODE_VENDOR']. '&KODE_TENDER=' . $row['KODE_TENDER']));

            }
        }

        if (isset($_REQUEST['KODE_PO']) && $_REQUEST['KODE_PO'] > 0) {
            $sql = "select * from ep_ktr_po where kode_po = '" . $_REQUEST['KODE_PO'] . "'";
            $row = $this->db->query($sql)->row_array();

            if ($row) {
                $this->attributes['KODE_PO'] = $row['KODE_PO'];
//                $this->attributes['KODE_PO'] = $row['KODE_PO'];
//                $this->attributes['KODE_PO'] = $row['KODE_PO'];
            }
        }
        else
            $this->attributes['KODE_PO'] = 0;
    }

    public function _before_insert() {
        parent::_before_insert();

        if (!count($_REQUEST['selected_items']) && !count($_REQUEST['selected_qty']))
            return;

        // set auto increament
        if ($this->attributes['KODE_PO'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_PO'")->row_array();
            $this->attributes['KODE_PO'] = $row['NEXT_ID'];
        }

//        print_r($this->attributes);
//        die();
    }

//    public function save() {
//
//        //parent::save();
//        $this->_before_insert();
////        print_r($this->attributes);
////        $this->attributes['TGL_REKAM'] = '';
//
//        $this->db->insert($this->table, $this->attributes);
//
////        echo $this->db->last_query();
////        die();
//        $this->_after_insert();
//    }
//
//    public function _insert() {
////        $this->_before_insert();
////        $this->db->insert($this->table, $this->attributes);
////        $this->_after_insert();
//        //parent::_insert();
//    }

    public function _after_insert() {
        parent::_after_insert();

        if (isset($this->attributes['KODE_PO']) != "" &&
                isset($this->attributes['KODE_KANTOR']) != "" &&
                isset($this->attributes['KODE_KONTRAK']) != "") {

            $sel_items = $_REQUEST['selected_items'];
            $sel_qty = $_REQUEST['selected_qty'];
            foreach ($sel_items as $k => $v) {
                
                parse_str($v, $output); // $v is querystring format
                
                $sql = "SELECT KODE_KONTRAK, KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, SATUAN, SUB_TOTAL, KETERANGAN_LENGKAP 
                    FROM EP_KTR_KONTRAK_ITEM
                    WHERE KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'
                        AND KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'
                        AND ( KODE_BARANG_JASA = '".$output['KODE_BARANG_JASA']."' AND KODE_SUB_BARANG_JASA = '".$output['KODE_SUB_BARANG_JASA']."' )";

                $data = $this->db->query($sql)->row_array();
                if(count($data) > 0){
                    $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                                from ep_nomorurut 
                                where kode_nomorurut = 'EP_KTR_PO_ITEM'")->row_array();

                    $data['KODE_PO_ITEM'] = $row['NEXT_ID'];
                    $data['KODE_PO'] = $this->attributes['KODE_PO'];
                    $data['QTY'] = $sel_qty[$k];
                    $data['SUB_TOTAL'] = $data['QTY'] * $data['HARGA'];
                    
                    $this->db->insert("ep_ktr_po_item", $data);
                    $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_PO_ITEM'");
                }
            }

//            $sql = "SELECT KODE_KONTRAK, KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, SATUAN, SUB_TOTAL, KETERANGAN_LENGKAP 
//                    FROM EP_KTR_KONTRAK_ITEM
//                    WHERE KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'
//                        AND KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'";
//
//            $rows = $this->db->query($sql)->result_array();
//
//            if (count($rows) > 0) {
//                foreach ($rows as $v) {
//                    $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
//                                from ep_nomorurut 
//                                where kode_nomorurut = 'EP_KTR_PO_ITEM'")->row_array();
//
//                    $data = array();
//                    $v['KODE_PO_ITEM'] = $row['NEXT_ID'];
//                    $v['KODE_PO'] = $this->attributes['KODE_PO'];
//
//                    $this->db->insert("ep_ktr_po_item", $v);
//                    $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_PO_ITEM'");
//                }
//            }
        }

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_PO'");
    }

}

?>