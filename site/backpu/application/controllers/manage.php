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
class Manage extends CI_Controller {

    //put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model(array('s_users', 'd_users', 'd_roles', 's_roles', 'm_database_update'));
    }

    function index() {
        echo "Sophea";
//        redirect('setting/db_update');
    }

    function db_update() {
        $checkCookie = $this->checkCookie();
        if ($checkCookie) {
            $this->session->set_flashdata('success', 'Your database aready up to date..!');
        } else {
            $db_update = $this->m_database_update->update_db();
            if ($db_update) {
                $this->session->set_flashdata('success', 'Database aready updated');
            } else {
                $this->session->set_flashdata('error', 'Can not update database. please contact you administrator');
            }
        }
         redirect('panel/manage');
    }

    function checkCookie() {
        $cookie_val = "db_19092015";   //db_d_m_y
        if (get_cookie('cookie_db') == $cookie_val) {
            return true;// Not something update for the database
        } else {
            $cookie = array(
                'name' => 'cookie_db',
                'value' => $cookie_val,
                'expire' => time() + 86500,
                'path' => '/',
            );
            set_cookie($cookie);
           return false;// Update base just update
        }
    }

}

?>
