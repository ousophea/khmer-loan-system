<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of S_roles
 * Date structure of table roles
 *
 * @author sochy.choeun
 */
class s_roles extends dbf{

    //put your code here
    private $rolId = null;
    private $rolName = null;
    private $rolAuthorize = null;
    private $rolStatus = null;
    private $objRole = null;

    /**
     * 
     * @return type int
     */
    public function getRolId() {
        return $this->rolId;
    }

    /**
     * 
     * @param type $rolId
     */
    public function setRolId($rolId) {
        $this->rolId = $rolId;
    }

    /**
     * 
     * @return type
     */
    public function getRolName() {
        return $this->rolName;
    }

    /**
     * 
     * @param type $rolName
     */
    public function setRolName($rolName) {
        $this->rolName = $rolName;
    }

    /**
     * 
     * @return type int
     */
    public function getRolAuthorize() {
        return $this->rolAuthorize;
    }

    /**
     * 
     * @param type $rolAuthorize
     */
    public function setRolAuthorize($rolAuthorize) {
        $this->rolAuthorize = $rolAuthorize;
    }

    /**
     * 
     * @return type boolean
     */
    public function getRolStatus() {
        return $this->rolStatus;
    }

    /**
     * 
     * @param type $rolStatus
     */
    public function setRolStatus($rolStatus) {
        $this->rolStatus = $rolStatus;
    }
    public function getObjRole() {
        return $this->objRole;
    }

    public function setObjRole($objRole) {
        $this->objRole = $objRole;
    }




}

?>
