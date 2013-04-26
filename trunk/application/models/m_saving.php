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

    function add(){
        $data = array(
            'sav_acc_code'=>1234567,
            'sav_acc_sav_pro_typ_id'=>$this->input->post('sav_acc_sav_pro_typ_id'),
            //'sav_acc_create_date'=>  now(),
            //'sav_acc_modified_date'=>now(),
            'sav_acc_reference'=>'ddsadfadsf',//$this->input->post('sav_acc_reference'),
            'sav_acc_con_id'=>1,//$this->input->post('sav_acc_con_id'),
            'sav_use_id'=> $this->session->userdata('use_id'),
        );
        if($this->db->insert('saving_account',$data)) return TRUE;
        else return FALSE;
    }

    function get_saving_account(){
        $this->db->where('status',1);
        return $this->db->get('saving_account');
    }
}
?>
