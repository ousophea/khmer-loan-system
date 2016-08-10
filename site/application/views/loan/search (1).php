<?php
// Get Laon Account infimation
$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
    // $list_acc_number .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_acc_number.= '</datalist>';


echo'<div id="disbursment_form" class="single_large">';
start_form_model(1);


open_form('dis_acc_info', 'Principal Owner Information', "disbursments/search_acc_num");

field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number",'class'=>'numeric', 'id' => "account_number", 'style' => "width:209px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code"  id="btn_search_account_number" href="' . base_url() . 'loan/search_account"> Search</a>');
echo '<span id="account_number_des"></span>';

close_form();

close_form_model();
echo"</div>";
?>

<script type="text/javascript" language="JavaScript">
    var jq_code = jQuery.noConflict();
    jq_code(document).ready(function(){
       
        jq_code('form#dis_acc_info').attr('onSubmit','return false;');
//        jq_code('[name="value_date"]').val(date);
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
                    success: function(data){
                        
                        alert(data);
//                        jq_code("#account_number_des").html(data);
//                        jq_code("#dis_form_and_tbl").html(jq_code("#form_and_data_table").html());
//                        jq_code("#form_and_data_table").html("");
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
