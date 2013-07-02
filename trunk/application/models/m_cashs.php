<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of d_cashs
 *
 * @author sochy.choeun
 */
class m_cashs extends CI_Model {

    //put your code here

    function cashin() {
        try {
            $this->db->where('til_tel_id', $this->session->userdata('use_id'));
            $this->db->where('til_cur_id', $this->input->post('currency'));
            $data = $this->db->get('tiller');
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $this->db->where('til_tel_id', $this->session->userdata('use_id'));
                    $this->db->where('til_cur_id', $this->input->post('currency'));
                    $fields = array(
                        'til_debit' => $this->input->post('amountin') + $row->til_debit,
                        'til_modifide_date' => date('Y-m-d h:i:s')
                    );
                    if ($this->db->update('tiller', $fields)) {
                        $tran = array(
                            'tra_debit' => $this->input->post('amountin'),
                            'tra_cur_id' => $this->input->post('currency'),
                            'tra_date' => date('Y-m-d h:i:s'),
                            'tra_value_date' => date('Y-m-d h:i:s'),
                            'tra_use_id' => $this->session->userdata('use_id'),
                            'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
                            'tra_type' => $this->find_transaction_type_id_by_title('Debit'),
                            'tra_gl_code' =>'111109121'
//                            'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
                        );
                        $this->db->insert('transaction', $tran);
//                        return last_query();
                        return TRUE;
                    }
                    else
                        return FALSE;
                }
            } else {
                $fields = array(
                    'til_debit' => $this->input->post('amountin'),
                    'til_cur_id' => $this->input->post('currency'),
                    'til_tel_id' => $this->session->userdata('use_id'),
                );
                if ($this->db->insert('tiller', $fields)) {
                    $tran = array(
                        'tra_debit' => $this->input->post('amountin'),
                        'tra_cur_id' => $this->input->post('currency'),
                        'tra_date' => date('Y-m-d h:i:s'),
                        'tra_value_date' => date('Y-m-d h:i:s'),
                        'tra_use_id' => $this->session->userdata('use_id'),
                        'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
                        'tra_type' => $this->find_transaction_type_id_by_title('Debit'),
                        'tra_gl_code' =>'111109121'
//                        'tra_gl_id' => $this->find_gl_id_by_code('111109121')
                    );
                    $this->db->insert('transaction', $tran);
                    return TRUE;
                }
                else
                    return FALSE;
            }
            return FALSE;
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    /**
     * 
     * @return boolean
     */
    function cashout() {
        try {
            $this->db->where('til_tel_id', $this->session->userdata('use_id'));
            $this->db->where('til_cur_id', $this->input->post('currencyout'));
            $data = $this->db->get('tiller');
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $this->db->where('til_tel_id', $this->session->userdata('use_id'));
                    $this->db->where('til_cur_id', $this->input->post('currencyout'));
                    $fields = array(
                        'til_credit' => $this->input->post('amountout') + $row->til_debit,
                        'til_modifide_date' => date('Y-m-d h:i:s')
                    );
                    if ($this->db->update('tiller', $fields)) {
                        $tran = array(
                            'tra_credit' => $this->input->post('amountout'),
                            'tra_cur_id' => $this->input->post('currencyout'),
                            'tra_date' => date('Y-m-d h:i:s'),
                            'tra_value_date' => date('Y-m-d h:i:s'),
                            'tra_use_id' => $this->session->userdata('use_id'),
                            'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
                            'tra_type' => $this->find_transaction_type_id_by_title('Credit'),
                            'tra_gl_code' =>'111109121'
//                            'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
                        );
                        $this->db->insert('transaction', $tran);
                        return TRUE;
                    }
                    else
                        return FALSE;
                }
            } else {
                $fields = array(
                    'til_credit' => $this->input->post('amountout'),
                    'til_cur_id' => $this->input->post('currencyout'),
                    'til_tel_id' => $this->session->userdata('use_id'),
                );
                if ($this->db->insert('tiller', $fields)) {
                    $tran = array(
                        'tra_credit' => $this->input->post('amountout'),
                        'tra_cur_id' => $this->input->post('currencyout'),
                        'tra_date' => date('Y-m-d h:i:s'),
                        'tra_value_date' => date('Y-m-d h:i:s'),
                        'tra_use_id' => $this->session->userdata('use_id'),
                        'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
                        'tra_type' => $this->find_transaction_type_id_by_title('Credit'),
                        'tra_gl_code' =>'111109121'
//                        'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
                    );
                    $this->db->insert('transaction', $tran);
                    return TRUE;
                }
                else
                    return FALSE;
            }
            return FALSE;
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    function find_transaction_mode_id_by_title($title) {
        $this->db->where('tra_mod_status', 1);
        $this->db->where('tra_mod_title', $title);
        $data = $this->db->get('transaction_mode');
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row)
                return $row->tra_mod_id;
        }
        else
            return 0;
    }

    function find_gl_id_by_code($code) {
        $this->db->where('gl_code', $code);
        $data = $this->db->get('gl_list');
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row)
                return $row->gl_id;
        }
        else
            return 0;
    }

    function find_transaction_type_id_by_title($title) {
        $this->db->where('tra_typ_title', $title);
        $this->db->where('tra_typ_status', 1);
        $data = $this->db->get('transaction_type');
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row)
                return $row->tra_typ_id;
        }
        else
            return 0;
    }

}

?>
