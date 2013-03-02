<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author sochy.choeun
 */
class users extends CI_Controller {

    //put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model(array('s_users', 'd_users','d_roles','s_roles'));
        $this->data['dbf'] = new dbf();
    }

    function index() {


        $this->load->view("layouts/defualt", $this->data);
    }

    function login() {
        try {
            $dbf = $this->data['dbf'];
            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            $this->form_validation->set_rules($dbf->getF_username(), 'Username', 'required');
            $this->form_validation->set_rules($dbf->getF_password(), 'Password', 'required');
            if ($this->form_validation->run() == FALSE)
                $this->load->view('layouts/users', $this->data);
            else {
                $s_user_obj = new s_users();
                $s_user_obj->setUsername($this->input->post($dbf->getF_username()));
                $s_user_obj->setPassword(md5($this->input->post($dbf->getF_password())));
                if ($this->d_users->getLogin($s_user_obj))
                    redirect ('users');
                else{
                    $this->data['login'] = '<div class="alert alert-error">Username and Password incorrect.</div>';
                    $this->load->view('layouts/users', $this->data);
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function go_register() {
        $this->load->view('register', $this->data);
    }

    /**
     * 
     */
    function register() {
        try {
            $dbf = $this->data['dbf'];
            $this->form_validation->set_rules($dbf->getF_Username(), 'Username', 'required|min_length[5]|max_length[30]|is_unique[' . $dbf->getT_users() . '.' . $dbf->getF_username() . ']');
            $this->form_validation->set_rules($dbf->getF_password(), 'Password', 'required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules($dbf->getF_password() . 'c', 'Password confirmation', 'required|matches[' . $dbf->getF_password() . ']');
            $this->form_validation->set_rules($dbf->getF_rol_id(), 'Role', 'required');
            $this->form_validation->set_message('is_unique', 'Username aready exist.');
            
            if ($this->form_validation->run() == FALSE) {
                $obj = new s_roles();
                $this->data['roles'] = $this->d_roles->getAllRoles($obj);
                $this->load->view('layouts/users', $this->data);
            } else {
                $s_user_obj = new s_users();
                $s_user_obj->setUsername($this->input->post($dbf->getF_username()));
                $s_user_obj->setRole($this->input->post($dbf->getF_rol_id()));
                $s_user_obj->setPassword(md5($this->input->post($dbf->getF_password())));
                //$s_user_obj->setDbf($dbf);
                if ($this->d_users->getRegister($s_user_obj))
                    redirect('users/login');
                else {
                    
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * 
     * @param type $str
     * @return boolean
     */
    public function is_login($str) {
        if ($str == 'test') {
            $this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function welcome() {
        $this->load->view('welcome_message');
    }

}

?>
