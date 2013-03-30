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
class d_users extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    private function setLogin(s_users $s_user_obj) {
        $this->db->where($s_user_obj->getF_username(), $s_user_obj->getUsername());
        $this->db->where($s_user_obj->getF_password(), $s_user_obj->getPassword());
        $data = $this->db->get($s_user_obj->getT_users());

        if ($data->num_rows() > 0) {

            return TRUE;
        }
        return FALSE;
    }

    public function getLogin(s_users $s_user_obj) {
        return $this->setLogin($s_user_obj);
    }

    public function getRegister(s_users $s_user_obj) {
        return $this->setRegister($s_user_obj);
    }

    /**
     * 
     * @param s_users $register
     * @return boolean
     */
    private function setRegister(s_users $register) {

        try {
            $data[$register->getF_username()] = $register->getUsername();
            $data[$register->getF_password()] = $register->getPassword();
            $data[$register->getF_use_status()] = 1;
            $data[$register->getF_user_rol_id()] = $register->getRole();
            if ($this->db->insert($register->getT_users(), $data))
                return TRUE;
            else
                return FALSE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function findAllUsers() {
        $obj = new s_users();
        $this->db->where($obj->getT_users() . '.' . $obj->getF_use_status(), 1);
        if (strtolower($this->session->userdata($obj->getF_rol_name())) != strtolower(Setting::$role0))
            $this->db->where($obj->getF_rol_name() . ' != ', Setting::$role0);
        $this->db->join($obj->getT_roles(), $obj->getF_rol_id() . '=' . $obj->getF_user_rol_id());
        return $this->db->get($obj->getT_users());
    }

    function deleteUserById() {
        $db = new dbf();
        for ($k = 0; $k < count($_POST['child_check']); $k++) {
            $id = $_POST['child_check'][$k];
            $this->db->where($db->getF_user_id(), $id);
            $this->db->delete($db->getT_users());
        }
        return true;
    }

    function changepassword() {
        $db = new dbf();
        $data = array($db->getF_password() => md5($this->input->post($db->getF_password())));
        $this->db->where($db->getF_user_id(), $this->input->post($db->getF_user_id()));
        return $this->db->update($db->getT_users(), $data);
    }

    function editUserById() {
        $db = new dbf();
        $data = array($db->getF_user_rol_id() => $this->input->post($db->getF_user_rol_id()));
        $this->db->where($db->getF_user_id(), $this->input->post($db->getF_user_id()));
        return $this->db->update($db->getT_users(), $data);
    }

    function getUserById($id) {
        $db = new dbf();
        $this->db->where($db->getF_user_id(), $id);
        $this->db->where($db->getT_users() . '.' . $db->getF_use_status(), 1);
        return $this->db->get($db->getT_users());
    }

}

?>
