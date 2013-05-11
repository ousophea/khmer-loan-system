<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//function start_form_model($col) {
//    
//    echo'<div class="form-model">
//        <div class="row">';
//    if ($col == 1) {
//        echo'<div class="span6">';
//    } else {
//        echo'<div class="span5">';
//    }
//}
//
//function close_form_model() {
//    echo '</div></div></div>';
//
//}
//
//function open_form($name,$title,$action=NULL) {    
//    echo'<div class="form_block" id="' . $name . '" title="'.$title.'">';
//    //<form name="'.$name.'" class="form-horizontal bs-docs-form">';
//    echo form_open($action, array('name' => $name, 'class' => 'form-horizontal bs-docs-form'));
//}
//
//function close_form() {
//    
//    echo form_close();
//    echo '<div class="form_model_style">&nbsp;</div>';
//    echo'</div>';
//}
//function fields($label, $type, $name, $valu, $validat, $sth) {
//    //function field($label,$field,$sth=NULL) {
//    echo '<div class="control-group">';
//    if ($label <> "") {
//        echo'<label for="' . $name . '" class="control-label">' . $label . '</label>';
//    }
//    echo'<div class="controls">';
//
//
//    switch ($type) {
//        case 'text':
//            echo form_input($name, $valu, 'class=span2');
//            //$name=$attr['name'];// validator
//            break;
//        case 'password':
//            echo form_password();
//            //$name=$attr['name'];
//            break;
//        case 'select':
//            echo form_dropdown();
//            //$name=$attr['name'];
//            break;
//        case 'file':
//            echo form_upload($name);
//            //if ($upload==1) echo '<span class="error">'.$this->upload->display_errors().'</span>';
//            //$name='userfile';
//            break;
//        case 'textarea':
//            echo form_textarea();
//            //$name=$attr['name'];
//            break;
//
//        default:
//            $name = 'Missing or incorrect type of input';
//            break;
//    }
//    //echo'<input class="span2" id="' . $name . '" name="' . $name . '" type="text">';
//    echo $sth;
//    echo'         </div>
//                </div>';
//}
//function f_start_col2(){
//    echo '</div><div class="span5">';
//}
echo "<div id='test'></div>";


// Get Gl infimation
$list_gl ="";
$list_gl .= '<datalist id="gl_code">';
foreach ($gl_query->result() as $gl_rows) {
    
    $list_gl .='<option value="'.$gl_rows->gl_code.':'.$gl_rows->gl_description.'">'; 
   // $list_gl .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_gl.= '</datalist>';

//Get transaction mode for desplay in list
$array_transaction = array();

foreach ($transaction_query->result() as $tra_rows) {
    $array_transaction['0'] = '-----Select-----';
    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows-> tra_mod_title; 
}

//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency['0'] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows-> cur_title; 
} 

//Get CID from database
$list_cid ="";
$list_cid .= '<datalist id="list_cid">';
foreach ($cid_query->result() as $cid_rows) {
    
    $list_cid .='<option value="'.$cid_rows->con_cid.'">'; 
    
}
$list_cid.= '</datalist>';


echo '<div class="myform">';
start_form_model(2);

open_form('account_info', "Account information");
field("text", "cis", "CID :", NULL, array('attribute' => array('list' => "list_cid",'id'=>"cid","title"=>"")), TRUE, 
        '<datalist id="list_cid">'.$list_cid.'</datalist>'.
        '<button type="button" class="btn">Search</button>');
//            field('text','txt_name','Name:','Vannak',array('attribute'=>array('class'=>'user')),TRUE);//<label for="CID:">CID:</label><input type="text" name="txt_name" />
//            field('select','sex','Sex:','m',array('options'=>array('0'=>'select','m'=>'Male','f'=>'Female'),'attribute'=>array('class'=>'dropdown','id'=>'test')),TRUE);
//            field('radio','status','Status:','single',array('radio_list'=>array('Married'=>'married','Single'=>'single'),'attribute'=>array('class'=>'status')));
//            field('checkbox','favorite','Favorite:',NULL,array('checkbox_list'=>array('TV'=>'tv','Dance'=>'dance'),'attribute'=>array('class'=>'checkbox')),TRUE);
//            field('textarea','txt_description','Description',NULL,NULL,TRUE);
//            field('button','btn_back',NULL,'Back',array('attribute'=>array('class'=>'btn')));

close_form();

open_form('account_detail', 'Account Detail');
field("text", "account_type", "Account Type: ",NULL,array('attribute'=>array('readonly'=>"")));
field("text", "account_no", "Account No: ",NULL,array('attribute'=>array('readonly'=>"")));
field("text", "account_date", 'Account Date:',NULL,array('attribute'=>array('readonly'=>"")));
field("text", "branch_code", 'Branch Code:',NULL,array('attribute'=>array('readonly'=>"")));
field("text", "cheque_account", 'Cheque Account:',NULL,array('attribute'=>array('readonly'=>"")));

close_form();

f_start_col2();

open_form('gl_info', 'GL Account');
//echo '<div class="input-append">';
//field("text", "gl_code", "GL Code: ", NULL, array('attribute' => array('list' => "gl_code",'style'=>"width:209px;")), TRUE,
//        '<datalist id="gl_code">'.$list_gl.'</datalist><button type="button" class="btn">Search</button>');
field("text", "gl_code", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code",'id'=>"gl_code", 'style'=>"width:209px;")), TRUE,
        '<datalist id="list_gl_code">'.$list_gl.'</datalist><br /><button type="button" class="btn gl_code">Search</button>');

//echo '</div>';

field("text", "gl_account_no", " GL Account No:",NULL, array('attribute' => array('readonly'=>"", 'style'=>"width:209px;",'id'=>"code_gl")));
field("textarea", "gl_detail","GL Description:",NULL,array('attribute'=>array('readonly'=>"",'id'=>"gl_description")));

close_form();

open_form('tra_info', 'Transaction Information');

//field('hidden','cid');
//field('hidden','gl_id');
echo form_hidden('cid');
echo form_hidden("gl_code");
field('select', 'transaction', 'Transaction Mode:', '1', 
        array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown', 'id' => 'test')), TRUE);

//field("text", "currency", "Carrency: ", NULL, NULL, NULL, " USD");
field('select', 'transaction_type', 'Transaction Type:','2', 
        array(
            'options' => array(
                '0'=>"-----Select-----",
                '1'=>"Debit",
                '2'=>"Credit"), 'attribute' => array('class' => 'dropdown', 'id' => 'tra_type')), TRUE);
field('select', 'currency', 'Currency :','1', array('options' => $array_currency, 'attribute' => array('class' => 'dropdown', 'id' => 'test')), TRUE);

field("text", "tra_amount", "Transaction Amount:", NULL, NULL, TRUE);
field("textarea", "tra_detail","Description:");
field("button",'btn_submit', NULL,"Submit", array('attribute'=>array('class'=>'btn')), NULL, 
    '<a class="btn btn_back" href="'.base_url().'panel"><i class="icon-circle-arrow-left"></i> Back</a>'
);
close_form();
close_form_model();

echo '</div>';
?>
