<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Get transaction mode for desplay in list
$array_transaction = array();
foreach ($transaction_query->result() as $tra_rows) {
    $array_transaction[''] = '-----Select-----';
    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows->tra_mod_title;
}
//===================== Account description ========================

if ($query_all->result() == NULL) {
    echo 'Not record found!';
    echo"<span id='form_and_data_table'></span>";
    echo"<span id='data_table'></span>";
} else {
    $gl_code = NULL;
    $cur_id = NULL;
    foreach ($query_all->result() as $rows) {
//        $gl_code = $rows->loa_acc_gl_code;
        $cur_id = $rows->cur_id;
        loan_acc_des($rows); /// ========return Saving account infomation=============//
        //============Get Loan disbursment info==================
        $arr_search_index = array(
            'loa_dis_loa_acc_code' => $accNum
        );

        //$loa_dis_query = $this->m_disbursments->select_disbursed($arr_search_index);

        echo"<span id='form_and_data_table'>";
//    
//    open_form('disbursments_tra', 'Disbursments / Debit', "disbursments/add_dis");
//
        $now = time();

//echo unix_to_human($now);
        field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);
//        field('text', 'gl_code', 'GL contra Account:', $rows->loa_acc_gl_code, array('attribute' => array('readonly' => "")));
        field('text', 'value_date', 'Value date:', unix_to_human($now), array('attribute' => array('readonly' => "")));
        echo'<input type="hidden" name="dis_amount" value="' . $rows->loa_acc_amount . '" />';
        field('text', 'dis_amount_view', 'Trn Amount:', formatMoney($rows->loa_acc_amount), array('attribute' => array('readonly' => "")));
        field('textarea', 'dis_des', 'Description:');


        echo'<input type="hidden" name="acc_number" value="' . $accNum . '" />';
//    echo'<input type="hidden" name="gl_code" value="' . $gl_code . '" />';
        echo'<input type="hidden" name="currency" value="' . $cur_id . '" />';
        echo'<table class="table table-bordered table-striped" cellspacing="0" cellpadding="0" border="0">
            <tr class="tbl_header">
                <th>Description</th>
                <th>Allocated Amt</th>
                <th>Already Disbursed</th>
                <th>This Disbursment</th>
            </tr>';

        $this_dis = NULL;
        $ready_dis = 0;

        // if ($loa_dis_query->result() != NULL) {
        //$i = 1;
        // foreach ($loa_dis_query->result() as $value) {
//            $ready_dis = ($rows->loa_acc_approval=="Approved")?$rows->loa_acc_amount:0;
        $ready_dis = ($rows->loa_acc_disbustment == NULL) ? $rows->loa_acc_amount : 0;
        echo"   <tr>
                <td>$rows->gl_description</td>
                <td>" . formatMoney($rows->loa_acc_amount, TRUE) . "</td>
                <td>" . formatMoney($ready_dis, TRUE) . "</td>
                <td></td>
            </tr>";
        // }
        //}
        echo "  <tr style='font-weight:bold;'>
            <td>Total</td>
            <td>" . formatMoney($rows->loa_acc_amount, TRUE) . "</td>
            <td>" . formatMoney($ready_dis, TRUE) . "</td>
            <td>" . formatMoney($rows->loa_acc_amount - $ready_dis, TRUE) . "</td>
        </tr>";
        echo"</table>";
        if ($rows->loa_acc_disbustment != NULL) {
            field("submit", 'btn_submit', NULL, "Disburse", array('attribute' => array('class' => 'btn', 'id' => 'btn_submit')), NULL, '<input type="submit" id="btn_disapprove" class="btn" value="Cancel" name="btn_disapprove">');
        }
    }
    echo "</span>"; //=== Close tmp span dis form and table==========
}
?>
