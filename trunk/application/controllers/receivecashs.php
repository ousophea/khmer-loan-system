<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class receivecashs extends CI_Controller {

    //put your code here
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model('global/mod_global', 'mod_global');
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
    }

    function index() {
        redirect('receivecashs/receivecash');
    }

    function receivecash() {
        $data['title'] = 'Receive Cash/Cheque';
        $data['gl_query'] = $this->mod_global->select_all('gl_list');
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->load->view(Variables::$layout_main, $data);
    }

}

?>
