<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of d_currencies
 *
 * @author sochy.choeun
 */
class m_currencies extends CI_Model{
    //put your code here
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
