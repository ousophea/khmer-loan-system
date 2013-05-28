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
function table_manager($table_object, $arr_column, $control = FALSE){
	if(!is_array($arr_column) || count($arr_column) <= 0) return FALSE;
	$string_table = form_open('',array('name'=>'form_manager'));
	$string_table .= '<table class="table table-bordered table-striped" cellpadding="0" cellspacing="0" border="0">';
	
	//start write table header
	$string_table .= '<tr clas="tbl_header">';
	if($control) $string_table .= '<th><input type="checkbox" class="check_all" /></th>';
	foreach($arr_column as $header => $column){
		$string_table .= '<th>'.$header.'</th>';
	}
	$string_table .= '</tr>';
	
	//start write table data
	if($table_object->num_rows() > 0){
		foreach($table_object->result() as $arr_data){
			$string_table .= '<tr>';
			$check_first = TRUE;
			foreach($arr_column as $column){
				if($check_first){
					if($control) $string_table .= '<td><input type="checkbox" class="check" name="check_select[]" value="'.$arr_data->$column.'" /></td>';
					$check_first = FALSE;
				}
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

function control_manager(){
	$string = '<div class="control_manager">';
	$string .= anchor(site_url(segment(1).'/add'),'<i class="icon-plus-sign"></i>Add New','class="btn btn-mini" id="add_manager" title="Add New"');
	$string .= nbs();
	$string .= anchor(site_url(segment(1).'/edit'),'<i class="icon-edit"></i>Edit','class="btn btn-mini" id="edit_manager" title="Edit"');
	$string .= nbs();
	$string .= anchor(site_url(segment(1).'/delete'),'<i class="icon-remove-sign"></i>Delete','class="btn btn-mini" id="delete_manager" title="Delete"');
	$string .= '</div>';
	return $string;
}

/**
 * Function create by Sophea
 * 
 */
function start_form_model($col) {
    
    echo'<div class="form-model">';
    if ($col == 1) {
        echo '<div class="row col1">';
    } else {
        echo '<div class="row">';
    } 
    echo'<div class="span5">';
}

function close_form_model() {
    echo '</div></div></div>';

}

function open_form($name,$title,$action=NULL) {    
    echo'<div class="form_block" id="' . $name . '" title="'.$title.'">';
    echo form_open($action, array('name' => $name, 'class' => 'form-horizontal bs-docs-form','id'=>$name));
}

function close_form() {
    
    echo form_close();
    echo '<span class="form_model_style">&nbsp;</span>';
    echo'</div>';
}

function f_start_col2(){
    echo '</div><div class="span5">';
}


/**
 * function to write the form element
 * @param $field_type string parameter to present about the type of field name. EX: text, password, file, ....
 * @param $field_name string parameter to present about the name of field
 * @param $field_value string parameter to present about the default value of the field
 * @param $label string parameter to present about label text. Optional
 * @param $arr_field_attribute array two dimentional present about the field option, and attribute. Mostly use with Select, Radio, Checkbox
 * @param $validate boolean parameter to present about form validator
 * @return void function
 * @example field('select','sex','Sex:','m',array('options'=>array('0'=>'select','m'=>'Male'),'attribute'=>array('class'=>'dropdown','id'=>'test')),TRUE);
 */
function field($field_type,$field_name,$label=NULL,$field_value=NULL,$arr_field_attribute=NULL,$validate=FALSE,$sth=NULL){
    $attributes = ' ';
    if(is_array($arr_field_attribute) && array_key_exists('attribute', $arr_field_attribute)){
        foreach($arr_field_attribute['attribute'] as $attribute => $attribute_value){
            $attributes .= $attribute.'="'.$attribute_value.'" ';
        }
    }
    echo '<div class="control-group">';
    if ($label <> NULL) {
        echo form_label($label.(($validate)?' <sup class="require">*</sup> ':''),$field_name,array('class'=>'control-label'));
    }
    echo'<div class="controls">';
    switch ($field_type){
        case 'text':
            echo form_input($field_name,$field_value,$attributes);
            break;
        case 'password':
            echo form_password($field_name,$field_value,$attributes);
            break;
        case 'select':
            if(is_array($arr_field_attribute) && array_key_exists('options', $arr_field_attribute)) echo form_dropdown($field_name,$arr_field_attribute['options'],$field_value,$attributes);
            else echo '<span class="form_invalid">Invalid parameter of calling form dropdown! Please correct by see example below: <br/><pre>field(\'Sex:\',\'select\',\'sex\',\'m\',array(\'options\'=>array(\'0\'=>\'select\',\'m\'=>\'Male\'),\'attribute\'=>array(\'class\'=>\'dropdown\',\'id\'=>\'test\')));</pre></span>';
            break;
        case 'file':
            echo form_upload($field_name,$field_value,$attributes);
            break;
        case 'textarea':
            echo form_textarea($field_name,$field_value,$attributes);
            break;
        case 'button':
            echo form_button($field_name,$field_value,$attributes);
            break;
        case 'submit':
            echo form_submit($field_name,$field_value,$attributes);
            break;
        case 'reset':
            echo form_reset($field_name,$field_value,$attributes);
            break;
        case 'radio':
            if(is_array($arr_field_attribute) && array_key_exists('radio_list', $arr_field_attribute)){
                foreach($arr_field_attribute['radio_list'] as $text => $value){
                   echo'<label class="radio">';
                    echo form_radio($field_name,$validate,(($field_value==$value)?TRUE:FALSE),$attributes);
                    echo ' '.$text.' ';
                    echo'</label>';
                }
            }else{
                echo '<span class="form_invalid">Invalid parameter of calling form radio box! Please correct by see example below: <br/>
                    <pre>field(\'Status:\',\'radio\',\'status\',\'single\',array(\'radio_list\'=>array(\'Married\'=>\'married\',\'Single\'=>\'single\'),\'attribute\'=>array(\'class\'=>\'status\')));
                    </pre></span>';
            }
            break;
        case 'checkbox':
            if(is_array($arr_field_attribute) && array_key_exists('checkbox_list', $arr_field_attribute)){
                foreach($arr_field_attribute['checkbox_list'] as $text => $value){
                     echo '<label class="checkbox">';
                    echo form_checkbox($field_name,$validate,(($field_value==$value)?TRUE:FALSE),$attributes);
                    echo ' '.$text.' ';
                    echo '</label>';
                }
            }else{
                echo '<span class="form_invalid">Invalid parameter of calling form checkbox box! Please correct by see example below: <br/>
                    <pre>field(\'Favorite:\',\'checkbox\',\'favorite\',\'song\',array(\'checkbox_list\'=>array(\'Song\'=>\'song\',\'Movie\'=>\'movie\'),\'attribute\'=>array(\'class\'=>\'favorite\')));
                    </pre></span>';
            }
            break;
        case 'hidden':
            echo form_hidden($field_name,$field_value,$attributes);
            break;
        default:
            echo 'Missing or incorrect type of input';
            break;
    }
    echo $sth;
    if($validate) echo '<span class="help-block">'.form_error($field_name).'</span>';
    echo '  </div>';
    echo '</div>';  
}
?>