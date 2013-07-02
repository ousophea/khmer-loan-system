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
            'sav_acc_code'=>'168-'.$this->input->post('con_cid').'-'.$this->input->post('currency'),
            'sav_acc_sav_pro_typ_id'=>$this->input->post('sav_acc_sav_pro_typ_id'),
            //'sav_acc_create_date'=>  now(),
            //'sav_acc_modified_date'=>now(),
            'sav_acc_reference'=>'ddsadfadsf',//$this->input->post('sav_acc_reference'),
            'sav_acc_con_id'=>$this->input->post('cid'),
            'sav_acc_gl_id'=>$this->input->post('glcode'),
            'sav_acc_cur_id'=>$this->input->post('currency'),
            'sav_use_id'=> $this->session->userdata('use_id'),
        );
        if($this->db->insert('saving_account',$data)) return TRUE;
        else return FALSE;
    }

    function get_saving_account(){
        $this->db->from('saving_account');
        $this->db->where('saving_account.sav_acc_status',1);
        $this->db->join('contacts','sav_acc_con_id=con_id');
        $this->db->join('currency','sav_acc_cur_id=cur_id');
        $this->db->join('saving_product_type','sav_pro_typ_id=sav_acc_sav_pro_typ_id');
        $this->db->join('gl_list','sav_acc_gl_id=gl_id');
        return $this->db->get();
    }
    
    function get_contacts(){
        $this->db->where('contacts.status',1);
        $this->db->join('contacts_detail','con_id=con_det_con_id');
        $this->db->join('contacts_type','con_typ_id=con_con_typ_id');
        $data = $this->db->get('contacts');
        $array = null;
        if($data->num_rows() > 0){
            $array = $data;
        }
        return $array;
    }
    
    function find_contact_by_code($con_cid){
        $this->db->where('con_id',$con_cid);
        $this->db->where('con_status',1);
        $this->db->join('contacts_detail','con_id=con_det_con_id');
        $this->db->join('contacts_type','con_typ_id=con_con_typ_id');
        $query = $this->db->get('contacts');
        $data=null;
        foreach ($query->result() as $row){
            $data['con_id'] = $row->con_id;
            $data['con_en_name'] = $row->con_en_name;
            $data['con_kh_name'] = $row->con_kh_name;
            $data['con_address'] = $row->con_address;
            $data['con_dob'] = $row->con_dob;
            $data['con_typ_title'] = $row->con_typ_title;
            break;
        }
        return $data;
    }
    
    function delete_saving_account_by_id(){
        
        for ($k = 0; $k < count($_POST['child_check']); $k++) {
            $id = $_POST['child_check'][$k];
            $this->db->where('sav_acc_id', $id);
            $this->db->delete('saving_account');
        }
        return true;
    }
    
    function find_gl_code_for_dropdown(){
        
        $data =  $this->db->get('gl_list');
        $result[''] = '--- Select GL Code ---';
        if($data->num_rows() > 0){
            foreach ($data->result() as $row){
                $result[$row->gl_id] = $row->gl_code.':'.$row->gl_description;
            }
            return $result;
        }
        else
            return $result;
    }
    
    function find_currencies_for_dropdown(){
        
        $this->db->where('cur_status',1);
        $data =  $this->db->get('currency');
        $result[''] = '--- Select Currency ---';
        if($data->num_rows() > 0){
            foreach ($data->result() as $row){
                $result[$row->cur_id] = $row->cur_title;
            }
            return $result;
        }
        else
            return $result;
    }
}
?>
