<?php
$arr_field_sch_table = array(
    'ល.រ' => 'rep_sch_num',
    'ថ្ចៃសងប្រាក់' => 'rep_sch_date_repay', // Due date
    'ប្រាក់ដើម' => 'rep_sch_principle_amount_repayment', // Principal
    'ការប្រាក់' => 'rep_sch_rate_repayment', //Interest
    'សរុបប្រាក់ត្រូវបង់' => 'rep_sch_total_repayment',
    'ប្រាក់ដើមនៅសល់' => 'rep_sch_balance', //Outstanding
//    'Instalment' => 'rep_sch_instalment'
);
//$str_table="";
//$str_table .= '<table class="table table-bordered table-striped" cellpadding="0" cellspacing="0" border="0">';
//$str_table .= '<tr clas="tbl_header">';
//foreach ($arr_field_sch_table as $header => $column) {
//    $str_table .= '<th>' . $header . '</th>';
//}
//$str_table .= '</tr>';
//$f=1;
//if ($repayment_sch->num_rows() > 0) {
//    
//    foreach ($repayment_sch->result() as $arr_data) {
//        $str_table .= '<tr>';
//        foreach ($arr_field_sch_table as $column) {
//            if($f>2){
//            $str_table .= '<td>' . $arr_data->$column . '</td>';
//            }  else {
//                $str_table .= '<td>' . formatMoney($arr_data->$column) . '</td>';
//            }
//        }
//        $str_table .= '</tr>';
//    }
//}
//$str_table .= '</table>';
//echo $str_table;
echo "<span id='rep_tbl'></span>";
echo table_manager($repayment_sch, $arr_field_sch_table,FALSE,1);
//echo "</div>";
?>