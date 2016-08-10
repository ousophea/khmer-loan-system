<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class paycashs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('global/mod_global', 'mod_global', 'm_global');
        //$this->load->library('session');
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
    }

    function index() {
        redirect('paycashs/paycash');
    }

    function paycash() {
        $data['title'] = 'Other expanse';
        $data['gl_query'] = $this->mod_global->select_where('gl_list', array('gl_code >' => 500009000, "gl_code <" => 691209111), NULL);
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $this->load->view(Variables::$layout_main, $data);
    }

    function gl_info() {
        $getGlcode = $this->input->post('glCode');
        $gl_query = $this->mod_global->select_where('gl_list', 'gl_code', $getGlcode);
        if ($gl_query->result() != NULL) {
            foreach ($gl_query->result() as $rows) {
                //====================== Create session to store GL info
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
                                ' . $submit_btn . '
                            });
                </script>';
    }

    function add() {
        if (isset($_POST['btn_submit'])) {
            $now = date('Y-m-d H:i:s');
            $arr_transaction_info = array(
                'tra_gl_code' => $this->input->post('gl_code'),
                'tra_tra_mod_id' => $this->input->post('transaction_mode'),
                'tra_cur_id' => $this->input->post('currency'),
                'tra_description' => $this->input->post('tra_detail'),
                'tra_type' => $this->input->post('transaction_type'),
                'tra_date' => $now,
                'tra_value_date' => $now,
                'tra_use_id' => $this->session->userdata("use_id"),
                'tra_debit' => $this->input->post('tra_amount'),
                'tra_credit' => 0
//                'tra_debit'=>($this->input->post('transaction_type')==1)?$this->input->post('tra_amount'):0,
                    //'tra_credit'=>($this->input->post('transaction_type')==2)?$this->input->post('tra_amount'):0
            );
            $this->db->insert('transaction', $arr_transaction_info);

            // ==============add to GL list balance
            // 
            $arr_gl_debit_update = array(
                'gl_bal_datemodifide' => $now
            );

            $this->db->set('gl_bal_debit', 'gl_bal_debit +' . $this->input->post('tra_amount'), FALSE);
            $this->db->where(array('gl_bal_gl_code' => $this->input->post('gl_code'), 'gl_bal_cur_id' => $this->input->post('currency')));
            $this->db->update('gl_balances', $arr_gl_debit_update);

            //===============Update Till balances

            redirect('paycashs');
        } else {
            redirect('paycashs/paycash');
        }
    }

}

?>
