<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}
 

        function get(){
            
            print_r($_GET);
        }
        
        
	function download($filename) {
            $this->load->helper('download'); //load helper

              // echo "Download";  
         
              $data = file_get_contents(base_url() . "/Attachments/" . $filename); // Read the file's contents
              $name = 'images11.jpg';

              force_download($name, $data);

        }
	
}	