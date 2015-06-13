<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//echo "<div id='test'></div>";

// Get Gl infimation
$list_gl = "";
$list_gl .= '<datalist id="gl_code">';
    
foreach ($gl_query->result() as $gl_rows) {

    $list_gl .='<option value="' . $gl_rows->gl_code . ':' . $gl_rows->gl_kh_description.'">';
    // $list_gl .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_gl.= '</datalist>';
//
//Get transaction mode for desplay in list
$array_transaction = array();

foreach ($transaction_query->result() as $tra_rows) {
    $array_transaction[''] = '-----Select-----';
    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows->tra_mod_title;
}
//
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//Get CID from database
//$list_cid = "";
//$list_cid .= '<datalist id="list_cid">';
//foreach ($cid_query->result() as $cid_rows) {
//
//    $list_cid .='<option value="' . $cid_rows->con_id . '">';
//}
//$list_cid.= '</datalist>';

echo '<div class="myform">';
start_form_model(1);

open_form('transaction_info', 'Transaction Information',"paycashs/add");
field("text", "gl_code", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "pay_gl", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>
            <a class="btn btn_search_gl"  id="btn_search_gl_pay" href="' . base_url() . 'paycashs/gl_info"> Search</a>');
echo '<span id="pay_gl_des"></span>';
field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);
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
                
        jq('.btn_search_gl').click(function(){
            var str = jq(this).attr('id').replace('btn_search_gl_','');
            var txtName = str+"_gl";
            var desName = str+"_gl_des";
            //alert(desName);
            //alert(jq("#"+txtName).val());return false;
            var arr_gl_val = (jq("#"+txtName).val()).split(':');
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
                        jq("#"+desName).html(output_string);
                    }
                
                });
                
            }else{
                alert("GL Code is require..!");
                jq('#'+txtName).focus();
            }
            return false;
        });
    });
</script>
