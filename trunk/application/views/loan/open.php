<?php
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
echo form_open_multipart(($edit == 0) ? 'loan/add' : 'loan/edit', array('class' => 'form-horizontal', 'name' => 'open_loan', 'id' => 'form_loan'));
//echo form_hidden('gl_list', $gl);
// Get Laon Account infimation
$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
// $list_acc_number .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_acc_number.= '</datalist>';
?>
<div class="row form-container">
    <div class="form_model_style"></div>

    <!--    <div class="span12">
            <div class="tools">
                <a disabled="disabled" class="btn btn-mini btn-success" href="<?php echo base_url() . 'loan/open'; ?>" title="Open new loan account"><i class="icon-plus-sign icon-white"></i> Open new loan account</a>
                <a class="btn btn-mini" href="<?php echo base_url() . 'loan/view'; ?>" title="View loan account"><i class="icon-eye-open"></i> View loan account</a>
                <a class="btn btn-mini" href="<?php echo base_url() . 'loan/open/edit'; ?>" title="Edit loan account"><i class="icon-edit"></i> Edit loan accounts</a>
            </div>
        </div>-->

    <div class="loan_style">
        <?php
        if ($edit == 0) {
            $i = 0;
            $typethread = NULL;
            foreach ($contacts->result() as $row) {

                echo form_hidden('_' . $row->con_cid, $row->con_id);
                if ($i == 0) {
                    $typethread .= '["' . $row->con_cid . '"';
                } else {
                    $typethread .= ',"' . $row->con_cid . '"';
                }
                $i++;
            }
            $i = 0;
            $typethread .= ']';
        }


        echo open_span(5);
        echo open_block('cutomer_info', 'Customer information');

        if ($edit == 1) {

            field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'class' => 'numeric', 'id' => "account_number", 'style' => "width:124px;"))
                    , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code" style=" padding: 4px 8px;"  id="search_customer_by_code" href="#"><i class="icon-search loader"></i> Search</a>');
            echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//
            echo "<span class='acc_info_des'>";

            acc_info('CID', 'view_con_cid');
        } else {
            ?>
            <div class="control-group">
                <label class="control-label" for="cid">CID</label>
                <div class="controls">
                    <input class="input-small numeric" name="con_cid" required value="<?php echo set_value('con_cid'); /* echo !empty($_POST['con_cid'])? $_POST['con_cid']:''; */ ?>" autocomplete="off" data-source='<?php echo $typethread ?>' data-provide='typeahead' data-items='10' name="con_cid" type="text" id="con_cid" placeholder="CID">
                    <?php echo form_button(array('content' => '<i class="icon-search loader"></i> Search', 'class' => 'btn', 'id' => 'search_customer_by_code'), 'search'); ?>
                    <?php
                    echo '<span class="error">' . form_error('con_cid') . '</span>';
                    ?>
                </div>
            </div>

            <?php
            echo "<span class='acc_info_des'>";
        }
        ?>
        <div class="control-group">
            <div class="controls">


                <?php
//                echo form_hidden('cid', set_value('cid'));
                echo form_hidden('loa_con_id', set_value(''));
                echo '<span class="error">' . form_error('cid') . '</span>';
                ?>
            </div>
        </div>               
        <?php
        acc_info('Display name', 'displayname');
//field("text", "dispayname", "Display name:", NULL, array('attribute' => array('disabled' => 'disabled')), FALSE);
//$data = array(
//'type' => 'text', // input type='text'
//'label' => 'Display name',
// 'attr' => array(
//'name' => 'dispayname',
// 'disabled' => 'disabled',
// )
//);
//echo get_form($data);
        acc_info('Date of birth', 'con_dob');
//field("text", "con_dob", "Date of birth:", NULL, array('attribute' => array('disabled' => 'disabled')), FALSE);
//$data = array(
//'type' => 'text', // input type='text'
//'label' => 'Date of birth',
// 'attr' => array(
//'name' => 'con_dob',
// 'disabled' => 'disabled',
// )
//);
//echo get_form($data);
//        $data = array(
//            'type' => 'text', // input type='text'
//            'label' => 'HID',
//            'attr' => array(
//                'name' => 'hid',
//                'disabled' => 'disabled',
//            )
//        );
//        echo get_form($data);
        acc_info('Address', 'con_address');
//field("textarea", "con_address", "Address:", NULL, array('attribute' => array('disabled' => 'disabled')), FALSE);
//$data = array(
//'type' => 'textarea', // input type='text'
//'label' => 'Address',
// 'attr' => array(
//'name' => 'con_address',
// 'disabled' => 'disabled',
// )
//);
//echo get_form($data);
//Contact information

        echo "<div id='c_info'></div>";
        echo "</span>";
        echo close_block();
