<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of saving
 *
 * @author sochy.choeun
 */
class saving extends CI_Controller{
    //put your code here
    var $data = null;
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_saving_product_type','m_saving'));
    }
    function index(){
        
    }
    
    function open(){
        $this->data['title'] = 'Open saving account';
        $this->data['product_type'] = $this->m_saving_product_type->get_product_type_array();

        $this->form_validation->set_rules('cid', 'Contact ID', 'required');
            if ($this->form_validation->run() == FALSE)
                $this->load->view(Variables::$layout_main, $this->data);
            else{
                if($this->m_saving->add()){
                    $this->session->set_flashdata('success','A saving account has been save');
                    redirect('saving/lists');
                }
                else{
                    $this->load->view(Variables::$layout_main, $this->data);
                }
            }
    }
    
    function lists(){
        $this->data['title'] = 'List saving accounts';
        $this->data['saving_account'] = $this->m_saving->get_saving_account();
        $this->load->view(Variables::$layout_main,  $this->data);
    }
    
    function update(){
        
    }
    
}

?>
