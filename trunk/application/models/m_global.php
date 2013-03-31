<?php
/**
 * Global model for using in this application
 * @package Model
 * @author PEN Vannak
 * @version 1.0
 */
 
if ( ! defined('BASEPATH')) exit('Permission Denied!');

class m_global extends CI_Model{
		
	public function __construct(){
		parent::__construct();
	}

	//GROUP OF FUNCTIONS QUERY TO SELECT//
	 
	/**
	 * Function select to get custom field from table
	 * @param $table the string parameter to select (required)
	 * @param $arr_fields the array parameter store the fields you would to select
	 * @param $limit the string parameter store the limit record select separated by , (optional)
	 * @return table object
	 * @example select('tbl_users',array('use_id','use_name'))
	 */
	public function select($table, $arr_fields = array(), $limit = NULL){
		if(!is_array($arr_fields) || count($arr_fields) <= 0) return FALSE;
		$this->db->select(join(',', $arr_fields));
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		$this->db->get($table);
	}
	
	/**
	 * Function select all from table
	 * @param $table the string parameter to select (required)
	 * @param $limit the string parameter store the limit record select separated by , (optional)
	 * @return table object
	 * @example select_all('tbl_users',10)
	 */
	public function select_all($table, $limit = NULL){
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		$this->db->get($table);
	}
	
	/**
	 * Function select all from table with status
	 * @param $table the string parameter to select (required)
	 * @param $status the int parameter to set status (default 1)
	 * @param $limit the string parameter store the limit record select separated by , (optional)
	 * @return table object
	 * @example select_status('tbl_contacts');
	 */
	public function select_status($table, $status = 1, $limit = NULL){
		$this->db->where('status',$status);
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		$this->db->get($table);
	}
	
	/**
	 * Function select Where / Where And
	 * @param $table the string parameter to select (required)
	 * @param $arr_item_where the array parameter to store the where field comming with value. It's associative array (required)
	 * @param $limit the string parameter store the limit record select separated by , (optional)  
	 * @return table object
	 * @example select_where('tbl_users',array('use_name' => 'vannak','use_password' => '12345'))
	 */
	public function select_where($table, $arr_item_where = array(), $limit = NULL){
		if(!is_array($arr_item_where) || count($arr_item_where) <= 0) return FALSE;
		foreach($arr_item_where as $field => $value){
			$this->db->where($field,$value);
		}
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		$this->db->get($table);
	}
	
	/**
	 * Function select Where Or
	 * @param $table the string parameter to select (required)
	 * @param $arr_item_where the array parameter to store the where field comming with value. It's associative array (required)
	 * @param $limit the string parameter store the limit record select separated by , (optional)  
	 * @return table object
	 * @example select_where_or('tbl_users',array('use_firstname' => 'vannak', 'use_lastname' => 'pen'), 30)
	 */
	public function select_where_or($table, $arr_item_where = array(), $limit = NULL){
		if(!is_array($arr_item_where) || count($arr_item_where) <= 0) return FALSE;
		foreach($arr_item_where as $field => $value){
			$this->db->where_or($field,$value);
		}
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		$this->db->get($table);
	}

	/**
	 * Function select join with inner, left, right
	 * @param $table the string parameter to select (required)
	 * @param $arr_join the multi-array dimention parameter to store the table that need to join and the fields need tobe reference on (required)
	 * @param $join_type the string parameter to specify the join type of sql join. Value only inner, left, right, and full (default null)
	 * @param $arr_where the array parameter store the where clause in this query (optional)
	 * @param $limit the string parameter store the limit record select separated by , (optional)
	 * @return table object
	 * @example select_join('tbl_contacts', array('tbl_users' => array('con_use_id' => 'use_id')),'inner',array('tbl_users.use_id' => 2),'30')
	 */
	public function select_join($table,$arr_join = array(), $join_type = NULL, $arr_where = NULL, $limit = NULL){
		if(!is_array($arr_join) || count($arr_join) <= 0) return FALSE;
		$this->db->from($table);
		//table need to join
		foreach($arr_join as $table_join => $fields_join){
			if(!is_array($fields_join)) return FALSE;
			$field_left = '';
			$field_right = '';
			foreach($fields_join as $field_l => $field_r){
				$field_left = $field_l;
				$field_right = $field_r;
			}
			if($join_type == NULL){
				$this->db->join($table_join,$table.'.'.$field_left.'='.$table_join.'.'.$field_right);
			}else{
				$this->db->join($table_join,$table.'.'.$field_left.'='.$table_join.'.'.$field_right,$join_type);
			}
		}
		if($arr_where != NULL && is_array($arr_where)){
			foreach($arr_where as $fields => $value){
				$this->db->where($fields,$value);
			}
		}
		if($limit != NULL){
			if(strpos($limit, ',')){
				$arr_limit = explode(',', $limit);
				if(is_numeric($arr_limit[0]) && is_numeric($arr_limit[1])){
					$this->db->limit($arr_limit[0],$arr_limit[1]);
				}
			}else{
				if(is_numeric($limit)){
					$this->db->limit($limit);
				}
			}
		}
		return $this->db->get();
	}
	
	//GROUP OF FUNCTIONS QUERY TO INSERT//
	
