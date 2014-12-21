<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_saving
 *
 * @author sochy.choeun
 */
class M_loan extends CI_Model {

    //put your code here

    function add($pro_type_code = NULL) {
//        echo $this->input->post('firstrepayment_date');exit();
        $last_id = 0;
        $num_loan_acc = $this->db->count_all('loan_account') + 1;
        $loa_code = $pro_type_code . '-' . $this->input->post('con_cid') . '-0' . $this->input->post('currency') . "-" . $num_loan_acc;

        $this->session->set_userdata(array('loa_code' => $loa_code)); // Add loand code for view
        $data = array(
            'loa_acc_code' => $loa_code,
            'loa_acc_con_id' => $this->input->post('con_cid'),
            'loa_acc_loa_pro_type_code' => $this->input->post('loa_acc_loa_pro_typ_id'),
//            'loa_acc_amount' => (int)$this->input->post('loan_amount'),
            'loa_acc_amount' => (int) str_replace(",", "", $this->input->post('loan_amount')),
//            'loa_acc_amount' => (int)$this->input->post('loan_amount'),
            'loa_acc_amount_in_word' => $this->input->post('loan_amount_in_word'),
            'loa_acc_cur_id' => $this->input->post('currency'),
//            'loa_acc_gl_code' => $this->input->post('gl_code'),
              'loa_lat_id' => $this->input->post('lat_id'),
            'loa_acc_rep_fre_id' => $this->input->post('rep_freg'),
            'loa_acc_created_date' => date('y-m-d h:i:s'),
            'loa_acc_use_id' => $this->session->userdata('use_id'),
            'loa_acc_approval' => "Not yest",
            'loa_acc_loa_det_id' => "1", // Opened
            'loa_acc_first_repayment' => date($this->input->post('firstrepayment_date')),
//            'loa_acc_disbustment' => $this->input->post('disbursment_date'),
        );

        if ($this->db->insert('loan_account', $data)) {
            $last_id = $this->db->insert_id();
            $ins_data = array(
                'loa_ins_loa_acc_id' => $last_id,
                'loa_ins_rep_fre_id' => $this->input->post('rep_freg'),
                'loa_ins_num_ins' => $this->input->post('num_installments'),
                'loa_ins_lead_interest' => $this->input->post('lead_interest'),
                'loa_ins_principal_start' => $this->input->post('principal_start'),
                'loa_ins_principal_frequency' => $this->input->post('principal_frequency'),
                'loa_ins_interest_rate' => $this->input->post('interest_rate'),
                'loa_ins_installment_amount' => $this->input->post('ins_amount'),
            );
            $this->db->insert('loan_installment', $ins_data);
        }
        return $last_id;
    }

    function update_loan_approve($loa_id = NULL, $btn_name = NULL) {

        $code_active = NULL;
        if ($btn_name == "Approved") {
            $code_active = 2;
        } else {
            $code_active = 3;
        }

        $data = array(
            'loa_acc_loa_det_id' => $code_active,
            'loa_acc_approval' => $btn_name
        );
        $this->db->where('loa_acc_id', $loa_id);
        if ($this->db->update('loan_account', $data)) {
            return $btn_name;
        }else
            return FALSE;
    }

    function edit($loa_acc_code = NULL) {
        $last_id = 0;
        $data = array(
            'loa_acc_loa_pro_type_code' => $this->input->post('loa_acc_loa_pro_typ_id'),
            'loa_acc_amount' => (int) str_replace(",", "", $this->input->post('loan_amount')),
            'loa_acc_cur_id' => $this->input->post('currency'),
            'loa_acc_gl_code' => $this->input->post('gl_code'),
            'loa_acc_created_date' => date('y-m-d h:i:s'),
            'loa_acc_use_id' => $this->session->userdata('use_id'),
            'loa_acc_approval' => "Not yest",
            'loa_acc_loa_det_id' => "1", // Opened
            'loa_acc_first_repayment' => date($this->input->post('firstrepayment_date')),
//            'loa_acc_disbustment' => $this->input->post('disbursment_date'),
        );
        $this->db->where('loa_acc_code', $loa_acc_code);

        if ($this->db->update('loan_account', $data)) {
            $last_id = $this->input->post('loa_con_id');
            $ins_data = array(
//                'loa_ins_loa_acc_id' => $last_id,
                'loa_ins_rep_fre_id' => $this->input->post('rep_freg'),
                'loa_ins_num_ins' => $this->input->post('num_installments'),
                'loa_ins_lead_interest' => $this->input->post('lead_interest'),
                'loa_ins_principal_start' => $this->input->post('principal_start'),
                'loa_ins_principal_frequency' => $this->input->post('principal_frequency'),
                'loa_ins_interest_rate' => $this->input->post('interest_rate'),
                'loa_ins_installment_amount' => $this->input->post('ins_amount'),
            );
            $this->db->where('loa_ins_loa_acc_id', $last_id);
            if ($this->db->update('loan_installment', $ins_data)) {

                return TRUE;
            }else
                return FALSE;
        }else
            return FALSE;
    }

