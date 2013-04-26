<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of d_roles
 *
 * @author sochy.choeun
 */
class d_roles extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return array
     */
    public function getAllRoles(s_roles $obj_role) {
        return $this->setAllRoles($obj_role);
    }

    /**
     * 
     * @param s_roles $obj_role
     */
    private function setAllRoles(s_roles $obj_role) {
        if (strtolower($this->session->userdata($obj_role->getF_rol_name())) != strtolower(Setting::$role0))
            $this->db->where($obj_role->getF_rol_name() . ' != ', Setting::$role0);
            $this->db->where($obj_role->getF_rol_status(), 1);
            $this->db->order_by($obj_role->getF_rol_name(),'ASC');
        $data = $this->db->get($obj_role->getT_roles());
        $row = null;
        foreach ($data->result_array() as $value) {
            $row[$value[$obj_role->getF_rol_id()]] = $value[$obj_role->getF_rol_name()];
        }
        //print_r($row);die();
        $obj_role->setObjRole($row);
        return $obj_role->getObjRole();
    }

    /**
     * 
     * @param s_users $user
     * @param type $getCell
     */
    function setRoleByUsername(s_users $user, $getCell=null) {
        $this->db->from($user->getT_roles());
        $this->db->join($user->getT_users(), $user->getF_rol_id() . '=' . $user->getF_user_rol_id());
        $this->db->where($user->getF_username(), $user->getUsername());
        $data = $this->db->get();
        foreach ($data->result_array() as $row) {
            $user->setRole($row[$getCell]);
        }
        return $user;
    }

    function getRoleId(){

        $id = 0;
        $this->db->where('gro_name',$this->session->userdata('gro_name'));
        $data = $this->db->get('user_groups');
        foreach ($data->result() as $row) {
            $id = $row->gro_id;
            break;
        }
        return $id;
    }

}

?>
