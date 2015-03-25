<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cofficer extends CI_Controller {

    private $_redirect;

    public function __construct() {
        parent::__construct();
        $this->_redirect = site_url('cofficer');
        $this->load->model('m_cofficer');
        if (!is_login()) {
            $this->session->set_flashdata('error', '<div class="alert alert-error">Please login!!!</div>');
            redirect('users/login');
        }
    }

    public function index() {
        $data['title'] = 'Credit Officer Manager';
        $data['data'] = $this->m_cofficer->get_co_list();
        $this->load->view(MAIN_MASTER, $data);
    }

    public function add() {
        $data['title'] = 'Credit Officer Manager : Add';
//        $chiefs = $this->m_global->select_data_join('creadit_officer', 'co_id,co_name', array(), array('co_position' => 1));
        $chiefs = $this->m_cofficer->get_chief();
        $data['chiefs'] = $this->get_dropdown($chiefs, 'co_id', 'co_name');
        $brands = $this->m_global->select_data_join('branch', 'bra_id,bra_name', array(), array('bra_status' => 1));
        $data['brands'] = $this->get_dropdown($brands, 'bra_id', 'bra_name');
        $this->load->view(MAIN_MASTER, $data);
    }

    public function get_dropdown($data = array(), $field_key, $field_value) {
        $res = array();
        foreach ($data as $row) {
            $res[$row[$field_key]] = $row[$field_value];
        }
        return $res;
    }

    public function save() {
        if ($_POST) {
            //get data for primary contact
            $cofficer = $this->input->post('cofficer');
            $this->m_global->insert('creadit_officer', $cofficer);
            $crob_cro_id = $this->m_global->insert_id();

            // add salary
            $salary = $this->input->post('salary');
            $co_salary_info = array(
                'cos_id' => $crob_cro_id,
                'cos_salary' => $salary,
                'cos_date_create' => date('y-m-d h:i:s')
            );
            $this->m_global->insert('creadit_officer_salary', $co_salary_info);

            //todo add branch
            $branches = $this->input->post('branches');
            if (count($branches) > 0) {
                $data = array();
                foreach ($branches as $branch) {
                    $data[] = array($crob_cro_id, $branch);
                }
                $this->m_global->insert_multi('cro_of_branch', array('crob_cro_id', 'crob_bra_id'), $data);
            }
            $this->session->set_flashdata('success', 'Creadit officer has been created successfully!');
        } else {
            $this->session->set_flashdata('error', 'No access without submit the form!');
        }
        redirect($this->_redirect);
    }

    public function addsalary() {
        $data['title'] = 'Increas salary';
        $this->load->view(MAIN_MASTER, $data);
    }

    public function inc_salary() {
        $salary = $this->input->post('salary');
        $id = $this->input->post('cos_id');

//            Update old salary
        $co_salary_info = array(
            'cos_date_modified' => date('y-m-d h:i:s'),
            'cos_status'=>0
        );
        $this->m_global->update('creadit_officer_salary', $co_salary_info, array('cos_id' => $id, 'cos_status' => 1));
//            Add new salary incress            

        $co_salary_info = array(
            'cos_id' => $id,
            'cos_salary' => $salary,
            'cos_date_create' => date('y-m-d h:i:s')
        );
        $ms = $this->m_global->insert('creadit_officer_salary', $co_salary_info);
//                        echo $ms;
    }

    public function edit() {
        $id = $this->input->post('check_select');
        $id = $id[0];
        $data['id'] = $id;
        $data['title'] = 'Credit Officer Manager : Edit';
//        $chiefs = $this->m_cofficer->select_data_join('creadit_officer', 'co_id,co_name', array(), array('co_position' => 1));
        $chiefs = $this->m_cofficer->get_chief($id);
        $data['chiefs'] = $this->get_dropdown($chiefs, 'co_id', 'co_name');
        $brands = $this->m_cofficer->select_data_join('branch', 'bra_id,bra_name', array(), array('bra_status' => 1));
        $data['brands'] = $this->get_dropdown($brands, 'bra_id', 'bra_name');
        $data['data'] = $this->m_cofficer->get_data_edit($id);
        $this->load->view(MAIN_MASTER, $data);
    }

    public function update($id = 0) {
        if ($_POST) {
            //get data for primary contact
            $cofficer = $this->input->post('cofficer');
            $this->m_global->update('creadit_officer', $cofficer, array('co_id' => $id));
            $crob_cro_id = $id;
            //update salary
            $salary = $this->input->post('salary');
            $co_salary_info = array(
                'cos_salary' => $salary,
                'cos_date_modified' => date('y-m-d h:i:s')
            );
            $this->m_global->update('creadit_officer_salary', $co_salary_info, array('cos_id' => $id, 'cos_status' => 1));

            //todo add branch
            $branches = $this->input->post('branches');
            if (count($branches) > 0) {
                $tmp = $this->m_cofficer->select_data_join('cro_of_branch', '*', array(), array('crob_cro_id' => $crob_cro_id, 'crob_status' => 1));
                //todo update what we don't have
                foreach ($tmp as $item) {
                    $_crob_cro_id = $item['crob_cro_id'];
                    $_crob_bra_id = $item['crob_bra_id'];
                    if (!in_array($_crob_bra_id, $branches)) {
                        $this->m_global->update('cro_of_branch', array('crob_status' => 0), array('crob_cro_id' => $_crob_cro_id, 'crob_bra_id' => $_crob_bra_id));
                    }
                }
                $data = array();
                foreach ($branches as $branch) {
                    if (!$this->checkInBranch($branch, $tmp)) {
                        $data[] = array($crob_cro_id, $branch);
                    }
                }
                if ($data) {
                    $this->m_global->insert_multi('cro_of_branch', array('crob_cro_id', 'crob_bra_id'), $data);
                }
            }
            $this->session->set_flashdata('success', 'Creadit offficer has been updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'No access without submit the form!');
        }
        redirect($this->_redirect);
    }

    public function checkInBranch($check, $data) {
        foreach ($data as $row) {
            if ($row['crob_bra_id'] == $check)
                return true;
        }
        return false;
    }

    public function ajax_check_exist() {
        $card_id = $this->input->post('card_id');
        $data = $this->m_global->select_data_join_by('creadit_officer', '*', array(), array('co_card_id' => $card_id));
        $res = array('result' => 'ok');
        if ($data) {
            $res = array('result' => 'exists', 'data' => $data);
        }
        echo json_encode($res);
    }

    public function delete() {
        $ids = $this->input->post('check_select');
        foreach ($ids as $id) {
            $this->m_global->update('cro_of_branch', array('crob_status' => 0), array('crob_cro_id' => $id));
        }
        redirect(site_url('cofficer'));
    }

}

?>