<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_ms_kelompok_panitia extends MY_Model
{
    public $table = "EP_MS_KELOMPOK_PANITIA";
	
	 public $elements_conf = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
		
        'NAMA_PANITIA' 
    );
    public $validation = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
        'NAMA_PANITIA' 
        
    );
    public $columns_conf = array(
        'KODE_PANITIA' =>array('hidden'=>false, 'width'=>10, 'align'=>'center') , 
		'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10, 'align'=>'center') ,
        'NAMA_PANITIA' =>array('hidden'=>false, 'width'=>75, 'align'=>'center')  
         ,   'HAPUS'  =>array('hidden'=>false, 'width'=>5, 'align'=>'center') 
    );
    public $sql_select = "(select KODE_PANITIA
            ,KODE_KANTOR
            , NAMA_PANITIA
            ,     '' as \"HAPUS\"
            from EP_MS_KELOMPOK_PANITIA)";

    function __construct()
    {
        parent::__construct();
        $this->init();
           
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                     bx = "<button onclick=\"fnDeletePanitia(\'"+cl+"\');\"  >HAPUS</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{HAPUS:bx});
                        
		}';

		
    }
	
}
?>	