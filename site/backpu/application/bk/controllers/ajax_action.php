<?php
/**
 *	The controller to handle ajax action only
 * @author PEN Vannak
 * @package Controller 
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_action extends CI_Controller{

/**
 * ajax action for page contacts
 */	
	public function district(){
		$province = $this->input->post('province');
		if($province == '' || is_numeric($province) == FALSE){
			echo '**Invalid Request**';
			die();
		}
		$select_option = '<select name="txt_con_district"><option value="">-khan/district-</option>';
		$query_district = $this->m_global->select_where('districts',array('dis_pro_id'=>$province));
		if($query_district->num_rows() > 0){
			foreach($query_district->result() as $rows){
				$select_option .= '<option value="'.$rows->dis_id.'">'.$rows->dis_en_name.'('.(($rows->dis_kh_name == '')?'no set':$rows->dis_kh_name).')'.'</option>';
			}
		}
		$select_option .= '</select>';
		echo $select_option;
	}
	
	public function commune(){
		$district = $this->input->post('district');
		if($district == '' || is_numeric($district) == FALSE){
			echo '**Invalid Request**';
			die();
		}
		$select_option = '<select name="txt_con_commune"><option value="">-sangkat/commune-</option>';
		$query_commune = $this->m_global->select_where('communes',array('com_dis_id'=>$district));
		if($query_commune->num_rows() > 0){
			foreach($query_commune->result() as $rows){
				$select_option .= '<option value="'.$rows->com_id.'">'.$rows->com_en_name.'('.(($rows->com_kh_name == '')?'no set':$rows->com_kh_name).')'.'</option>';
			}
		}
		$select_option .= '</select>';
		echo $select_option;
	}
	
	public function village(){
		$commune = $this->input->post('commune');
		if($commune == '' || is_numeric($commune) == FALSE){
			echo '**Invalid Request**';
			die();
		}
		$select_option = '<select name="txt_con_village"><option value="">-village-</option>';
		$query_village = $this->m_global->select_where('villages',array('vil_com_id'=>$commune));
		if($query_village->num_rows() > 0){
			foreach($query_village->result() as $rows){
				$select_option .= '<option value="'.$rows->vil_id.'">'.$rows->vil_en_name.'('.(($rows->vil_kh_name == '')?'no set':$rows->vil_kh_name).')'.'</option>';
			}
		}
		$select_option .= '</select>';
		echo $select_option;
	}
        
        public function saving_product_type(){
           
//            
		$pro_type = $this->input->post('pro_type');
//                $pro_type ="Compulsory";
		if($pro_type ==""){
			echo '**Invalid Request**';
			die();
		}
                $select_option = '<div class="control-group"><label class="control-label" for="gl_id">GL Code</label><div class="controls">';
		$select_option .= '<select name="gl_id"><option value="0">--- Select GL Code ---</option>';
		$gl = $this->m_global->select_like('gl_list',array('gl_description'=>$pro_type));
		if($gl->num_rows() > 0){
			foreach($gl->result() as $rows){
				$select_option .= '<option value="'.$rows->gl_id.'">'.$rows->gl_description.'</option>';
			}
		}
		$select_option .= '</select><span class="error"></span></div></div>';
		echo $select_option;
	}
	
	public function ajaxGetData(){
		$field_where = $this->input->post('field_where');
		$field_value = $this->input->post('field_value');
		$tbl = $this->input->post('table');
		$data = $this->m_global->select_data_where($tbl,array($field_where=>$field_value));
		echo json_encode($data);
	}
}

