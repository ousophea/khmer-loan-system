<?php
/**
 *	The controller to manage the contact of customer
 * @author PEN Vannak
 * @package Controller 
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Contacts extends CI_Controller {
     
	public function __construct() {
		parent::__construct();
		if(!is_login()){
            $this->session->set_flashdata('error','<div class="alert alert-error">Please login!!!</div>');
            redirect('users/login');
        }
	}
	 
	public function index(){
		//select_join('tbl_contacts', array('tbl_users' => array('con_use_id' => 'use_id')),'inner',array('tbl_users.use_id' => 2),'30')
		$data['title'] = 'Contacts Manager';
		$data['query_all'] = $this->m_global->select_join('contacts',array('contacts_type' => array('con_con_typ_id' => 'con_typ_id'),'contacts_detail' => array('con_id' => 'con_det_con_id'), 'contacts_job' => array('con_con_job_id' => 'con_job_id')),'inner');
 		$this->load->view(MAIN_MASTER,$data);
	}
	
	public function add(){
		$data['title'] = 'Contacts Manager : Add';
		$this->load->view('master_page',$data);
	}
	
	public function add_save(){
		if($_POST){
			//get data for primary contact
			$arr_contact = array(
				'con_con_typ_id' => (($this->input->post('txt_con_group') == 'group')?1:2),
				'con_kh_first_name' => $this->input->post('txt_con_kh_first_name'),
				'con_kh_last_name' => $this->input->post('txt_con_kh_last_name'),
				'con_en_first_name' => $this->input->post('txt_con_en_first_name'),
				'con_en_last_name' => $this->input->post('txt_con_en_last_name'),
				'con_sex' => $this->input->post('txt_con_sex'),
				'con_national_identity_card' => $this->input->post('txt_con_national_identity_card'),
				'con_email' => $this->input->post('txt_con_email')
			);
			$this->m_global->insert('contacts',$arr_contact);
			//update cid
			$last_id = $this->m_global->insert_id();
			$cid = substr('000000', 0, -(count($last_id))).$last_id;
			$this->m_global->update('contacts',array('con_cid'=>$cid),array('con_id'=>$last_id));
			//get last id
			$con_phones = $this->input->post('txt_con_phone');
			//get data of phone for primary contact
			$arr_phone = array();
			if(count($con_phones) > 0){
				foreach($con_phones as $phone){
					array_push($arr_phone,array($last_id,$phone));
				}
			}
			$this->m_global->insert_multi('contacts_number',array('con_num_con_id','con_num_line'),$arr_phone);
			//insert detail contact
			$arr_contact_detail = array(
				'con_det_con_id' => $last_id,
				'con_det_civil_status' => $this->input->post('txt_con_civil_status'),
				'con_det_dob' => $this->input->post('txt_con_dob'),
				'con_det_job' => $this->input->post('txt_con_job'),
				'con_det_address' => $this->input->post('txt_con_address'),
				'con_det_income' => $this->input->post('txt_con_income').$this->input->post('txt_con_income_currency')
			);
			$this->m_global->insert('contacts_detail',$arr_contact_detail);
			//get data for group contact
			if($this->input->post('txt_con_group') == 'group'){
				//create new group list and get last id
				$this->m_global->insert('group',array('gro_title'=>substr('G000000', 0, -(count($last_id))).$last_id));
				$last_id_group = $this->m_global->insert_id();
				//insert primary contact to contacts_group table
				$this->m_global->insert('contacts_group',array('con_gro_con_id'=>$last_id,'con_gro_gro_id'=>$last_id_group));
				//insert member involve with group
				$con_kh_first_name_group = $this->input->post('txt_con_kh_first_name_group');
				$con_kh_last_name_group = $this->input->post('txt_con_kh_last_name_group');
				$con_en_first_name_group = $this->input->post('txt_con_en_first_name_group');
				$con_en_last_name_group = $this->input->post('txt_con_en_last_name_group');
				$con_sex_group = $this->input->post('txt_con_sex_group');
				$con_phone_group = $this->input->post('txt_con_phone_group');
				$con_national_identity_card_group = $this->input->post('txt_con_national_identity_card_group');
				$con_email_group = $this->input->post('txt_con_email_group');
				if(count($con_en_first_name_group) > 0){
					foreach($con_en_first_name_group as $key=>$value){
						$arr_contact_group = array(
							'con_con_typ_id' => 1,
							'con_en_first_name' => $con_en_first_name_group[$key],
							'con_en_last_name' => $con_en_last_name_group[$key],
							'con_kh_first_name' => $con_kh_first_name_group[$key],
							'con_kh_last_name' => $con_kh_last_name_group[$key],
							'con_sex' => $con_sex_group[$key],
							'con_national_identity_card' => $con_national_identity_card_group[$key],
							'con_email' => $con_email_group[$key]
						);
						$this->m_global->insert('contacts',$arr_contact_group);
						$last_id_contact_group = $this->m_global->insert_id();
						$cid_group = substr('000000', 0, -(count($last_id_contact_group))).$last_id_contact_group;
						$this->m_global->update('contacts',array('con_cid'=>$cid_group),array('con_id'=>$last_id_contact_group));
						//insert phone number to table contacts_number
						$this->m_global->insert('contacts_number',array('con_num_con_id'=>$last_id_contact_group,'con_num_line'=>$con_phone_group[$key]));
						//update relationship contact and group contact
						$this->m_global->insert('contacts_group',array('con_gro_con_id'=>$last_id_contact_group,'con_gro_gro_id'=>$last_id_group));
					}
				}
			}
			$this->session->set_flashdata('success','New contact has been created successfully!');
			redirect(site_url('contacts'));
		}else{
			$this->session->set_flashdata('error','No access without submit the form!');
			redirect(site_url('contacts'));
		}
	}
	
	public function edit(){
		
	}
	
	public function delete(){
		
	}
}
 
?>