<?php
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
echo form_open_multipart('loan/active', array('class' => 'form-horizontal', 'name' => 'open_loan', 'id' => 'form_loan_approv'));

//================= Get Laon Account infimation =================
$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
}
$list_acc_number.= '</datalist>';
//================= End Laon Account infimation =================
?>
<div class="row form-container">
    <div class="form_model_style"></div>

    <div class="loan_style">
        <?php
        echo open_span(5);
        echo open_block('cutomer_info', 'Customer information');

        field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'class' => 'numeric', 'id' => "account_number", 'style' => "width:124px;"))
                , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code" style=" padding: 4px 8px;"  id="search_customer_by_code" href="#"><i class="icon-search loader"></i> Search</a>');
        echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//
//        echo "<span class='acc_info_des'>";
//        echo "<span class='acc_info_des'>";
        ?>
        <div class="control-group">
            <div class="controls">


                <?php
                echo form_hidden('loa_con_id', set_value(''));
//                echo '<span class="error">' . form_error('cid') . '</span>';
                ?>
            </div>
        </div>               
        <?php
//        acc_info('Display name', 'displayname');
//
//        acc_info('Date of birth', 'con_dob');
//        acc_info('Address', 'con_address');

        echo "<div id='c_info'></div>";
        echo "</span>";
        echo close_block();
//-----------------------------


        echo open_block('principal_info', 'Principal Owner Information');
        acc_info('CID', 'view_con_cid');
        acc_info('Display name', 'displayname');
        acc_info('Date of birth', 'con_dob');
        acc_info('Address', 'con_address');
        echo close_block();

        echo open_block('product_detail', 'Product Owner Information');
        acc_info('Product type', 'loa_acc_loa_pro_typ_id');
        acc_info('Currency', 'currency');
        echo "<span id='status_view'>";
        acc_info('Account Status', 'loa_detail');
        echo "</span>";

        echo close_block();
        echo close_span();
// End Left
// ===============Start right colunm===============
        echo open_span(5);
        $tab1 = "";
        $tab2 = "";
        echo '<span id="tbl_rep_box" class="content-list">';


//        $tab1.=open_block('general_info', 'Loan Specs');

//        $tab1.= acc_info_html('GL Code', 'gl_code');
        $tab1.= acc_info_html('គណនីអតិថិជន ', 'loa_acc_typ_num');
        $tab1.= acc_info_html('Loan Amount', 'loan_amount');
        $tab1.= acc_info_html('Interest Rate', 'interest_rate');
        $tab1.= acc_info_html('Penalty Rate', 'penalty_rate');
        $tab1.= "<hr>";
//        $tab1.= acc_info_html('Disbursment Date', 'disbursment_date');
        $tab1.= acc_info_html('First Repayment', 'firstrepayment_date');
        $tab1.= acc_info_html('Maturity Date', 'maturity_date');
        $tab1.= "<hr>";

        $tab1.= acc_info_html('Number of Installments', 'num_installments');
        $tab1.= acc_info_html('Repayment Freg', 'rep_freg');
        $tab1.= acc_info_html('Installment Amount', 'loa_ins_installment_amount');

//        acc_info('Loan Amount', 'loan_amount');
//        acc_info('Interest Rate', 'interest_rate');
//        acc_info('Penalty Rate', 'penalty_rate');
//        echo "<hr>";
////      acc_info('Disbursment Date', 'disbursment_date');
//        acc_info('First Repayment', 'firstrepayment_date');
//        acc_info('Maturity Date', 'maturity_date');
//        echo "<hr>";
//
//        acc_info('Number of Installments', 'num_installments');
//        acc_info('Repayment Freg', 'rep_freg');
//        acc_info('Installment Amount', 'loa_ins_installment_amount');
//       
//        $tab1 .= close_block();

        $tab2 .='<span id="repayment_tbl"></span>';

        $tabs = array(
            array("Loan Specs", $tab1),
            array("Repayment", $tab2),
        );
        echo tab_form($tabs);

        echo close_span();

// End span5

        echo '</div>';


        echo '<div id="btn_action" class="span10">';
