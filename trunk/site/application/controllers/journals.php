<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class journals extends CI_Controller {

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
        redirect('journals/journal');
    }

    function journal() {
//        $query = $this->m_global->select_join('contacts', array(
//            'contact_type' => array('con_con_typ_id' => 'con_typ_id')
//            ,'branch' => array('con_bra_id' => 'bra_id')
//            ,'contacts_detail'=>array('con_id'=>'con_det_con_id'))
//                , 'inner', array('con_cidk' => 2), 1);

        $data['title'] = 'Journal Entry';
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
            'contacts_type' => array('con_con_typ_id' => 'con_typ_id')
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
                echo'
                <div class="control-group">
                    <div class="controls" style="font-weight: bold;">
                         Name : ' . $rows->con_en_first_name . " " . $rows->con_en_last_name .
                '<br />
                         CID: ' . $rows->con_id . '
                </div></div>
                ';

//echo $this->session->userdata('session_con_id');
                // Print out  Account information
//                open_form('account_detail', 'Account Detail');
//                field("text", "account_type", "Account Type: ", $rows->con_typ_title, array('attribute' => array('readonly' => "")));
//                field("text", "account_no", "Account No: ", $rows->con_account_number, array('attribute' => array('readonly' => "")));
//                field("text", "account_date", 'Account Date:', $rows->con_del_date_created, array('attribute' => array('readonly' => "")));
//                field("text", "branch_code", 'Branch Code:', $rows->bra_name, array('attribute' => array('readonly' => "")));
//                field("text", "cheque_account", 'Cheque Account:', NULL, array('attribute' => array('readonly' => "")));
//                close_form();
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
                //$newdata = array(
                //    'gl_id' => $rows->gl_id
                //);
                //$this->session->set_userdata($newdata);
                echo'
                <div class="control-group">
                    <div class="controls" style="font-weight: bold;">
                         <input type="hidden" name="gl_id" value="' . $rows->gl_id . '" />
                         GL Code : ' . $rows->gl_code .
                '<br />
                         Description: ' . $rows->gl_description . '
                </div></div>
                ';
                $submit_btn = 'jq_script(".btn_submit").removeAttr("disabled");';
               

//                field("text", "gl_account_no", " GL Account No:", $rows->gl_code, array('attribute' => array('readonly' => "", 'style' => "width:209px;", 'id' => "code_gl")));
//                field("textarea", "gl_detail", "GL Description:", $rows->gl_description, array('attribute' => array('readonly' => "", 'id' => "gl_description")));
            }
        } else {
            $submit_btn = 'jq_script(".btn_submit").attr("disabled","disabled");';
           echo'
                <div class="control-group">
                    <div class="controls" style="font-weight: bold;">
                         Not GL code found! 
                    </div>
                </div> ';
        }
        // ==================Script for disable submit button=======================
         echo '<script type="text/javascript" language="JavaScript">
                            var jq_script = jQuery.noConflict();
                            jq_script(document).ready(function(){
                                '.$submit_btn.'
                            });
                </script>';
         
    }

    function add() {
//        if (isset($_POST['btn_submit'])) {
//            $now = date('Y-m-d H:i:s');
//            $con_id = $this->session->userdata('session_con_id');
//            $arr_transaction_info = array(
//                'tra_con_id' => $con_id,
//                'tra_gl_id' => $this->session->userdata('gl_id'),
//                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
//                'tra_cur_id' => $this->input->post('currency'),
//                'tra_amount' => $this->input->post('tra_amount'),
//                'tra_description' => $this->input->post('tra_detail'),
//                'tra_type' => $this->input->post('transaction_type'),
//                'tra_date' => $now,
//                'tra_value_date' => $now,
//                'tra_use_id' => $this->session->userdata("use_id"),
//                'tra_debit' => ($this->input->post('transaction_type') == 1) ? $this->input->post('tra_amount') : 0,
//                'tra_credit' => ($this->input->post('transaction_type') == 2) ? $this->input->post('tra_amount') : 0
//            );
//            $this->db->insert('transaction', $arr_transaction_info);
//            redirect('receivecashs/lists');
//        } else {
//            redirect('receivecashs/receivecash');
//        }

        if (isset($_POST['btn_submit_sigle'])) {
            // insert data for transaction table
            //$now = date('Y-m-d H:i:s');
//            $con_id = $this->session->userdata('session_con_id');
            $arr_transaction_info = array(
                'tra_con_id' => ($this->input->post('cid')) == "" ? NULL : $this->input->post('cid'),
                'tra_gl_code' => $this->input->post('gl_code_signle'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' => $this->input->post('currency'),
//                'tra_amount' => $this->input->post('tra_amount_single'),
                'tra_description' => $this->input->post('tra_detail'),
                'tra_type' => $this->input->post('transaction_type'),
                //'tra_date' => $now,
                //'tra_value_date' => $now,
                'tra_use_id' => $this->session->userdata("use_id"),
                'tra_debit' => ($this->input->post('transaction_type') == 1) ? $this->input->post('tra_amount_single') : 0,
                'tra_credit' => ($this->input->post('transaction_type') == 2) ? $this->input->post('tra_amount_single') : 0
            );
            $this->db->set('tra_date', 'NOW()', FALSE);
            $this->db->insert('transaction', $arr_transaction_info);
//            redirect('journals/journal');
            // update data for GL balance
            //
            //check for Gl balance
            //
            //
            /// ============Update new query ============
//            $balance = $this->mod_global->select_where('gl_balances', array('gl_bal_gl_code' => $this->input->post('gl_code_signle'), 'gl_bal_cur_id' => $this->input->post('currency')), 1);
//
//            if ($balance->num_rows() != NULL) {
//
//                foreach ($balance->result() as $rows) {
//
//                    if ($this->input->post('transaction_type') == 1) { // transaction type = debit
//                        $amount = $rows->gl_bal_debit + $this->input->post('tra_amount_single');
//
//                        $arr_cash_info_update = array(
//                            'gl_bal_debit' => $amount,
//                            'gl_bal_datemodifide' => $now
//                        );
//                    } else if ($this->input->post('transaction_type') == 2) {
//                        $amount = $rows->gl_bal_credit + $this->input->post('tra_amount_single');
//                        $arr_cash_info_update = array(
//                            'gl_bal_credit' => $amount,
//                            'gl_bal_datemodifide' => $now
//                        );
//                    }
//                }
//
//                $this->db->where(array('gl_bal_gl_id' => $this->input->post('gl_code'), 'gl_bal_cur_id' => $this->input->post('currency')));
//                $this->db->update('gl_balances', $arr_cash_info_update);
//
//            } else {
//                if ($this->input->post('transaction_type') == 1) {
//                    $arr_cash_info = array(
//                        'gl_bal_gl_id' => $this->input->post('gl_id'),
//                        'gl_bal_cur_id' => $this->input->post('currency'),
//                        'gl_bal_debit' => $this->input->post('tra_amount_single'),
//                        'gl_bal_datecreate' => $now
//                    );
//                } else {
//                    $arr_cash_info = array(
//                        'gl_bal_gl_id' => $this->input->post('gl_id'),
//                        'gl_bal_cur_id' => $this->input->post('currency'),
//                        'gl_bal_credit' => $this->input->post('tra_amount_single'),
//                        'gl_bal_datecreate' => $now
//                    );
//                }
//
//                $this->db->insert('gl_balances', $arr_cash_info);
//            }
            /// ============End update new query ============

            //$arr_cash_info_update = array('gl_bal_datemodifide' => $now);

            if ($this->input->post('transaction_type') == 1) { // transaction type = debit
                $this->db->set('gl_bal_debit', 'gl_bal_debit +' . $this->input->post('tra_amount_single'), FALSE);
            } else if ($this->input->post('transaction_type') == 2) {
                $this->db->set('gl_bal_credit', 'gl_bal_credit +' . $this->input->post('tra_amount_single'), FALSE);
            }
             $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code_signle'), 'gl_bal_cur_id' => $this->input->post('currency')));
//            $this->db->update('gl_balances', $arr_cash_info_update);
            $this->db->update('gl_balances');
        } else if (isset($_POST['btn_submit_multy'])) { // multy journal entry
            // insert data for transaction table
            // debit GL
            //$now = date('Y-m-d H:i:s');
            $arr_transaction_debit_info = array(
                'tra_con_id' => ($this->input->post('cid')) == "" ? NULL : $this->input->post('cid'),
                'tra_gl_code' => $this->input->post('gl_code_debit_mul'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' => $this->input->post('currency'),
                'tra_description' => $this->input->post('tra_detail'),
                'tra_type' => $this->input->post('transaction_type'),
                'tra_type' => 1,
                //'tra_date' => $now,
                //'tra_value_date' => $now,
                'tra_use_id' => $this->session->userdata("use_id"),
                'tra_debit' => $this->input->post('debit_amount_mul')
                    //'tra_credit' => ($this->input->post('transaction_type') == 2) ? $this->input->post('tra_amount_single') : 0
            );
            $this->db->set('tra_date', 'NOW()', FALSE);
            $this->db->insert('transaction', $arr_transaction_debit_info);
            // Credit GL
            $arr_transaction_credit_info = array(
                'tra_con_id' => ($this->input->post('cid')) == "" ? NULL : $this->input->post('cid'),
                'tra_gl_code' => $this->input->post('gl_code_credit_mul'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' => $this->input->post('currency'),
                'tra_description' => $this->input->post('tra_detail'),
//                'tra_type' => $this->input->post('transaction_type'),
                'tra_type' => 2,
                //'tra_date' => $now,
                //'tra_value_date' => $now,
                'tra_use_id' => $this->session->userdata("use_id"),
                //'tra_debit' => ($this->input->post('transaction_type') == 1) ? $this->input->post('tra_amount_single') : 0
                'tra_credit' => $this->input->post('credit_amount_mul')
            );
            $this->db->set('tra_date', 'NOW()', FALSE);
            $this->db->insert('transaction', $arr_transaction_credit_info);
//            $arr_gl_debit_update = array(
//                'gl_bal_datemodifide' => $now
//            );
//
//            $arr_gl_credit_update = array(
//                'gl_bal_datemodifide' => $now
//            );
//Update debit GL=========================
            $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
            $this->db->set('gl_bal_debit', 'gl_bal_debit +' . $this->input->post('debit_amount_mul'), FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code_debit_mul'), 'gl_bal_cur_id' => $this->input->post('currency')));
//            $this->db->update('gl_balances', $arr_gl_debit_update);
            $this->db->update('gl_balances');

//Update credit GL=========================
             $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
            $this->db->set('gl_bal_credit', 'gl_bal_credit +' . $this->input->post('credit_amount_mul'), FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code_credit_mul'), 'gl_bal_cur_id' => $this->input->post('currency')));
//            $this->db->update('gl_balances', $arr_gl_credit_update);
            $this->db->update('gl_balances');
        }
        redirect('journals/journal');
    }

    function lists() {
        //allows(array(Setting::$role0, Setting::$role1));
        $data['title'] = 'GL Transaction';
        $data['query_all'] = $this->m_global->select_join('transaction', array('transaction_mode' => array('tra_tra_mod_id' => 'tra_mod_id'), 'gl_list' => array('tra_gl_id' => 'gl_id'), 'currency' => array('tra_cur_id' => 'cur_id')), 'inner');
        $this->load->view(Variables::$layout_main, $data);
    }

    function chang_form() {
        $Type = $this->input->post('entryType');
        if ($Type == "single") {
            
        } else {
            echo "TEst";
        }
    }

}

?>