	/**
	 * Function insert single record
	 * @param $table the string parameter of table name
	 * @param $arr_data the associative array parameter to store data to be inserted (required)
	 * @return boolean
	 * @example insert('tbl_users', array('use_name' => 'Vannak','use_sex' => 'm'))
	 */
	 public function insert($table, $arr_data = array()){
	 	if(!is_array($arr_data) || count($arr_data) <= 0) return FALSE;
		$this->db->insert($table,$arr_data);
		return true;
	 }
	 
	 /**
	 * Function insert multiple record
	 * @param $table the string parameter of table name
	 * @param $arr_fields the numeric array parameter to store fields list to be inserted (required)
	 * @param $arr_data the numeric 2nd dimentional array parameter to store multiple data tobe inserted (required)
	 * @return boolean
	 * @example insert_multi('tbl_users', array('use_name','use_sex'), array(array('vannak','m'),array('sochy','m'), array('sophea','m'))) 
	 */
	 public function insert_multi($table, $arr_fields = array(), $arr_data = array()){
	 	if(!is_array($arr_fields) || !is_array($arr_data) || count($arr_fields) <= 0 || count($arr_data) <= 0) return FALSE;
		$batch_data = array();
		foreach($arr_data as $datas){
			$batch_list = array();
			if(is_array($datas)){
				foreach($datas as $key => $data){
					$batch_list[$arr_fields[$key]] = $data;
				}
			}
			array_push($batch_data,$batch_list);
		}
		$this->db->insert_batch($table,$batch_data);
		return TRUE;
	 }
	 
	 //GROUP OF FUNCTIONS QUERY TO UPDATE//
	 
	 
	 /**
	 * Function update single record
	 * @param $table the string parameter of table name
	 * @param $arr_data the associative array parameter to store multiple data to be updated (required)
	 * @param $arr_where the associative array parameter to store where clause (required)
	 * @return boolean
	 * @example update('tbl_users',array('use_name'=>'Vannak', 'sex'=>'m'),array('use_id'=>2))
	 */
	 public function update($table, $arr_data = array(), $arr_where = array()){
	 	if(!is_array($arr_data) || !is_array($arr_where) || count($arr_data) <= 0 || count($arr_where) <= 0) return FALSE;
		foreach($arr_where as $field => $value){
			$this->db->where($field,$value);
		}
		$this->db->update($table,$arr_data);
		return TRUE;
	 }
	 
	 /**
	 * Function update multiple record
	 * @param $table the string parameter of table name
	 * @param $arr_data_multi the associative 3rd dimention array parameter to store multiple data with where clause to be updated (required)
	 * @return boolean
	 * @example update_multi('tbl_users',array(array(array('user' => 'vannak'),array('use_id' => 2)),array(array('use_name' => 'tola'),array('use_id' => 1))));
	 */
	 public function update_multi($table, $arr_data_multi = array()){
	 	if(!is_array($arr_data_multi) || count($arr_data_multi) <= 0) return FALSE;
		foreach($arr_data_multi as $datas){
			foreach($datas[1] as $field => $value){
				$this->db->where($field,$value);
			}
			$this->db->update($table,$datas[0]);
		}
		return TRUE;
	 }
	 
	 //GROUP OF FUNCTIONS QUERY TO UPDATE//
	 
	 /**
	 * Function delete single record with one or multiple where clause
	 * @param $table the string parameter of table name
	 * @param $arr_where the associative array parameter to store where clause to be deleted (required)
	 * @return boolean
	 * @example delete('tbl_users',array('use_id'=>2));
	 */
	 public function delete($table, $arr_where = array()){
	 	if(!is_array($arr_where) || count($arr_where) <= 0) return FALSE;
		foreach($arr_where as $field => $value){
			$this->db->where($field,$value);
		}
		$this->db->delete($table);
		return TRUE;
	 }
	 
	 /**
	 * Function delete single record with one or multiple where clause
	 * @param $table the string parameter of table name
	 * @param $arr_where the associative multi-dimentional array parameter to store where clause to be deleted (required)
	 * @return boolean
	 * @example delete_multi('tbl_users',array('use_id'=>array(1,2,3,4,5,6,7)));
	 */
	 public function delete_multi($table, $arr_where = array()){
	 	if(!is_array($arr_where) || count($arr_where) <= 0) return FALSE;
		foreach($arr_where as $field => $list){
			$this->db->where_in($field,$list);
		}
		$this->db->delete($table);
		return TRUE;
	 }
	 
	 /**
	 * Function delete all record from one or multiple table(s)
	 * @param $arr_table the string/array parameter of table name
	 * @return boolean
	 * @example delete_all('tbl_users'); or delete_all(array('tbl_users','tbl_contacts'));
	 */
	 public function delete_all($arr_table){
	 	if(is_array($arr_table) and count($arr_table) > 0){
	 		foreach($arr_table as $table){
	 			$this->db->empty_table($table);
	 		}
	 	}else{
	 		$this->db->empty_table($arr_table);
	 	}
		return TRUE;
	 }
	 
	 /**
	 * Function truncate to reset the table data from one or more table
	 * @param $arr_table the string/array parameter of table name
	 * @return boolean
	 * @example truncate('tbl_users'); or truncate(array('tbl_users','tbl_contacts'));
	 */
	 public function truncate($arr_table){
	 	if(is_array($arr_table) and count($arr_table) > 0){
	 		foreach($arr_table as $table){
	 			$this->db->truncate($table);
	 		}
	 	}else{
	 		$this->db->truncate($arr_table);
	 	}
		return TRUE;
	 }	 
}
?>