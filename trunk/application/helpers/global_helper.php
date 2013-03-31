<?php
/**
 * Helper
 * @package Customer Helper
 * @author Vannak
 * @path application/helpers/global_helper.php
 */
 
/**
 * function return segment name
 * @param $i integer parameter default 1 to define the segment state number
 * @return String
 * @example echo segment(1); //for getting the controller name
 */
function segment($i = 1){
	$ci =& get_instance();
	$ci->load->helper('url');
	return $ci->uri->segment($i);
}

/**
 * function return the table data manager
 * @param $table_object table object parameter passed by the sql query
 * @param $arr_column associative array parameter for select the field to be display with the column field
 * @return String
 * @example $arr_select_field = array(
		'ID' => 'con_id', 
		'English Name' => 'con_en_name',
		'Address' => 'con_address'
	);
	echo table_manager($this->db->get('contacts'), $arr_select_field);
 */
function table_manager($table_object, $arr_column){
	if(!is_array($arr_column) || count($arr_column) <= 0) return FALSE;
	$string_table = form_open('');
	$string_table .= '<table cellpadding="0" cellspacing="0" border="0">';
	
	//start write table header
	$string_table .= '<tr clas="tbl_header">';
	$string_table .= '<th><input type="checkbox" class="check_all" /></th>';
	foreach($arr_column as $header => $column){
		$string_table .= '<th>'.$header.'</th>';
	}
	$string_table .= '</tr>';
	
	//start write table data
	if($table_object->num_rows() > 0){
		foreach($table_object->result() as $arr_data){
			$string_table .= '<tr>';
			$string_table .= '<td><input type="checkbox" class="check" name="check_select" value="" /></td>';
			foreach($arr_column as $column){
				$string_table .= '<td>'.$arr_data->$column.'</td>';
			}
			$string_table .= '</tr>';
		}
	}else{
		$string_table .= '<tr><td colspan="'.count($arr_column).'"><p class="no_record">There is no record.</p></td></tr>';
	}
	$string_table .= '</table>';
	$string_table .= form_close();
	return $string_table; 
}

?>