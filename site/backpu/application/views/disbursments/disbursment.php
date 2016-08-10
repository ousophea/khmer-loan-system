<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Get Laon Account infimation
$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
    // $list_acc_number .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_acc_number.= '</datalist>';

//Get transaction mode for desplay in list
//$array_transaction = array();
//
//foreach ($transaction_query->result() as $tra_rows) {
//    $array_transaction[''] = '-----Select-----';
//    $array_transaction[$tra_rows->tra_mod_id] = $tra_rows->tra_mod_title;
//}

////Get Loan disbursment info
//$arr_search_index = array(
//    'loa_dis_loa_acc_code' => '66-000001-00-1'
//);
//
//$loa_dis_query = $this->m_disbursments->select_disbursed($arr_search_index);

echo'<div id="disbursment_form" class="single_large">';
start_form_model(1);


open_form('dis_acc_info', 'Principal Owner Information', "disbursments/search_acc_num");

field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'id' => "account_number", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code"  id="btn_search_account_number" href="' . base_url() . 'disbursments/search_acc_num"> Search</a>');
echo '<span id="account_number_des"></span>';

//         $arr_search_index = array(
//                "loa_acc_code" =>"66-000001-00-1"
//            );
//         $cid = "66-000001-00-1";
//         $query_all = $this->m_disbursments->select_acc_info($arr_search_index);

close_form();
//f_start_col2();
//echo"<div id='dis_form'>";
//open_form('disbursments_tra', 'Disbursments / Debit', "disbursments/add_dis");
//
//
//field('select', 'transaction_mode', 'Transaction Mode:', '1', array('options' => $array_transaction, 'attribute' => array('class' => 'dropdown validate[required]', 'id' => 'test')), TRUE);
//field('text', 'gl_contra_account', 'GL contra Account:');
//field('text', 'value_date', 'Value date:');
//field('text', 'dis_amount', 'Trn Amount:',NULL,NULL,TRUE);
//field('textarea', 'dis_des', 'Description:');
//

//echo'<span>';
open_form('disbursments_tra', 'Disbursments / Debit', "disbursments/add_dis");
echo"<span id='dis_form_and_tbl'>";
//field('text', 'gl_contra_account', 'GL contra Account:');
////
echo '</span>';
close_form();

//echo"</div>"; // close form disburement

close_form_model();
echo"</div>";

//echo formatMoney(1050); # 1,050
//echo formatMoney(1321435.4, true); # 1,321,435.40
//echo formatMoney(10059240.42941, true); # 10,059,240.43
//echo formatMoney(13245); # 13,245



?>

<script type="text/javascript" language="JavaScript">
    var jq_code = jQuery.noConflict();
    jq_code(document).ready(function(){
       
        jq_code('form#dis_acc_info').attr('onSubmit','return false;');
//        jq_code('[name="value_date"]').val(date);
        jq_code('#btn_search_account_number').click(function(){
            var getAccNumber = jq_code('#account_number').val();
            //jq_code("#account_number_des").html("Loading...");
            
            if(getAccNumber!=""){
                var this_url = jq_code(this).attr('href');
                
                var form_data = {
                    accNum : getAccNumber
                };
                
                jq_code.ajax({ 
                    url: this_url,
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success: function(output_string){
                        jq_code("#account_number_des").html(output_string);
                        jq_code("#dis_form_and_tbl").html(jq_code("#form_and_data_table").html());
                        jq_code("#form_and_data_table").html("");
//                        jq_code("input[name='value_date']").val();
                    }
                
                });
                
            }else{
                alert("Account number is require..!");
                jq_code('#account_number').focus();
            }
            return false;
        });
               
   
    });
    
</script>
