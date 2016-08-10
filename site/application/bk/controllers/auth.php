<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author sochy.choeun
 */
class auth extends CI_Controller{
    //put your code here
    var $data=null;
    function __construct() {
        parent::__construct();
    }
    function index(){
        redirect('auth/no_permission');
    }
    function no_permission(){
        $this->data['title'] = 'You have no permission!!!';
        $this->load->view(Variables::$layout_main,  $this->data);
    }
}

?>
