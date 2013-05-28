<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class receivecashs extends CI_Controller {

    //put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model('global/mod_global', 'mod_global', 'm_global');
        //$this->load->library('session');
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
    }

    function index() {
        redirect('receivecashs/lists');
    }
    
    function receivecash() {
//        $query = $this->m_global->select_join('contacts', array(
//            'contact_type' => array('con_con_typ_id' => 'con_typ_id')
//            ,'branch' => array('con_bra_id' => 'bra_id')
//            ,'contacts_detail'=>array('con_id'=>'con_det_con_id'))
//                , 'inner', array('con_cidk' => 2), 1);
        
        $data['title'] = 'Receive Cash/Cheque';
        $data['gl_query'] = $this->mod_global->select_all('gl_list');
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->data['cid_query'] = $data['cid_query'];
        $this->load->view(Variables::$layout_main, $data);
        
    }

    function con_info() {
        $getCid = $this->input->post('cid');

        $query = $this->m_global->select_join('contacts', array(
            'contact_type' => array('con_con_typ_id' => 'con_typ_id')
            , 'branch' => array('con_bra_id' => 'bra_id')
            , 'contacts_detail' => array('con_id' => 'con_det_con_id'))
                , 'inner', array('con_id' => $getCid), 1);

        if ($query->result() != NULL) {
            
            foreach ($query->result() as $rows) {
                // Create session to store CID info
                $newdata = array(
                    'session_con_id' => $rows->con_id
                );
                $this->session->set_userdata($newdata);

//echo $this->session->userdata('session_con_id');
                // Print out  Account information
                open_form('account_detail', 'Account Detail');
                field("text", "account_type", "Account Type: ", $rows->con_typ_title, array('attribute' => array('readonly' => "")));
                field("text", "account_no", "Account No: ", $rows->con_account_number, array('attribute' => array('readonly' => "")));
                field("text", "account_date", 'Account Date:', $rows->con_del_date_created, array('attribute' => array('readonly' => "")));
                field("text", "branch_code", 'Branch Code:', $rows->bra_name, array('attribute' => array('readonly' => "")));
                field("text", "cheque_account", 'Cheque Account:', NULL, array('attribute' => array('readonly' => "")));

                close_form();
            }
        } else {
            echo "Not data found!";
        }
    }

    function gl_info() {
        $getGlcode = $this->input->post('glCode');
        $gl_query = $this->mod_global->select_where('gl_list', 'gl_code', $getGlcode);
        if ($gl_query->result() != NULL) {
            foreach ($gl_query->result() as $rows) {
                // Create session to store GL info
                $newdata = array(
                    'gl_id' => $rows->gl_id
                );
                $this->session->set_userdata($newdata);
                
                field("text", "gl_account_no", " GL Account No:", $rows->gl_code, array('attribute' => array('readonly' => "", 'style' => "width:209px;", 'id' => "code_gl")));
                field("textarea", "gl_detail", "GL Description:", $rows->gl_description, array('attribute' => array('readonly' => "", 'id' => "gl_description")));
            }
        } else {
            echo "Not data found!";
        }
    }

    function add() {
        if (isset($_POST['btn_submit'])) {
            $now = date('Y-m-d H:i:s');
            $arr_transaction_info = array(
                'tra_con_id' => $this->session->userdata('session_con_id'),
                'tra_gl_id' => $this->session->userdata('gl_id'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' => $this->input->post('currency'),
                'tra_amount' => $this->input->post('tra_amount'),
                'tra_description' => $this->input->post('tra_detail'),
                'tra_type' => $this->input->post('transaction_type'),
                'tra_date'=> $now,
                'tra_value_date'=>$now,
                'tra_use_id' => $this->session->userdata("use_id"),
                'tra_debit'=>($this->input->post('transaction_type')==1)?$this->input->post('tra_amount'):0,
                'tra_credit'=>($this->input->post('transaction_type')==2)?$this->input->post('tra_amount'):0
            );
            $this->db->insert('transaction', $arr_transaction_info);
        }else{
            redirect('receivecashs/receivecash');
        }
    }
    
     function lists() {
        //allows(array(Setting::$role0, Setting::$role1));
        $data['title']= 'GL Transaction';
        $data['query_all'] = $this->m_global->select_join('transaction',array('transaction_mode' => array('tra_tra_mod_id' => 'tra_mod_id'),'gl_list' => array('tra_gl_id' => 'gl_id'), 'currency' => array('tra_cur_id' => 'cur_id')),'inner');
        $this->load->view(Variables::$layout_main,$data);
    }

}

?>
