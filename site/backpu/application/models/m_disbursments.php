<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('Permission Denied!');

class m_disbursments extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

//    function select_acc_info($acc_num) {
//        $this->db->join('contacts', 'loan_account.loa_acc_con_id=contacts.con_id', 'left');
//        $this->db->join('contacts_detail', 'contacts.con_id=contacts_detail.con_det_con_id', 'left');
//        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
//        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
//        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
//        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
//        $this->db->join('currency', 'loan_account.loa_acc_cur_id=currency.cur_id', 'left');
//         $this->db->join('gl_list', 'loan_account.loa_acc_gl_code=gl_list.gl_code', 'left');
//        $this->db->join('loan_product_type','loan_account.loa_acc_loa_pro_type_id=loan_product_type.loa_pro_typ_id','left');
//        $this->db->where($acc_num);
//        return $this->db->get("loan_account");
//        $this->db->get("loan_account");
//        return $this->db->last_query();
//    }
    function getTellerCash($id=null){
        $this->db->where('til_tel_id',$id);
        $this->db->where('til_create_date',date('Y-m-d', now()));
        $this->db->order_by("til_create_date", "asc");
        return $this->db->get('tiller', 1);
    }
    public function select_disbursed($arr_search_index) {

        $this->db->join('loan_account', 'loan_disbursments.loa_dis_loa_acc_code=loan_account.loa_acc_code', 'left');
        $this->db->join('gl_list', 'loan_account.loa_acc_gl_code=gl_list.gl_code', 'left');
        $this->db->where($arr_search_index);
        $this->db->order_by("loa_dis_date", "asc");
        return $this->db->get('loan_disbursments', 1);
    }
    public function getCOBalenc() {
        $this->db->join('loan_account', 'loan_disbursments.loa_dis_loa_acc_code=loan_account.loa_acc_code', 'left');
        $this->db->join('gl_list', 'loan_account.loa_acc_gl_code=gl_list.gl_code', 'left');
        $this->db->where($arr_search_index);
        $this->db->order_by("loa_dis_date", "asc");
        return $this->db->get('loan_disbursments', 1);
    }

    public function search_acc_disburse() {
         $accNum = $this->input->post('accNum');
        $arr_search_index = array(
            "loan_account.loa_acc_code" => $accNum,
            "loan_account.loa_acc_loa_det_id" =>2 //// loan ready approved
        );
        $this->db->join('contacts', 'loan_account.loa_acc_con_id=contacts.con_id', 'left');
        $this->db->join('contacts_detail', 'contacts.con_id=contacts_detail.con_det_con_id', 'left');
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
        $this->db->join('currency', 'loan_account.loa_acc_cur_id=currency.cur_id', 'left');
        $this->db->join('gl_list', 'loan_account.loa_acc_gl_code=gl_list.gl_code', 'left');
        $this->db->join('loan_product_type', 'loan_account.loa_acc_loa_pro_type_code=loan_product_type.loa_pro_typ_id', 'left');
        $this->db->where($arr_search_index);
        return $this->db->get("loan_account");

//        $this->db->get("loan_account");
//        return $this->db->last_query();
    }

}

?>
