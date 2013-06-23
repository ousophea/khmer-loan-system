<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cashs
 *
 * @author sochy.choeun
 */
class cashs extends CI_Controller {
    //put your code here
    var $data = null;
    function __construct() {
        parent::__construct();
        allows(array(Setting::$role3));
        $this->load->model(array('m_cashs','m_currencies'));
    }
    
    function index(){
        $this->data['title'] = "Tiller cash";
        $this->data['currencies'] = $this->m_currencies->find_currencies_for_dropdown();
        $this->load->view(MAIN_MASTER,  $this->data);
    }
    
    function cashin(){
        if($this->m_cashs->cashin()){
            echo json_encode(array('result' => 1));
        }
        else
            echo json_encode(array('result' => 0));
        
    }
    function cashout(){
        if($this->m_cashs->cashout()){
            echo json_encode(array('result' => 1));
        }
        else
            echo json_encode(array('result' => 0));
        
    }
}

?>
