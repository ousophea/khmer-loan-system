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
class d_users extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
        
    }
    private function setLogin(s_users $s_user_obj){
        $this->db->where($s_user_obj->getF_username(),$s_user_obj->getUsername());
        $this->db->where($s_user_obj->getF_password(),$s_user_obj->getPassword());
        $data = $this->db->get($s_user_obj->getT_users());
        
        if($data->num_rows() > 0){
            
            return TRUE;
        }
        return FALSE;
    }
    public function getLogin(s_users $s_user_obj){
        return $this->setLogin($s_user_obj);
    }
    public function getRegister(s_users $s_user_obj) {
        return $this->setRegister($s_user_obj);
    }

    private function setRegister(s_users $register) {
        
        try {
            $data[$register->getF_username()] = $register->getUsername();
            $data[$register->getF_password()] = $register->getPassword();
            $data[$register->getF_rol_id()] = $register->getRole();
            if($this->db->insert($register->getT_users(),$data))
                return TRUE;
            else
                return FALSE;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


}

?>
