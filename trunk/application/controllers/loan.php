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
class loan extends CI_Controller {

    //put your code here
    var $data = NULL;
    var $rand = NULL;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_loan_product_type', 'm_loan', 'm_global', 'global/mod_global'));
//        $this->rand=NULL;
    }

    function index() {
        redirect('loan/open');
    }

    function add() {

        $arr_pro_id = $this->m_global->select_where("loan_product_type", array('loa_pro_typ_id' => $this->input->post('loa_acc_loa_pro_typ_id')), 1);
        if ($arr_pro_id->num_rows() > 0) {
            foreach ($arr_pro_id->result() as $arr_data) {
                $pro_type_code = $arr_data->loa_pro_typ_code;
            }
        }
        $last_id = $this->m_loan->add($pro_type_code);



        if ($last_id > 0) {
//            =============== Create repayment schedule==================
            if ($this->repayment_schedule($last_id)) {
                $this->session->set_flashdata('success', 'A loan account has been saved');
            }
//            ======================end repayment ========================
            redirect('loan/Open');
        } else {
            $this->session->set_flashdata('error', 'Error to create loan');
            redirect('loan/Open');
        }
//
//        $this->form_validation->set_rules('cid', 'Contact information,Enter CID and click button search.', 'required|is_unique[loan_account.sav_acc_con_id]');
//        $this->form_validation->set_rules('loa_acc_loa_pro_typ_id', 'Product type', 'required');
//        $this->form_validation->set_rules('currency', 'Currency', 'required');
//        $this->form_validation->set_rules('gl_id', 'GL code', 'required');
//        $this->form_validation->set_rules('con_cid', 'CID', 'required');
//        $this->form_validation->set_rules('sign_rule', 'Sign Rule', 'required');
//        $this->form_validation->set_rules('dispayname', 'Display name', 'required');
//        $this->form_validation->set_message('is_unique', 'CID "' . $this->input->post('con_cid') . '" already has loan account. Try another CID');
//
//        if ($this->form_validation->run() == FALSE)
//            $this->load->view(Variables::$layout_main, $this->data);
//        else {
//            if ($this->m_loan->add()) {
//                $this->session->set_flashdata('success', 'A loan account has been saved');
//                redirect('loan/Open');
//            }
//        }
    }

    function edit() {
        $last_update = $this->m_loan->edit($this->input->post('account_number'));
        if ($last_update) {

            $this->m_global->delete('repayment_schedule', array('rep_sch_loa_acc_id' => $this->input->post('loa_con_id')));
//            =============== Create repayment schedule==================
            if ($this->repayment_schedule($this->input->post('loa_con_id'))) {
                $this->session->set_flashdata('success', 'A loan account has been saved');
            }
//            ======================end repayment ========================
            redirect('loan/Open');
        } else {
            $this->session->set_flashdata('error', 'Error to create loan');
            redirect('loan/Open');
        }

//        View search box
//        $data['title'] = 'Disbursment / Debit';
//        $data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));
//        $data['cid_query'] = $this->mod_global->select_all('contacts');
//        $this->data['cid_query'] = $data['cid_query'];
//        $this->load->view(Variables::$layout_main, $data);
//        allows(array(Setting::$role0, Setting::$role1));
//        
//        $this->data['title'] = 'Open loan account';
//        $product_type = $this->m_loan_product_type->get_loan_product_type_array();
//        $this->data['product_type'] = $product_type;
//        $contracts = $this->m_loan->get_contacts();
//        $gl = $this->m_loan->find_gl_code_for_dropdown();
//        $rep_peraid = $this->m_loan->rep_peraid();
//        $this->data['rep_peraid'] = $rep_peraid;
//
//        $currency = $this->m_loan->find_currencies_for_dropdown();
//        $this->data['contacts'] = $contracts;
//        $this->data['currency'] = $currency;
//        $this->data['gl'] = $gl;
//        $this->load->view(Variables::$layout_main, $this->data);
//        $this->data['title'] = 'Edit loan account';
//        $this->data['contacts'] = $this->m_loan->get_contacts_loan();
//        $this->data['product_type'] = $this->m_loan_product_type->get_product_type_array();
//
//        $product_type = $this->m_loan_product_type->get_product_type_array();
//        $this->data['product_type'] = $product_type;
//        $gl = $this->m_loan->find_gl_code_for_dropdown();
//        $currency = $this->m_loan->find_currencies_for_dropdown();
//        $this->data['currency'] = $currency;
//        $this->data['gl'] = $gl;
//        $this->data['signature_rule'] = $this->m_loan->find_signature_rule_for_dropdown();
//
//        $this->form_validation->set_rules('cid', 'Contact information,Enter CID and click button search.', 'required');
//        $this->form_validation->set_rules('sav_acc_sav_pro_typ_id', 'Product type', 'required');
//        $this->form_validation->set_rules('currency', 'Currency', 'required');
//        $this->form_validation->set_rules('gl_id', 'GL code', 'required');
//        $this->form_validation->set_rules('con_cid', 'CID', 'required');
//        $this->form_validation->set_rules('sign_rule', 'Sign Rule', 'required');
//        if ($this->form_validation->run() == FALSE)
//            $this->load->view(Variables::$layout_main, $this->data);
//        else {
//            $config['upload_path'] = './images/upload/';
//            $config['allowed_types'] = 'gif|jpg|png';
//            $config['max_size'] = 1024;
//            $config['max_width'] = 200;
//            $config['max_height'] = 200;
//            $this->load->library('upload', $config);
//            $this->load->library('image_lib');
//
//            if (!$this->upload->do_upload()) {
//                // if file not selected
//                if ($_FILES['userfile']['error'] == 4) {
//                    // DB-------------
//                    //-----------------
//                    if ($this->m_loan->edit()) {
//                        $this->session->set_flashdata('success', 'A loan account has been updated');
//                        redirect('loan/edit');
//                    }
//                } else {
//                    $this->data['upload'] = $this->upload->display_errors();
//                    $this->load->view(Variables::$layout_main, $this->data);
//                }
//            } else {
//                // DB-------------
//                //-----------------
//                $file = $this->upload->data();
//                if ($this->m_loan->edit($file['file_name'])) {
//                    $this->session->set_flashdata('success', 'A loan account has been updated');
//                    redirect('loan/edit');
//                } else {
//                    $this->session->set_flashdata('error', 'A loan account could not update, please try again');
//                    redirect('loan/edit');
//                }
//            }
//        }
    }

    function repayment_schedule($get_acc_id = NULL) {

        $loan_amount = $this->input->post('loan_amount'); // Loan amount start up
        $rate_per = $this->input->post('interest_rate') / 100; // Percentag of interest %
        $loan_peraid = $this->input->post('num_installments'); // Number for time to repayment
        $rep_freg = $this->input->post('rep_freg'); // Type of repayment ex: Monthly, Daily, Weekly
        $disbu_date = $this->input->post('disbursment_date');
        $loa_id = $get_acc_id;


        $arr_num_freg = $this->m_global->select_where("repayment_freg", array('rep_fre_id' => $rep_freg), 1);
        if ($arr_num_freg->num_rows() > 0) {
            foreach ($arr_num_freg->result() as $arr_data) {
                $num_date = $arr_data->rep_fre_period;
            }
        }
        //1 ==============instalment====================
        $instalment = ($loan_amount * $rate_per) / (1 - pow((1 + $rate_per), (-$loan_peraid)));

//          ======================= Repayment day ===========================
        $repayment_date = $disbu_date;
        //$repayment_date = date('Y-m-d', $repayment_date."+" . $num_date . " days");

        $arr_sch = array();
        $principle_repay = 0;
        $rate_repay = 0;
        $balance = $loan_amount;
        for ($i = 1; $i <= $loan_peraid; $i++) {
            $repayment_date = date('Y-m-d', strtotime($repayment_date . "+" . $num_date . " days"));

//          1 ===================Rate===============
            $rate = $rate_per * $balance;

//          2 ================ Principle repayment ===============
            $principle_repay = $instalment - $rate;

//            ================ total repayment =============
            $total_repayment = $principle_repay + $rate;
//            ================ balance after repay==================
            $balance -= $principle_repay;

            $arr_sch_rec = array(
                'rep_sch_num' => $i,
                'rep_sch_date_repay' => $repayment_date,
                'rep_sch_principle_amount_repayment' => $principle_repay,
                'rep_sch_rate_repayment' => $rate,
                'rep_sch_total_repayment' => $total_repayment,
                'rep_sch_balance' => $balance,
                'rep_sch_instalment' => $instalment,
                'rep_sch_loa_acc_id' => $loa_id
            );
            array_push($arr_sch, $arr_sch_rec);
        }
        $this->db->insert_batch('repayment_schedule', $arr_sch);
        return TRUE;


//        ==== Sent to view===============
//        $this->data['repayment_sch'] = $this->m_global->select_all('repayment_schedule');
//        $this->load->view(Variables::$layout_main, $this->data);
    }

    //////==============Get table repayment==============================
    function repayment_tbl($loa_id = NULL) {
//        return "Hello";
        $this->data['repayment_sch'] = $this->m_global->select_where('repayment_schedule', array('rep_sch_loa_acc_id' => $loa_id));
//        $this->data['repayment_sch'] = $this->m_global->select_where('repayment_schedule',array('rep_sch_loa_acc_id' =>35));
//        return $this->load->view('loan/repayment_schedule', $this->data);
        $arr_field_sch_table = array(
            'ល.រ' => 'rep_sch_num',
            'ថ្ចៃសងប្រាក់' => 'rep_sch_date_repay', // Due date
            'ប្រាក់ដើម' => 'rep_sch_principle_amount_repayment', // Principal
            'ការប្រាក់' => 'rep_sch_rate_repayment', //Interest
            'ប្រាក់ដើមនៅសល់' => 'rep_sch_balance', //Outstanding
        );
        return table_manager($this->data['repayment_sch'], $arr_field_sch_table,FALSE,1);
    }

    //======================================================================
    function open() {
        $this->data['title'] = 'Open loan account';

        $this->data['edit'] = 0;

        if (segment(3) == TRUE && segment(3) == "edit") {
            $this->data['edit'] = 1;
            $this->data['title'] = 'Edit loan account';
        }
        $this->data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));

        allows(array(Setting::$role0, Setting::$role1));

        $product_type = $this->m_loan_product_type->get_loan_product_type_array();
        $this->data['product_type'] = $product_type;
        $contracts = $this->m_loan->get_contacts();
        $gl = $this->m_loan->find_gl_code_for_dropdown();
        $rep_peraid = $this->m_loan->rep_peraid();
        $this->data['rep_peraid'] = $rep_peraid;

        $currency = $this->m_loan->find_currencies_for_dropdown();
        $this->data['contacts'] = $contracts;
        $this->data['currency'] = $currency;
        $this->data['gl'] = $gl;
        $this->load->view(Variables::$layout_main, $this->data);


