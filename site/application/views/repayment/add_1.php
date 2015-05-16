<?php
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';

$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
}
$list_acc_number.= '</datalist>';
?>

<?php
echo'<div id="deposit_form" class="single_large">';

start_form_model(1);
open_form('repayment_form', 'Principal Owner Information', "repayment/update");

field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'class' => 'numeric', 'id' => "account_number", 'style' => "width:124px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code" style=" padding: 4px 8px;"  id="search_customer_by_code" href="' . base_url() . 'repayment/search_loan_account"><i class="icon-search loader"></i> Search</a>
    <span id="account_number_des" class="error"></span><input type="hidden" value="" id="loan_id" name="loan_id">');
//echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//

$now = time();
//field("text", "value_date", "Value Date:", NULL, array('attribute' => array('class' => 'txtdate')), FALSE);
//field('text', 'value_date', 'Value date:', unix_to_human($now), array('attribute' => array('readonly' => "")));

field("text", "limit_date", "Limit Date:", NULL, array('attribute' => array('class' => 'txtdate', 'readonly' => "")), FALSE, '<span id="payment_des" class="error"></span><input type="hidden" value="0" id="payment_late" name="payment_late">');
//field("text", "currency", "Settlement Currency:", NULL, array('attribute' => array('readonly' => "")));
field("text", "amount", "Settlement Amount:", NULL, array('attribute' => array('readonly' => "")), FALSE, ' <span id="currency_title"></span>');

//field('select', 'currency', 'Currency:', NULL, array('options' => $currency, 'attribute' => array('id' => 'currency')), TRUE);
field("text", "paid_amount", "Paid Amount:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
field("textarea", "rep_detail", "Description:");
echo '<div class="modal-footer btn_tool">';

echo form_submit(array('name' => 'Confirm', 'class' => 'btn btn-success btn_confirm'), 'Confirm');
echo anchor('loan/lists', 'Cancel', 'class="btn"');
echo '</div>';

close_form();
close_form_model();
echo"</div>";
//
//echo'<div id="deposit_form" class="single_large">';
//start_form_model(1);
//
//
//open_form('dep_acc_info', 'Principal Owner Information', "deposits/search_acc_num");
//
//field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'id' => "account_number", 'style' => "width:209px;"))
//        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
//<a class="btn account_number btn_search_gl gl_code"  id="btn_search_account_number" href="' . base_url() . 'deposits/search_acc_num"> Search</a>');
//echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//
//
//close_form();
//
//open_form('deposit_tra', 'Deposit / Credit', "deposits/add_dep");
//echo"<span id='dep_form'></span>"; // ===========Deposit form====================//
//close_form();
//
//close_form_model();
//echo"</div>";
?>

<script type="text/javascript" language="JavaScript">
    var jq_code = jQuery.noConflict();

    jq_code(document).ready(function () {
        jq_code('.btn_tool').addClass("disable_box");
        jq_code('#search_customer_by_code').click(function () {
            var getAccNumber = jq_code('#account_number').val();
            jq_code("#account_number_des").html("Loading...");
            if (getAccNumber != "") {
                var this_url = jq_code(this).attr('href');
                var form_data = {
                    accNum: getAccNumber
                };
                jq_code.ajax({
                    url: this_url,
                    type: 'POST',
                    async: false,
                    data: form_data,
                    dataType: "json",
                    success: function (data) {
                        //                     jq_code("#account_number_des").html(data.loa_acc_id);

                        if (data.loa_acc_id) {

                            //==== Check for late repayment=============
                            //                            if(data.rep_sch_date_repay < now()){

                            //xdate.setFullYear(currentdate.getFullYear(),currentdate.getMonth(),currentdate.getDate());
                            var pay_late = checkDate(data.rep_sch_date_repay);
                            if (pay_late > 0) {
                                jq_code("#payment_des").html("<span class='help-block'>Late payment " + pay_late + " day(s)</span>");
                                jq_code("#payment_late").val(pay_late);
                            }

                            //                                jq_code("#payment_des").html(data.rep_sch_date_repay);
                            //                            }

                            jq_code('.btn_tool').removeClass("disable_box");//// =========Show botton submit========
                            jq_code("#loan_id").val(data.loa_acc_id);
                            jq_code('[name="limit_date"]').val(data.rep_sch_date_repay);
                            jq_code('[name="amount"]').val(data.rep_sch_total_repayment);
                            jq_code('#currency_title').html(data.cur_title);
                            jq_code('[name="paid_amount"]').val(data.rep_sch_total_repayment);
                            jq_code("#account_number_des").html("");
                        } else {
                            jq_code("#account_number_des").html('<span class="help-block">Loan acount not found..!</span>');
                            jq_code('.btn_tool').addClass("disable_box");
                        }
                        //                    

//                                                jq_code("#dis_form_and_tbl").html(jq_code("#form_and_data_table").html());
//                                                jq_code("#form_and_data_table").html("");
                    }

                });
                return false;

            } else {
                alert("Account number is require..!");
                jq_code('.btn_tool').addClass("disable_box");
                jq_code('#account_number').focus();

            }
            return false;
        });


    });
    function checkDate(payDate) {
        var arr_date = payDate.split('-');
        var x = new Date();
        var set_date = x.setFullYear(arr_date[0], arr_date[1] - 1, arr_date[2]);
        var today = new Date();
        var late_pay_number = (-1) * (set_date - today);
        var num_days = Math.round(late_pay_number / (1000 * 60 * 60 * 24));

        //alert(num_days);
        if (set_date >= today)
        {
            return 0;
        }
        else
        {
            return num_days;
        }
    }

</script>