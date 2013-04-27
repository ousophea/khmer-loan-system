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
            'sav_acc_code'=>'168-'.$this->input->post('sav_acc_con_id').'-'.$this->input->post('curency'),
            'sav_acc_sav_pro_typ_id'=>$this->input->post('sav_acc_sav_pro_typ_id'),
            //'sav_acc_create_date'=>  now(),
            //'sav_acc_modified_date'=>now(),
            'sav_acc_reference'=>'ddsadfadsf',//$this->input->post('sav_acc_reference'),
            //'sav_acc_con_id'=>$this->input->post('sav_acc_con_id'),
            'sav_use_id'=> $this->session->userdata('use_id'),
        );
        if($this->db->insert('saving_account',$data)) return TRUE;
        else return FALSE;
    }

    function get_saving_account(){
        $this->db->from('saving_account');
        $this->db->where('saving_account.status',1);
        $this->db->join('contacts','sav_acc_con_id=con_id');
        return $this->db->get();
    }
    
    function get_contacts(){
        $this->db->where('contacts.status',1);
        $data = $this->db->get('contacts');
        $array = null;
        if($data->num_rows() > 0){
            $array = $data;
        }
        return $array;
    }
}
?>
