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
class Ep_pgd_perencanaan_get extends MY_Model {

    
  
    public $table = "EP_PGD_PERENCANAAN";
    //public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
    public $elements_conf = array('KODE_PERENCANAAN', 
			'KODE_KANTOR'  => array('type' => 'dropdown', 'options' => array()),
			 'JUDUL_PEKERJAAN',  
			 'LINGKUP_PEKERJAAN',
			 'RENCANA_KEBUTUHAN',  
			 'RENCANA_PELAKSANAAN',  
			 'SWAKELOLA' => array(
            'type' => 'dropdown', 'options' => array(
                '0' => 'TIDAK',
                '1' => 'YA'
        )) );
		
		
    public $columns_conf = array('KODE_PERENCANAAN' =>array('hidden'=>true, 'width'=>0) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0) ,
								 'PERENCANA' =>array('hidden'=>false, 'width'=>15),
								 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>30) ,
								 'LINGKUP_PEKERJAAN' =>array('hidden'=>true, 'width'=>0) ,
								 
        'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>20),
								 'RENCANA_KEBUTUHAN' =>array('hidden'=>false, 'width'=>10),
								 'RENCANA_PELAKSANAAN' =>array('hidden'=>false, 'width'=>10),
 								 'STATUS' =>array('hidden'=>false, 'width'=>15)
								 );
	
	
    public $sql_select = "(SELECT P.PERENCANA, P.KODE_PERENCANAAN ,  P.KODE_KANTOR, P.JUDUL_PEKERJAAN, P.LINGKUP_PEKERJAAN,  K.NAMA_KANTOR, P.RENCANA_KEBUTUHAN, P.RENCANA_PELAKSANAAN
        , CASE  
          WHEN P.STATUS  = 1 THEN 'TELAH DISETUJUI' 
          ELSE 'BELUM DISETUJUI'
          END AS STATUS  
            FROM EP_PGD_PERENCANAAN P
            LEFT JOIN MS_KANTOR K ON P.KODE_KANTOR = K.KODE_KANTOR
            LEFT JOIN EP_ALURKERJA_AKTIFITAS A ON P.STATUS_AKTIFITAS = A.KODE_AKTIFITAS
            WHERE P.STATUS  = 1
            AND P.SWAKELOLA != 1
	  )";
    
    protected function _before_insert()
    {
        
	$urut = $this->urut->get("ALL","PERENCANAAN");	
	
         
        
        $this->attributes['KODE_PERENCANAAN'] = $urut;
        
        echo $urut;
        $this->attributes['TGL_REKAM'] = date("Y-m-d");
    }
    
    protected function _after_insert()
    {
        
         $this->urut->set_plus( "ALL","PERENCANAAN") ;
        
        /*
		$kode_kantor = $this->session->userdata("kode_kantor");
		$kode_nomerurut = 'PERENCANAAN';
       $sql = "SELECT NOMORURUT FROM EP_NOMORURUT WHERE KODE_KANTOR='" . $this->kode_kantor . "' AND KODE_NOMORURUT = '".$this->kode_nomerurut."' ";
		$query = $this->db->query($sql);
		
		$result = $query->result();
 
	
		if (count($result)== 0)	{
		
			$sql = "INSERT INTO EP_NOMORURUT (KODE_KANTOR,KODE_NOMORURUT,NOMORURUT) ";
			$sql .= " VALUES ('" .$this->kode_kantor . "', '" . $this->kode_nomerurut . "',1) ";
			$this->db->simple_query($sql);
			  
		} else {
			$urut = $result[0]->NOMORURUT + 1;
			$sql = "UPDATE EP_NOMORURUT SET  NOMORURUT = ".$urut ;
			$sql .= " WHERE  KODE_KANTOR = '" .$this->kode_kantor . "' AND KODE_NOMORURUT =  '" . $kode_nomerurut . "' ";
			 
			$this->db->simple_query($sql);
			
			
		}	
	 */
 
    }
	 
 
    function __construct() {
        parent::__construct();
        $this->init();
	 $this->load->model('Nomorurut','urut');	 
		
		$this->kode_kantor = $this->session->userdata("kode_kantor");
	//	$this->attributes['KODE_KANTOR'] = $this->input->get('KODE_KANTOR');
		
        // get selected value 
        $query = $this->db->query('SELECT * FROM MS_KANTOR ');
        $rows = $query->result_array();
        
        $this->elements_conf['KODE_KANTOR']['options'] = array();
		
        foreach ($rows as $v)
        {
			
		

			$this->elements_conf['KODE_KANTOR']['options'][$v['KODE_KANTOR']] = $v['NAMA_KANTOR'];
        
		
		}

			  
		if ($this->input->get('KODE_KANTOR')) {
			 $this->elements_conf['KODE_KANTOR']['value'][] = $this->input->get('KODE_KANTOR');
		} else {
			$this->elements_conf['KODE_KANTOR']['value'][] = $this->session->userdata("kode_kantor");
		
		}
	   
    }

}

?>
