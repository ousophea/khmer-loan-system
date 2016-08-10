<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class reports extends CI_Controller {

    //put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model(array('global/mod_global', 'mod_global', 'm_global', 'm_report'));
        $this->load->helper('date');
        //$this->load->library('session');
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
    }

    function index() {
        redirect('reports/transaction');
    }

    function transaction() {

        $data['title'] = 'Transaction Report';
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $this->load->view(Variables::$layout_main, $data);
    }

    function disbursment() {

        $this->data['title'] = 'Loan Disbursment Report By Size By Credit Officer Name';
        $this->data['currency_query'] = $this->mod_global->select_all('currency');

        $this->form_validation->set_rules('txt_dis_sdate', '', 'trim');
        $this->form_validation->set_rules('txt_dis_edate', '', 'trim');
        $this->form_validation->set_rules('currency', '', 'trim');
        $this->form_validation->run();
//          if ($this->form_validation->run() == TRUE) {
        $this->data['data'] = $this->m_report->get_disburs();
        $this->data['setStart'] = $sdate = $this->input->post('txt_dis_sdate');
        $this->data['setEnd'] = $edate = $this->input->post('txt_dis_edate');
//          }
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function collection() {

        $this->data['title'] = 'Loan Collection Report By Credit Officer Name';
        $this->data['currency_query'] = $this->mod_global->select_all('currency');

        $this->form_validation->set_rules('txt_dis_sdate', '', 'trim');
        $this->form_validation->set_rules('txt_dis_edate', '', 'trim');
        $this->form_validation->set_rules('currency', '', 'trim');
        $this->form_validation->run();
//          if ($this->form_validation->run() == TRUE) {
        $this->data['data'] = $this->m_report->get_collection();
        $this->data['setStart'] = $sdate = $this->input->post('txt_dis_sdate');
        $this->data['setEnd'] = $edate = $this->input->post('txt_dis_edate');
//          }
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function ajax_get_disbursment() {

        $getCurid = $this->input->post('currency');
        $staDate = $this->input->post('sta_date');
        $endDate = $this->input->post('end_date');
        $query_all = $this->m_report->get_disburs();

        if ($query_all->result() == NULL) {
            echo 'Not record found!';
        } else {
            $arr_select_field = array(
                'CO Name' => 'co_name',
                'CO ID' => 'co_card_id',
                'Amount' => 'loa_acc_amount'
            );
            echo table_manager($query_all, $arr_select_field, FALSE, TRUE);
        }
    }

    function ajax_transaction() {
        $getCurid = $this->input->post('currency');
        $getsDate = $this->input->post('txt_sdate');
         $geteDate = $this->input->post('txt_edate');
         
//        if ($this->input->post('boo_isbn') != '') {
//            $this->db->like('boo_isbn', $this->input->post('boo_isbn'));
//        }
        if ($getCurid != NULL) { // Where condetion
            $arr_search_index = array(
                "tra_cur_id" => $getCurid,
                "DATE(tra_date) >=" => $getsDate,
                "DATE(tra_date) <=" => $geteDate
            );
        }
        $query_all = $this->m_global->select_join('transaction', array('transaction_mode' => array('tra_tra_mod_id' => 'tra_mod_id'),
            'gl_list' => array('tra_gl_code' => 'gl_code'),
            'users' => array('tra_use_id' => 'use_id'),
            'currency' => array('tra_cur_id' => 'cur_id')), 'left', $arr_search_index, NULL, array('tra_date' => 'desc'));
        if ($query_all->result() == NULL) {
            echo 'Not record found!';
        } else {
            $total_dc = $this->m_report->select_count_trn($arr_search_index);
            $arr_select_field = array(
                'GL Code' => 'gl_code',
                'GL Description' => 'gl_description',
                'Trn Description' => 'tra_description',
                'Trn Date' => 'tra_date',
                'Currency' => 'cur_title',
                'Debit' => 'tra_debit',
                'Credit' => 'tra_credit',
                'User' => 'use_name'
            );
            foreach ($total_dc->result() as $total_rows) {
                $total_debit = $total_rows->total_debit;
                $total_credit = $total_rows->total_credit;
            }
            echo table_gl($query_all, $arr_select_field, FALSE, $total_debit, $total_credit);
        }
    }

    function glreport() {
        $data['title'] = 'GL Transactions by Post Date';
        $data['gl_query'] = $this->m_global->select_all('gl_list');
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $this->load->view(Variables::$layout_main, $data);
    }

    function ajax_gl() {
        $getCurid = $this->input->post('currency');
        $getGL = $this->input->post('txt_gl');
        $getGLdes = $this->input->post('txt_gldes');
        $getStaDate = $this->input->post('sta_date');
        $getEndDate = $this->input->post('end_date');

        $last_date_total = $this->m_global->select_where('transaction', array('DATE(tra_date) <' => $getStaDate), 1);
        //var_dump($last_date_total);
        $last_balance = $this->m_report->select_count_trn(array('DATE(tra_date) <' => $getStaDate));
        foreach ($last_balance->result() as $total_rows) {
            $total_last_balance = $total_rows->total_debit - $total_rows->total_credit;
        }

        if ($getCurid != NULL && $getStaDate != NULL && $getEndDate != NULL) {
            $arr_search_index = array(
                "tra_cur_id" => $getCurid,
                "gl_kh_description" => $getGL,
                "DATE(tra_date)>=" => $getStaDate,
                "DATE(tra_date)<=" => $getEndDate
            );
        }

        $query_all = $this->m_global->select_join('transaction', array('transaction_mode' => array('tra_tra_mod_id' => 'tra_mod_id'),
            'gl_list' => array('tra_gl_code' => 'gl_code'),
            'users' => array('tra_use_id' => 'use_id'),
            'currency' => array('tra_cur_id' => 'cur_id')), 'left', $arr_search_index, NULL, array('tra_date' => 'desc')
        );

        if ($query_all->num_rows() == 0) {
            echo '<span id="noRecord">No transaction match your search</span>';
        } else {
            $arr_select_field = array(
                'Trn Date' => 'tra_date',
                'Value Date' => 'tra_value_date',
                'Trn Description' => 'gl_kh_description',
                'User' => 'use_name',
                'Debit' => 'tra_debit',
                'Credit' => 'tra_credit',
                'Balance' => 'tra_credit',
            );
            echo "<p><b>GL Account: " . $getGL . " &nbsp;" . $getGLdes . "</b></p>";

            echo '<table class="table table-bordered table-striped" cellpadding="0" cellspacing="0" border="0">';
            echo '<tr clas="tbl_header">';
            foreach ($arr_select_field as $header => $column) {
                echo '<th>' . $header . '</th>';
            }
            echo '</tr>';
            $balance = $total_last_balance;
            $tatal_d = NULL;
            $tatal_c = NULL;

            $last_date = NULL;
            foreach ($last_date_total->result() as $last_rows) {
                $last_date = $last_rows->tra_date;
            }
            echo '<tr>';
            echo '<td>' . $last_date . '</td><td>' . $last_date . '</td><td>BALANCE BROUGHT FORWARD</td><td></td><td>0</td><td>0</td><td>' . $total_last_balance . '</td></tr>';
            foreach ($query_all->result() as $total_rows) {
                $debit = $total_rows->tra_debit;
                $credit = $total_rows->tra_credit;
                $tatal_d+=$debit;
                $tatal_c+=$credit;

                echo'<tr>';
                foreach ($arr_select_field as $header => $column) {
                    echo '<td class="balance">';
                    if ($header == "Balance") {
                        $balance += (($debit) - ($credit));
                        echo $balance;
                    } else {
                        echo $total_rows->$column;
                    }
                    echo '</td>';
                }
                echo'</tr>';
            }
            echo"<tr id='total_gl'><td colspan='4'>Total:</td><td>$tatal_d</td><td>$tatal_c</td><td></td></tr>";
            echo '</table>';
        }
    }

    function loan() {
        $data['title'] = 'Loan Report';
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $this->load->view(Variables::$layout_main, $data);
    }

    function ajax_loan() {
        $getCurid = $this->input->post('currency');
        $getDate = $this->input->post('txt_date');

        $filter = array();
        if ($getCurid != '') {
            //$filter["tra_cur_id"] = $getCurid;			
        }
        if ($getDate != '') {
            $filter["DATE(loa_acc_created_date)"] = $getDate;
        }

        $data = $this->m_global->select_data_join(
                'loan_account', '*', array(
            'loan_detail' => array('loa_acc_loa_det_id' => 'loa_det_id'),
            'contacts' => array('loa_acc_con_id' => 'con_id'),
            'currency' => array('loa_acc_cur_id' => 'cur_id'),
            'repayment_freg' => array('loa_acc_rep_fre_id' => 'rep_fre_id'),
            'loan_installment' => array('loa_acc_id' => 'loa_ins_loa_acc_id')
                ), $filter
        );
        echo json_encode($data);
    }

}

?>
