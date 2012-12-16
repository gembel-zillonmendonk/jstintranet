<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author farid
 */
class top extends MY_Controller
{
    public function create_draft(){
        
        if($this->_is_ajax_request())
            $this->load->view('top/draft');
        else
            $this->layout->view('top/draft');
    }
    
    public function todo(){
        $this->layout->view('top/todo');
    }
    
    public function monitoring(){
        $this->layout->view('top/monitoring');
    }
}
?>
