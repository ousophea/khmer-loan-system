<?php

/**
 * Helper
 * @author Sochy
 * @path application/helpers/auth_helper.php
 */
if (!function_exists('auth')) {
    /**
     * 
     * @param array $array_role_name list superadmin,admin,teller, accountain
     * @see Value of array must be in list: $array_role_name = array("superadmin","admin","teller", "accountain");
     * @return boolean
     */
    function allows($array_role_name) {
        
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        $db = new dbf();
        if(!is_login()){
            redirect('users/login');
        }
        $arry_auth = array(
            strtolower(Setting::$role0) => strtolower(Setting::$role0),
            strtolower(Setting::$role1) => strtolower(Setting::$role1),
            strtolower(Setting::$role2) => strtolower(Setting::$role2),
            strtolower(Setting::$role3) => strtolower(Setting::$role3),
        );
        foreach ($array_role_name as $value) {
            if ($arry_auth[strtolower($value)] != strtolower($value))
                die('Value of array must be in list: $array_role_name = array("superadmin","admin","teller", "accountain");');
        }
        foreach ($array_role_name as $value) {
            if (strtolower($value) == strtolower($CI->session->userdata($db->getF_rol_name())))
                return;
        }
        $CI->session->set_flashdata('error',alert_error('You don\'t have permission to access this page. If you have any question, please contact to administrator.'));
        redirect('auth/no_permission');
    }

    /**
     * 
     * @return boolean
     */
    function is_login() {
        $CI = &get_instance();
        $CI->load->library('session');
        $db = new dbf();
        ;
        if ($CI->session->userdata($db->getF_rol_name()))
            return TRUE;
        return FALSE;
    }

}
?>