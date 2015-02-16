<?php

/**
 * 	The controller to manage the contact of customer
 * @author PEN Vannak
 * @package Controller 
 * @updated 22-06-2013
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!is_login()) {
            $this->session->set_flashdata('error', '<div class="alert alert-error">Please login!!!</div>');
            redirect('users/login');
        }
    }

    public function index() {
        //select_join('tbl_contacts', array('tbl_users' => array('con_use_id' => 'use_id')),'inner',array('tbl_users.use_id' => 2),'30')
        $data['title'] = 'Contacts Manager';
        $data['query_all'] = $this->m_global->select_join('contacts', array('contacts_type' => array('con_con_typ_id' => 'con_typ_id'),
            'contacts_detail' => array('con_id' => 'con_det_con_id'),
            'contacts_job' => array('con_con_job_id' => 'con_job_id')
                ), 'inner', array('contacts.status' => 1), NULL, array('con_id' => 'DESC'));
        $this->load->view(MAIN_MASTER, $data);
    }

    public function add() {
        $data['title'] = 'Contacts Manager : Add';
        $data['query_job'] = $this->m_global->select_status('contacts_job');
        $data['query_income'] = $this->m_global->select_status('contacts_income');
        $data['query_pronvince'] = $this->m_global->select_all('provinces');
        $this->load->view(MAIN_MASTER, $data);
    }
	
	public function is_con_exist($cid){
		$res = 0;
		$query = $this->m_global->select_where('contacts',array('con_cid'=>$cid));
		if($query){
			$res = $query->num_rows();
		}
		return $res;
	}
	
    public function add_save() {
        if ($_POST) {
            $cid = substr(CONTACT_DIGIT, 0, -(strlen($this->input->post('txt_con_cid')))) . $this->input->post('txt_con_cid');
			
			if($this->is_con_exist($cid)){
				$res = array(
						'result'=>'error',
						'msg'=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Contact ID is already exists!</div>'
					);
				echo json_encode($res);
			}else{				
				//get data for primary contact
				$arr_contact = array(
					//'con_cid'=> $this->input->post('txt_con_cid'),
					'con_cid' => $cid,
					'con_con_typ_id' => (($this->input->post('txt_con_group') == 'group') ? 1 : 2),
					'con_kh_first_name' => $this->input->post('txt_con_kh_first_name'),
					'con_kh_last_name' => $this->input->post('txt_con_kh_last_name'),
					'con_kh_nickname' => $this->input->post('txt_con_kh_nick_name'),
					'con_en_first_name' => $this->input->post('txt_con_en_first_name'),
					'con_en_last_name' => $this->input->post('txt_con_en_last_name'),
					'con_en_nickname' => $this->input->post('txt_con_en_nick_name'),
					'con_sex' => $this->input->post('txt_con_sex'),
					'con_national_identity_card' => $this->input->post('txt_con_national_identity_card'),
					'con_con_job_id' => $this->input->post('txt_con_job'),
					'con_con_inc_id' => $this->input->post('txt_con_income'),
					'con_use_id' => $this->session->userdata('use_id'),
					'con_bra_id' => $this->session->userdata('bra_id')
				);
				$this->m_global->insert('contacts', $arr_contact);				
				//get last id
				$last_id = $this->m_global->insert_id();
				//$cid = substr(CONTACT_DIGIT, 0, -(strlen($last_id))).$last_id;
				//$this->m_global->update('contacts',array('con_cid'=>$cid),array('con_id'=>$last_id));
				$con_phones = $this->input->post('txt_con_phone');
				//get data of phone for primary contact
				$arr_phone = array();
				if (count($con_phones) > 0) {
					foreach ($con_phones as $phone) {
						array_push($arr_phone, array($last_id, $phone));
					}
				}
				$this->m_global->insert_multi('contacts_number', array('con_num_con_id', 'con_num_line'), $arr_phone);
				//insert detail contact
				$arr_contact_detail = array(
					'con_det_con_id' => $last_id,
					'con_det_email' => $this->input->post('txt_con_email'),
					'con_det_dob' => $this->input->post('txt_con_dob'),
					'con_det_pro_id' => $this->input->post('txt_con_province'),
					'con_det_dis_id' => $this->input->post('txt_con_district'),
					'con_det_com_id' => $this->input->post('txt_con_commune'),
					'con_det_vil_id' => $this->input->post('txt_con_village'),
					'con_det_address_detail' => $this->input->post('txt_con_address_detail'),
					'con_det_civil_status' => $this->input->post('txt_con_civil_status')
				);
				$this->m_global->insert('contacts_detail', $arr_contact_detail);
				//get status incase member married
				$con_det_civil_status = $this->input->post('txt_con_civil_status');
				if ($con_det_civil_status == 2) {
					$arr_contact_couple = array(
						'con_con_typ_id' => (($this->input->post('txt_con_group') == 'group') ? 1 : 2),
						'con_kh_first_name' => $this->input->post('txt_con_kh_first_name_couple'),
						'con_kh_last_name' => $this->input->post('txt_con_kh_last_name_couple'),
						'con_kh_nickname' => $this->input->post('txt_con_kh_nick_name_couple'),
						'con_en_first_name' => $this->input->post('txt_con_en_first_name_couple'),
						'con_en_last_name' => $this->input->post('txt_con_en_last_name_couple'),
						'con_en_nickname' => $this->input->post('txt_con_en_nick_name_couple'),
						'con_sex' => (($this->input->post('txt_con_sex') == 'm') ? 'f' : 'm'),
						'con_national_identity_card' => $this->input->post('txt_con_national_identity_card_couple'),
						'con_con_job_id' => $this->input->post('txt_con_job_couple'),
						'con_con_inc_id' => $this->input->post('txt_con_income_couple'),
						'con_use_id' => $this->session->userdata('use_id'),
						'con_bra_id' => $this->session->userdata('bra_id')
					);
					$this->m_global->insert('contacts', $arr_contact_couple);
					//get last id of couple
					$last_id_couple = $this->m_global->insert_id();
					$cid_couple = substr(CONTACT_DIGIT, 0, -(strlen($last_id_couple))) . $last_id_couple;
					$this->m_global->update('contacts', array('con_cid' => $cid_couple), array('con_id' => $last_id_couple));
					//update relationship contact couple
					$this->m_global->insert('contacts_couple', array('con_cou_owner' => $last_id, 'con_cou_couple' => $last_id_couple));
				}
				//get data for group contact TO SAVE
				if ($this->input->post('txt_con_group') == 'group') {
					//create new group list and get last id
					$this->m_global->insert('group', array('gro_title' => substr('G000000', 0, -(count($last_id))) . $last_id));
					$last_id_group = $this->m_global->insert_id();
					//insert primary contact to contacts_group table
					$this->m_global->insert('contacts_group', array('con_gro_con_id' => $last_id, 'con_gro_gro_id' => $last_id_group));
					//insert member involve with group
					$con_kh_first_name_group = $this->input->post('txt_con_kh_first_name_group');
					$con_kh_last_name_group = $this->input->post('txt_con_kh_last_name_group');
					$con_kh_nick_name_group = $this->input->post('txt_con_kh_nick_name_group');
					$con_en_first_name_group = $this->input->post('txt_con_en_first_name_group');
					$con_en_last_name_group = $this->input->post('txt_con_en_last_name_group');
					$con_en_nick_name_group = $this->input->post('txt_con_en_nick_name_group');
					$con_sex_group = $this->input->post('txt_con_sex_group');
					$con_con_job_group = $this->input->post('txt_con_job_group');
					$con_con_inc_group = $this->input->post('txt_con_income_group');
					$con_phone_group = $this->input->post('txt_con_phone_group');
					$con_national_identity_card_group = $this->input->post('txt_con_national_identity_card_group');
					if (count($con_en_first_name_group) > 0) {
						foreach ($con_en_first_name_group as $key => $value) {
							$arr_contact_group = array(
								'con_con_typ_id' => 1,
								'con_en_first_name' => $con_en_first_name_group[$key],
								'con_en_last_name' => $con_en_last_name_group[$key],
								'con_en_nickname' => $con_en_nick_name_group[$key],
								'con_kh_first_name' => $con_kh_first_name_group[$key],
								'con_kh_last_name' => $con_kh_last_name_group[$key],
								'con_kh_nickname' => $con_kh_nick_name_group[$key],
								'con_con_job_id' => $con_con_job_group[$key],
								'con_con_inc_id' => $con_con_inc_group[$key],
								'con_sex' => $con_sex_group[$key],
								'con_national_identity_card' => $con_national_identity_card_group[$key],
								'con_use_id' => $this->session->userdata('use_id'),
								'con_bra_id' => $this->session->userdata('bra_id')
							);
							$this->m_global->insert('contacts', $arr_contact_group);
							$last_id_contact_group = $this->m_global->insert_id();
							$cid_group = substr(CONTACT_DIGIT, 0, -(strlen($last_id_contact_group))) . $last_id_contact_group;
							$this->m_global->update('contacts', array('con_cid' => $cid_group), array('con_id' => $last_id_contact_group));
							//insert phone number to table contacts_number
							$this->m_global->insert('contacts_number', array('con_num_con_id' => $last_id_contact_group, 'con_num_line' => $con_phone_group[$key]));
							//update relationship contact and group contact
							$this->m_global->insert('contacts_group', array('con_gro_con_id' => $last_id_contact_group, 'con_gro_gro_id' => $last_id_group));
						}
					}
				}
				$this->session->set_flashdata('success','New contact has been created successfully!');
				$res = array(
						'result'=>'ok');
				echo json_encode($res);
			}
        } else {
            $res = array(
						'result'=>'error',
						'msg'=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No access without submit the form!</div>'
					);
			echo json_encode($res);
        }
    }

    public function edit() {
        $id = $this->input->post('check_select');
        $id = $id[0];
        //group
        $gtitle = substr('G000000', 0, -count($id)) . $id;
        $gId = $this->m_global->select_string('group', 'gro_id', array('gro_title' => $gtitle));

        $cid = $this->m_global->select_string('contacts', 'con_cid', array('con_id' => $id));
        $data['title'] = 'Contacts Manager : Edit (' . $cid . ')';
        $data['cm'] = $this->m_global->select_data_join_by(
                'contacts', '*', array(
            'contacts_type' => array('con_con_typ_id' => 'con_typ_id'),
            'contacts_job' => array('con_con_job_id' => 'con_job_id'),
            'contacts_income' => array('con_con_inc_id' => 'con_inc_id'),
            'contacts_detail' => array('con_id' => 'con_det_con_id')), array('con_id' => $id)
        );
        $data['cphone'] = $this->m_global->select_data_join(
                'contacts', 'contacts_number.*', array(
            'contacts_number' => array('con_id' => 'con_num_con_id')), array('con_id' => $id)
        );
        $data['couple'] = $this->m_global->select_data_join_by(
                'contacts', '*', array(
            'contacts_couple' => array('con_id' => 'con_cou_couple', 'join_type' => 'inner'),
            'contacts_number' => array('con_id' => 'con_num_con_id', 'join_type' => 'left')
                ), array('con_cou_owner' => $id)
        );

        $data['group'] = $this->m_global->select_data_join(
                'contacts', '*', array(
            'contacts_group' => array('con_id' => 'con_gro_con_id', 'join_type' => 'inner'),
            'contacts_number' => array('con_id' => 'con_num_con_id', 'join_type' => 'left')
                ), array('con_gro_gro_id' => $gId, 'con_id !=' => $id)
        );
        $data['group_id'] = ($gId == '' ? 0 : $gId);
        $data['query_job'] = $this->m_global->select_status('contacts_job');
        $data['query_income'] = $this->m_global->select_status('contacts_income');
        $data['query_pronvince'] = $this->m_global->select_all('provinces');
        $this->load->view(MAIN_MASTER, $data);
    }

    public function edit_save() {
        if ($_POST) {
            $use_id = $this->session->userdata('use_id');
            $bra_id = $this->session->userdata('bra_id');

            //get data for primary contact
            $cid = $this->input->post('cid');
            $contact = $this->input->post('info');
            $contact['con_use_id'] = $use_id;
            $contact['con_bra_id'] = $bra_id;
            //type of contact
            $con_type = $contact['con_con_typ_id'];

            $this->m_global->update('contacts', $contact, array('con_id' => $cid));

            $cphones = $this->input->post('phone');
            //get data of phone for primary contact			
            $this->m_global->delete('contacts_number', array('con_num_con_id' => $cid));
            if (count($cphones) > 0) {
                for ($ind = 0; $ind < count($cphones); $ind++) {
                    $cphones[$ind]['con_num_con_id'] = $cid;
                }
                $this->m_global->inserts('contacts_number', $cphones);
            }

            //update contact detail
            $cdetail = $this->input->post('detail');
            $this->m_global->update('contacts_detail', $cdetail, array('con_det_con_id' => $cid));

            //get status incase member married
            $civil_status = $cdetail['con_det_civil_status'];
            $couple_id = $this->input->post('couple_id');
            if ($civil_status == 2) {
                //todo update couple				
                $couple = $this->input->post('couple');

                $couple['con_con_typ_id'] = $con_type;
                $couple['con_use_id'] = $use_id;
                $couple['con_bra_id'] = $bra_id;
                unset($couple['con_id']);

                $couple_phone = $couple['phone'];
                unset($couple['phone']);

                if ($couple_id > 0) {
                    $this->m_global->update('contacts', $couple, array('con_id' => $couple_id));
                    $this->m_global->delete('contacts_number', array('con_num_con_id' => $couple_id));
                    $couple_phone['con_num_con_id'] = $couple_id;
                    $this->m_global->insert('contacts_number', $couple_phone);
                } else {
                    //get last id of couple
                    $this->m_global->insert('contacts', $couple);
                    $last_id_couple = $this->m_global->insert_id();
                    $cid_couple = substr(CONTACT_DIGIT, 0, -(strlen($last_id_couple))) . $last_id_couple;
                    $this->m_global->update('contacts', array('con_cid' => $cid_couple), array('con_id' => $last_id_couple));
                    //update relationship contact couple
                    $couple_phone['con_num_con_id'] = $last_id_couple;
                    $this->m_global->insert('contacts_number', $couple_phone);
                    $this->m_global->insert('contacts_couple', array('con_cou_owner' => $cid, 'con_cou_couple' => $last_id_couple));
                }
            } else {
                $this->m_global->delete('contacts_number', array('con_num_con_id' => $couple_id));
                $this->m_global->delete('contacts_couple', array('con_cou_couple' => $couple_id));
                $this->m_global->delete('contacts', array('con_id' => $couple_id));
            }

            //get data for group contact			
            $group_id = (int) $this->input->post('group_id');
            if ($con_type == 1) {
                //insert member involve with group
                $groups = $this->input->post('group');
                if (!$group_id) {
                    $filter = array('gro_title' => substr('G000000', 0, -(count($cid))) . $cid);
                    $this->m_global->insert('group', $filter);
                    $group_id = (int) $this->m_global->insert_id();
                }
                foreach ($groups as $group) {
                    $group['con_con_typ_id'] = $con_type;
                    $group['con_use_id'] = $use_id;
                    $group['con_bra_id'] = $bra_id;

                    $group_phone = $group['phone'];
                    $group_con_id = $group['con_id'];
                    unset($group['phone']);
                    unset($group['con_id']);

                    if ($group_con_id > 0) {
                        $this->m_global->update('contacts', $group, array('con_id' => $group_con_id));
                        $this->m_global->delete('contacts_number', array('con_num_con_id' => $group_con_id));
                        $group_phone['con_num_con_id'] = $group_con_id;
                        $this->m_global->insert('contacts_number', $group_phone);
                    } else {
                        $this->m_global->insert('contacts', $group);
                        $last_id_contact_group = $this->m_global->insert_id();
                        $cid_group = substr(CONTACT_DIGIT, 0, -(strlen($last_id_contact_group))) . $last_id_contact_group;
                        $this->m_global->update('contacts', array('con_cid' => $cid_group), array('con_id' => $last_id_contact_group));
                        //insert phone number to table contacts_number
                        $group_phone['con_num_con_id'] = $last_id_contact_group;
                        $this->m_global->insert('contacts_number', $group_phone);
                        //update relationship contact and group contact
                        $this->m_global->insert('contacts_group', array('con_gro_con_id' => $last_id_contact_group, 'con_gro_gro_id' => $group_id));
                    }
                }
                if ($group_id > 0) {
                    $_con_gro_con_id = $this->m_global->select_string('contacts_group', 'con_gro_con_id', array('con_gro_con_id' => $cid, 'con_gro_gro_id' => $group_id));
                    if ($_con_gro_con_id == '') {
                        $this->m_global->insert('contacts_group', array('con_gro_con_id' => $cid, 'con_gro_gro_id' => $group_id));
                    }
                }
            } else {
                if ($group_id > 0) {
                    $groups = $this->m_global->select_data_join(
                            'contacts', '*', array(
                        'contacts_group' => array('con_id' => 'con_gro_con_id', 'join_type' => 'inner')
                            ), array('con_gro_gro_id' => $group_id, 'con_id !=' => $cid, 'status' => 1)
                    );
                    foreach ($groups as $group) {
                        $_con_id = $group['con_id'];
                        $this->m_global->delete('contacts_number', array('con_num_con_id' => $_con_id));
                        $this->m_global->delete('contacts', array('con_id' => $_con_id));
                    }
                    $this->m_global->delete('contacts_group', array('con_gro_gro_id' => $group_id));
                    $this->m_global->delete('group', array('gro_id' => $group_id));
                }
            }

            $this->session->set_flashdata('success', 'New contact has been created successfully!');
            redirect(site_url('contacts'));
        } else {
            $this->session->set_flashdata('error', 'No access without submit the form!');
            redirect(site_url('contacts'));
        }
    }

    public function delete() {
        $ids = $this->input->post('check_select');
        foreach ($ids as $id) {
            $gtitle = substr('G000000', 0, -count($id)) . $id;
            $groups = $this->m_global->select_data_join(
                    'contacts_group', 'con_gro_con_id', array('group' => array('con_gro_gro_id' => 'gro_id')), array('gro_title' => $gtitle, 'status' => 1)
            );
            $data = array('status' => 0);
            if (empty($groups)) {
                $this->m_global->update('contacts', $data, array('con_id' => $id));
                $this->m_global->update('contacts_number', $data, array('con_num_con_id' => $id));
            } else {
                foreach ($groups as $group) {
                    $con_id = $group['con_gro_con_id'];
                    $this->m_global->update('contacts', $data, array('con_id' => $con_id));
                    $this->m_global->update('contacts_number', $data, array('con_num_con_id' => $con_id));
                }
                $this->m_global->update('group', $data, array('gro_title' => $gtitle));
            }
        }
        redirect(site_url('contacts'));
    }

}

?>