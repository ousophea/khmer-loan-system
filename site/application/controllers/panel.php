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
class panel extends CI_Controller {

    var $data = null;

    function __construct() {
        parent::__construct();
        $this->data['dbf'] = new dbf();
//        if (!is_login()) {
//            $this->session->set_flashdata('error', '<div class="alert alert-error">Please login!!!</div>');
//            redirect('users/login');
//        }
    }

    function index() {
        redirect('panel/manage');
    }

    function manage() {
        allows(array('admin', 'teller', 'accountain', 'superadmin'));
        $this->data['title'] = "Welcome to Loan System Managment";
        $this->load->view(Variables::$layout_main, $this->data);
    }

    function sendMail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ousophea@gmail.com', // change it to yours
            'smtp_pass' => 'sophealau#gmail$', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = 'Just for testing eamil';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('ousophea@gmail.com'); // change it to yours
        $this->email->to('sophea.ou@passerellesnumeriques.org'); // change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

}

?>
