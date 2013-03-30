<?php
/**
 * Helper
 * @package Customer Helper
 * @author Vannak
 * @path application/helpers/global_helper.php
 */
 
/**
 * function return segment name
 * @param $i integer default 1 to define the segment state number
 * @return String
 */
$CI = &get_instance();
$CI->load->library('session');
if (!function_exists('auth')) {
    
    /**
     * 
     * @param array $array_role_name
     * @return boolean
     * @example /example/auth_helper.php description
     */
    function allow($array_role_name){
        
        
        return FALSE;
    }
    
}

?>