//-----------------------------


        echo open_block('product_detail', 'Product Detail');
        $product_type[''] = '---Select product type---';
//        $data = array(
//            'type' => 'select', // input type='text'
//            'label' => 'Product type',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'loa_acc_loa_pro_typ_code',
//                'option' => $product_type
//            )
//        );
//        echo get_form($data);
        field('select', 'loa_acc_loa_pro_typ_id', 'Product type:', NULL, array('options' => $product_type, 'attribute' => array('validated' => 1)), TRUE);

//        $data = array(
//            'type' => 'text', // input type='text'
//            'label' => 'Interest Rate',
//            'attr' => array(
//                'name' => 'interest_rate',
//                'value' => ($this->input->post('interest_rate')) ? $this->input->post('interest_rate') : '0.00'
//            )
//        );
//        echo get_form($data);

        /**
          $data = array(
          'type' => 'text', // input type='text'
          'label' => 'Income Rate',
          'attr' => array(
          'name' => 'income_rate',
          'disabled' => 'disabled',
          'value' => '0.00'
          )
          );
          echo get_form($data);
         * */
        echo close_block();
        echo close_span();
// End Left

        echo open_span(5);
        echo open_block('general_info', 'Loan Specs');
//-----------------------------
        $won_type = array('' => '---Select Ownership Type---', 1 => 'Sigle', 2 => 'Group');
//        $data = array(
//            'type' => 'select', // input type='text'
//            'label' => 'Ownership Type',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'won_type',
//                'option' => $won_type
//            )
//        );
//        echo get_form($data);
        field('select', 'won_type', 'Ownership Type:', NULL, array('options' => $won_type, 'attribute' => array('id' => 'won_type')), TRUE);

//        $data = array(
//            'type' => 'select', // input type='text'
//            'label' => 'GL Code',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'gl_id',
//                'option' => $gl
//            )
//        );
//        echo get_form($data);

        field('select', 'gl_code', 'GL Code :', NULL, array('options' => $gl, 'attribute' => array('id' => 'gl_code')), TRUE);
//echo form_hidden('gl_id');
        field('select', 'currency', 'Currency:', NULL, array('options' => $currency, 'attribute' => array('id' => 'currency')), TRUE);


//        $data = array(
//            'type' => 'text', // input type='text'
//            'label' => 'Loan Amount',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'loan_amount',
//            )
//        );
//        echo get_form($data);
        field("text", "loan_amount", "Loan Amount:", NULL, array('attribute' => array('validated' => '1', 'class' => "numeric")), TRUE);

//        $data = array(
//            'type' => 'text', // input type='text'
//            'label' => 'Disbursment Date',
//            'attr' => array(
//                'name' => 'disbursment_date',
//                'class' => 'txtdate'
//            )
//        );
//        echo get_form($data);

//        field("text", "disbursment_date", "Disbursment Date:", NULL, array('attribute' => array('class' => 'txtdate')), TRUE);

//        $data = array(
//            'type' => 'select', // input type='text'
//            'label' => 'Repayment Freg',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'rep_freg',
//                'option' => $rep_peraid
//            )
//        );
//        echo get_form($data);

        field('select', 'rep_freg', 'Repayment Freg:', NULL, array('options' => $rep_peraid, 'attribute' => array('validated' => '1')), TRUE);


        field("text", "firstrepayment_date", "First Repayment:", NULL, array('attribute' => array('class' => 'txtdate')), TRUE);


        echo close_block();

// Others
        echo open_block('installmets', 'Installmets...');
