<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of d_cashs
 *
 * @author sophea.ou
 */
class m_transaction extends CI_Model {

    //put your code here
    function add($debit=null,$credit=null,$amount=null,$currency=null,$gl_id=null,$tran_type=null) {
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
