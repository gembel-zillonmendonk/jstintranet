<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}
 

        function get(){
            
            print_r($_GET);
        }
        
        public function download($filename) {


        $config = $this->config->item('ftp');
        if ($config['enable']) {
            $this->load->library('ftp');
            $this->ftp->connect($config);

            //Create temp handler: 
            $tempHandle = fopen('php://temp', 'r+');

            //Get file from FTP: 
            $size = ftp_size($this->ftp->conn_id, $config['target_dir'] . $filename);

            if (ftp_fget($this->ftp->conn_id, $tempHandle, $config['target_dir'] . $filename, FTP_BINARY)) {
                rewind($tempHandle);

                header("Content-Length: " . $size . "\n\n");
                header("Content-Disposition: attachment; filename=$filename");

                echo stream_get_contents($tempHandle);
            } else {
                return false;
            }

            $this->ftp->close();
        }
    }

       /* 
	function download($filename) {
            $this->load->helper('download'); //load helper

              // echo "Download";  
         
              $data = file_get_contents(base_url() . "/Attachments/" . $filename); // Read the file's contents
              $name = $filename;

              force_download($name, $data);

              
              
              
        }
	*/
}	