<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ftpupload extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}
        
        
        function index(){
            $this->load->library('ftp');

            $config['hostname'] = '127.0.0.1';
            $config['username'] = 'uc';
            $config['password'] = 'uc';
            $config['port']     = 21;
            $config['passive']  = FALSE;
            $config['debug']    = TRUE;

            $this->ftp->connect($config);
             $this->ftp->upload('./uploaded_test/test123.txt', 'test.txt' );

          //   $this->ftp->upload('D:/test123.txt', 'test123.txt', 'ascii', 0775);

                    $this->ftp->close();

          }
        
}