//        
//        $data = null;
//        $style = '';
//        if(!empty($upload)) $style = 'color:red;';
//        $data = array(
//            'type' => 'file', // input type='text'
//            'label' => '<span style="'.$style.'">Signature (max: 200x200px)</span>',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'userfile',
//                'upload'=>$upload
//            )
//        );
//        echo get_form($data);
//        $data = null;
//        $data = array(
//            'type' => 'select', // input type='text'
//            'label' => 'Sign Rule',
//            'validated' => 1,
//            'attr' => array(
//                'name' => 'sign_rule',
//                'option'=>$signature_rule
//            )
//        );
//        echo get_form($data);

        field("text", "num_installments", "Num Installments:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
        field("text", "lead_interest", "Lead interest:", NULL, array('attribute' => array('disabled' => 'disabled')));
        field("text", "principal_start", "Principal Start:", NULL, array('attribute' => array('disabled' => 'disabled')));
        field("text", "principal_frequency", "Principal Frequency:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
        field("text", "interest_rate", "Interest Rate:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
        field("text", "ins_amount", "Installment Amount:", NULL, array('attribute' => array('class' => "numeric")), TRUE);

        echo close_block();

        echo close_span();


// End span5
        echo '<div id="note"><sup class="require">*</sup> <span>All require</span></div>';
        echo '</div>';

        echo '<div id="btn_action" class="span10"><div class="modal-footer">';

        echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Confirm');
        echo anchor('loan/lists', 'Cancel', 'class="btn"');
        echo '</div></div>';
        ?>

    </div>
    <script>

        jQuery.noConflict();
        (function($) {
             
             
            $(function() {
               
                $('#btn_action').addClass("disable_box");
                $('.numeric').numberOnly();
                
                var uri=[
                    $('[name="base_url"]').val(),
                    $('[name="segment1"]').val(),
                    $('[name="segment2"]').val(),
                    $('[name="segment3"]').val(),
                ];             
                
                //=============Date input type============
                $( ".txtdate" ).datepicker({ 
                    defaultDate: '-0y',
                    buttonText: "Choose",
                    dateFormat: "yy-mm-dd" 
                });
                
                
                $('#search_customer_by_code').click(function(){
                    var con_cid = "";
                    var acc_num=null;
                    if($('#con_cid')){
                        con_cid = $('#con_cid').val();
                    }
                    if($('#account_number')){
                        acc_num = $('#account_number').val();
                    }
                    
                    //('.btn').attr('disabled',true);
                    $('.loader').addClass('icon-loader');
                    $.post( uri[0]+"loan/find_contact_by_code",
                    {
                        'con_cid':con_cid,
                        'acc_num':acc_num
                    },
                    function(data){
                       
                        //$('.btn').removeAttr('disabled');
                        $('.loader').removeClass('icon-loader');
                        $('.loader').addClass('icon-search');
                        if(data.result == 0){
                            //                           
                            $('[name="cid"],[name="view_con_cid"],[name="displayname"],[name="con_dob"],[name="con_address"],[name="con_typ_title"]').html("");
                            if(acc_num==null){
                                alert("Contact not found, please try another CID.");
                                $("#con_cid").focus();
                                $('#btn_action').addClass("disable_box");
                            }else{
                                alert("Account number not found, please try another Account.");
                                $("#account_number").focus();
                                $('#btn_action').addClass("disable_box");
                            }
                            
                            //                            resetForm('#form_loan');///=======Reset form data
                            $('#form_loan').each(function() { this.reset() });
                        }
                        else{
                            $('[name="loa_con_id"]').val(data.loa_acc_id)
                            $('#btn_action').removeClass("disable_box"); //// =========Show botton submit========
                            $('[name="cid"]').html(data.con_id);
                            $('[name="view_con_cid"]').html(data.con_cid);
                            $('[name="displayname"]').html(data.con_en_last_name+ " "+data.con_en_first_name);
                            //                            $('[name="accountname"]').val(data.con_en_last_name+ " "+data.con_en_first_name);
                            $('[name="con_dob"]').html(data.con_dob +" "+ data.sex +"/"+ data.civil);
                            $('[name="con_address"]').html(data.con_address);
                            
                            // product type
                            $('[name="loa_acc_loa_pro_typ_id"]').val(data.pro_type);
                            
                            // Loan space
                            $('[name="gl_code"]').val(data.gl);
                            $('[name="currency"]').val(data.currency);
                            $('[name="loan_amount"]').val(data.loa_amount);
//                            $('[name="disbursment_date"]').val(data.loa_acc_disbustment);
                            $('[name="rep_freg"]').val(data.loa_acc_rep_fre_id);
                            $('[name="firstrepayment_date"]').val(data.loa_acc_first_repayment);
                            //installment
                            $('[name="num_installments"]').val(data.loa_ins_num_ins);
                            $('[name="lead_interest"]').val(data.loa_ins_lead_interest);
                            $('[name="principal_start"]').val(data.loa_ins_principal_start);
                            $('[name="principal_frequency"]').val(data.loa_ins_principal_frequency);
                            $('[name="interest_rate"]').val(data.loa_ins_interest_rate);
                            $('[name="ins_amount"]').val(data.loa_ins_installment_amount);
                        }
                        
                    },
                    'json'
                );
                });

                
            });
            
        
        })(jQuery);
        
        
    </script>
</div>
<?php
echo form_close();
?>