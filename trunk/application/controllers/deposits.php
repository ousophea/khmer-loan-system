<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class deposits extends CI_Controller {

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
        redirect('deposits/deposit#contents');
    }

    function deposit() {
        $data['title'] = 'Saing account Deposit/Credit';
        $data['acc_num_query'] = $this->m_global->select('saving_account', array('sav_acc_code'));

        $this->load->view(Variables::$layout_main, $data);
    }

    function search_acc_num() { // call by Ajax
        $accNum = $this->input->post('accNum');
        $arr_search_index = array(
            "sav_acc_code" => $accNum
        );

        $data['accNum'] = $accNum;
//        echo $this->m_global->select_sav_acc_info($arr_search_index);
        $data['query_all'] = $this->m_global->select_sav_acc_info($arr_search_index);
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $this->load->view("deposits/deposit_form", $data);
    }

    public function add_dep() {
        if (isset($_POST['btn_save'])) {
            $action = TRUE;
            //=============Update Saving account table===============
            
            $this->db->set("sav_acc_modified_date", "NOW()", FALSE);
            $this->db->set("sav_acc_amount", "sav_acc_amount +".$this->input->post('dep_amount'), FALSE);
            $this->db->where(array('sav_acc_code' => $this->input->post('acc_number')));
            if (!$this->db->update('saving_account'))
                $action = FALSE;
        }

        //===============Update Trn=========================
        $arr_tra_info = array(
            'tra_debit' => $this->input->post('dep_amount'),
            'tra_gl_code' => $this->input->post('gl_code'),
            'tra_tra_mod_id' => $this->input->post('transaction_mode'),
            'tra_cur_id' => $this->input->post('currency'),
            'tra_description' => $this->input->post('dep_des'),
            'tra_use_id' => $this->session->userdata("use_id"),
        );
        $this->db->set('tra_date', 'NOW()', FALSE);
        $this->db->set('tra_value_date', 'NOW()', FALSE);
        if (!$this->db->insert('transaction', $arr_tra_info))
            $action = FALSE;
        //============================================
        //============= Update GL Balances====================
        $this->db->set('gl_bal_credit', 'gl_bal_credit -' . $this->input->post('dep_amount'), FALSE);
        $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
        $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code'), 'gl_bal_cur_id' => $this->input->post('currency')));
        if (!$this->db->update('gl_balances'))
            $action = FALSE;

        //===============Update Till balances=========================
        $this->db->set('til_debit', 'til_debit +' . $this->input->post('dep_amount'), FALSE);
        $this->db->where(array('til_tel_id' => $this->session->userdata("use_id"), 'til_cur_id' => $this->input->post('currency')));
        $this->db->set('til_modifide_date', 'NOW()', FALSE);
        if(!$this->db->update('tiller')) $action = FALSE;
        
        //============================================================

        
        /// send message to View update success
        if ($action) {
            $this->session->set_flashdata('success', 'A saving account deposit has been saved');
//            $this->session->set_flashdata('success', $this->db->last_query());
        }

        redirect('deposits/deposit');
    }

}

?>
