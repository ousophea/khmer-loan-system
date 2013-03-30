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
        $arry_auth = array(
            strtolower(Setting::$role0) => strtolower(Setting::$role0),
            strtolower(Setting::$role1) => strtolower(Setting::$role1),
            strtolower(Setting::$role2) => strtolower(Setting::$role2),
            strtolower(Setting::$role3) => strtolower(Setting::$role3),
        );
        foreach ($array_role_name as $value) {
            if ($arry_auth[$value] != $value)
                die('Value of array must be in list: $array_role_name = array("superadmin","admin","teller", "accountain");');
        }
        foreach ($array_role_name as $value) {
            if ($value == strtolower($CI->session->userdata($db->getF_rol_name())))
                return;
        }
        redirect('auth/no_auth');
    }

    /**
     * 
     * @global type $CI
     * @global dbf $db
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