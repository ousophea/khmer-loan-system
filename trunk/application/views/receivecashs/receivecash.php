<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<div id='test'></div>";


// Get Gl infimation
$list_gl = "";
$list_gl .= '<datalist id="gl_code">';
foreach ($gl_query->result() as $gl_rows) {

    $list_gl .='<option value="' . $gl_rows->gl_code . ':' . $gl_rows->gl_description . '">';
    // $list_gl .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_gl.= '</datalist>';

//Get transaction mode for desplay in list
$array_transaction = array();

foreach ($transaction_query->result() as $tra_rows) {
    $array_transaction['0'] = '-----Select-----';
    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows->tra_mod_title;
}

//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency['0'] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//Get CID from database
$list_cid = "";
$list_cid .= '<datalist id="list_cid">';
foreach ($cid_query->result() as $cid_rows) {

    $list_cid .='<option value="' . $cid_rows->con_id . '">';
}
$list_cid.= '</datalist>';


echo '<div class="myform">';
start_form_model(2);

open_form('account_info', "Account information");
field("text", "cid", "CID :", NULL, array('attribute' => array('list' => "list_cid", 'id' => "cid", "title" => "")), TRUE, '<datalist id="list_cid">' . $list_cid . '</datalist>' .
        '<a class="btn"  id="btn_search_cid" href="' . base_url() . 'receivecashs/con_info"> Search</a>');
//            <button type="button" id="btn_search_cid" class="btn">Search</button>');
//            field('text','txt_name','Name:','Vannak',array('attribute'=>array('class'=>'user')),TRUE);//<label for="CID:">CID:</label><input type="text" name="txt_name" />
//            field('select','sex','Sex:','m',array('options'=>array('0'=>'select','m'=>'Male','f'=>'Female'),'attribute'=>array('class'=>'dropdown','id'=>'test')),TRUE);
//            field('radio','status','Status:','single',array('radio_list'=>array('Married'=>'married','Single'=>'single'),'attribute'=>array('class'=>'status')));
//            field('checkbox','favorite','Favorite:',NULL,array('checkbox_list'=>array('TV'=>'tv','Dance'=>'dance'),'attribute'=>array('class'=>'checkbox')),TRUE);
//            field('textarea','txt_description','Description',NULL,NULL,TRUE);
//            field('button','btn_back',NULL,'Back',array('attribute'=>array('class'=>'btn')));



close_form();
echo '<div id="c_info">';
open_form('account_detail', 'Account Detail');
field("text", "account_type", "Account Type: ", NULL, array('attribute' => array('readonly' => "")));
field("text", "account_no", "Account No: ", NULL, array('attribute' => array('readonly' => "")));
field("text", "account_date", 'Account Date:', NULL, array('attribute' => array('readonly' => "")));
field("text", "branch_code", 'Branch Code:', NULL, array('attribute' => array('readonly' => "")));
field("text", "cheque_account", 'Cheque Account:', NULL, array('attribute' => array('readonly' => "")));

close_form();
echo '</div>';
f_start_col2();

open_form('form_gl_account', 'GL Account');
//echo '<div class="input-append">';
//field("text", "gl_code", "GL Code: ", NULL, array('attribute' => array('list' => "gl_code",'style'=>"width:209px;")), TRUE,
//        '<datalist id="gl_code">'.$list_gl.'</datalist><button type="button" class="btn">Search</button>');
field("text", "gl_code", "GL Code: ", NULL, 
        array('attribute' => array('list' => "list_gl_code", 'id' => "gl_code", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist><br />
<a class="btn gl_code"  id="btn_search_gl" class="btn gl_code" href="' . base_url() . 'receivecashs/gl_info"> Search</a>');

//echo '</div>';
echo '<div id="gl_info">';
field("text", "gl_account_no", " GL Account No:", NULL, array('attribute' => array('readonly' => "", 'style' => "width:209px;", 'id' => "code_gl")));
field("textarea", "gl_detail", "GL Description:", NULL, array('attribute' => array('readonly' => "", 'id' => "gl_description")));
echo '</div>';
close_form();

open_form('tra_info', 'Transaction Information', "receivecashs/add");

//field('hidden','cid');
//field('hidden','gl_id');
//echo form_hidden('hidden_cid');
//echo form_hidden("hidden_gl_code");
field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown', 'id' => 'test')), TRUE);

//field("text", "currency", "Carrency: ", NULL, NULL, NULL, " USD");
field('select', 'transaction_type', 'Transaction Type:', '2', array(
    'options' => array(
        '0' => "-----Select-----",
        '1' => "Debit",
        '2' => "Credit"), 'attribute' => array('class' => 'dropdown', 'id' => 'tra_type')), TRUE);
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('class' => 'dropdown', 'id' => 'test')), TRUE);

field("text", "tra_amount", "Transaction Amount:", NULL, NULL, TRUE);
field("textarea", "tra_detail", "Description:");
field("submit", 'btn_submit', NULL, "Submit", array('attribute' => array('class' => 'btn', 'id' => 'btn_submit')), NULL, '<a class="btn btn_back" href="' . base_url() . 'receivecashs/lists"><i class="icon-circle-arrow-left"></i> Back</a>'
);
close_form();
close_form_model();

echo '</div>';
?>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function(){
        
        jq('#btn_search_cid').click(function(){
            var this_url = jq(this).attr('href');
            var getCid = jq("#cid").val();
            
            if(getCid == null || getCid == '') return false;
            var form_data = {
                cid : getCid
            };
            
            // Using ajax to get account info from data by CID 
            jq.ajax({ 
                url: this_url,
                type: 'POST',
                async : false,
                data: form_data,
                success: function(output_string){
                    jq('#c_info').html(output_string);
                    jq('').html(output_string);
                }
                
            });
            return false;
        });
        
        jq('#btn_submit').click(function(){
            //alert(true);
            jq("#tra_info").submit();
            
        });
        
        jq('#btn_search_gl').click(function(){
            var arr_gl_val = (jq('#gl_code').val()).split(':');
            
            if(arr_gl_val[0] || arr_gl_val[0]!=""){
                var this_url = jq(this).attr('href');
                
                var getGlid = arr_gl_val[0];
                if(getGlid == null || getGlid == '') return false;
            var form_data = {
                glCode : getGlid
            };
                jq.ajax({ 
                    url: this_url,
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success: function(output_string){
                        jq('#gl_info').html(output_string);
                    }
                
                });

            }else{
                alert("Don't have GL Code is require..!");
                this.focus();
            }
            return false;
        });
        
    });
</script>
