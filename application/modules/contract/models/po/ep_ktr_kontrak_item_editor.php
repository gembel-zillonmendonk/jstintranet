<?php

class ep_ktr_kontrak_item_editor extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_ITEM';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
        'PILIH',
//        'KODE_ITEM_KONTRAK'=>array('formatter'=>'checkboxFormatter'),
//        'TIT_ID',
        'KODE_ITEM',
        'KODE_KONTRAK',
        'KETERANGAN',
        'HARGA',
//        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
//        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
        'QTY',
        'SUB_TOTAL_PO',
        'PPN',
        'SUB_TOTAL_INCLUDE_PPN' => array('label'=>'TOTAL'),
    );
    public $toolbar = true;
    public $sql_select = "( select a.*, '' as qty, '' as act 
        from EP_KTR_KONTRAK_ITEM a 
        left join EP_KTR_PO_ITEM b on a.kode_kontrak = b.kode_kontrak)";
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();

        $kode_po = isset($_REQUEST['KODE_PO']) && $_REQUEST['KODE_PO'] > 0 ? $_REQUEST['KODE_PO'] : 0;
        $this->sql_select = "(
            select a.*
                , case
                    when b.kode_po_item > 0 then b.qty
                    else null 
                end as qty
                , case
                    when b.kode_po_item > 0 then b.qty * b.harga
                    else null 
                end as sub_total_po
                , case
                    when b.kode_po_item > 0 then (b.qty * b.harga) * 0.10
                    else null 
                end as ppn
                , case
                    when b.kode_po_item > 0 then (b.qty * b.harga) + ((b.qty * b.harga) * 0.10)
                    else null 
                end as sub_total_include_ppn
                , '' as pilih
            from EP_KTR_KONTRAK_ITEM a
            left join (
                select * 
                from ep_ktr_po_item
                where kode_po = '$kode_po'
            ) b on a.kode_kontrak = b.kode_kontrak 
            and a.kode_kantor = b.kode_kantor 
            and a.kode_barang_jasa = b.kode_barang_jasa
            and a.kode_sub_barang_jasa = b.kode_sub_barang_jasa
        )";
        
        $this->js_grid_completed = '
                var total = 0;
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    total += Number(data[\'SUB_TOTAL_INCLUDE_PPN\']);
                    var checked = \'\';
                    if(data[\'QTY\'] > 0){
                        checked = \'checked\';
                    }
                    var param = "KODE_BARANG_JASA=" + data[\'KODE_BARANG_JASA\'] + "&KODE_SUB_BARANG_JASA=" + data[\'KODE_SUB_BARANG_JASA\'];
                    cb = "<input type=\"checkbox\" value=\"" +param+ "\" name=\"selected_items[]\" "+checked+"/>";
                    qty = "<input type=\"number\" value=\"" +data[\'QTY\']+ "\" name=\"selected_qty[]\" />";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{QTY:qty,PILIH:cb});
		}
                
                $("#t_grid_' . strtolower(get_class($this)) . '").css({"text-align":"right", "width":"100%"}).html("TOTAL : " + total + "&nbsp;&nbsp;");
        ';
        
        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//        if (isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_KONTRAK'])) {
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//
//        }
    }

}

?>