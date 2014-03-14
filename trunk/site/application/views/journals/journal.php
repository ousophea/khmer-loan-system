<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
    $array_transaction[''] = '-----Select-----';
    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows->tra_mod_title;
}

//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//Get CID from database
$list_cid = "";
$list_cid .= '<datalist id="list_cid">';
foreach ($cid_query->result() as $cid_rows) {

    $list_cid .='<option value="' . $cid_rows->con_id . '">';
}
$list_cid.= '</datalist>';


start_form_model(1);


open_form('journal_tra_info', 'Transaction Detail', "journals/add");
echo'<div id="journal_entry">';
field('radio', 'journal_type', 'Entry Type:', NULL, array('radio_list' => array('Single' => 'single', 'Multyple' => 'multyple'),
    'attribute' => array('class' => "entry_typ"))
);
echo "</div>"; // close div journal_entry

echo "<div id='multiple_entry'>";
echo"<legend>Debit</legend>";
field("text", "gl_code_debit_mul", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "debit_gl", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>
<a class="btn gl_code btn_search_gl"  id="btn_search_gl_debit" href="' . base_url() . 'journals/gl_info"> Search</a>');
//echo "<div id='debit_text'>fsd</div>";
echo "<span id='debit_gl_des'></span>";
//field("textarea", "debit_gl_des", NULL);
field("text", "debit_amount_mul", "Debit Amount:", NULL, array('attribute' => array('id' => "debit_amount_mul")), TRUE);

echo"<legend>Credit</legend>";
field("text", "gl_code_credit_mul", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "credit_gl", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>
            
<a class="btn gl_code btn_search_gl"  id="btn_search_gl_credit" class="btn gl_code" href="' . base_url() . 'journals/gl_info"> Search</a>');
//echo "<div id='crabit_text'>sdfsd</div>";
echo "<span id='credit_gl_des'></span>";
//field("textarea", "crabit_gl_des", NULL);
field("text", "credit_amount_mul", "Cradit Amount:", NULL, array('attribute' => array('id' => "credit_amount_mul")), TRUE);
echo"<legend>&nbsp;</legend>";
echo "</div>"; // close div journal entry
echo "<br />";





field("text", "cid", "CID :", NULL, array('attribute' => array('list' => "list_cid", 'id' => "cid", "title" => "", 'style' => "width:209px;")), FALSE, $list_cid .
        '<a class="btn"  id="btn_search_cid" href="' . base_url() . 'journals/con_info"> Search CID</a>');
echo "<span id='con_des'></span>";
//field("textarea", "con_des", NULL, NULL, array('attribute' => array('readonly' => "", 'id' => "con_des")));
// Open GL for sigle entry
echo "<div id='gl_code_sigle'>";
field("text", "gl_code_signle", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "single_gl", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>
            
<a class="btn gl_code btn_search_gl"  id="btn_search_gl_single" class="btn gl_code" href="' . base_url() . 'journals/gl_info"> Search</a>');
echo "<span id='single_gl_des'></span>";

//field("textarea", "singl_gl_des", NULL);
echo"</div>";
// Close GL for sigle entry


field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);

field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);


echo"<div id='single_entry_block'>"; // Open amount and transation typoe for single entry

field('select', 'transaction_type', 'Transaction Type:', '2', array(
    'options' => array(
        '' => "-----Select-----",
        '1' => "Debit",
        '2' => "Credit"), 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'tra_type')), TRUE);

field("text", "tra_amount_single", "Transaction Amount:", NULL, array('attribute' => array('id' => "tra_amount_single")), TRUE);

echo"</div>"; // Close amount and transation type for single entry




field("textarea", "tra_detail", "Description:");

field("submit", 'btn_submit_sigle', NULL, "Submit", array('attribute' => array('class' => 'btn btn_submit', 'id' => 'btn_submit')), NULL, '<a class="btn btn_back" href="' . base_url() . 'receivecashs/lists"><i class="icon-circle-arrow-left"></i> Back</a>'
);

