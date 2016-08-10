<?php
echo form_open_multipart('loan/open', array('class' => 'form-horizontal', 'name' => 'open_loan'));
//echo form_hidden('gl_list', $gl);
?>
<div class="row form-container">
    <div class="form_model_style"></div>
    <div class="span12">
        <div class="tools">
            <a class="btn btn-mini" href="<?php echo base_url() . 'loan/open'; ?>" title="Open new loan account"><i class="icon-plus-sign"></i> Open new loan account</a>
            <a disabled="disabled" class="btn btn-mini btn-success" href="<?php echo base_url() . 'loan/view'; ?>" title="View loan account"><i class="icon-eye-open icon-white"></i> View new loan account</a>
            <a class="btn btn-mini" href="<?php echo base_url() . 'loan/edit'; ?>" title="Edit loan account"><i class="icon-edit"></i> Edit loan accounts</a>
        </div>
    </div>
    <div>
        <?php
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
        echo open_span(5);
        echo open_block('cutomer_info', 'Customer information');
        ?>
        <div class="control-group">
            <label class="control-label" for="cid">CID</label>
            <div class="controls">
                <input class="input-small" name="con_cid" value="<?php echo set_value('con_cid'); /* echo !empty($_POST['con_cid'])? $_POST['con_cid']:''; */ ?>" autocomplete="off" data-source='<?php echo $typethread ?>' data-provide='typeahead' data-items='10' name="con_cid" type="text" id="con_cid" placeholder="CID">
                <?php echo form_button(array('content' => '<i class="icon-search loader"></i> Search', 'class' => 'btn', 'id' => 'search_customer_by_code'), 'search'); ?>
                <?php
                echo '<span class="error">' . form_error('con_cid') . '</span>';
                ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php
                echo form_hidden('cid', set_value('cid'));
                echo '<span class="error">' . form_error('cid') . '</span>';
                ?>
            </div>
        </div>               
        <?php
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Display name',
            'attr' => array(
                'name' => 'dispayname',
                'disabled' => 'disabled',
                'class'=>'span3'
            )
        );
        echo get_form($data);
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Date of birth',
            'attr' => array(
                'name' => 'con_dob',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        $data = array(
            'type' => 'textarea', // input type='text'
            'label' => 'Address',
            'attr' => array(
                'name' => 'con_address',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        echo close_block();
//-----------------------------


        echo open_block('product_detail', 'Product Detail');
        $product_type[''] = '---Select product type---';
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Product type',
            'validated' => 1,
            'attr' => array(
                'name' => 'sav_acc_sav_pro_typ_id',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Interest Rate',
            'attr' => array(
                'name' => 'interest_rate',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);

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
		**/
        echo close_block();
        echo close_span();
// End Left

        echo open_span(5);
        echo open_block('general_info', 'General information');
//-----------------------------
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Account name',
            'attr' => array(
                'name' => 'accountname',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);

        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Ownership type',
            'validated' => 1,
            'attr' => array(
                'name' => 'con_typ_title',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        $data = NULL;
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Currency',
            'validated' => 1,
            'attr' => array(
                'name' => 'currency',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        $data = NULL;
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'GL Code',
            'validated' => 1,
            'attr' => array(
                'name' => 'gl_id',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        //echo form_hidden('gl_id');

        echo close_block();
        
        // Others
        echo open_block('others', 'Others...');
        ?>
        <div class="control-group">
            <label class="control-label">Signature</label>
            <div class="controls">
                <?php echo img(array('class'=>'signature','id'=>'loan_signature'));?>
            </div>
        </div>  
        <?php
        //echo get_form($data);
        $data = null;
        $sign_rules = array(''=>'----');
        $data = array(
            'type' => 'text', // input type='text'
            'label' => 'Sign Rule',
            'validated' => 1,
            'attr' => array(
                'name' => 'sign_rule',
                'disabled' => 'disabled',
            )
        );
        echo get_form($data);
        echo close_block();
        
        echo close_span();
//// End span5
//        echo '</div>';
//        echo '<div class="span10"><div class="modal-footer">';
//        echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Confirm');
//        echo anchor('loan/edit', 'Edit', 'class="btn"');
//        echo '</div></div>';
        ?>

    </div>
    <script>

        jQuery.noConflict();
        (function($) {
            $(function() {
                
                var uri=[
                    $('[name="base_url"]').val(),
                    $('[name="segment1"]').val(),
                    $('[name="segment2"]').val(),
                    $('[name="segment3"]').val(),
                ];             
                
                $('#search_customer_by_code').click(function(){
                    var con_cid = $('#con_cid').val();
                    //$('.btn').attr('disabled',true);
                    $('.loader').addClass('icon-loader');
                    $.post(
                    uri[0]+"loan/find_loan_by_contact_id",
                    {
                        'con_cid':con_cid
                    },
                    function(data){
                        
                        //$('.btn').removeAttr('disabled');
                        $('.loader').removeClass('icon-loader');
                        $('.loader').addClass('icon-search');
                        if(data.result == 0){
                            $('#dispayname,[name="accountname"],[name="con_dob"],[name="con_address"],[name="con_typ_title"]').val("");
                            alert("Contact not found, please try another CID.");
                        }
                        else{
                            $('#dispayname').val(data.con_en_name);
                            $('[name="cid"]').val(data.con_id);
                            //$('[name="con_cid"]').val(data.con_cid);
                            $('[name="dispayname"]').val(data.con_kh_last_name+ " "+data.con_kh_first_name);
                            $('[name="accountname"]').val(data.con_en_last_name+ " "+data.con_en_first_name);
                            $('[name="con_dob"]').val(data.con_dob);
                            $('[name="con_address"]').val(data.con_address);
                            $('[name="con_typ_title"]').val(data.con_typ_title);
                            $('[name="currency"]').val(data.cur_title);
                            $('[name="sav_acc_sav_pro_typ_id"]').val(data.sav_pro_typ_title);
                            $('[name="sign_rule"]').val(data.sir_title);
                            $('[name="gl_id"]').val(data.gl_description);
                            $('[name="interest_rate"]').val(data.sav_acc_interest_rate);
                            $('#loan_signature').attr('src',uri[0]+'images/upload/'+data.sav_acc_signature);
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