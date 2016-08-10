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
//        $num_loan_acc = $this->db->count_all('loan_account') + 1;
//        $loa_code = $pro_type_code . '-' . $this->input->post('con_cid') . '-0' . $this->input->post('currency') . "-" . $num_loan_acc; ///// for old requirement
        // Create laon code
        // Check loan cicle
        $con_id = $this->input->post('con_id');
        $this->db->where('loa_acc_con_id', $con_id); /////////// get loan cicle
        $this->db->from('loan_account');
        $cicle_loan = $this->db->count_all_results() + 1;

        $cicle_loan = substr("00", 0, -(strlen($cicle_loan))) . $cicle_loan; /// create fomart for Cicle 01

        $loa_code = $this->input->post('lat_id') . "-" . $this->input->post('con_cid') . "-" . $cicle_loan;
        $this->session->set_userdata(array('loa_code' => $loa_code)); // Add loand code for view
        // ====Get loan type and Repayment Freg by លេខគណនីអតិថិជន
        $loan_info = $this->getLoanTF($this->input->post('lat_id'));
        $this->session->set_userdata(array('freg_num' => $loan_info->lat_freg));
        ///========================
        // ============Check disbursment date if it emty get the current date===================
        if ($this->input->post('disbursment_date') != "") {
            $disbursment_date = date('Y-m-d', strtotime($this->input->post('disbursment_date')));
        } else {
            $disbursment_date =  date('Y-m-d', strtotime(now()));
        }

