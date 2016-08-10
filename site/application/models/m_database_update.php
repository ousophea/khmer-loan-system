<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('Permission Denied!');

class m_database_update extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
    public function update_db() {
        $sql = $this->string_update();
        $sqls = explode(';', $sql);
        array_pop($sqls);
        $smt="";
        foreach ($sqls as $statement) {
            $statment = $statement . ";";
            $smt = $this->db->query($statement);
        }
        return $smt;
    }
    public function string_update(){
        $sr = "";

        return $sr;
    }

}

?>
