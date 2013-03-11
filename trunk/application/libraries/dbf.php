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
    
    private $t_users = "users";
    private $f_user_rol_id = "use_gro_id";
    private $f_user_id = "use_id";
    private $f_username = "use_name";
    private $f_password = "use_password";
    private $f_use_status = "status";


    private $t_roles = 'user_groups';
    private $f_rol_id = 'gro_id';
    private $f_rol_name = 'gro_name';
    private $f_rol_des = 'gro_des';
    private $f_rol_status = 'status';



    public function getF_use_status() {
        return $this->f_use_status;
    }

        public function getF_user_rol_id() {
        return $this->f_user_rol_id;
    }

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
