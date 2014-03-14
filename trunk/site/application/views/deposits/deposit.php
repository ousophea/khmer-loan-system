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



echo'<div id="deposit_form" class="single_large">';
start_form_model(1);


open_form('dep_acc_info', 'Principal Owner Information', "deposits/search_acc_num");

field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'id' => "account_number", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code"  id="btn_search_account_number" href="' . base_url() . 'deposits/search_acc_num"> Search</a>');
echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//

close_form();

open_form('deposit_tra', 'Deposit / Credit', "deposits/add_dep");
echo"<span id='dep_form'></span>"; // ===========Deposit form====================//
close_form();

close_form_model();
echo"</div>";
?>

<script type="text/javascript" language="JavaScript">
    var jq_code = jQuery.noConflict();
    jq_code(document).ready(function(){
       
        jq_code('form#dep_acc_info').attr('onSubmit','return false;');
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
                        jq_code("#dep_form").html(jq_code("#form_input").html());
                        jq_code("#form_input").html("");
                        //                        jq_code("input[name='value_date']").val();
                    }
                
                });
                jq_code('.numeric').numberOnly();
                
            }else{
                alert("Account number is require..!");
                jq_code('#account_number').focus();
            }
            return false;
        });
        
    });
    
</script>
