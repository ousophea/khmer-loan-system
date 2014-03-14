<?php
echo control_manager();
if($this->session->flashdata('success')) echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
if($this->session->flashdata('error')) echo '<div class="alert alert-fail">'.$this->session->flashdata('error').'</div>';
$debit = 
$arr_select_field = array(
	'GL Code' => 'gl_code', 
	'Trn Ref No' => 'trn_ref_no', 
	'GL Description' => 'gl_description',
	'Ref No' => 'tra_ref_no',
	'Trn Dt' => 'tra_date',
	'Value Date' => 'tra_value_date',
	'Currency' => 'cur_title',
	'Debit' => 'tra_debit',
	'Credit' => 'tra_credit'
);
echo "<div class='tbl_trn'";
echo table_manager($query_all, $arr_select_field, FALSE);
echo "</div>";
?>