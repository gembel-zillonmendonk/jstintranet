<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Ep_kom_harga_barang_banding extends MY_Model {

    
  
    public $table = "EP_KOM_HARGA_BARANG";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_HARGA_BARANG','KODE_BARANG',   'KODE_KANTOR', 'KODE_SUMBER' , 'TGL_SUMBER', 'MATA_UANG', 'HARGA', 'KODE_VENDOR' );
    public $columns_conf = array( 'KODE_KANTOR' => array('hidden' =>false, 'width'=>'10') ,'KODE_BARANG' => array('hidden' =>true, 'width'=>'10') , 'NAMA_KANTOR' => array('hidden' =>false, 'width'=>'80'), 'HARGA_TERAKHIR' => array('hidden' =>false, 'width'=>'10', 'align'=>'right') , 'HARGA_RATA' => array('hidden' =>false, 'width'=>'10', 'align'=>'right')   );
    public $sql_select = "(select    K.KODE_KANTOR, K.NAMA_KANTOR, B.KODE_BARANG, B.KODE_SUB_BARANG, COALESCE(AKHIR.HARGA,0) AS HARGA_TERAKHIR, COALESCE(RATA.HARGA_RATA,0) AS  HARGA_RATA
	from MS_KANTOR K
	CROSS JOIN MS_BARANG  B
        LEFT JOIN (SELECT KODE_KANTOR, KODE_BARANG, KODE_SUB_BARANG, TOTAL_BIAYA   AS HARGA
                    FROM  (SELECT   ROWNUM, KODE_KANTOR, KODE_BARANG, KODE_SUB_BARANG, TOTAL_BIAYA
                            FROM    EP_KOM_HARGA_BARANG   
                            ORDER BY TGL_SUMBER DESC  
                    )    
                    WHERE ROWNUM = 1 ) AKHIR ON K.KODE_KANTOR = AKHIR.KODE_KANTOR AND B.KODE_BARANG = AKHIR.KODE_BARANG AND B.KODE_SUB_BARANG =  AKHIR.KODE_SUB_BARANG 
        LEFT JOIN (SELECT KODE_KANTOR, KODE_BARANG, KODE_SUB_BARANG, AVG(TOTAL_BIAYA)   AS HARGA_RATA
                    FROM  (SELECT   ROWNUM, KODE_KANTOR, KODE_BARANG, KODE_SUB_BARANG, TOTAL_BIAYA
                            FROM    EP_KOM_HARGA_BARANG   
                            ORDER BY TGL_SUMBER DESC  
                    )    
                    WHERE ROWNUM <= 5
					GROUP BY KODE_KANTOR, KODE_BARANG, KODE_SUB_BARANG
					 ) RATA ON K.KODE_KANTOR = RATA.KODE_KANTOR AND B.KODE_BARANG = RATA.KODE_BARANG AND B.KODE_SUB_BARANG =  RATA.KODE_SUB_BARANG
                    WHERE K.KODE_TIPE = '2'	AND KODE_KELAS = '0'
			
        ";
    
    
      function setParam() {
		  $this->sql_select = $this->sql_select . " AND B.KODE_BARANG = '" . $this->input->get("KODE_BARANG") . "' AND B.KODE_SUB_BARANG = '" . $this->input->get("KODE_SUB_BARANG") . "' )" ;
      }
 
    /*
      public $columns = array(
      'KODE_VENDOR'=>array('name'=>'KODE VENDOR', 'raw_name'=>'KODE_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'NAMA_VENDOR'=>array('name'=>'NAMA VENDOR', 'raw_name'=>'NAMA_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'KODE_LOGIN'=>array('name'=>'KODE LOGIN', 'raw_name'=>'KODE_LOGIN', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      );
     */

    function __construct() {
        parent::__construct();
        $this->init();
        $this->setParam();
    }

}

?>
