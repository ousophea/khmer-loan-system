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
        $this->load->model(array('m_loan_product_type', 'm_loan', 'm_global', 'global/mod_global', 'm_repayment', 'm_teller_cash', 'm_transaction'));
//        $this->rand=NULL;
    }

    function index() {
        redirect('repayment/add');
    }

    function search_loan_account() {
        $query_data = NULL;
        $loan_code = $this->input->post('accNum');
//        $loan_code = "11-000003-01";
        $query_data = $this->m_repayment->getLoanInfo($loan_code);
        ////==============Check previes loan================
        $pdata = $this->checkRemainLoan($loan_code);
        $fdata = $this->checkForwardLoan($loan_code);
//        var_dump($fdata); exit();
        if ($pdata != NULL) {
            $query_data[0]['rep_sch_remain'] = $pdata;
        }
        if ($fdata != NULL) {
            $query_data[0]['rep_sch_forward'] = $fdata;
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

    function addTellerBalance() {
        $this->m_teller_cash->addTellerCash();
    }

//    function addTransaction() {
//        $paid_value = $this->input->post('paid_amount');
//        $this->m_transaction->add(null,$paid_value,1,1,1);
//    }

    function update() {
        $limit_date = $this->input->post('limit_date');
        $loan_id = $this->input->post('loan_id');
        $loan_des = $this->input->post('rep_detail');
        $loan_late_pay = $this->input->post('payment_late');
        $paid_value = $this->input->post('paid_amount');
//        
        $newRepay = $this->calculateRepay();
//        var_dump($newRepay); exit();
        if ($loan_late_pay > 0) {
            $loan_rep_status = 3; /// Loan pay late
        }
        if ($newRepay) {
            $this->session->set_flashdata('success', 'Repayment account has been saved');
//========insert transaction ==============
//        add($debit=null,$credit=null,$amount,$currency=null,$gl_id=null,$tran_type=null)
            $debit = NULL;
            $credit = $paid_value;
            $gl_id = "3001234";
            $amount = $paid_value;
            $currency = 1; // KH
            $tran_type = 1; // Debit
            $this->m_transaction->add($debit, $credit, $amount, $currency, $gl_id, $tran_type);
//        ====================
            //===========Add teller cash==========
            $debite = null;
            $credit = $paid_value;
            $currency = 1;
            $this->m_teller_cash->addTellerCash($debite, $credit, $currency);
            //====================
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
        $getForward = $this->input->post('forward_amount');
        $rep_id = $this->input->post('rep_id'); // Recived amount
        $arr_list_repay = array();
        $repay = $paid_value + $getForward;
        if ($repay > $loan_amount) {
//            echo $repay;
//            echo "<br /> paid ".$loan_amount;exit();
//            ========== Check paid with all total of repay amount=======
            $loan_id = $this->input->post('loan_id');
            $totalRempay = $this->m_repayment->getTotalRepay($loan_id); // Get back total amount of repayment for a loan account
            if (($repay - $getRemain) > $totalRempay) {
                $this->session->set_flashdata('error', 'Error, Paid is more than total repayment');
                redirect('repayment/add');
            }
//            =========================
            if ($getRemain > 0) {
                $balance = $repay - $loan_amount - $getRemain;
                if ($balance > 0) {
                    $forward = $balance;
                    $remain = $getRemain * (-1);
                    $statuse = 8; // release remain and froward;
                    $arr_repay = array(
                        'loan_rep_status' => $statuse,
                        'remain' => $remain,
                        'forward' => $forward,
                        'rep_paid' => $paid_value,
                        'rep_id' => $rep_id
                    );
                    $this->doUpdateRepay($arr_repay);
                    $this->doFowardWithRemain($forward); // Release some remain
//                    $getRemain = 0;
                } elseif ($balance == 0) {
                    $forward = 0;
                    $remain = $getRemain * (-1);
                    $statuse = 6; // release remain;
                    $arr_repay = array(
                        'loan_rep_status' => $statuse,
                        'remain' => $remain,
                        'forward' => $forward,
                        'rep_paid' => $paid_value,
                        'rep_id' => $rep_id
                    );
                    $this->doUpdateRepay($arr_repay);
                } else { // if $balance < 0;
                    $forward = 0;
                    $remain = ($getRemain + $balance) * (-1); // 3000 + (-2000)
                    $statuse = 9; // release some remain;
                    $arr_repay = array(
                        'loan_rep_status' => $statuse,
                        'remain' => $remain,
                        'forward' => $forward,
                        'rep_paid' => $paid_value,
                        'rep_id' => $rep_id
                    );
                    $this->doUpdateRepay($arr_repay);
                }
            } else {  ///$paid_value > $loan_amount and Remain < 0;
                $balance = $repay - $loan_amount;
                $remain = 0;
                if($paid_value > $loan_amount){
                    $forward = $paid_value - $loan_amount;
                   $statuse = 6; /// Do forward
                }else{ //////////// paid_input  < or = silement
                    $forward = $loan_amount - $paid_value;
                     $statuse = 7; ////  forward some value      
                }
                $arr_repay = array(
                        'loan_rep_status' => $statuse,
                    'remain' => $remain,
                    'forward' => $forward,
                    'rep_paid' => $paid_value,
                    'rep_id' => $rep_id
                );
                $this->doUpdateRepay($arr_repay);
                $this->doFowardWithRemain($balance); // Release some remain
//                if ($balance == 0) {
//                    $statuse = 2; // Paid;
//                    $arr_repay = array(
//                        'loan_rep_status' => $statuse,
//                        'remain' => $remain,
//                        'forward' => $forward,
//                        'rep_paid' => $paid_value,
//                        'rep_id' => $rep_id
//                    );
//                    $this->doUpdateRepay($arr_repay);
//                } elseif ($balance > 0) {
//                    $forward = $balance;
//                    $statuse = 6; // Paid;
//                    $arr_repay = array(
//                        'loan_rep_status' => $statuse,
//                        'remain' => $remain,
//                        'forward' => $forward,
//                        'rep_paid' => $paid_value,
//                        'rep_id' => $rep_id
//                    );
//                    $this->doUpdateRepay($arr_repay);
//                    $this->doFowardWithRemain($balance); // Release some remain
//                }
            }
            return true;
        } elseif ($repay < $loan_amount) { //////////////Paid value + forward < settlement amount
//            echo "repaym + forward : " . $repay . " < silement: " . $loan_amount;
//            exit();
            $remain = $loan_amount - $repay;
//            echo "<br/>remain: ".$remain; exit();
//            $getForward = $this->input->post('forward_amount');
            if ($getForward > 0) {
                $forward = $getForward * (-1);
                $remain = $loan_amount - $repay;
                $status = 8; /// Release remain
            } else {
                $forward = 0;
                $status = 5; // Set regmain
            }
            $arr_repay = array(
                'loan_rep_status' => $status, // Repay have remain
                'remain' => $remain,
                'rep_paid' => $paid_value,
                'forward' => $forward,
                'rep_id' => $rep_id
            );
            $this->doUpdateRepay($arr_repay);
            return true;
        } else {  ////////// Paid =  settlement amount
//            echo "repaym + forward : " . $repay . " = silement: " . $loan_amount;
//            exit();
            if ($getForward > 0) {
                $forward = $getForward * (-1);
                $status = 10; /// Release remain
            }
            $arr_repay = array(
                'loan_rep_status' => $status, // Repay have remain
                'remain' => 0,
                'forward' => $forward,
                'rep_paid' => $paid_value,
                'rep_id' => $rep_id
            );
            $dataFoword = $this->doUpdateRepay($arr_repay);
            return true;
        }
    }

    function checkRemainLoan($loan_code) {
        $pData = $this->m_repayment->getRemain($loan_code);
        return $pData;
    }

    function checkForwardLoan($loan_code = null) {
//        $loan_code = "13-000001-01";
        $pData =0;
        $pData = $this->m_repayment->getForward($loan_code);
        return $pData;
    }

    function doFowardWithRemain($forwardBalance = null) {
        $loa_id = $this->input->post('loan_id');
        $nextRepay = $this->m_repayment->getNextRepay($loa_id); // Get back array of repayment for a loan acound
        foreach ($nextRepay->result() as $row) {
            $forwardBalance -= $row->rep_sch_total_repayment;  // balance = paid - nextRepay()
            if ($forwardBalance >= 0) {
                $forward = $row->rep_sch_total_repayment * (-1);
                $status = 6; /// forward
                $remain = 0;
                $paid = 0;
                $arr_repay = array(
                    'loan_rep_status' => $status,
                    'rep_paid' => $paid,
                    'remain' => $remain,
                    'forward' => $forward,
                    'rep_id' => $row->rep_sch_id
                );
                $this->doUpdateRepay($arr_repay);
            } else {
                return true; // if don't have enought value to forward
            }
        }
    }

    function doFowardRepay($getForward = null, $balance = null, $paid_value = null, $getRemain = null) {
        $loa_id = $this->input->post('loan_id');
        $nextRepay = $this->m_repayment->getNextRepay($loa_id); // Get back array of repayment for a loan acound
        foreach ($nextRepay->result() as $row) {
            $tmp = $getForward;
            $getForward -= $row->rep_sch_total_repayment;  // balance = paid - nextRepay()
            if ($getForward >= 0) {
                $status = 6;
                $remain = 0;
                $paid = 0;
                $arr_repay = array(
                    'loan_rep_status' => $status,
                    'rep_paid' => $paid,
                    'remain' => $remain,
                    'forward' => $forward,
                    'rep_id' => $row->rep_sch_id
                );
                $this->doUpdateRepay($arr_repay);
                $paid_value = $balance;
//                echo $forward;
            } else {
                $status = 7;
                $paid = 0;
                $remain = 0;
                $forward = $tmp;
                $arr_repay = array(
                    'loan_rep_status' => $status, 'rep_paid' => $paid, 'remain' => $remain, 'forward' => $forward, 'rep_id' => $row->rep_sch_id
                );
                $this->doUpdateRepay($arr_repay);
                return true;
            }
            $i++;
        }
//        exit();
        return true;
    }

    function doFowardSomeRepay($remain = null, $status = null, $paid = null, $forward = null, $rep_id = null) {
        $arr_repay = array(
            'loan_rep_status' => $status,
            'rep_paid' => $paid,
            'remain' => $remain,
            'forward' => $forward,
            'rep_id' => $rep_id
        );
        $this->doUpdateRepay($arr_repay);
    }

    function doUpdateRepay($repay = null) {
//        $limit_date = $this->input->post('limit_date');
        $loan_id = $this->input->post('loan_id');
//        $rep_sch_num = $this->input->post('rep_num');
        $loan_des = $this->input->post('rep_detail');
//        $loan_late_pay = $this->input->post('payment_late');
//        $paid_value = $this->input->post('paid_amount');
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
