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
    echo"<span id='form_input'></span>";
} else {

    foreach ($query_all->result() as $rows) {
        $cur_id = $rows->cur_id;
        saving_acc_des($rows); /// ========return Saving account infomation=============//
    }

    echo"<span id='form_input'>";
    $now = time();
    echo'<input type="hidden" name="acc_number" value="' . $accNum . '" />';
    echo'<input type="hidden" name="currency" value="' . $cur_id . '" />';
    field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);
    field('text', 'gl_code', 'GL contra Account:', $rows->gl_code, array('attribute' => array('readonly' => "")));
    field('text', 'value_date', 'Value date:', unix_to_human($now), array('attribute' => array('readonly' => "")));
    field('text', 'wit_amount', 'Trn Amount:', NULL,  array('attribute' => array('id' => "wit_amount",'class'=>"numeric")), TRUE);
    field('textarea', 'wit_des', 'Description:');
    
    field("submit", 'btn_submit', NULL, "Confirm", array('attribute' => array('class' => 'btn', 'id' => 'btn_submit')), NULL, '<input type="submit" id="btn_disapprove" class="btn" value="Cancel" name="btn_disapprove">');
    
    echo "</span>"; //=== Close tmp span dis form and table==========

    echo "<span class='acc_info_des'>";

    echo "<span class='wit_res_data'>";

    foreach ($til_query->result() as $til_rows) {
        echo "<input type='hidden' name='out_balance' id='hid_out_balance' value='$rows->sav_acc_amount' />";
        $balance = ($til_rows->til_debit - $til_rows->til_credit);
//        acc_info("Outstanding Balance", formatMoney($rows->sav_acc_amount, TRUE));
        $labal ="Teller's Max Cash Out";
            $value = formatMoney($rows->sav_acc_amount, TRUE);
            echo '<div class="control-group">
            <label class="control-label" for="value_date">'.$labal.':</label>
            <div class="controls" id="out_balance">'.$value.'</div></div>';
            
        acc_info("Available Balance", formatMoney($rows->sav_acc_amount, TRUE));
        if ($balance > 0) {
            acc_info("Teller's Max Cash Out", formatMoney($balance, TRUE));
        } else {
            echo "<span class='blog'>";
            acc_info("Teller's Max Cash Out", formatMoney($balance, TRUE));
            echo "</span>";
        }
    }
    echo "</span></span>";

    //=================== Button confirm==================
    echo '<span id="sub_tool">';
//    echo '<div class="modal-footer">';
//    echo form_submit(array('name' => 'btn_save', 'class' => 'btn btn-success'), 'Confirm');
//    echo anchor('saving/lists', 'Cancel', 'class="btn"');
//    echo '</div>';
    echo '</span>';
}
?>
