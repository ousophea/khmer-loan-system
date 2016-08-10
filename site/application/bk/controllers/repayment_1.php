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
        if ($newRepay) {
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
        $getRemain = $this->input->post('remain_amount');
        $totalRepay = $this->input->post('total_amount');
        $rep_id = $this->input->post('rep_id'); // Recived amount
        $arr_list_repay = array();
        $balance = $paid_value - $loan_amount;
        switch ($balance) {
            case 0: ////////// paid value is equa to to settlement amount
                $arr_repay = array(
                    'loan_rep_status' => 2,
                    'remain' => 0,
                    'rep_paid' => $paid_value,
                    'rep_id' => $rep_id
                );
                $this->doUpdateRepay($arr_repay);
                return true;
                break;
            case ($balance < 0): //////////////Paid value less than settlement amount
                if ($paid_value < $totalRepay) {
                    $status = 5;
                } else {
                    $status = 8;
                }
                $arr_repay = array(
                    'loan_rep_status' => $status, // Repay have remain
                    'remain' => $balance * (-1),
                    'rep_paid' => $paid_value,
                    'rep_id' => $rep_id
                );
                $this->doUpdateRepay($arr_repay);
                return true;
                break;
            case ($balance > 0): ////////// Paid more than settlement amount
                $dataFoword = $this->doFowardRepay($paid_value);
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
        $getRemain = (int) $this->input->post('remain_amount');
        $getData = $this->m_repayment->getNextRepay($loa_id); // Get back array of repayment for a loan acound
        $arr_sch_rec = array();
        foreach ($getData->result() as $row) {
            if ($getRemain > 0) {
                $tmp_remain = $balance;
                if ($balance >= $row->rep_sch_total_repayment) {
                    $tmp = $balance;
                    $balance -= $row->rep_sch_total_repayment;
                    $status_r_forward = 8;  //Release Remain$
                    $remain = $balance * (-1);
                    $remain_balance = $balance - $getRemain;
                    if ($remain_balance >= 0) {
                        $getRemain = 0;
                    }
                    $arr_repay = array(
                        'loan_rep_status' => $status_r_forward,
                        'rep_paid' => $tmp,
                        'forward' => $remain,
                        'rep_id' => $row->rep_sch_id
                    );
                    $this->doUpdateRepay($arr_repay);
                } else {  //== $balance > total_repay and $balance - $getRemain < 0;  2-5= -3
                    $status_r_forward = 7; //// Forward some value
                    $remain = $tmp_remain * (-1);
                    $arr_repay = array(
                        'loan_rep_status' => $status_r_forward,
                        'rep_paid' => 0,
                        'forward' => $remain,
                        'rep_id' => $row->rep_sch_id
                    );
                    $this->doUpdateRepay($arr_repay);
                      return true;
                }
            } else {  // If don't have remain repayment
                if ($balance >= $row->rep_sch_total_repayment) {
                    $tmp_repay_forward = $balance;
                    $balance -= $row->rep_sch_total_repayment;  //===  2-5 =-3   or $tmp - 5 = -3
                    $arr_repay = array(
                        'loan_rep_status' => 6,
                        'rep_paid' => $tmp_repay_forward,
                        'forward' => $balance,
                        'rep_id' => $row->rep_sch_id
                    );
                    $this->doUpdateRepay($arr_repay);
                } else {  ////// if balance < 0
                    $arr_repay = array(
                        'loan_rep_status' => 7,
                        'rep_paid' => 0,
                        'forward' => $balance * (-0), //
                        'rep_id' => $row->rep_sch_id
                    );
                    $this->doUpdateRepay($arr_repay);
                    return true;
                }
            }
        }
        return true;
    }

    function doUpdateRepay($repay = null) {
        $limit_date = $this->input->post('limit_date');
        $loan_id = $this->input->post('loan_id');
//        $rep_sch_num = $this->input->post('rep_num');
        $loan_des = $this->input->post('rep_detail');
        $loan_late_pay = $this->input->post('payment_late');
        $paid_value = $this->input->post('paid_amount');
        $repinfo = array(
            'rep_sch_status' => $repay['loan_rep_status'],
            'rep_sch_description' => $loan_des,
            'rep_sch_paid' => $repay['rep_paid'],
            'rep_sch_remain' => $repay['remain'],
            'rep_sch_forward' => $repay['forward'],
            'rep_sch_value_date' => date('y-m-d h:i:s'));
        $rep_condition = array(
            'rep_sch_loa_acc_id' => $loan_id,
            'rep_sch_id' => $repay['rep_id']
        );
        $update_query = $this->m_global->update('repayment_schedule', $repinfo, $rep_condition);
//        return $update_query;
//        exit();
    }

}

?>
