<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_ms_anggota_panitia_view extends MY_Model
{
    public $table = "EP_MS_ANGGOTA_PANITIA";
	
	 public $elements_conf = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
        'KODE_JABATAN',
        'STATUS_PEMIMPIN'
		
    );
    public $validation = array(
         'KODE_PANITIA',
		'KODE_KANTOR',
        'KODE_JABATAN',
        'STATUS_PEMIMPIN'
    );
    public $columns_conf = array(
         'KODE_PANITIA'  =>array('hidden'=>true, 'width'=>10, 'align'=>'center') ,
		'KODE_KANTOR'  =>array('hidden'=>false, 'width'=>10, 'align'=>'center') ,
        'KODE_JABATAN'  =>array('hidden'=>true, 'width'=>10, 'align'=>'center') , 
		'NAMA_JABATAN'  =>array('hidden'=>false, 'width'=>60, 'align'=>'left') ,
        'STATUS_PEMIMPIN'  => array('hidden'=>false, 'width'=>10, 'align'=>'center') 
    );
    
    public $sql_select = "(select P.KODE_PANITIA, P.KODE_KANTOR, P.KODE_JABATAN , J.NAMA_JABATAN, 
                                                CASE 
                                                    WHEN STATUS_PEMIMPIN = '1' THEN 'PIMPINAN'
                                                    ELSE 'ANGGOTA'
                                                END AS  STATUS_PEMIMPIN  
                                  		FROM EP_MS_ANGGOTA_PANITIA P 
						LEFT JOIN MS_JABATAN J ON P.KODE_JABATAN = J.KODE_JABATAN
						";

	
	function setParam() {
		  $this->sql_select = $this->sql_select . " WHERE  P.KODE_PANITIA = " . $this->session->userdata("kode_panitia") . " ";
		  $this->sql_select = $this->sql_select . " AND  P.KODE_KANTOR = '" . $this->session->userdata("kode_kantor_panitia") . "' )" ;
		  
		 
    }
 
    function __construct()
    {
        parent::__construct();
        $this->init();
		$this->setParam();
		$CI = & get_instance();
        $this->attributes['KODE_PANITIA'] = $CI->session->userdata('kode_panitia');
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                     bx = "<button onclick=\"fnDeleteAnggotaPanitia(\'"+cl+"\');\"  >HAPUS</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{HAPUS:bx});
                }';		
    }
	
}
?>	