    function get_saving_account() {
        $this->db->from('saving_account');
        $this->db->where('saving_account.sav_acc_status', 1);
        $this->db->join('contacts', 'sav_acc_con_id=con_id');
        $this->db->join('contacts_detail', 'con_id=con_det_con_id', 'LEFT');
        $this->db->join('currency', 'sav_acc_cur_id=cur_id');
        $this->db->join('saving_product_type', 'sav_pro_typ_id=sav_acc_sav_pro_typ_id');
        $this->db->join('gl_list', 'sav_acc_gl_id=gl_id');
        $this->db->join('signature_rule', 'sav_acc_sig_rul_id=sir_id');
        return $this->db->get();
    }

    function get_contacts() {
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_typ_id=con_con_typ_id');
        $data = $this->db->get('contacts');
        $array = null;
        if ($data->num_rows() > 0) {
            $array = $data;
        }
        return $array;
    }

    public function get_contacts_loan() {
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_typ_id=con_con_typ_id');
        $this->db->join('saving_account', 'con_id=sav_acc_con_id');
        $data = $this->db->get('contacts');
        $array = null;
        if ($data->num_rows() > 0) {
            $array = $data; 
        }
        return $array;
    }

    function exit_loa_of_contact() {
        $data = null;
        $loa_exit = $this->m_global->select_where("loan_account", array('loa_acc_con_id' => $this->input->post('con_cid'), 'loa_status' => 0));
        if ($loa_exit->num_rows() > 0) {
            $data['loa_exit'] = 1;
        } else {
            $data['loa_exit'] = 0;
        }
        return $data;
    }

    function find_contact_by_code($con_cid) {
        $this->db->where('con_cid', $con_cid);
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id');
//        ============ More detail about contact ============
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
//        ======================= end contact===========================
        $query = $this->db->get('contacts');
        $data = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['result'] = 1;
                $data['con_id'] = $row->con_id;
                $data['con_cid'] = $row->con_cid;
                $data['con_en_first_name'] = $row->con_en_first_name;
                $data['con_en_last_name'] = $row->con_en_last_name;
                $data['con_kh_first_name'] = $row->con_kh_first_name;
                $data['con_kh_last_name'] = $row->con_kh_last_name;
                $data['con_en_nickname'] = $row->con_en_nickname;
                $data['con_kh_nickname'] = $row->con_kh_nickname;
                $data['sex'] = ($row->con_kh_nickname == "m") ? "Male" : "Female";
                if ($row->con_det_civil_status == "1") {
                    $data['civil'] = "Single";
                } elseif ($row->con_det_civil_status == "2") {
                    $data['civil'] = "Married";
                } else {
                    $data['civil'] = "Devoise";
                }


                $data['con_address'] = $row->con_det_address_detail . " , ភូមិ " . $row->vil_kh_name . ", ឃុំ/សង្កាត់ " . $row->com_kh_name . ", ស្រុក/ខណ្ឌ " . $row->dis_kh_name . ", ខេត្ត/រាជធានី " . $row->pro_kh_name;
                $data['con_dob'] = $row->con_det_dob;
                $data['con_typ_title'] = $row->con_typ_title;

                break;
            }
        }
        return $data;
    }

