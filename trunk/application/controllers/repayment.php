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
        $this->load->model(array('m_loan_product_type', 'm_loan', 'm_global', 'global/mod_global'));
//        $this->rand=NULL;
    }

    function index() {
        redirect('repayment/add');
    }

    function add() {
         $this->data['title'] = 'Loan Repayment';
        $this->data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));
        $this->load->view(Variables::$layout_main, $this->data);
    }

}

?>
