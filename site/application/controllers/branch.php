<?php

/**
 * 	The controller to manage the contact of customer
 * @author DIM Bunthoeurn
 * @package Controller 
 * @updated 22-06-2013
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!is_login()) {
            $this->session->set_flashdata('error', '<div class="alert alert-error">Please login!!!</div>');
            redirect('users/login');
        }
    }

    function validate_branch($str) {
        $bra_name = $str;
        $query = $this->m_global->select_where('branch', array('bra_name' => $bra_name, 'bra_status' => 1));
        if ($query->num_rows) {
            $this->form_validation->set_message('validate_branch', 'Branch already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function index() {
        //select_join('tbl_contacts', array('tbl_users' => array('con_use_id' => 'use_id')),'inner',array('tbl_users.use_id' => 2),'30')
        $data['title'] = 'Branch Manager';
        $data['data'] = $this->m_global->select_where('branch', array('bra_status' => 1),NULL,array('bra_name'=>"asc"));
        $this->load->view(MAIN_MASTER, $data);
    }

    public function add() {
        $data['title'] = 'Branch Manager : Add';
        if ($_POST) {
            $this->form_validation->set_rules('txt_branch_name', 'Branch Name', 'required|callback_validate_branch');
            $this->form_validation->set_rules('txt_branch_address', 'Branch Address', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view(MAIN_MASTER, $data);
            } else {
                //get data for branch
                $arr_branch = array(
                    'bra_name' => $this->input->post('txt_branch_name'),
                    'bra_address' => $this->input->post('txt_branch_address')
                );
                $this->m_global->insert('branch', $arr_branch);
                $this->session->set_flashdata('success', 'New branch has been created successfully!');
                redirect(site_url('branch'));
            }
        }

        $this->load->view(MAIN_MASTER, $data);
    }

    public function checkBranch($id) {
        $res = 0;
        $bId = $this->m_global->select_string('branch', 'bra_id', array('bra_id' => $id));
        if ($bId > 0) {
            $res = $this->m_global->select_string('branch', 'bra_id', array('bra_id' => $bId));
        }
        return $res;
    }

    public function edit($id) {
        $data['title'] = 'Branch Manager : Edit';
        $this->form_validation->set_rules('bra_name', 'branch name', 'required|trim|callback_edit_unique[' . $id . ']');
        $this->form_validation->set_rules('bra_address', 'Branch Address', 'trim');
        if ($this->form_validation->run() == FALSE) {
//            $id = $this->input->post('check_select');
//            $id = $id[0];
//            $idHG = $this->checkBranch($id);
//            if ($idHG) {
//                $id = $idHG;
//            }
            $data['br'] = $this->m_global->select_data_where('branch', array('bra_id' => $id), 1);
//            $data['ids'] = $this->input->post('check_select');
            $this->load->view(MAIN_MASTER, $data);
        } else {
            //get selected branch id
            $brid = $this->input->post('bra_id');
//            echo $brid;exit();
            //update branch
            $cdetail = $this->input->post();
            $this->m_global->update('branch', $cdetail, array('bra_id' => $brid));

            $this->session->set_flashdata('success', 'Brand have update successfully!');
            redirect(site_url('branch'));
        }
    }

    public function edit_save() {
        if ($_POST) {

            //get selected branch id
            $brid = $this->input->post('brId');
            //update branch
            $cdetail = $this->input->post('branch');
            $this->m_global->update('branch', $cdetail, array('bra_id' => $brid));

            $this->session->set_flashdata('success', 'New contact has been created successfully!');
            redirect(site_url('branch'));
        } else {
            $this->session->set_flashdata('error', 'No access without submit the form!');
            redirect(site_url('contacts'));
        }
    }

//    public function delete() {
//        $ids = $this->input->post('check_select');
//        foreach ($ids as $id) {
//            $data = array('bra_status' => 0);
//            if ($this->checkBranch($id)) {
//                $this->m_global->update('branch', $data, array('bra_id' => $id));
//            }
//        }
//        redirect(site_url('branch'));
//    }
    public function delete($id) {

        $data = array('bra_status' => 0);
         $result =$this->m_global->update('branch', $data, array('bra_id' => $id));
         if($result){
          $this->session->set_flashdata('success', 'Branch delete successfully!');
         }  else {
             $this->session->set_flashdata('error', 'Error, can not delete data your required!');
         }
        redirect(site_url('branch'));
    }

    function edit_unique($value, $current_id) {
        $query = $this->m_global->select_where('branch', array('bra_name' => $value, 'bra_status' => 1, 'bra_id !=' => $current_id), 1);
        if ($query->num_rows() > 0) { // if input is not not not the same other recode
            $this->form_validation->set_message('edit_unique', 'The %s  "' . $value . '" is already being used.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
