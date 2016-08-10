<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of constructions
 *
 * @author sochy.choeun
 */
class constructions extends CI_Controller {
    //put your code here
    var $data = null;
    function index(){
        redirect('constructions/page_not_found'); 
    }
    
    function page_not_found(){
        
        $this->data['title'] = 'Under construction';
        $this->load->view(Variables::$layout_main,  $this->data);
    }
}

?>
