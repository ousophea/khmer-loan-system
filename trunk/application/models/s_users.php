<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of s_users
 *
 * @author sochy.choeun
 */
class s_users extends dbf {
    //put your code here

    private $username;
    private $password;
    private $user;
    private $role;

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }



}

?>
