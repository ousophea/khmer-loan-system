<?php
echo form_open('saving/open', array('class' => 'form-horizontal', 'name' => 'open_saving'));
?>
<div class="row form-model">
    <div class="form_model_style"></div>
    <div class="span12">
        <div class="tools">
            <a class="btn btn-mini" href="<?php echo base_url() . 'saving/lists'; ?>" title="Add new"><i class="icon-circle-arrow-left"></i> List saving accounts</a>
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
                <?php echo form_button(array('content' => '<i class="icon-search"></i> Search', 'class' => 'btn', 'id' => 'search_customer_by_code'), 'search'); ?>
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
            'type' => 'text', // input type='text'
            'label' => 'HID',
            'attr' => array(
                'name' => 'hid',
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
            'type' => 'select', // input type='text'
            'label' => 'Product type',
            'validated' => 1,
            'attr' => array(
                'name' => 'sav_acc_sav_pro_typ_id',
                'option' => $product_type
            )
        );
        echo get_form($data);

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
        $data = array(
            'type' => 'select', // input type='text'
            'label' => 'Currency',
            'validated' => 1,
            'attr' => array(
                'name' => 'currency',
                'option' => $currency//array('' => '---Select currency---', 201 => 'USD($)', 202 => 'Real(៛)')
            )
        );
        echo get_form($data);

        $data = array(
            'type' => 'select', // input type='text'
            'label' => 'GL Code',
            'validated' => 1,
            'attr' => array(
                'name' => 'glcode',
                'option' => $gl
            )
        );
        echo get_form($data);

        echo close_block();
        echo close_span();
// End span5
        echo '</div>';
        echo '<div class="span10"><div class="modal-footer">';
        echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Confirm');
        echo anchor('saving/lists', 'Cancel', 'class="btn"');
        echo '</div></div>';
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
                    $('.btn').attr('disabled',true);
                    $('.btn i').addClass('icon-loader');
                    
                    $.post(
                    uri[0]+"saving/find_contact_by_code",
                    {
                        'con_cid':con_cid
                    },
                    function(data){
                        $('.btn').removeAttr('disabled');
                        $('.btn i').removeClass('icon-loader');
                        $('.btn i').addClass('icon-search');
                        if(data.result == 0){
                            $('#dispayname,[name="accountname"],[name="con_dob"],[name="con_address"],[name="con_typ_title"]').val("");
                            alert("Contact not found, please try another CID.");
                        }
                        else{
                            $('#dispayname').val(data.con_en_name);
                            $('[name="cid"]').val(data.con_id);
                            $('[name="accountname"]').val(data.con_en_name);
                            $('[name="con_dob"]').val(data.con_dob);
                            $('[name="con_address"]').val(data.con_address);
                            $('[name="con_typ_title"]').val(data.con_typ_title);
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