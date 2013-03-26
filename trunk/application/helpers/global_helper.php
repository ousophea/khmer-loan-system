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
function segment($i = 1){
	$ci =& get_instance();
	$ci->load->helper('url');
	return $ci->uri->segment($i);
}

?>