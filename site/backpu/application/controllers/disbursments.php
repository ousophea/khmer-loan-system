<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class disbursments extends CI_Controller {

//put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model(array('global/mod_global', 'mod_global', 'm_global', 'm_disbursments', 'm_teller_cash', 'm_transaction'));
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
        $dbf = new dbf();
    }

    function index() {
        redirect('disbursments/disbursment');
    }

    function disbursment() {
        $data['title'] = 'Disbursment / Debit';
//        select_where('tbl_users',array('use_name' => 'vannak','use_password' => '12345'))
//        $data['acc_num_query'] = $this->m_global->select_where('loan_account', array('loa_acc_disbustment'=>NULL));
        $data['acc_num_query'] = $this->m_global->select_where('loan_account', array('loa_acc_loa_det_id' => 2)); /// Loan ready approve
        //$data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
//        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->data['cid_query'] = $data['cid_query'];
        $this->load->view(Variables::$layout_main, $data);
    }

    function search_acc_num() { // call by Ajax
        $data['accNum'] = $this->input->post('accNum');
        $data['query_all'] = $this->m_disbursments->search_acc_disburse();


        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $this->load->view("disbursments/disburement_form", $data);
    }

    public function add_dis() {
        if (isset($_POST['btn_submit'])) {
            //=============Check Teller balance ================
            // To make sure CO have enought money to pay the client
            $dbf = new dbf();
//            $getCOBanlance = $this->m_global->select_where('tillers', array('til_tel_id' =>  $this->session->userdata('use_id'),'til_create_date'=>'CURRENT_DATE'));
            $getCOBanlance = $this->m_disbursments->getTellerCash($this->session->userdata('use_id'));
            $COBanlance = $getCOBanlance->result_array();
            $loanBanlance = $this->input->post('dis_amount');
            
//            echo $COBanlance[0]['til_debit'] - $loanBanlance; exit();
//            echo $COBanlance[0]['til_debit']; exit();
//            echo "Session". $this->session->userdata('use_id')."db ".$this->session->userdata($dbf->getF_rol_id());
//                        exit();
            if (count($COBanlance) <= 0) {
                if ($COBanlance[0]['til_debit'] < $loanBanlance) {
                    $this->session->set_flashdata('error', "You don't have enought cash to pay. please try again late.");
                    redirect('disbursments/disbursment');
                }
            }
            // ===========end================================
            //=============Add to disburse table===============
            $arr_disburse_info = array(
                'loa_dis_loa_acc_code' => $this->input->post('acc_number'),
                'loa_dis_tra_mod_id' => $this->input->post('transaction_mode'),
                'loa_dis_description' => $this->input->post('dis_des'),
                'loa_dis_use_id' => $this->session->userdata("use_id"),
            );
            $addD = $this->db->insert('loan_disbursments', $arr_disburse_info);
            if ($addD) {
                $this->session->set_flashdata('success', 'A loan account has been saved');
            }
            //=============================
            //=============Update loan account table===============
            $data = array(
                'loa_acc_approval' => "Approved"
            );
//            $this->db->set("loa_acc_disbustment","NOW()",FALSE);
            $this->db->set("loa_acc_loa_det_id", 7, FALSE); // Loan disbursed
            $this->db->set("loa_acc_modified_date", "NOW()", FALSE);
            $this->db->where(array('loa_acc_code' => $this->input->post('acc_number')));
            $this->db->update('loan_account');

            //============= Update GL Balances====================

            $this->db->set('gl_bal_credit', 'gl_bal_credit +' . $this->input->post('dis_amount'), FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code'), 'gl_bal_cur_id' => $this->input->post('currency')));
            $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
            $this->db->update('gl_balances');

            //===============Update Till balances=========================
//            $this->db->set('til_credit', 'til_credit -' . $this->input->post('dis_amount'), FALSE);
//            $this->db->where(array('til_tel_id' => $this->session->userdata("use_id"), 'til_cur_id' => $this->input->post('currency')));
//            $this->db->set('til_modifide_date', 'NOW()', FALSE);
//            $this->db->update('tiller');
            $debite = null;
            $credit = $this->input->post('dis_amount') * (-1);
            $currency = 1;
            $this->m_teller_cash->addTellerCash($debite, $credit, $currency);
            //============================================
            //===============Update Trn=========================
//            $arr_tra_info = array(
//                'tra_credit' => $this->input->post('dis_amount'),
//                'tra_gl_code' =>  $this->input->post('gl_code'),
//                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
//                'tra_cur_id' =>  $this->input->post('currency'),
//                'tra_description' => $this->input->post('dis_des'),
//                'tra_use_id' => $this->session->userdata("use_id"),
//            );
//            $this->db->set('tra_date', 'NOW()', FALSE);
//            $this->db->set('tra_value_date', 'NOW()', FALSE);
//            $this->db->insert('transaction', $arr_tra_info);
            //        add($debit=null,$credit=null,$amount,$currency=null,$gl_id=null,$tran_type=null)
            $debit = $this->input->post('dis_amount');
            $credit = null;
            $gl_id = "800003000";
            $amount = $this->input->post('dis_amount');
            $currency = 1; // KH
            $tran_type = 1; // Debit
            $this->m_transaction->add($debit, $credit, $amount, $currency, $gl_id, $tran_type);

            //============================================
        }
        if (isset($_POST['btn_disapprove'])) {
            $data = array(
                'loa_acc_approval' => "Not Approved"
            );
            $this->db->set("loa_acc_disbustment", "NOW()", FALSE);
            $this->db->set("loa_acc_modified_date", "NOW()", FALSE);
            $this->db->where(array('loa_acc_code' => $this->input->post('acc_number')));
            $this->db->update('loan_account', $data);
        }
        redirect('disbursments/disbursment');
    }

}

?>