//        ==============================end ======================

        $data = array(
            'loa_acc_code' => $loa_code,
            'loa_acc_con_id' => $this->input->post('con_id'),
            'loa_acc_loa_pro_type_code' => $this->input->post('loa_acc_loa_pro_typ_id'),
            'loa_lpp_id' => $this->input->post('lpp_id'),
            'loa_acc_loa_sch_id' => $this->input->post('loa_sch_id'),
//            'loa_acc_amount' => (int)$this->input->post('loan_amount'),
            'loa_acc_amount' => (int) str_replace(",", "", $this->input->post('loan_amount')),
//            'loa_acc_amount' => (int)$this->input->post('loan_amount'),
            'loa_acc_amount_in_word' => $this->input->post('loan_amount_in_word'),
            'loa_acc_cur_id' => $this->input->post('currency'),
//            'loa_acc_gl_code' => $this->input->post('gl_code'),
            'loa_lat_id' => $this->input->post('lat_id'),
            // Got by លេខគណនីអតិថិជន
//            'loa_acc_rep_fre_id' => $this->input->post('rep_freg'),
            'loa_acc_rep_fre_id' => $loan_info->lat_freg,
            'loa_acc_ownership_type' => $loan_info->lat_loan_type,
            //===============
            'loa_acc_co_id' => $this->input->post('co_id'),
            'loa_acc_created_date' => date('y-m-d h:i:s'),
            'loa_acc_use_id' => $this->session->userdata('use_id'),
            'loa_acc_approval' => "Not yest",
            'loa_acc_loa_det_id' => "1", // Opened
            'loa_acc_first_repayment' => date('Y-m-d', strtotime($this->input->post('firstrepayment_date'))),
            'loa_cicle' => $cicle_loan,
            'loa_acc_disbustment' => $disbursment_date
        );

        if ($this->db->insert('loan_account', $data)) {
            $last_id = $this->db->insert_id();
            $ins_data = array(
                'loa_ins_loa_acc_id' => $last_id,
                'loa_ins_rep_fre_id' => $loan_info->lat_freg,
//                'loa_acc_ownership_type' => $loan_info->lat_loan_type,
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

    function getLoanTF($lat_id) {
        $this->db->where('lat_id', $lat_id);
        $tfdata = $this->db->get('loan_account_type');
        if ($tfdata->num_rows() > 0) {
            foreach ($tfdata->result() as $row) {
                return $row;
            }
        }
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
        } else
            return FALSE;
    }

    function edit($loa_acc_code = NULL) {
        $last_id = 0;
        // ====Get loan type and Repayment Freg by លេខគណនីអតិថិជន
        $loan_info = $this->getLoanTF($this->input->post('lat_id'));
        $this->session->set_userdata(array('freg_num' => $loan_info->lat_freg));
        ///========================
        // ============Check disbursment date if it emty get the current date===================
        if ($this->input->post('disbursment_date') != "") {
            $disbursment_date = date('Y-m-d', strtotime($this->input->post('disbursment_date')));
        } else {
                $disbursment_date =  date('Y-m-d', strtotime(now()));
        }

//        ==============================end ======================
        $data = array(
            'loa_acc_loa_pro_type_code' => $this->input->post('loa_acc_loa_pro_typ_id'),
            'loa_lpp_id' => $this->input->post('loa_lpp_id'),
            'loa_acc_amount' => (int) str_replace(",", "", $this->input->post('loan_amount')),
            'loa_acc_cur_id' => $this->input->post('currency'),
            'loa_acc_loa_sch_id' => $this->input->post('loa_sch_id'),
            'loa_acc_amount_in_word' => $this->input->post('loan_amount_in_word'),
//            'loa_acc_gl_code' => $this->input->post('gl_code'),
            'loa_acc_created_date' => date('y-m-d h:i:s'),
            'loa_acc_use_id' => $this->session->userdata('use_id'),
//            'loa_acc_approval' => "Not yest",
//            'loa_acc_loa_det_id' => "1", // Opened
            'loa_lat_id' => $this->input->post('lat_id'),
            // Got by លេខគណនីអតិថិជន
//            'loa_acc_rep_fre_id' => $this->input->post('rep_freg'),
            'loa_acc_rep_fre_id' => $loan_info->lat_freg,
            'loa_acc_ownership_type' => $loan_info->lat_loan_type,
            //===============
            'loa_acc_first_repayment' => date('Y-m-d', strtotime($this->input->post('firstrepayment_date'))),
            'loa_acc_disbustment' => $disbursment_date
        );
        $this->db->where('loa_acc_code', $loa_acc_code);

        if ($this->db->update('loan_account', $data)) {
            $last_id = $this->input->post('loa_con_id');
            $ins_data = array(
//                'loa_ins_loa_acc_id' => $last_id,
                'loa_ins_rep_fre_id' => $loan_info->lat_freg,
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
            } else
                return FALSE;
        } else
            return FALSE;
    }

    function updateLoanMaturity($repayment_date, $loa_acc_code) {
        $arr_loan_info = array(
            'loa_acc_maturity' => $repayment_date
        );
        $this->db->where('loa_acc_id', $loa_acc_code);
        $this->db->update('loan_account', $arr_loan_info);
    }

    function close_loan($loa_acc_code = NULL) {
        $data = array(
            'loa_acc_loa_det_id' => 5, ///// Close loan
            'loa_acc_modified_date' => date('y-m-d h:i:s'),
            'loa_cicle' => 0 ////// Allow create new loan
        );
        $this->db->where('loa_acc_code', $loa_acc_code);

        if ($this->db->update('loan_account', $data)) {
            return TRUE;
        } else
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
        $this->db->join('contacts_detail', 'con_id=con_det_con_id', 'left');
        $this->db->join('contacts_type', 'con_typ_id=con_con_typ_id', 'left');
        $data = $this->db->get('contacts');
        $array = null;
        if ($data->num_rows() > 0) {
            $array = $data;
        }
        return $array;
    }

    public function checkpayoff() {
        
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
        // test
//        $con_cid = "000033";
//        ================
        $con_cid = $this->input->post('con_cid');
        $this->db->where('con_cid', $con_cid);
        $this->db->where('contacts.status', 1); /// Get only anable contact
//        $this->db->where('loa_acc_loa_det_id !=', 5); /////Find contact not in active
        $this->db->join('contacts_detail', 'con_id=con_det_con_id', 'left');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id', 'left');
        $this->db->join('loan_account', 'loa_acc_con_id=con_id', 'left');
//        ============ More detail about contact ============
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
//        ======================= end contact===========================
        $this->db->order_by('loa_acc_loa_det_id'); ///// to get active loan from array of result
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


                $data['lao_code'] = $row->loa_acc_code;

                $data['loa_detail'] = $row->loa_acc_loa_det_id;
                break;
            }
        }
        return $data;
    }

    function find_contact_by_loan_number($loan_code = NULL) {
        // test
//        $loan_code = "12-000033-01";
//        ================
        $this->db->where('loan_account.loa_acc_code', $loan_code);
        $this->db->where('contacts.status', 1); /// edite only padding account
//        $this->db->where('loa_acc_loa_det_id !=', 5); /////Find contact not in active
        $this->db->join('contacts_detail', 'con_id=con_det_con_id', 'left');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id', 'left');
//        =================More detail for loan===========
        $this->db->join('loan_account', 'loa_acc_con_id=con_id', 'left');
        $this->db->join('loan_detail', 'loa_det_id=loa_acc_loa_det_id', 'left');
        $this->db->join('loan_installment', 'loan_installment.loa_ins_loa_acc_id=loan_account.loa_acc_id');
        $this->db->join('loan_product_type', 'loan_product_type.loa_pro_typ_id=loan_account.loa_acc_loa_pro_type_code');
        $this->db->join('loan_account_type', 'loan_account_type.lat_id=loan_account.loa_lat_id');
        $this->db->join('currency', 'currency.cur_id=loan_account.loa_acc_cur_id');
        $this->db->join('repayment_freg', 'repayment_freg.rep_fre_id=loan_account.loa_acc_rep_fre_id');
        $this->db->join('creadit_officer', 'creadit_officer.co_id=loan_account.loa_acc_co_id');


//        ============ More detail about contact ============
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
//        ======================= end contact===========================
//        $this->db->order_by('loa_acc_loa_det_id'); ///// to get active loan from array of result
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

//                ========Loan info===========
                $data['loa_acc_id'] = $row->loa_acc_id;
                $data['loa_acc_typ_num'] = $row->lat_title;
                $data['pro_type'] = $row->loa_acc_loa_pro_type_code;
                $data['loan_purpose'] = $row->loa_lpp_id;
                $data['co_id'] = $row->loa_acc_co_id;
                $data['repayment_type'] = $row->loa_acc_loa_sch_id;
                $data['loa_acc_ownership_type'] = $row->loa_acc_ownership_type;
                $data['loa_lat_id'] = $row->loa_lat_id;
                $data['currency'] = $row->loa_acc_cur_id;
                $data['currency_title'] = $row->cur_title;
                $data['loa_acc_amount_in_word'] = $row->loa_acc_amount_in_word;
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
                $data['disbursment_date'] = $row->loa_acc_disbustment;
                $data['loa_ins_installment_amount'] = $row->loa_ins_installment_amount;
                $data['create_date'] = $row->loa_acc_created_date;

                $data['loa_detail'] = $row->loa_det_status;
                break;
            }
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
        } else
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

    function laon_account_type_for_dropdown() {
        $this->db->order_by('lat_id');
        $this->db->where('lat_status', 1);
        $data = $this->db->get('loan_account_type');
        $result = null;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->lat_id] = $row->lat_title;
            }
        }
        return $result;
    }

    function laon_purpose_for_dropdown() {
        $this->db->order_by('lpp_id');
        $data = $this->db->get('loan_purpose');
        $result = null;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->lpp_id] = $row->lpp_title;
            }
        }
        return $result;
    }

    function co_data_for_dropdown() {
        /// Get brand the same as user login brand
        $bran_id = $this->session->userdata('use_bra_id');
        $this->db->where('cro_of_branch.crob_bra_id', $bran_id);
        $this->db->where('co_status', 1);
        $this->db->where('crob_status', 1);
        $this->db->order_by('co_name');
        $this->db->join('cro_of_branch', 'cro_of_branch.crob_cro_id=creadit_officer.co_id');
        $data = $this->db->get('creadit_officer');
        $result[''] = '--- Select CO ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->co_id] = $row->co_name;
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
        } else
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
        } else
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
        } else
            return $result;
    }
    //put your code here
    function add_transaction($debit=null,$credit=null,$amount=null,$currency=null,$gl_id=null,$tran_type=null) {
                    $tran = array(
                         'tra_debit' => $debit,
                        'tra_credit' => $credit,
                        'tra_cur_id' => $currency,
                        'tra_amount' => $amount,
                        'tra_date' => date('Y-m-d h:i:s'),
                        'tra_value_date' => date('Y-m-d h:i:s'),
                        'tra_use_id' => $this->session->userdata('use_id'),
                        'tra_type' => $this->$tran_type,
                        'tra_gl_code' => $gl_id
                    );
                    $this->db->insert('transaction', $tran);
    }

}

?>
