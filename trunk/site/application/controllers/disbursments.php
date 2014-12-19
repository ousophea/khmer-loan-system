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
        $this->load->model(array('global/mod_global', 'mod_global', 'm_global', 'm_disbursments'));
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
    }

    function index() {
        redirect('disbursments/disbursment');
    }

    function disbursment() {
        $data['title'] = 'Disbursment / Debit';
//        select_where('tbl_users',array('use_name' => 'vannak','use_password' => '12345'))
        $data['acc_num_query'] = $this->m_global->select_where('loan_account', array('loa_acc_loa_det_id'=>2)); //Loan account ready approved
        //$data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
//        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->data['cid_query'] = $data['cid_query'];
        $this->load->view(Variables::$layout_main, $data);
    }

    function search_acc_num() { // call by Ajax
        $accNum = $this->input->post('accNum');
        $arr_search_index = array(
            "loa_acc_code" => $accNum
        );
                
        $data['accNum']= $accNum;
        $data['query_all'] = $this->m_global->select_acc_info($arr_search_index);
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $this->load->view("disbursments/disburement_form",$data);
    }
    
    public function add_dis() {
        if (isset($_POST['btn_submit'])) {
            //=============Add to disburse table===============
            $arr_disburse_info = array(
                'loa_dis_loa_acc_code' => $this->input->post('acc_number'),
                'loa_dis_tra_mod_id' => $this->input->post('transaction_mode'),
                'loa_dis_description' => $this->input->post('dis_des'),
                'loa_dis_use_id' => $this->session->userdata("use_id"),
                'loa_dis_date' => date('y-m-d h:i:s')
            );
            $this->db->insert('loan_disbursments', $arr_disburse_info);
            
            //=============Update loan account table===============
            $data = array(
//               'loa_acc_approval' => "Approved"
                'loa_acc_loa_det_id' => APPROVED  // mean ready approved and disbursed
            );
//            $this->db->set("loa_acc_disbustment","NOW()",FALSE);
            $this->db->set("loa_acc_modified_date","NOW()",FALSE);
            $this->db->where(array('loa_acc_code' => $this->input->post('acc_number')));
            $this->db->update('loan_account',$data);

            //============= Update GL Balances====================

            $this->db->set('gl_bal_credit', 'gl_bal_credit +' . $this->input->post('dis_amount'), FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code'), 'gl_bal_cur_id' => $this->input->post('currency')));
            $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
            $this->db->update('gl_balances');

            //===============Update Till balances=========================
            $this->db->set('til_credit', 'til_credit -' . $this->input->post('dis_amount'), FALSE);
            $this->db->where(array('til_tel_id' => $this->session->userdata("use_id"), 'til_cur_id' => $this->input->post('currency')));
            $this->db->set('til_modifide_date', 'NOW()', FALSE);
            $this->db->update('tiller');
            //============================================
            //===============Update Trn=========================
            $arr_tra_info = array(
                'tra_credit' => $this->input->post('dis_amount'),
                'tra_gl_code' =>  $this->input->post('gl_code'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' =>  $this->input->post('currency'),
                'tra_description' => $this->input->post('dis_des'),
                'tra_use_id' => $this->session->userdata("use_id"),
            );
            $this->db->set('tra_date', 'NOW()', FALSE);
            $this->db->set('tra_value_date', 'NOW()', FALSE);
            $this->db->insert('transaction', $arr_tra_info);

            //============================================

        
        }
        if(isset($_POST['btn_disapprove'])){
            $data = array(
               'loa_acc_approval' => "Not Approved"
            );
            $this->db->set("loa_acc_disbustment","NOW()",FALSE);
            $this->db->set("loa_acc_modified_date","NOW()",FALSE);
            $this->db->where(array('loa_acc_code' => $this->input->post('acc_number')));
            $this->db->update('loan_account',$data);
        }   
        redirect('disbursments/disbursment');
    }

}

?>
