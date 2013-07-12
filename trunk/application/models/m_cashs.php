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
            // if data exist we update
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $this->db->where('til_tel_id', $this->session->userdata('use_id'));
                    $this->db->where('til_cur_id', $this->input->post('currency'));
//                    $fields = array(
//                        'til_credit' => $this->input->post('amountin') + $row->til_credit,
//                        'til_modifide_date' => 'NOW()'//date('Y-m-d h:i:s')
//                    );
                    $this->db->set('til_credit', 'til_credit +' . $this->input->post('amountin'), FALSE);
                    $this->db->set('til_modifide_date', 'NOW()', FALSE);
                    if ($this->db->update('tiller')) {
//                        $tran = array(
//                            'tra_credit' => $this->input->post('amountin'),
//                            'tra_cur_id' => $this->input->post('currency'),
//                            'tra_date' => date('Y-m-d h:i:s'),
//                            'tra_value_date' => date('Y-m-d h:i:s'),
//                            'tra_use_id' => $this->session->userdata('use_id'),
//                            'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
//                            'tra_type' => $this->find_transaction_type_id_by_title('Debit'),
//                            'tra_gl_code' => '111109121'
////                            'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
//                        );
                        $this->db->set('tra_credit', $this->input->post('amountin'), FALSE);
                        $this->db->set('tra_cur_id', $this->input->post('currency'), FALSE);
                        $this->db->set('tra_date', 'NOW()', FALSE);
                        $this->db->set('tra_value_date', 'NOW()', FALSE);
                        $this->db->set('tra_use_id', $this->session->userdata('use_id'), FALSE);
                        $this->db->set('tra_tra_mod_id', $this->find_transaction_mode_id_by_title('Cash'), FALSE);
                        $this->db->set('tra_type', $this->find_transaction_type_id_by_title('Debit'), FALSE);
                        $this->db->set('tra_gl_code', '111109121', FALSE);
                        $this->db->insert('transaction');
                        //============ update Gl balance
                        $this->db->set('gl_bal_debit', 'gl_bal_debit - ' . $this->input->post('amountin'), FALSE);
                        $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
                        $this->db->where('gl_bal_cur_id', $this->input->post('currency'));
                        $this->db->where('gl_bal_gl_code', '111109121');
                        $this->db->update('gl_balances');
//                        return last_query();
                        return TRUE;
                    }
                    else
                        return FALSE;
                }
            }
            // if data not exist create new
            else {
                $fields = array(
                    'til_credit' => $this->input->post('amountin'),
                    'til_cur_id' => $this->input->post('currency'),
                    'til_tel_id' => $this->session->userdata('use_id'),
                );
                if ($this->db->insert('tiller', $fields)) {
//                    $tran = array(
//                        'tra_credit' => $this->input->post('amountin'),
//                        'tra_cur_id' => $this->input->post('currency'),
//                        'tra_date' => date('Y-m-d h:i:s'),
//                        'tra_value_date' => date('Y-m-d h:i:s'),
//                        'tra_use_id' => $this->session->userdata('use_id'),
//                        'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
//                        'tra_type' => $this->find_transaction_type_id_by_title('Debit'),
//                        'tra_gl_code' => '111109121'
////                        'tra_gl_id' => $this->find_gl_id_by_code('111109121')
//                    );
//                    $this->db->insert('transaction', $tran);
                    $this->db->set('tra_credit', $this->input->post('amountin'), FALSE);
                    $this->db->set('tra_cur_id', $this->input->post('currency'), FALSE);
                    $this->db->set('tra_date', 'NOW()', FALSE);
                    $this->db->set('tra_value_date', 'NOW()', FALSE);
                    $this->db->set('tra_use_id', $this->session->userdata('use_id'), FALSE);
                    $this->db->set('tra_tra_mod_id', $this->find_transaction_mode_id_by_title('Cash'), FALSE);
                    $this->db->set('tra_type', $this->find_transaction_type_id_by_title('Debit'), FALSE);
                    $this->db->set('tra_gl_code', '111109121', FALSE);
                    $this->db->insert('transaction');
                    //============ update Gl balance
                    $this->db->set('gl_bal_debit', 'gl_bal_debit - ' . $this->input->post('amountin'), FALSE);
                    $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
                    $this->db->where('gl_bal_cur_id', $this->input->post('currency'));
                    $this->db->where('gl_bal_gl_code', '111109121');
                    $this->db->update('gl_balances');
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
//                    $fields = array(
//                        'til_debit' => $row->til_debit - $this->input->post('amountout'),
//                        'til_modifide_date' => date('Y-m-d h:i:s')
//                    );

                    $this->db->set('til_debit', $row->til_debit - $this->input->post('amountout'), FALSE);
                    $this->db->set('til_modifide_date', 'NOW()', FALSE);
                    if ($this->db->update('tiller')) {
//                        $tran = array(
//                            'tra_debit' => $this->input->post('amountout'),
//                            'tra_cur_id' => $this->input->post('currencyout'),
//                            'tra_date' => date('Y-m-d h:i:s'),
//                            'tra_value_date' => date('Y-m-d h:i:s'),
//                            'tra_use_id' => $this->session->userdata('use_id'),
//                            'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
//                            'tra_type' => $this->find_transaction_type_id_by_title('Credit'),
//                            'tra_gl_code' => '111109121'
////                            'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
//                        );
//                        $this->db->insert('transaction', $tran);
                        $this->db->set('tra_debit', $this->input->post('amountout'), FALSE);
                        $this->db->set('tra_cur_id', $this->input->post('currencyout'), FALSE);
                        $this->db->set('tra_date', 'NOW()', FALSE);
                        $this->db->set('tra_value_date', 'NOW()', FALSE);
                        $this->db->set('tra_use_id', $this->session->userdata('use_id'), FALSE);
                        $this->db->set('tra_tra_mod_id', $this->find_transaction_mode_id_by_title('Cash'), FALSE);
                        $this->db->set('tra_type', $this->find_transaction_type_id_by_title('Debit'), FALSE);
                        $this->db->set('tra_gl_code', '111109121', FALSE);
                        $this->db->insert('transaction');
                        //============ update Gl balance
                        $this->db->set('gl_bal_credit', 'gl_bal_credit + ' . $this->input->post('amountout'), FALSE);
                        $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
                        $this->db->where('gl_bal_cur_id', $this->input->post('currency'));
                        $this->db->where('gl_bal_gl_code', '111109121');
                        $this->db->update('gl_balances');
                        return TRUE;
                    }
                    else
                        return FALSE;
                }
            } else {
                $fields = array(
                    'til_debit' => $this->input->post('amountout'),
                    'til_cur_id' => $this->input->post('currencyout'),
                    'til_tel_id' => $this->session->userdata('use_id'),
                );
                if ($this->db->insert('tiller', $fields)) {
//                    $tran = array(
//                        'tra_debit' => $this->input->post('amountout'),
//                        'tra_cur_id' => $this->input->post('currencyout'),
//                        'tra_date' => date('Y-m-d h:i:s'),
//                        'tra_value_date' => date('Y-m-d h:i:s'),
//                        'tra_use_id' => $this->session->userdata('use_id'),
//                        'tra_tra_mod_id' => $this->find_transaction_mode_id_by_title('Cash'),
//                        'tra_type' => $this->find_transaction_type_id_by_title('Credit'),
//                        'tra_gl_code' => '111109121'
////                        'tra_gl_id' => $this->find_gl_id_by_code('111109121'),
//                    );
//                    $this->db->insert('transaction', $tran);
                    $this->db->set('tra_debit', $this->input->post('amountout'), FALSE);
                    $this->db->set('tra_cur_id', $this->input->post('currencyout'), FALSE);
                    $this->db->set('tra_date', 'NOW()', FALSE);
                    $this->db->set('tra_value_date', 'NOW()', FALSE);
                    $this->db->set('tra_use_id', $this->session->userdata('use_id'), FALSE);
                    $this->db->set('tra_tra_mod_id', $this->find_transaction_mode_id_by_title('Cash'), FALSE);
                    $this->db->set('tra_type', $this->find_transaction_type_id_by_title('Debit'), FALSE);
                    $this->db->set('tra_gl_code', '111109121', FALSE);
                    $this->db->insert('transaction');
                    //============ update Gl balance
                    $this->db->set('gl_bal_credit', 'gl_bal_debit + ' . $this->input->post('amountin'), FALSE);
                    $this->db->set('gl_bal_datemodifide', 'NOW()', FALSE);
                    $this->db->where('gl_bal_cur_id', $this->input->post('currency'));
                    $this->db->where('gl_bal_gl_code', '111109121');
                    $this->db->update('gl_balances');
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
