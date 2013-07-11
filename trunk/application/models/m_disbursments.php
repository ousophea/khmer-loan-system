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

    public function select_acc_info($acc_num) {
        $this->db->join('contacts', 'loan_account.loa_acc_con_id=contacts.con_id', 'left');
        $this->db->join('contacts_detail', 'contacts.con_id=contacts_detail.con_det_con_id', 'left');
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
        $this->db->join('currency', 'loan_account.loa_acc_cur_id=currency.cur_id', 'left');
        $this->db->join('loan_product_type','loan_account.loa_acc_loa_pro_type_id=loan_product_type.loa_pro_typ_id','left');
        $this->db->where($acc_num);
        return $this->db->get("loan_account");
//        $this->db->get();
//        return $this->db->last_query();
    }
    public function select_disbursed($arr_search_index){
        
        $this->db->join('loan_account', 'loan_disbursments.loa_dis_loa_acc_code=loan_account.loa_acc_code', 'left');
        $this->db->join('gl_list', 'loan_account.loa_acc_gl_code=gl_list.gl_code', 'left');
        $this->db->where($arr_search_index);
        $this->db->order_by("loa_dis_date", "asc"); 
        return  $this->db->get('loan_disbursments');
    }

}

?>
