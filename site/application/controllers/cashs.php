<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cashs
 *
 * @author sochy.choeun
 */
class cashs extends CI_Controller {

    //put your code here
    var $data = null;

    function __construct() {
        parent::__construct();
        allows(array(Setting::$role3));
        $this->load->model(array('m_cashs', 'm_currencies', 'm_transaction'));
    }

    function index() {
        $this->data['title'] = "Tiller cash";
        $this->data['currencies'] = $this->m_currencies->find_currencies_for_dropdown();
        $this->load->view(MAIN_MASTER, $this->data);
    }

    function cashin() {
//========insert transaction ==============
        $gl_id = '111109112';
        $debit = 0;
        $credit = $this->input->post('amountout');
        $amount = $this->input->post('amountout');
        $currency = $this->input->post('currencyout');
        $tran_type = 2; // Debit
        $add_transation_result = $this->m_transaction->add($debit, $credit, $amount, $currency, $gl_id, $tran_type);
        if (!$add_transation_result) {
            $this->session->set_flashdata('error', 'Loan account was create successfully, but this transaction was not record');
        }
        //=============end transaction===========
        if ($this->m_cashs->cashin()) {
            echo json_encode(array('result' => 1));
        } else
            echo json_encode(array('result' => 0));

        //echo json_encode(array('result' => 1));
    }

    function cashout() {
        if ($this->m_cashs->cashout()) {
            //========insert transaction ==============
            $gl_code = '111109112';
            $debit = 0;
            $credit = $this->input->post('amountout');
            $amount = $this->input->post('amountout');
            $currency = $this->input->post('currencyout');
            $tran_type = 1; // Debit
            $add_transation_result = $this->m_transaction->add($debit, $credit, $amount, $currency, $gl_code, $tran_type);
            if (!$add_transation_result) {
                $this->session->set_flashdata('error', 'Loan account was create successfully, but this transaction was not record');
            }
            //=============end transaction===========
            echo json_encode(array('result' => 1));
        } else {
            echo json_encode(array('result' => 0));
        }
    }

}

?>
