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
class d_roles extends CI_Model{
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
    private function setAllRoles(s_roles $obj_role){
        $data = $this->db->get($obj_role->getT_roles());
        $row = null;
        foreach ($data->result_array() as $value) {
            $row[$value[$obj_role->getF_rol_id()]] = $value[$obj_role->getF_rol_name()];
        }
        //print_r($row);die();
        $obj_role->setObjRole($row);
        return $obj_role->getObjRole();
    }

}

?>
