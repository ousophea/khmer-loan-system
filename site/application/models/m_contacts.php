<?php
/**
 * Model work on contact page
 */
class M_contacts extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function select_contacts(){
		$this->db->where('status',1);
		return $this->db->get('contacts');
	}

}
?>