//    function find_saving_by_contact_id($con_cid) {
//        $this->db->where('con_cid', $con_cid);
//        $this->db->where('contacts.status', 1);
//        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
//        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id');
//        $this->db->join('saving_account', 'con_id=sav_acc_con_id');
//        $this->db->join('currency', 'cur_id=sav_acc_cur_id');
//        $this->db->join('saving_product_type', 'sav_pro_typ_id=sav_acc_sav_pro_typ_id');
//        $this->db->join('gl_list', 'gl_id=sav_acc_gl_id');
//        $this->db->join('signature_rule', 'sir_id=sav_acc_sig_rul_id');
//        $query = $this->db->get('contacts');
//        $data = null;
//        if ($query->num_rows() > 0) {
//            foreach ($query->result() as $row) {
//                $data['result'] = 1;
//                $data['sav_acc_id'] = $row->sav_acc_id;
//                $data['con_id'] = $row->con_id;
//                $data['con_cid'] = $row->con_cid;
//                $data['con_en_first_name'] = $row->con_en_first_name;
//                $data['con_en_last_name'] = $row->con_en_last_name;
//                $data['con_kh_first_name'] = $row->con_kh_first_name;
//                $data['con_kh_last_name'] = $row->con_kh_last_name;
//                $data['con_en_nickname'] = $row->con_en_nickname;
//                $data['con_kh_nickname'] = $row->con_kh_nickname;
//                $data['con_address'] = $row->con_det_address_detail;
//                $data['con_dob'] = $row->con_det_dob;
//                $data['con_typ_title'] = $row->con_typ_title;
//                $data['cur_title'] = $row->cur_title;
//                $data['cur_id'] = $row->cur_id;
//                $data['sav_pro_typ_title'] = $row->sav_pro_typ_title;
//                $data['sav_pro_typ_id'] = $row->sav_pro_typ_id;
//                $data['sir_title'] = $row->sir_title;
//                $data['sir_id'] = $row->sir_id;
//                $data['gl_description'] = $row->gl_description;
//                $data['gl_id'] = $row->gl_id;
//                $data['sav_acc_interest_rate'] = $row->sav_acc_interest_rate;
//                $data['sav_acc_signature'] = $row->sav_acc_signature;
//                break;
//            }
//        }
//        return $data;
//    }
//
//    function delete_saving_account_by_id() {
//
//        for ($k = 0; $k < count($_POST['child_check']); $k++) {
//            $id = $_POST['child_check'][$k];
//            $this->db->where('sav_acc_id', $id);
//            $this->db->delete('saving_account');
//        }
//        return true;
//    }

    function find_gl_code_for_dropdown() {
        $data = $this->db->like('gl_description', "Loan");
        $data = $this->db->get('gl_list');
        $result[''] = '--- Select GL Code ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->gl_code] = $row->gl_description;
            }
            return $result;
        }
        else
            return $result;
    }

    function rep_peraid() {
        $this->db->order_by('rep_fre_id`');
        $data = $this->db->get('repayment_freg');
        
        $result[''] = '--- Plase Select ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->rep_fre_id] = $row->rep_fre_type;
            }
        }
        return $result;
    }
function laon_account_type_for_dropdown(){
        $this->db->order_by('lat_id');
        $data = $this->db->get('loan_account_type');
        $result = null;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->lat_id] = $row->lat_title;
            }
        }
        return $result;
}
    function find_gl_by_product_type_id($id) {

        $this->db->like('gl_code', $id);
        $this->db->limit(1);
        $data = $this->db->get('gl_list');
        $result = null;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result['gl'] = $row->gl_description;
                $result['gl_id'] = $row->gl_id;
                $result['result'] = 1;
            }
            return $result;
        }
        else
            return $result;
    }

    function find_currencies_for_dropdown() {

        $this->db->where('cur_status', 1);
        $data = $this->db->get('currency');
        $result[''] = '--- Select Currency ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->cur_id] = $row->cur_title;
            }
            return $result;
        }
        else
            return $result;
    }

    function find_signature_rule_for_dropdown() {
        $this->db->where('signature_rule.status', 1);
        $this->db->order_by('sir_title');
        $data = $this->db->get('signature_rule');
        $result[''] = '--- Select signature rule ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->sir_id] = $row->sir_title;
            }
            return $result;
        }
        else
            return $result;
    }

}

?>
