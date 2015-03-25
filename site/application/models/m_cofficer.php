<?php

/**
 * Model work on contact page
 */
class M_cofficer extends m_global {

    public function __construct() {
        parent::__construct();
    }

    public function get_co_list() {
        $res = array();
        $this->db->select('co.*');
        $this->db->join('cro_of_branch cob', 'cob.crob_cro_id=co.co_id', 'inner');
        $this->db->join('branch b', 'b.bra_id=cob.crob_bra_id', 'inner');
        $this->db->where('cob.crob_status', 1);
        $this->db->where('b.bra_status', 1);
        $this->db->group_by('co.co_id');
        $query = $this->db->get('creadit_officer co');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $co_id = $row['co_id'];
                $brands = $this->select_data_join(
                        'cro_of_branch', 'branch.*', array('branch' => array('crob_bra_id' => 'bra_id')), array('crob_cro_id' => $co_id, 'crob_status' => 1, 'bra_status' => 1));
                $row['brands'] = $brands;
                $chief_id = $row['chif_co_id'];
                $chief = array();
                if ($chief_id > 0) {
//                    $chief = $this->select_data_join(
//                            'creadit_officer', '*', array(), array('chif_co_id' => $chief_id));
                     $chief = $this->select_data_join(
                            'creadit_officer', '*', array(), array('co_id' => $chief_id));
                }
                $row['chief_name'] = $chief ? $chief[0]['co_name'] : '';
                $res[] = $row;
            }
        }
        $query->free_result();
        return $res;
    }

    public function get_data_edit($id) {
        $res = array();
        $this->db->select('co.*,s.*');
        $this->db->where('co.co_id', $id);
        $this->db->where('s.cos_status', 1); ////select only current salary
        $this->db->join('creadit_officer_salary s', 's.cos_id=co.co_id', 'inner');
        $query = $this->db->get('creadit_officer co');
        if ($query->num_rows() > 0) {
            $tmp = $query->row();
            $co_id = $tmp->co_id;
            $branch = $this->select_data_join(
                    'cro_of_branch', 'branch.*', array('branch' => array('crob_bra_id' => 'bra_id')), array('crob_cro_id' => $co_id, 'crob_status' => 1, 'bra_status' => 1));
            $tmp->branch = $branch;
            $res = $tmp;
        }
        $query->free_result();
        return $res;
    }

    public function get_chief($id=NULL) {
        if($id!=NULL){
             $this->db->where('co_id !=', $id);
        }
        $this->db->select('co_id,co_name');
        $this->db->where('crob_status', 1);
        $this->db->where('co_position', 1);
        $this->db->join('cro_of_branch', 'crob_cro_id=co_id', 'inner');
        $res = array();
        $query = $this->db->get('creadit_officer');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $res[] = $row;
            }
        }
        $query->free_result();
        return $res;
    }

}

?>