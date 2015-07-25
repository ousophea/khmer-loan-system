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
        $db_update = $this->m_database_update->update_db();
        if ($db_update) {
            $this->session->set_flashdata('success', 'Database aready updated');
        } else {
            $this->session->set_flashdata('error', 'Can not update database. please contact you administrator');
        }
        redirect('panel/manage');
//        $this->load->view(MAIN_MASTER, $data);
//        var_dump($ms);
    }

}

?>