close_form();
close_form_model();
?>
<script type="text/javascript" language="JavaScript">
    var jq_code = jQuery.noConflict();
    jq_code(document).ready(function(){
        jq_code("#multiple_entry").hide();
        jq_code("#single_entry_block").show();
        jq_code('.btn_submit').attr('disabled','disabled');// Block submit button befor input GL Code
        
        jq_code('input:radio[name=journal_type][value=single]').attr('checked', true);
        jq_code("#debit_gl").removeAttr("required");
        jq_code("#credit_gl").removeAttr("required");
        jq_code("#debit_amount_mul").removeAttr("required");
        jq_code("#credit_amount_mul").removeAttr("required");
                
        jq_code(".entry_typ").click(function(){    
            var type = jq_code(this).val();
            if(type == "single"){
                jq_code("#multiple_entry").fadeOut();
                jq_code("#single_entry_block").show();
                jq_code("#gl_code_sigle").show();
                jq_code("#gl_code_debit_mul").removeAttr("required");
                jq_code("#gl_code_credit_mul").removeAttr("required");
                jq_code("#debit_amount_mul").removeAttr("required");
                jq_code("#credit_amount_mul").removeAttr("required");
                jq_code("#btn_submit").attr("name",'btn_submit_sigle');
                
            }else{
                jq_code("#btn_submit").attr("name",'btn_submit_multy');
                jq_code("#multiple_entry").fadeIn();
                jq_code("#single_entry_block").hide();
                jq_code("#gl_code_sigle").hide();
                jq_code("#single_gl").removeAttr("required");
                jq_code("#tra_type").removeAttr("required");
                jq_code("#tra_amount_single").removeAttr("required");
                
                jq_code("#debit_gl").attr("required","required");
                jq_code("#credit_gl").attr("required","required");
                jq_code("#debit_amount_mul").attr("required","required");
                jq_code("#credit_amount_mul").attr("required","required");
                
            }
        });
        function doRemoveAttr(id,att){
            jq_code(id).removeAttr(att);
        }
        
        jq_code('#btn_search_cid').click(function(){
            var this_url = jq_code(this).attr('href');
            var getCid = jq_code("#cid").val();
            if(getCid == null || getCid == '') return false;
            var form_data = {
                cid : getCid
            };
            // Using ajax to get account info from data by CID 
            jq_code.ajax({ 
                url: this_url,
                type: 'POST',
                async : false,
                data: form_data,
                success: function(output_string){
                    
                    jq_code('#con_des').html(output_string);
                    //                    jq_code('').html(output_string);
                }
                
            });
            return false;
        });
        
         
//        jq_code('#btn_search_gl_single').click(function(){
//            var arr_gl_val = (jq_code('#single_gl').val()).split(':');
//            //jq_code('#form_gl_account').submit();
//            //            
//            if(arr_gl_val[0] || arr_gl_val[0]!=""){
//                var this_url = jq_code(this).attr('href');
//                
//                var getGlid = arr_gl_val[0];
//                if(getGlid == null || getGlid == '') return false;
//                var form_data = {
//                    glCode : getGlid
//                };
//                jq_code.ajax({ 
//                    url: this_url,
//                    type: 'POST',
//                    async : false,
//                    data: form_data,
//                    success: function(output_string){
//                        jq_code('#singl_gl_des').html(output_string);
//                    }
//                
//                });
//
//            }else{
//                alert("Don't have GL Code is require..!");
//                jq_code('#singl_gl_des').focus();
//            }
//            return false;
//        });
        
         jq_code('.btn_search_gl').click(function(){
            var str = jq_code(this).attr('id').replace('btn_search_gl_','');
            var txtName = str+"_gl";
            var desName = str+"_gl_des";
            //alert(desName);
            //alert(jq_code("#"+txtName).val());return false;
            var arr_gl_val = (jq_code("#"+txtName).val()).split(':');
            if(arr_gl_val[0] || arr_gl_val[0]!=""){
                var this_url = jq_code(this).attr('href');
                
                var getGlid = arr_gl_val[0];
                if(getGlid == null || getGlid == '') return false;
                var form_data = {
                    glCode : getGlid
                };
                jq_code.ajax({ 
                    url: this_url,
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success: function(output_string){
                        jq_code("#"+desName).html(output_string);
                    }
                
                });
                
            }else{
                alert("GL Code is require..!");
                jq_code('#'+txtName).focus();
            }
            return false;
        });
        
    });
</script>
