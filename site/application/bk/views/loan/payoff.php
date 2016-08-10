<?php
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
echo form_open_multipart('loan/do_close_loan', array('class' => 'form-horizontal', 'name' => 'open_loan', 'id' => 'form_loan_approv'));

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
                ?>
            </div>
        </div>               
        <?php
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
        acc_info('Account Status', 'loa_acc_loa_detail');
        acc_info('Loan Purpose', 'loa_lpp_title');
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
//            ==================Footer =========
        echo '<div class="modal-footer">';
        echo form_submit(array('name' => 'Payoff', 'class' => 'btn btn-warning'), 'Payoff');
         echo anchor('panel', 'Cancel', 'class="btn"');
        echo '</div></div>';
        ?>
        <div>

        </div>
    </div>
    <script>

        jQuery.noConflict();
        (function($) {


            $(function() {

                $('.numeric').numberOnly();
<?php echo "var code='$random_code';" ?>
                var uri = [
                    $('[name="base_url"]').val(),
                    $('[name="segment1"]').val(),
                    $('[name="segment2"]').val(),
                    $('[name="segment3"]').val(),
                ];
                 $('#btn_action').addClass("disable_box");
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
                            alert("Account number not found, please try another Account.");
                            $('.controls:gt(0)').html('');
                            $('#btn_action').addClass("disable_box");

                        }
                        else {

                            //                        $('[name="loa_con_id"]').val(data.loa_acc_id+code);//=====For security=======
                            $('[name="loa_con_id"]').val(data.loa_acc_id);
                            $('#btn_action').removeClass("disable_box"); //// =========Show footer button submit========
//                        $('#btn_tool').removeClass("disable_box");//// =========Show botton submit========
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
//                        $('[name="gl_code"]').html(data.gl_des);
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
                            $('[name="loa_acc_loa_detail"]').html(data.loa_acc_loa_detail);
                             $('[name="loa_lpp_title"]').html(data.loa_lpp_title);
                             $('[name="loa_ins_installment_amount"]').html(data.loa_ins_installment_amount);

                            var status = data.loa_detail;
                            if (status == "Disapproved") {
                                $('#Approved').removeClass('disabled');
                                $('#Approved').addClass('action_btn');
                            } else {
                                $('#Disapproved').removeClass('disabled');
                                $('#Disapproved').addClass('action_btn');
                            }




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


            });


        })(jQuery);


    </script>
</div>
<?php
echo form_close();
?>