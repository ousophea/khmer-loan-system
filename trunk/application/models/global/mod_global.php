<?php

/**
 * The model sample of the front-page site and admin-page site
 *
 */
class Mod_global extends CI_Model {

    //some function here
    function __construct() {
        parent::__construct();
    }

    function select_all($table) {
        return $this->db->get($table);
    }

    function select_where($table, $field, $field_value) {
        $this->db->where($field, $field_value);
        return $this->db->get($table);
    }

    function select_where_and($table, $arr_where = NULL) {
        if (count($arr_where) != 0) {
            foreach ($arr_where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->get($table);
    }

    function delete($table, $field, $field_value) {
        $this->db->where($field, $field_value);
        return $this->db->delete($table);
    }

}

?>