//        if($this->input->post('ss')){
//             if ($this->m_loan->add()) {
//                $this->session->set_flashdata('success', 'A loan account has been saved');
//                redirect('loan/Open');
//        }
//       
//
//        $this->form_validation->set_rules('cid', 'Contact information,Enter CID and click button search.', 'required|is_unique[loan_account.sav_acc_con_id]');
//        $this->form_validation->set_rules('loa_acc_loa_pro_typ_id', 'Product type', 'required');
//        $this->form_validation->set_rules('currency', 'Currency', 'required');
//        $this->form_validation->set_rules('gl_id', 'GL code', 'required');
//        $this->form_validation->set_rules('con_cid', 'CID', 'required');
//        $this->form_validation->set_rules('sign_rule', 'Sign Rule', 'required');
//        $this->form_validation->set_rules('dispayname', 'Display name', 'required');
//        $this->form_validation->set_message('is_unique', 'CID "' . $this->input->post('con_cid') . '" already has loan account. Try another CID');
//        
//        if ($this->form_validation->run() == FALSE)
//            $this->load->view(Variables::$layout_main, $this->data);
//        else {
//              echo "Hello";
//            if ($this->m_loan->add()) {
//                $this->session->set_flashdata('success', 'A loan account has been saved');
//                redirect('loan/Open');
//            }
//            $config['upload_path'] = './images/upload/';
//            $config['allowed_types'] = 'gif|jpg|png';
//            $config['max_size'] = 1024;
//            $config['max_width'] = 200;
//            $config['max_height'] = 200;
//            $this->load->library('upload', $config);
//            $this->load->library('image_lib');
//            if (!$this->upload->do_upload()) {
//                // if file not selected
//                if ($_FILES['userfile']['error'] == 4) {
//                    // DB-------------
//                    //-----------------
//                    if ($this->m_loan->add()) {
//                        $this->session->set_flashdata('success', 'A loan account has been saved');
//                        redirect('loan/lists');
//                    }
//                } else {
//                    $this->data['upload'] = $this->upload->display_errors();
//                    $this->load->view(Variables::$layout_main, $this->data);
//                }
//            } else {
//                // DB-------------
//                //-----------------
//                $file = $this->upload->data();
//                if ($this->m_loan->add($file['file_name'])) {
//                    $this->session->set_flashdata('success', 'A loan account has been saved');
//                    redirect('loan/lists');
//                } else {
//                    $this->load->view(Variables::$layout_main, $this->data);
//                }
//            }
//        }
    }

    function openloan() {
//        $this->rand = 10;
        $random_code = random_string('alnum', 16);
        $this->data['random_code'] = $random_code;
        $this->data['title'] = '(Dis)approve Loan Application';
        


        $this->data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));

