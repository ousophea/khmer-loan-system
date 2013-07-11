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
        $data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
//        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->data['cid_query'] = $data['cid_query'];
        $this->load->view(Variables::$layout_main, $data);
    }

    function search_acc_num() {
        $accNum = $this->input->post('accNum');
        $arr_search_index = array(
            "loa_acc_code" => $accNum
        );
        $query_all = $this->m_disbursments->select_acc_info($arr_search_index);

        if ($query_all->result() == NULL) {
            echo 'Not record found!';
            echo"<span id='data_table'></span>";
        } else {
            $gl_code = NULL;
            $cur_id = NULL;
            $loa_amount = NULL;
            foreach ($query_all->result() as $rows) {
                $gl_code = $rows->loa_acc_gl_code;
                $cur_id = $rows->cur_id;
                $loa_amount = $rows->loa_acc_amount;
                echo'
                <div class="control-group">
                    <div class="controls" style="font-weight: bold;">
                         CID: ' . $rows->con_cid .
                '<br />
                         Name : ' . $rows->con_en_first_name . " " . $rows->con_en_last_name .
                '<br />
                         Bate of Birth: ' . $rows->con_det_dob . "&nbsp;&nbsp;" . (($rows->con_sex == "m") ? "Male" : "Female") . "/" . (($rows->con_det_civil_status == 1) ? "Single" : "Maried") .
                '<br />
                         NID: ' . $rows->loa_acc_id .
                '<br />
                         Address: ' . $rows->con_det_address_detail . " ," . $rows->dis_kh_name . ", " . $rows->com_kh_name . ", " . $rows->vil_kh_name . ", " . $rows->pro_kh_name .
                '<br />
                         Product: ' . $rows->loa_pro_typ_amount .
                '<br />
                         Currency: ' . $rows->cur_title .
                '<br />
                         Account Status: ' . (($rows->loa_acc_status == 1) ? 'Approved' : 'Not approved') .
                '</div></div>';
            }
            //$this->load->view('c_info.php');
            //Get Loan disbursment info
            $arr_search_index = array(
                'loa_dis_loa_acc_code' => $accNum
            );

            $loa_dis_query = $this->m_disbursments->select_disbursed($arr_search_index);
            echo"<span id='data_table'>";
            echo'<input type="hidden" name="acc_number" value="' . $accNum . '" />';
            echo'<input type="hidden" name="gl_code" value="' . $gl_code . '" />';
            echo'<input type="hidden" name="currency" value="' . $cur_id . '" />';
            echo'<table class="table table-bordered table-striped" cellspacing="0" cellpadding="0" border="0">
            <tr class="tbl_header">
                <th>Code</th>
                <th>Description</th>
                <th>Allocated Amt</th>
                <th>Already Disbursed</th>
                <th>This Disbursment</th>
            </tr>';

            $this_dis = NULL;
            $ready_dis = 0;

            if ($loa_dis_query->result() != NULL) {
                $i = 1;

                foreach ($loa_dis_query->result() as $value) {
                    $ready_dis +=$value->loa_dis_value;

                    echo"   <tr>
                <td>$i</td>
                <td>$value->gl_description</td>
                <td></td>
                <td>$value->loa_dis_value</td>
                <td></td>
            </tr>";
                    $i++;
                }
            }
            $this_dis = $loa_amount - $ready_dis;
            echo "  <tr style='font-weight:bold;'>
            <td colspan='2'>Total</td>
            <td>$loa_amount</td>
            <td>$ready_dis</td>
            <td>$this_dis</td>
        </tr>";
            echo"</table>";
            field("submit", 'btn_submit', NULL, "Approve", array('attribute' => array('class' => 'btn', 'id' => 'btn_submit')), NULL, '<a class="btn btn_back" href="' . base_url() . 'disbursments/cancel">Not Arpp</a>');
            echo "</span>";
        }
    }

    public function add_dis() {
        if (isset($_POST['btn_submit'])) {
            //=============Add to disburse table===============
            $arr_disburse_info = array(
                'loa_dis_value' => $this->input->post('dis_amount'),
                'loa_dis_loa_acc_code' => $this->input->post('acc_number'),
                'loa_dis_tra_mod_id' => $this->input->post('transaction_mode'),
                'loa_dis_description' => $this->input->post('dis_des'),
                'loa_dis_use_id' => $this->session->userdata("use_id"),
            );
            $this->db->set('loa_dis_date', 'NOW()', FALSE);
            $this->db->insert('loan_disbursments', $arr_disburse_info);


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
                'tra_description' => $this->input->post('dis_des'),
                'tra_use_id' => $this->session->userdata("use_id"),
            );
            $this->db->set('tra_date', 'NOW()', FALSE);
            $this->db->set('tra_value_date', 'NOW()', FALSE);
            $this->db->insert('transaction', $arr_tra_info);

            //============================================

            redirect('disbursments/disbursment');
        }
    }

}

?>
