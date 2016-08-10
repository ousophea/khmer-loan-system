<?php

/**
 * Model work on contact page
 */
class M_contacts extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function select_contacts() {
        $this->db->where('status', 1);
        return $this->db->get('contacts');
    }

    public function getAllConatact() {
        $this->db->where('contacts.status', 1);
        $this->db->join('contacts_detail', 'con_id=con_det_con_id');
        $this->db->join('contacts_type', 'con_con_typ_id=con_typ_id');
//        ============ More detail about contact ============
        $this->db->join('provinces', 'contacts_detail.con_det_pro_id=provinces.pro_id', 'left');
        $this->db->join('districts', 'contacts_detail.con_det_dis_id=districts.dis_id', 'left');
        $this->db->join('communes', 'contacts_detail.con_det_com_id=communes.com_id', 'left');
        $this->db->join('villages', 'contacts_detail.con_det_vil_id=villages.vil_id', 'left');
//        ======================= end contact===========================
        $query = $this->db->get('contacts');
    }

}

?>