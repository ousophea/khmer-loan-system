<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class paycashs extends CI_Controller {
      function __construct() {
        parent::__construct();
        $this->load->model('global/mod_global', 'mod_global', 'm_global');
        //$this->load->library('session');
        $this->data['title'] = NULL;
        $this->data['data'] = NULL;
        $this->data['cid_query'] = NULL;
    }

    function index() {
        redirect('paycashs/paycash');
    }
    function paycash(){
        $data['title'] = 'Pay Cash/Cheque';
        $data['gl_query'] = $this->mod_global->select_all('gl_list');
        $data['transaction_query'] = $this->mod_global->select_all('transaction_mode');
        $data['currency_query'] = $this->mod_global->select_all('currency');
        $data['cid_query'] = $this->mod_global->select_all('contacts');
        $this->data['cid_query'] = $data['cid_query'];
        $this->load->view(Variables::$layout_main, $data);
    }

}
?>
