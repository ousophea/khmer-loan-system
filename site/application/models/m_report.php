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

    public function get_disburs() {
        if ($this->input->post('currency')) {

            if ($this->input->post('txt_dis_sdate') != '') {
                $this->db->where('loa_dis_date >=', $this->input->post('txt_dis_sdate'));
            }
            if ($this->input->post('txt_dis_edate') != '') {
                $this->db->where('loa_dis_date <=', $this->input->post('txt_dis_edate'));
            }
//            echo $this->input->post('txt_dis_edate');exit();
//        ===============For Currency dropdown list ==============
            if ($this->input->post('currency') != '') {
                $this->session->set_userdata('currency', $this->input->post('currency'));
                $this->db->where('loa.loa_acc_cur_id', $this->input->post('currency'));  ///Select data with currency id
            }
//        ======================================

            $this->db->where('loa.loa_acc_loa_det_id', DISBURSED, true); /////when laon is ready disbursed
            $this->db->select("co.co_name,co.co_card_id,loa.loa_acc_id,loa_acc_cur_id,
    SUM(IF(loa.loa_acc_loa_pro_type_code='1',1,0)) countMicro,
    SUM(IF(loa.loa_acc_loa_pro_type_code='1',loa.loa_acc_amount,0)) sumMicro,
    SUM(IF(loa.loa_acc_loa_pro_type_code='2',1,0)) countSmall,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='2',loa.loa_acc_amount,0)) sumSmall,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='3',1,0)) countMedium,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='3',loa.loa_acc_amount,0)) sumMedium,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='4',1,0)) countLarge,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='4',loa.loa_acc_amount,0)) sumLarge,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='4',1,0)) countLargest,
	 SUM(IF(loa.loa_acc_loa_pro_type_code='4',loa.loa_acc_amount,0)) sumLargest,
	 count(loa.loa_acc_id) countTotal,
    sum(loa.loa_acc_amount) total", FALSE);
            $this->db->join('loan_account loa', 'loa.loa_acc_code=dis.loa_dis_loa_acc_code');
            $this->db->join('creadit_officer co', 'loa.loa_acc_co_id=co.co_id');
            $this->db->join('loan_product_type pt', 'loa.loa_acc_loa_pro_type_code=pt.loa_pro_typ_id');
            $this->db->group_by('co.co_id');
            $query = $this->db->get('loan_disbursments dis');
            return $query;
        } else {
            $this->session->set_userdata('currency', "");  // Keep data for currency select box
            return FALSE;
        }
    }

    public function get_collection() {
        if ($this->input->post('currency')) {

            if ($this->input->post('txt_dis_sdate') != '') {
                $this->db->where('rep_sch_value_date >=', $this->input->post('txt_dis_sdate'));
            }
            if ($this->input->post('txt_dis_edate') != '') {
                $this->db->where('rep_sch_value_date <=', $this->input->post('txt_dis_edate'));
            }
//            echo $this->input->post('txt_dis_edate');exit();
//        ===============For Currency dropdown list ==============
            if ($this->input->post('currency') != '') {
                $this->session->set_userdata('currency', $this->input->post('currency'));
                $this->db->where('loa_acc_cur_id', $this->input->post('currency'));  ///Select data with currency id
            }
//        ======================================
            $this->db->from('repayment_schedule rs');
            $this->db->select(" co.co_name coname, rs.rep_sch_value_date as valuedate,
	SUM(IF(rs.rep_sch_status ='3', rs.rep_sch_remain, 0)) as lateRepay, 
	SUM(IF(rs.rep_sch_status ='2', rs.rep_sch_principle_amount_repayment, 0)) as totalPriciple, 
	SUM(IF(rs.rep_sch_status ='6', rs.rep_sch_forward, 0))as totalForward, 
	SUM(IF(rs.rep_sch_status ='3', rs.rep_sch_rate_repayment, 0)) as lateRate, 
	SUM(IF(rs.rep_sch_status ='2', rs.rep_sch_rate_repayment, 0)) as paidRate, 
	SUM(IF(rs.rep_sch_status ='6', rs.rep_sch_rate_repayment, 0)) as forwardRate ", FALSE);
            $this->db->join('loan_account loa', 'loa.loa_acc_id=rs.rep_sch_loa_acc_id');
            $this->db->join('currency cu', 'cu.cur_id=loa.loa_acc_cur_id');
            $this->db->join('creadit_officer co', 'loa.loa_acc_co_id=co.co_id');
            $this->db->group_by('loa.loa_acc_co_id');
            $query = $this->db->get();
            return $query;
//        var_dump($query);
//        exit();
        } else {
            $this->session->set_userdata('currency', ''); // Keep data for currency select box
            return FALSE;
        }
    }

}

?>
