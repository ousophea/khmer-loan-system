<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class m_recivecash extends CI_Model {
        //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function get_gls(){
        
        $this->db->from('gl_list');
        return $this->db->get();
    }

}


?>
