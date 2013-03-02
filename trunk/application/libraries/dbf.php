<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbf
 *
 * @author sochy.choeun
 */
class dbf{
    //put your code here
    
    private $f_user_id = "user_id";
    private $t_users = "users";
    private $f_username = "email";
    private $f_password = "password";
    
    private $t_roles = 'roles';
    private $f_rol_id = 'rol_id';
    private $f_rol_name = 'rol_name';
    private $f_rol_des = 'rol_des';
    private $f_rol_status = 'rol_status';




    public function getT_users() {
        return $this->t_users;
    }

    public function getF_username() {
        return $this->f_username;
    }

    public function getF_password() {
        return $this->f_password;
    }

    public function getF_roles() {
        return $this->t_roles;
    }
    public function getF_user_id() {
        return $this->f_user_id;
    }

    public function getT_roles() {
        return $this->t_roles;
    }

    public function getF_rol_id() {
        return $this->f_rol_id;
    }

    public function getF_rol_name() {
        return $this->f_rol_name;
    }

    public function getF_rol_des() {
        return $this->f_rol_des;
    }

    public function getF_rol_status() {
        return $this->f_rol_status;
    }



    
}

?>
