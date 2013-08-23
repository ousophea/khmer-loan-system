<?php
// Get Laon Account infimation
$list_acc_number = "";
$list_acc_number .= '<datalist>';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
    // $list_acc_number .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_acc_number.= '</datalist>';

?>