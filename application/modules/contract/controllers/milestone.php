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
class milestone extends MY_Controller
{
    public function list_todo(){
        if($this->_is_ajax_request())
            $this->load->view('milestone/list_todo');
        else
            $this->layout->view('milestone/list_todo');
    }
    
    public function create_draft(){
        
        if($this->_is_ajax_request())
            $this->load->view('milestone/draft');
        else
            $this->layout->view('milestone/draft');
    }
    
    public function detail(){
        
        if($this->_is_ajax_request())
            $this->load->view('milestone/detail');
        else
            $this->layout->view('milestone/detail');
    }
    
    public function view_popup() {
        $this->layout->setLayout('layout_popup');
        $this->layout->view('milestone/view_popup');
    }
    
    public function update_bastp(){
        
        if($this->_is_ajax_request())
            $this->load->view('milestone/update_bastp');
        else
            $this->layout->view('milestone/update_bastp');
    }
    
    public function todo(){
        if($this->_is_ajax_request())
            $this->load->view('milestone/todo');
        else
            $this->layout->view('milestone/todo');
    }
    
    public function monitoring(){
        $this->layout->view('milestone/monitoring');
    }
}
?>
