<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('Permission Denied!');

class m_report extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
//    function select_count_trn() {
//        $data['total_debit'] = $this->db->select('SUM(tra_debit) as debit_total');
//        $data['total_credit'] = $this->db->select('SUM(tra_credit) as credit_total');
//        return $data;
//    }
    public function select_count_trn($arr_total_case = array()) {
        $this->db->select_sum('tra_credit', 'total_credit');
        $this->db->select_sum('tra_debit', 'total_debit');
        foreach ($arr_total_case as $field => $value) {
            $this->db->where($field, $value);
        }

       // $this->db->where($arr_total_case);
        $query = $this->db->get('transaction');
        //echo $this->db->last_query();
        return $query;
    }

    public function sum_balance($arr_item_where = NULL) {
        if ($arr_item_where != NULL) {
            foreach ($arr_item_where as $field => $value) {
                $data['balance'] = $this->db->where($field, $value);
            }
        }
        $data['balance'] = $this->db->select('SUM(tra_debit) as debit_total,SUM(tra_credit) as credit_total');
        return $data;
    }

}

?>
