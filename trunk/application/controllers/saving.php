<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of saving
 *
 * @author sochy.choeun
 */
class saving extends CI_Controller {

    //put your code here
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_saving_product_type', 'm_saving'));
    }

    function index() {
        redirect('saving/lists');
    }

    function open() {
        allows(array(Setting::$role0, Setting::$role1));
        $this->data['title'] = 'Open saving account';
        $product_type = $this->m_saving_product_type->get_product_type_array();
        $this->data['product_type'] = $product_type;
        $contracts = $this->m_saving->get_contacts();
        $gl = $this->m_saving->find_gl_code_for_dropdown();
        $currency = $this->m_saving->find_currencies_for_dropdown();
        $this->data['contacts'] = $contracts;
        $this->data['currency'] = $currency;
        $this->data['gl'] = $gl;
        $this->data['signature_rule'] = $this->m_saving->find_signature_rule_for_dropdown();
        $this->data['upload'] = 0;

        if ($product_type == NULL) {
            $this->session->set_flashdata('error', '<div class="alert alert-error">Saving product type is empty, please add new saving product type first.</div>');
            redirect('saving/lists');
        }
        if ($contracts->num_rows() == NULL) {
            $this->session->set_flashdata('error', '<div class="alert alert-error">Contract is empty, please add contract first.</div>');
            redirect('saving/lists');
        }

        $this->form_validation->set_rules('cid', 'Contact information,Enter CID and click button search.', 'required|is_unique[saving_account.sav_acc_con_id]');
        $this->form_validation->set_rules('sav_acc_sav_pro_typ_id', 'Product type', 'required');
        $this->form_validation->set_rules('currency', 'Currency', 'required');
        $this->form_validation->set_rules('gl_id', 'GL code', 'required');
        $this->form_validation->set_rules('con_cid', 'CID', 'required');
        $this->form_validation->set_rules('sign_rule', 'Sign Rule', 'required');
        //$this->form_validation->set_rules('dispayname', 'Display name', 'required');
        $this->form_validation->set_message('is_unique', 'CID "' . $this->input->post('con_cid') . '" already has saving account. Try another CID');
        if ($this->form_validation->run() == FALSE)
            $this->load->view(Variables::$layout_main, $this->data);
        else {

            $config['upload_path'] = './images/upload/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            $config['max_width'] = 200;
            $config['max_height'] = 200;
            $this->load->library('upload', $config);
            $this->load->library('image_lib');

            if (!$this->upload->do_upload()) {
                $data['upload'] = $this->upload->display_errors();
                $this->load->view(Variables::$layout_main, $this->data);
            }
            // DB-------------
            //-----------------
            $file = $this->upload->data();
            if ($this->m_saving->add($file['file_name'])) {
                $this->session->set_flashdata('success', 'A saving account has been saved');
                redirect('saving/lists');
            } else {
                $this->load->view(Variables::$layout_main, $this->data);
            }
        }
    }

    function lists() {
        allows(array(Setting::$role0, Setting::$role1));
        $this->data['title'] = 'List saving accounts';
        $this->data['saving_account'] = $this->m_saving->get_saving_account();
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function find_contact_by_code() {
        allows(array(Setting::$role0, Setting::$role1));
        $contact = $this->m_saving->find_contact_by_code($this->input->post('con_cid'));
        if ($contact != NULL)
            echo json_encode($contact);
        else
            echo json_encode(array('result' => 0));
    }

    function find_gl_by_product_type_id() {
        allows(array(Setting::$role0, Setting::$role1));
        $contact = $this->m_saving->find_gl_by_product_type_id($this->input->post('id'));
        if ($contact != NULL)
            echo json_encode($contact);
        else
            echo json_encode(array('result' => 0));
    }

    function delete() {
        allows(array(Setting::$role0, Setting::$role1));
        if ($this->m_saving->delete_saving_account_by_id()) {
            $this->session->set_flashdata('success', 'Saving account(s) has been deleted.');
            redirect('saving/lists');
        } else {
            $this->session->set_flashdata('error', 'Saving account(s) could not deleted');
            redirect('saving/lists');
        }
    }

}

?>
