<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



field("text", "cid", "CID :", NULL, array('attribute' => array('list' => "list_cid", 'id' => "cid", "title" => "",'style' => "width:209px;")), FALSE, $list_cid.
        '<a class="btn"  id="btn_search_cid" href="' . base_url() . 'journals/con_info"> Search CID</a>');
echo "<span id='con_des'></span>";

echo "<div id='gl_code_sigle'>";
field("text", "gl_code_signle", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "single_gl_code", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>
            
<a class="btn gl_code"  id="btn_search_gl_single" class="btn gl_code" href="' . base_url() . 'journals/gl_info"> Search</a>');
echo "<span id='singl_gl_des'></span>";

//field("textarea", "singl_gl_des", NULL);
echo"</div>";


field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);

field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);


echo"<div id='single_entry_block'>"; // Open amount and transation typoe for single entry

field('select', 'transaction_type', 'Transaction Type:', '2', array(
    'options' => array(
        '' => "-----Select-----",
        '1' => "Debit",
        '2' => "Credit"), 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'tra_type')), TRUE);

field("text", "tra_amount_single", "Transaction Amount:", NULL, NULL, TRUE);

echo"</div>"; // Close amount and transation type for single entry




field("textarea", "tra_detail", "Description:");

field("submit", 'btn_submit', NULL, "Submit", array('attribute' => array('class' => 'btn', 'id' => 'btn_submit')), NULL, 
        '<a class="btn btn_back" href="' . base_url() . 'receivecashs/lists"><i class="icon-circle-arrow-left"></i> Back</a>'
);
?>
