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
class m_saving extends CI_Model {

    //put your code here

    function add($signature = NULL) {
        $data = array(
            'sav_acc_code' => '168-' . $this->input->post('con_cid') . '-' . $this->input->post('currency'),
            'sav_acc_sav_pro_typ_id' => $this->input->post('sav_acc_sav_pro_typ_id'),
            'sav_acc_create_date' => date('y-m-d h:i:s'),
            //'sav_acc_modified_date'=>now(),
            'sav_acc_reference' => '', //$this->input->post('sav_acc_reference'),
            'sav_acc_con_id' => $this->input->post('cid'),
            'sav_acc_gl_id' => $this->input->post('gl_id'),
            'sav_acc_cur_id' => $this->input->post('currency'),
            'sav_acc_sig_rul_id' => $this->input->post('sign_rule'),
            'sav_use_id' => $this->session->userdata('use_id'),
            'sav_acc_interest_rate' => $this->input->post('interest_rate'),
            'sav_acc_signature' => $signature,
        );
        if ($this->db->insert('saving_account', $data))
            return TRUE;
        else
            return FALSE;
    }

    function edit($signature = NULL) {

        $this->db->where('sav_acc_id',$this->input->post('sav_acc_id'));
        $this->db->set('sav_acc_code', '168-' . $this->input->post('con_cid') . '-' . $this->input->post('currency'), FALSE);
        $this->db->set('sav_acc_sav_pro_typ_id', $this->input->post('sav_acc_sav_pro_typ_id'), FALSE);
        $this->db->set('sav_acc_modified_date', 'NOW()', FALSE);
        //$this->db->set('sav_acc_reference' , '', //$this->input->post('sav_acc_reference'),FALSE);
        $this->db->set('sav_acc_con_id', $this->input->post('cid'), FALSE);
        $this->db->set('sav_acc_gl_id', $this->input->post('gl_id'), FALSE);
        $this->db->set('sav_acc_cur_id', $this->input->post('currency'), FALSE);
        $this->db->set('sav_acc_sig_rul_id', $this->input->post('sign_rule'), FALSE);
        $this->db->set('sav_use_id', $this->session->userdata('use_id'), FALSE);
        $this->db->set('sav_acc_interest_rate', $this->input->post('interest_rate'), FALSE);
        if($signature!=NULL){
            $this->db->set('sav_acc_signature', $signature);
            if(file_exists('./images/upload/'.$this->input->post('old_signature')))
                unlink('./images/upload/'.$this->input->post('old_signature'));
        }

        if ($this->db->update('saving_account'))
            return TRUE;
        else
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

    function get_contacts_saving() {
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

    function find_contact_by_code($con_cid) {
        $this->db->where('con_cid', $con_cid);
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id');
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
                $data['con_address'] = $row->con_det_address_detail;
                $data['con_dob'] = $row->con_det_dob;
                $data['con_typ_title'] = $row->con_typ_title;
                break;
            }
        }
        return $data;
    }

    function find_saving_by_contact_id($con_cid) {
        $this->db->where('con_cid', $con_cid);
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id');
        $this->db->join('saving_account', 'con_id=sav_acc_con_id');
        $this->db->join('currency', 'cur_id=sav_acc_cur_id');
        $this->db->join('saving_product_type', 'sav_pro_typ_id=sav_acc_sav_pro_typ_id');
        $this->db->join('gl_list', 'gl_id=sav_acc_gl_id');
        $this->db->join('signature_rule', 'sir_id=sav_acc_sig_rul_id');
        $query = $this->db->get('contacts');
        $data = null;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['result'] = 1;
                $data['sav_acc_id'] = $row->sav_acc_id;
                $data['con_id'] = $row->con_id;
                $data['con_cid'] = $row->con_cid;
                $data['con_en_first_name'] = $row->con_en_first_name;
                $data['con_en_last_name'] = $row->con_en_last_name;
                $data['con_kh_first_name'] = $row->con_kh_first_name;
                $data['con_kh_last_name'] = $row->con_kh_last_name;
                $data['con_en_nickname'] = $row->con_en_nickname;
                $data['con_kh_nickname'] = $row->con_kh_nickname;
                $data['con_address'] = $row->con_det_address_detail;
                $data['con_dob'] = $row->con_det_dob;
                $data['con_typ_title'] = $row->con_typ_title;
                $data['cur_title'] = $row->cur_title;
                $data['cur_id'] = $row->cur_id;
                $data['sav_pro_typ_title'] = $row->sav_pro_typ_title;
                $data['sav_pro_typ_id'] = $row->sav_pro_typ_id;
                $data['sir_title'] = $row->sir_title;
                $data['sir_id'] = $row->sir_id;
                $data['gl_description'] = $row->gl_description;
                $data['gl_id'] = $row->gl_id;
                $data['sav_acc_interest_rate'] = $row->sav_acc_interest_rate;
                $data['sav_acc_signature'] = $row->sav_acc_signature;
                break;
            }
        }
        return $data;
    }

    function delete_saving_account_by_id() {

        for ($k = 0; $k < count($_POST['child_check']); $k++) {
            $id = $_POST['child_check'][$k];
            $this->db->where('sav_acc_id', $id);
            $this->db->delete('saving_account');
        }
        return true;
    }

    function find_gl_code_for_dropdown() {
        $data = $this->db->like('gl_description', "Savings");
        $data = $this->db->get('gl_list');
        $result[''] = '--- Select GL Code ---';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[$row->gl_id] = $row->gl_description;
            }
            return $result;
        }
        else
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
