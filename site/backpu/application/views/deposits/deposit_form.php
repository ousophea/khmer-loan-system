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
    field('text', 'dep_amount', 'Trn Amount:', NULL, array('attribute' => array('class' => "numeric")), TRUE);
    field('textarea', 'dep_des', 'Description:');


    echo '<div class="modal-footer">';
    echo form_submit(array('name' => 'btn_save', 'class' => 'btn btn-success'), 'Confirm');
    echo anchor('saving/lists', 'Cancel', 'class="btn"');
    echo '</div></div>';
    
    echo "</span>"; //=== Close tmp span dis form and table==========
}
?>
