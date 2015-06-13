<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loan
 *
 * @author sophea.ou
 */
class repayment extends CI_Controller {

    //put your code here
    var $data = NULL;
    var $rand = NULL;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_loan_product_type', 'm_loan', 'm_global', 'global/mod_global', 'm_repayment'));
//        $this->rand=NULL;
    }

    function index() {
        redirect('repayment/add');
    }

    function search_loan_account() {
        $query_data = NULL;
        $loan_code = $this->input->post('accNum');
//        $loan_code = "12-000001-01";
        $query_data = $this->m_repayment->getLoanInfo($loan_code);
        ////==============Check previes loan================
        $pdata = $this->checkRemainLoan($loan_code);
       
        if ($pdata != NULL) {
//            echo $pdata; exit();
//            if ($pdata > 0) {
                $query_data[0]['rep_sch_remain'] = $pdata;
//            }
        }
//        =============================
        if (count($query_data) > 0) {
            echo json_encode($query_data[0]);
        } else {
            echo json_encode($query_data);
        }
    }

    public function repayList() {
        $data['title'] = 'Daily Repayment List';
        $this->form_validation->set_rules('date', '', 'trim');
        $this->form_validation->set_rules('co_name', '', 'trim');
        $this->form_validation->run();
        $data['query_all'] = $this->m_repayment->getRepay();
        $data['co_list'] = $this->m_global->getDataArray('creadit_officer', 'co_id', 'co_name', NULL);
//         $data['co_list'] = $this->mod_global->select_all('creadit_officer');
        $this->load->view(MAIN_MASTER, $data);
    }

    function add() {
        $this->data['title'] = 'Loan Repayment';
        $this->data['acc_num_query'] = $this->m_global->select_where('loan_account', array('loa_acc_loa_det_id' => DISBURSED));
        $currency = $this->m_loan->find_currencies_for_dropdown();
        $this->data['currency'] = $currency;
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function update() {
        $limit_date = $this->input->post('limit_date');
        $loan_id = $this->input->post('loan_id');
        $loan_des = $this->input->post('rep_detail');
        $loan_late_pay = $this->input->post('payment_late');
        $paid_value = $this->input->post('paid_amount');
        $newRepay = $this->calculateRepay();
//        var_dump($newRepay); exit();
        if ($loan_late_pay > 0) {
            $loan_rep_status = 3; /// Loan pay late
        }
        $arr_repayment = array();
        $arr_where = array();
        foreach ($newRepay as $row) {
            $repinfo = array(
                'rep_sch_status' => $row['loan_rep_status'],
                'rep_sch_description' => $loan_des,
                'rep_sch_paid' => $paid_value,
                'rep_sch_remain' => $row['remain'],
                'rep_sch_value_date' => date('y-m-d h:i:s'));
            $rep_condition = array(
                'rep_sch_loa_acc_id' => $loan_id,
                'DATE(rep_sch_date_repay)' => $limit_date);
            //If need to do forward
            if ($row['rep_sch_id'] != null) {
                $rep_condition2 = array(
                    'rep_sch_id' => $row['rep_sch_id']);
                $rep_condition = array_merge((array) $rep_condition, (array) $rep_condition2);
            }
//            var_dump($repinfo);
            $update_query = $this->m_global->update('repayment_schedule', $repinfo, $rep_condition);
        }
//        var_dump($arr_repayment);exit();
//        $this->db->update_batch('repayment_schedulea', $arr_repayment,$arr_where);
//        $update_query = $this->m_global->update('repayment_schedulew', $repinfo, $rep_condition);
//        echo $update_query;exit();
        if ($update_query) {
            $this->session->set_flashdata('success', 'Repayment account has been saved');
            redirect('repayment/add');
        } else {
            $this->session->set_flashdata('error', 'Error on update repayment loan');
            redirect('repayment/add');
        }
    }

    function calculateRepay() {
        $loan_amount = $this->input->post('amount'); // Amount to be pay
        $paid_value = $this->input->post('paid_amount'); // Recived amount
        $arr_list_repay = array();
        $balance = $paid_value - $loan_amount;
        switch ($balance) {
            case 0: ////////// paid value is equa to to settlement amount
                $arr_repay = array(
                    'loan_rep_status' => 2,
                    'remain' => 0,
                    'rep_sch_id' => null
                );
                array_push($arr_list_repay, $arr_repay);
                return $arr_list_repay;
                break;
            case ($balance < 0): //////////////Paid value less than settlement amount
                $arr_repay = array(
                    'loan_rep_status' => 5, // Repay have remain
                    'remain' => $balance * (-1),
                    'rep_sch_id' => null
                );
                array_push($arr_list_repay, $arr_repay);
                return $arr_list_repay;
                break;
            case ($balance > 0): ////////// Paid more than settlement amount
                $dataFoword = $this->doFowardRepay($balance);
                return $dataFoword;
                break;
        }
    }

    function checkRemainLoan($loan_code) {
        $pData = $this->m_repayment->getRemain($loan_code);
        return $pData;
    }

    function doFowardRepay($forword = null) {
        $balance = $forword;
        $loa_id = $this->input->post('loan_id');
        $getRemain = $this->input->post('remain_amount');
        ///Test value =====
//        $remain = 20000;
//        $loa_id = 2;
        //==========    
        $getData = $this->m_repayment->getNextRepay($loa_id); // Get back array of repayment for a loan acound
        $arr_sch_rec = array();
        foreach ($getData->result() as $row) {
            if ($getRemain > 0) {
                $balance-= $getRemain; // 5-2= 3
            } else {
                $balance -= $row->rep_sch_total_repayment;
            }
//             echo $balance; exit();
//            $array_repay = array();
            if ($balance >= 0) {
                if ($getRemain > 0) {
                    $setRemain = $getRemain * (-1); 
                    $getRemain = 0;
                }else{
                    $setRemain = $balance;
                }
                
                $array_repay = array(
                    'rep_sch_id' => $row->rep_sch_id,
                    'loan_rep_status' => 6, /////////Do forward repayment
                    'remain' => $setRemain
                );
                array_push($arr_sch_rec, $array_repay);
            } elseif ($balance < 0) {
                $array_repay = array(
                    'rep_sch_id' => $row->rep_sch_id,
                    'loan_rep_status' => 7, /////////Do forward some value
                    'remain' => $balance
                );
                array_push($arr_sch_rec, $array_repay);
                return $arr_sch_rec;
            }
        }
        return $arr_sch_rec;
    }

}

?>
