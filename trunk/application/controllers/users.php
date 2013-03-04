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
        if(!$this->session->userdata($this->data['dbf']->getF_username())){
            redirect('users/login');
        }
        $this->data['username'] = ($this->session->userdata($this->data['dbf']->getF_username()))?$this->session->userdata($this->s_users->getF_username()):null;
        $this->data['role'] = ($this->session->userdata($this->data['dbf']->getF_rol_name()))?$this->session->userdata($this->data['dbf']->getF_rol_name()):'Test';
        $this->load->view("layouts/defualt", $this->data);
    }

    function login() {
        try {
            if($this->session->userdata($this->data['dbf']->getF_username())){
                redirect('users');
            }
            $dbf = $this->data['dbf'];
            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            $this->form_validation->set_rules($dbf->getF_username(), 'Username', 'required');
            $this->form_validation->set_rules($dbf->getF_password(), 'Password', 'required');
            if ($this->form_validation->run() == FALSE)
                $this->load->view('layouts/users', $this->data);
            else {
                $user = new s_users();
                $user->setUsername($this->input->post($dbf->getF_username()));
                $user->setPassword(md5($this->input->post($dbf->getF_password())));
                if ($this->d_users->getLogin($user)){
                    $this->session->set_userdata($user->getF_username(),$user->getUsername());
                    $role = new d_roles();
                    $roles = $role->setRoleByUsername($user, $user->getF_rol_name());
                    $this->session->set_userdata($user->getF_rol_name(),$roles->getRole());
                    redirect ('users');
                }
                else{
                    $this->data['login'] = '<div class="alert alert-error">Username and Password incorrect.</div>';
                    $this->load->view('layouts/users', $this->data);
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * @param void $name register function is use to add a new user in into system, and we can access via url
     * @example base_url/users/register
     */
    function register() {
        try {
            if(!$this->session->userdata($this->data['dbf']->getF_username()) || $this->session->userdata($this->data['dbf']->getF_rol_name()) !='SuperAdmin'){
                redirect('users/login');
            }
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
     * @param Destroy session $name This function will destroy all session of website
     */
    public function signout(){
        $this->session->sess_destroy();
        redirect('users/login');
    }
    
    /**
     * 
     * @param String $url
     * @param redirecting $name This function will redirect follow $url in case it could not session of username
     */
    public function check_session(){
        if(!$this->session->userdata($this->data['dbf']->getF_username())){
            redirect('users/login');
        }
        else{
            redirect('users');
        }
    }

}

?>
