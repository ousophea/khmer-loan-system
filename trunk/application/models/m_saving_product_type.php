<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_saving_product_type
 *
 * @author sochy.choeun
 */
class m_saving_product_type extends CI_Model {
    //put your code here

    function get_product_type_array(){
        $array = null;
        $this->db->where('status',1);
        $data = $this->db->get('saving_product_type');
        foreach ($data->result() as $row) {
            $array[$row->sav_pro_typ_id] = $row->sav_pro_typ_title;
        }
        return $array;
    }
}
?>
