<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author sochy.choeun
 */
class panel extends CI_Controller {

    var $data = null;
    function  __construct() {
        parent::__construct();
        $this->data['dbf'] = new dbf();
        if(!is_login()){
            $this->session->set_flashdata('error','<div class="alert alert-error">Please login!!!</div>');
            redirect('users/login');
        }
    }

    function index(){
       redirect('panel/manage');
    }

    function manage(){
        allows(array('admin','teller','accountain','superadmin'));
        $this->data['title'] = "Welcome to Loan System Managment";
        $this->load->view(Variables::$layout_main,  $this->data);
    }
}

?>