////        allows(array(Setting::$role0, Setting::$role1));
//
//        $product_type = $this->m_loan_product_type->get_loan_product_type_array();
//        $this->data['product_type'] = $product_type;
//        $contracts = $this->m_loan->get_contacts();
//        $gl = $this->m_loan->find_gl_code_for_dropdown();
//        $rep_peraid = $this->m_loan->rep_peraid();
//        $this->data['rep_peraid'] = $rep_peraid;
//
//        $currency = $this->m_loan->find_currencies_for_dropdown();
//        $this->data['contacts'] = $contracts;
//        $this->data['currency'] = $currency;
//        $this->data['gl'] = $gl;
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function loan_status() {
//        echo $this->rand."<br />Ok";
        
//        echo $this->input->post("l_id_code"); exit();
        if ($this->input->post("l_id_code") == TRUE && $this->input->post("btn_nam") == TRUE) {
            $result = $this->m_loan->update_loan_approve($this->input->post("l_id_code"), $this->input->post("btn_nam"));
            if ($result == TRUE && $result != NULL) {
                echo $result;
            } else {
                echo 'Disapproved';
            }
            $this->session->set_flashdata('success', 'A loan account has been '.$this->input->post("btn_nam"));
//            redirect('loan/Openloan#contents');
        } else {
            return FALSE;
        }
    }

    function lists() {
        allows(array(Setting::$role0, Setting::$role1));
        $this->data['title'] = 'List loan accounts';
        $this->data['loan_account'] = $this->m_loan->get_loan_account();
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function test() {
        $contact_info = $contact_info = $this->m_global->select_join('loan_account', array('contacts' => array('loa_acc_con_id' => 'con_id'), 'loan_installment' => array('loa_acc_id' => 'loa_ins_loa_acc_id'), 'loan_product_type' => array('loa_acc_loa_pro_type_code' => 'loa_pro_typ_id')), 'inner', array('loan_account.loa_acc_code' => "777-000001-01-1"), '1');
//        if ($contact_info->num_rows() > 0) {
//            foreach ($contact_info->result() as $row) {
//                echo $contact_id = $row->con_cid;
//            }
//        }
        echo $contact_info;
    }

    function find_contact_by_code() {
        allows(array(Setting::$role0, Setting::$role1));
        $data = null;
        if ($this->input->post('acc_num') != NULL) {
//            $contact_info = $this->m_global->select_join('loan_account', array('contacts' => array('loa_acc_con_id' => 'con_id'), 'loan_installment' => array('loa_acc_id' => 'loa_ins_loa_acc_id')), 'inner', array('loan_account.loa_acc_code' => $this->input->post('acc_num')), '1');
            $contact_info = $contact_info = $this->m_global->select_join('loan_account', array('contacts' => array('loa_acc_con_id' => 'con_id'),
                'loan_installment' => array('loa_acc_id' => 'loa_ins_loa_acc_id'),
                'loan_product_type' => array('loa_acc_loa_pro_type_code' => 'loa_pro_typ_id'),
                'gl_list' => array('loa_acc_gl_code' => 'gl_code'),
                'currency' => array('loa_acc_cur_id' => 'cur_id'),
                'loan_detail' => array('loa_acc_loa_det_id' => 'loa_det_id'),
                'repayment_freg' => array('loa_acc_rep_fre_id' => 'rep_fre_id')), 'inner', array('loan_account.loa_acc_code' => $this->input->post('acc_num')), '1');

            if ($contact_info->num_rows() > 0) {
                foreach ($contact_info->result() as $row) {
                    $contact_id = $row->con_cid;
                    $data['loa_acc_id'] = $row->loa_acc_id;
                    $data['pro_type'] = $row->loa_acc_loa_pro_type_code;
                    $data['pro_type_code'] = $row->loa_pro_typ_code . " : " . $row->loa_pro_typ_amount;
                    $data['gl'] = $row->loa_acc_gl_code;
                    $data['gl_des'] = $row->gl_description;
                    $data['currency'] = $row->loa_acc_cur_id;
                    $data['currency_title'] = $row->cur_title;
                    $data['loa_amount'] = formatMoney($row->loa_acc_amount, TRUE);
                    $data['loa_acc_disbustment'] = $row->loa_acc_disbustment;
                    $data['loa_acc_rep_fre_id'] = $row->loa_acc_rep_fre_id;
                    $data['loa_acc_rep_fre_type'] = $row->rep_fre_type;
                    $data['loa_acc_first_repayment'] = $row->loa_acc_first_repayment;
                    $data['loa_ins_num_ins'] = $row->loa_ins_num_ins;
                    $data['loa_ins_lead_interest'] = $row->loa_ins_lead_interest;
                    $data['loa_ins_principal_start'] = $row->loa_ins_principal_start;
                    $data['loa_ins_principal_frequency'] = $row->loa_ins_principal_frequency;
                    $data['loa_ins_interest_rate'] = $row->loa_ins_interest_rate;
                    $data['loa_ins_installment_amount'] = $row->loa_ins_installment_amount;
                    $data['create_date'] = $row->loa_acc_created_date;
                    $data['create_date'] = $row->loa_acc_created_date;
                    $data['loa_detail'] = $row->loa_det_status;

                    $data['tbl_rep'] = $this->repayment_tbl($row->loa_acc_id);

                    $contact = $data;
                }
                $contact += $this->m_loan->find_contact_by_code($contact_id);
            } else {
                $contact_id = 0;
                $contact = $this->m_loan->find_contact_by_code($contact_id);
            }
        } else {
            $contact_id = $this->input->post('con_cid');
            $contact = $this->m_loan->find_contact_by_code($contact_id);
        }

        if ($contact != NULL) {
            echo json_encode($contact);
        } else {
            echo json_encode(array('result' => 0));
        }
    }

    function find_loan_by_contact_id() {
        allows(array(Setting::$role0, Setting::$role1));
        $contact = $this->m_loan->find_contact_by_code($this->input->post('con_cid'));
        if ($contact != NULL)
            echo json_encode($contact);
        else
            echo json_encode(array('result' => 0));
    }

    function find_gl_by_product_type_id() {
        allows(array(Setting::$role0, Setting::$role1));
        $contact = $this->m_loan->find_gl_by_product_type_id($this->input->post('id'));
        if ($contact != NULL)
            echo json_encode($contact);
        else
            echo json_encode(array('result' => 0));
    }

    function delete() {
        allows(array(Setting::$role0, Setting::$role1));
        if ($this->m_loan->delete_loan_account_by_id()) {
            $this->session->set_flashdata('success', 'Saving account(s) has been deleted.');
            redirect('loan/lists');
        } else {
            $this->session->set_flashdata('error', 'Saving account(s) could not deleted');
            redirect('loan/lists');
        }
    }

    function view() {
        $this->data['title'] = 'View loan account';
        $this->data['contacts'] = $this->m_loan->get_contacts_loan();
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function search() {
        $data['title'] = 'Search loan account';
        $data['acc_num_query'] = $this->m_global->select('loan_account', array('loa_acc_code'));
        $this->load->view(Variables::$layout_main, $data);
    }

    function search_account() {
        $query_data = $this->m_global->select('loan_account', array('loa_acc_code'));
        return $data;
    }

}

?>
