<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loan
 *
 * @author sochy.choeun
 */
class repayment extends CI_Controller {

    //put your code here
    var $data = NULL;
    var $rand = NULL;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_loan_product_type', 'm_loan', 'm_global', 'global/mod_global','m_repayment'));
//        $this->rand=NULL;
    }

    function index() {
        redirect('repayment/add');
    }

    function search_loan_account() {
        $data = NULL;
        $loan_code = $this->input->post('accNum');
//        $loan_code = '888-000001-01-1';
//        $query_data = $this->m_global->select_where('loan_account', array('loa_acc_code' => $loan_code));
        $query_data = $this->m_global->select_join('loan_account', array('currency' => array('loa_acc_cur_id' => 'cur_id'),
            'repayment_schedule' => array('loa_acc_id' => 'rep_sch_loa_acc_id')), 'inner', array('loa_acc_code' => $loan_code, 'rep_sch_status' => 1), '1'); // rep_sch_status =1 mean not yet pay
        $this->session->set_flashdata('loan_code', $loan_code);
//        echo $query_data;exit();

        $query_data->result_array();
        $data = $query_data->result_array;

        if (count($data) > 0) {
            echo json_encode($data[0]);
        } else {
            echo json_encode($data);
        }
    }

    public function repayList() {
        $data['title'] = 'Daily Repayment List';
        $data['query_all'] = $this->m_repayment->getRepay();
        $this->load->view(MAIN_MASTER, $data);
    }
        function add() {
            $this->data['title'] = 'Loan Repayment';
            $this->data['acc_num_query'] = $this->m_global->select_where('loan_account', array('loa_acc_loa_det_id' => APPROVED));
            $currency = $this->m_loan->find_currencies_for_dropdown();
            $this->data['currency'] = $currency;
            $this->load->view(Variables::$layout_main, $this->data);
        }

        function update() {
            $limit_date = $this->input->post('limit_date');
            $loan_id = $this->input->post('loan_id');
            $loan_des = $this->input->post('rep_detail');
            $loan_late_pay = $this->input->post('payment_late');
            $loan_rep_status = 2; ///// Loan ready pay
            if ($loan_late_pay > 0) {
                $loan_rep_status = 3; /// Loan pay late
            }

            $update_query = $this->m_global->update('repayment_schedule', array('rep_sch_status' => $loan_rep_status,
                'rep_sch_description' => $loan_des,
                'rep_sch_value_date' => date('y-m-d h:i:s')), array('rep_sch_loa_acc_id' => $loan_id,
                'DATE(rep_sch_date_repay)' => $limit_date));
//        echo $update_query;exit();
            if ($update_query) {
                $this->session->set_flashdata('success', 'Repayment account has been saved');
                redirect('repayment/add');
            } else {
                $this->session->set_flashdata('error', 'Error on update repayment loan');
                redirect('repayment/Open');
            }
        }

    }

?>
