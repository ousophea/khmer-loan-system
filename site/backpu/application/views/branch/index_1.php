<!-- Author: Bunthoeurn -->
<?php
// echo $query_all;
echo form_open('branch', array('name' => 'frm', 'class' => 'form', 'id' => 'frm_branch'));
echo control_manager();
$arr_select_field = array(
'Branch ID' => 'bra_id',
 'Branch Name' => 'bra_name',
 'Branch Address' => 'bra_address'
);
echo table_manager($query_all, $arr_select_field, TRUE);
echo form_close();
?>