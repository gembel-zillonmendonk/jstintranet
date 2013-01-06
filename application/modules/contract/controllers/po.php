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
class po extends MY_Controller
{
    public $rules;
    public $where;

    public function create_draft(){
        
        if($this->_is_ajax_request())
            $this->load->view('po/draft');
        else
            $this->layout->view('po/draft');
    }
    
    public function verify_progress(){
        
        if($this->_is_ajax_request())
            $this->load->view('po/verify_progress');
        else
            $this->layout->view('po/verify_progress');
    }
    
    public function detail(){        
        if($this->_is_ajax_request())
            $this->load->view('po/detail');
        else
            $this->layout->view('po/detail');
    }
    
    public function detail_progress(){        
        if($this->_is_ajax_request())
            $this->load->view('po/detail_progress');
        else
            $this->layout->view('po/detail_progress');
    }
    
    public function detail_bastp(){        
        if($this->_is_ajax_request())
            $this->load->view('po/detail_bastp');
        else
            $this->layout->view('po/detail_bastp');
    }
    
    public function todo(){
        $this->layout->view('po/todo');
    }
    
    public function monitoring(){
        $this->layout->view('po/monitoring');
    }
    
    public function monitoring_progress(){
        $this->layout->view('po/monitoring_progress');
    }
}
?>
