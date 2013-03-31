<?php
/**
 *	The controller to manage the contact of customer
 * @author PEN Vannak
 * @package Controller 
 * 
 */

class Contacts extends CI_Controller {
     
	public function __construct() {
		parent::__construct();
	}
	 
	public function index(){
		$data['title'] = 'Contacts Manager';
		$data['query_all'] = $this->m_global->select_all('contacts','50');
 		$this->load->view('master_page',$data);
	}
}
 
?>