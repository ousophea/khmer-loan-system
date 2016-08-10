<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Get Laon Account infimation
$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->sav_acc_code . '">';
    // $list_acc_number .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_acc_number.= '</datalist>';


if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
}



echo'<div id="withdrawal_form" class="single_large">';
start_form_model(2);


open_form('wit_acc_info', 'Principal Owner Information', "withdrawals/search_acc_num");

field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'id' => "account_number", 'style' => "width:145px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code"  id="btn_search_account_number" href="' . base_url() . 'withdrawals/search_acc_num"> Search</a>');
echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//

close_form();


f_start_col2();
open_form('withdrawal_res', 'Withdrawal / Debit Restictions');
echo"<span id='wit_res'></span>";
//close_box();
close_form();
open_form('withdrawal_tra', 'Withdrawal / Debit information', "withdrawals/add_wit");
//open_box('withdrawal_tra', 'Withdrawal / Debit information');
echo"<span id='wit_form'></span>"; // ===========Deposit form====================//
close_form();

//open_form('cheque_form', 'Cheque Information');
//echo"<span id='cheque'></span>";
//close_form();
close_form_model();
echo '<span id="submit_too"></span>';


echo"</div>";
?>

<script type="text/javascript" language="JavaScript">
    
    var jq_code = jQuery.noConflict();
    jq_code(document).ready(function(){
        jq_code('form#wit_acc_info').attr('onSubmit','return false;');
        jq_code('form#withdrawal_tra').submit(function(){
            return test();
        });
        jq_code('#btn_search_account_number').click(function(){
            var getAccNumber = jq_code('#account_number').val();            
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
                        jq_code("#wit_form").html(jq_code("#form_input").html());
                        jq_code("#form_input").html("");
                        
                        jq_code("#wit_res").html(jq_code(".wit_res_data").html());
                        jq_code(".wit_res_data").html("");
                        
                        jq_code("#submit_too").html(jq_code("#sub_tool").html());
                        jq_code("#sub_tool").html("");
                        
                    }
                
                });
                
                 jq_code('#wit_amount').numberOnly();
//                jq_code('#wit_amount').onlyNum();
                jq_code('#wit_amount').on('keyup',function(e){
                    if(parseInt(jq_code(this).val()) > parseInt(jq_code('#hid_out_balance').val())){
                        alert("Over value to withdraw..!");
                        jq_code(this).val("");
                        //                        jq_code(this).val(jq_code(this).val().replace(/.$/g, ''));
                    }else{
                        var out_balance = jq_code('#hid_out_balance').val()- jq_code(this).val();
                        jq_code('#out_balance').html(out_balance);
                    }
                });
                
            }else{
                alert("Account number is require..!");
                jq_code('#account_number').focus();
            }
            return false;
        });
        
        function test(){
            var out_balance = jq_code('#hid_out_balance').val()- jq_code("#wit_amount").val();
            alert(out_balance);
            return false;
        }
        
    });
    
</script>