//        ==================Repayment Table====================
//        echo '<div id="repayment_box">';
//        echo "<span id='tmp_box'></span><span id='tmp_tbl_rep'></span><span id='tmp_loa_status'></span>";
//        echo anchor('loan/repayment_tbl', 'Repayment', 'class="btn btn-info btn_repayment"');
////        echo '<br><br><span id="repayment_tbl"></span>';
//        echo '</div>';
//            ==================Footer =========
        echo '<div class="modal-footer">';

//        echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Confirm');
        echo "<span id='btn_tool'>";
//        echo anchor('loan/voucher', 'Print', 'class="btn btn-success btn_loa_stantus  disabled"  id="print"');

        echo anchor('loan/loan_status', 'Disapprove', 'class="btn btn-danger btn_loa_stantus  disabled" id="Disapproved"');
        echo anchor('loan/loan_status', 'Approve', 'class="btn btn-success btn_loa_stantus  disabled"  id="Approved"');
        echo "</span>";
        echo anchor('panel', 'Exit', 'class="btn exit"');
        echo '</div></div>';
        ?>
        <div>

        </div>
    </div>
    <script>

        jQuery.noConflict();
        (function($) {


            $(function() {

                //                $('#btn_action,#status_view').addClass("disable_box");
                $('#btn_tool').addClass("disable_box");
                $('.numeric').numberOnly();
<?php echo "var code='$random_code';" ?>
                var uri = [
                    $('[name="base_url"]').val(),
                    $('[name="segment1"]').val(),
                    $('[name="segment2"]').val(),
                    $('[name="segment3"]').val(),
                ];

                //            ============= Button (Dis)approve click====================
                //            $('.action_btn2').click(function(){
                //                var btn_name =$(this).attr("id");
                //                //                alert(btn_name); return false;
                //                var approve = confirm("Are you sure want to "+btn_name+" this loan?");
                //                if(approve){
                //                        
                //                    var this_url = $(this).attr('href');
                //                    var id_code = $('[name="loa_con_id"]').val();
                //                    var form_data = {
                //                        "l_id_code" : id_code,
                //                        "btn_nam" : btn_name
                //                    };
                //                
                //                    $.ajax({ 
                //                        url: this_url,
                //                        type: 'POST',
                //                        async : false,
                //                        data: form_data,
                //                        success: function(output_string){
                //                            //                            $('#status_view div div').html(output_string);
                //                            //                            $('#btn_tool').addClass("disable_box");
                //                            //                            $('#status_view').removeClass("disable_box");
                //                            //                            $('.exit').html("Exit");
                //                            location.reload(true);
                //                        },
                //                        error:function(){
                //                            alert("Database not respont this time, please try again latter!");
                //                        }
                //                
                //                    });
                //                }
                //                return false;
                //            });
                //            
                //  =================Button Seacher Loan Code==============
                $('#search_customer_by_code').click(function() {

                    var acc_num = null;
                    acc_num = $('#account_number').val();

                    $('.loader').addClass('icon-loader');

                    $.post(uri[0] + "loan/find_contact_by_code",
                            {
                                'acc_num': acc_num
                            },
                    function(data) {
                        $('.loader').removeClass('icon-loader');
                        $('.loader').addClass('icon-search');
                        if (data.result == 0) {
                            //                           
                            // $('[name="cid"],[name="view_con_cid"],[name="displayname"],[name="con_dob"],[name="con_address"],[name="con_typ_title"]').html("");
                            alert("Account number not found, please try another Account.");
                            //                        $('#form_loan_approv').find(".controls:gt(0)").html('');
                            $('.controls:gt(0)').html('');
                            //                            $('#btn_action').addClass("disable_box");
                            //$(document).

                            //                            resetForm('#form_loan');///=======Reset form data
                            //                            $('#form_loan').each(function() { this.reset() });
                        }
                        else {

                            //                        $('[name="loa_con_id"]').val(data.loa_acc_id+code);//=====For security=======
                            $('[name="loa_con_id"]').val(data.loa_acc_id);
                            $('#btn_action').removeClass("disable_box"); //// =========Show footer button submit========
                            $('#btn_tool').removeClass("disable_box");//// =========Show botton submit========
                            $('[name="cid"]').html(data.con_id);
                            $('[name="view_con_cid"]').html(data.con_cid);
                            $('[name="displayname"]').html(data.con_en_last_name + " " + data.con_en_first_name);
                            //                            $('[name="accountname"]').val(data.con_en_last_name+ " "+data.con_en_first_name);
                            $('[name="con_dob"]').html(data.con_dob + " " + data.sex + "/" + data.civil);
                            $('[name="con_address"]').html(data.con_address);

                            //                            // product type
                            $('[name="loa_acc_loa_pro_typ_id"]').html(data.pro_type_code);
                            //                            
                            //                            // Loan space
//                            $('[name="gl_code"]').html(data.gl_des);
                             $('[name="loa_acc_typ_num"]').html(data.loa_acc_typ_num);
                            $('[name="currency"]').html(data.currency_title);
                            $('[name="loan_amount"]').html(data.loa_amount);
                            //                        $('[name="disbursment_date"]').html(data.loa_acc_disbustment);
                            $('[name="rep_freg"]').html(data.loa_acc_rep_fre_type);
                            $('[name="firstrepayment_date"]').html(data.loa_acc_first_repayment);
                            //                            //installment
                            $('[name="num_installments"]').html(data.loa_ins_num_ins);
                            //                            $('[name="lead_interest"]').val(data.loa_ins_lead_interest);
                            //                            $('[name="principal_start"]').val(data.loa_ins_principal_start);
                            //                            $('[name="principal_frequency"]').val(data.loa_ins_principal_frequency);
                            $('[name="interest_rate"]').html(data.loa_ins_interest_rate);
                            $('[name="maturity_date"]').html(data.create_date);
                            $('[name="loa_detail"]').html(data.loa_det_status);
                            $('[name="loa_ins_installment_amount"]').html(data.loa_ins_installment_amount);

//                            var status = data.loa_acc_loa_det_id;
                             var status = data.loa_acc_loa_detail;
                              if(status != "Approved"){
                                $('#Approved').removeClass('disabled');
                                $('#Approved').addClass('action_btn');
                            }
                             if(status != "Disapproved"){
                                $('#Disapproved').removeClass('disabled');
                                $('#Disapproved').addClass('action_btn');
                            }
//                            if (status != 2) {
//                            if(status != 3){
//                                $('#Approved').removeClass('disabled');
//                                $('#Approved').addClass('action_btn');
//                            }
//                            } else {
//
//                                $('#Disapproved').removeClass('disabled');
//                                $('#Disapproved').addClass('action_btn');
//                            }




                            //                        =============Table repayment================
                            $('#repayment_tbl').html(data.tbl_rep);
                        }

                    },
                            'json'
                            );

                    return false;
                });

                //            ===============Live disable link ======================
                $(document).on('click', '.btn_loa_stantus', function(event) {
                    return false;
                });
                //            ====================== ======================
                //            ============= Button (Dis)approve click====================
                $(document).on('click', '.action_btn', function(event) {
                    var btn_name = $(this).attr("id");
                    //                alert(btn_name); return false;
                    var approve = confirm("Are you sure want to " + btn_name + " this loan?");
                    if (approve) {

                        var this_url = $(this).attr('href');
                        var id_code = $('[name="loa_con_id"]').val();
                        var form_data = {
                            "l_id_code": id_code,
                            "btn_nam": btn_name
                        };

                        $.ajax({
                            url: this_url,
                            type: 'POST',
                            async: false,
                            data: form_data,
                            success: function() {
                                //                            $('#status_view div div').html(output_string);
                                //                            $('#btn_tool').addClass("disable_box");
                                //                            $('#status_view').removeClass("disable_box");
                                //                            $('.exit').html("Exit");
                                location.reload(true);
                            },
                            error: function() {
                                alert("Database not respont this time, please try again latter!");
                            }

                        });
                    }
                    return false;
                });

            });


        })(jQuery);


    </script>
</div>
<?php
echo form_close();
?>