<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
?>
<div class="tools">
    <a class="btn btn-mini" href="<?php echo base_url().'/saving/lists'; ?>" title="Add new"><i class="icon-circle-arrow-left"></i> List saving accounts</a>
</div>
<div>
    <?php
    echo form_open('saving/open', array('class' => 'form-horizontal', 'name' => 'open_saving'));

    echo '<fieldset>';
    echo legend('Customer information');
    
    ?>
    <div class="control-group">
        <label class="control-label" for="cid">CID</label>
        <div class="controls">
            <input value="<?php echo set_value('con_cid'); ?>" autocomplete="off" data-source='<?php echo $typethread ?>' data-provide='typeahead' data-items='10' name="con_cid" type="text" id="con_cid" placeholder="CID">
            <?php echo form_button(array('content' => 'Search', 'class' => 'btn btn-success', 'data-loading-text' => "Loading...", 'id' => 'search_customer_by_code'), 'search'); ?>
            <?php
            echo '<span class="error">' . form_error('con_cid') . '</span>';
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php
            echo form_hidden('cid',  set_value('cid'));
            echo '<span class="error">' . form_error('cid') . '</span>';
            ?>
        </div>
    </div>
    <?php
//    $data = array(
//        'type' => 'text', // input type='text'
//        'label' => 'CID *',
//        'validated'=>1,
//        'attr' => array(
//            'name' => 'cid',
//            'data-provide'=>'typeahead',
//            'data-items'=>'10',
//            'data-source'=> "['ddd']",
//        )
//    );
//    $search = form_button(array('content'=>'Search','class'=>'btn btn-success','data-loading-text'=>"Loading..."), 'search');
//    echo get_form($data,$search);

    $data = array(
        'type' => 'label', // input type='text'
        'label' => 'Display name',
        'attr' => array(
            'name' => 'dispayname',
            'text' => '',
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'label', // input type='text'
        'label' => 'Date of birth',
        'attr' => array(
            'name' => 'dob',
            'text' => '',
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'label', // input type='text'
        'label' => 'HID',
        'attr' => array(
            'name' => 'hid',
            'text' => '',
        )
    );
    echo get_form($data);
    echo '</fieldset>';

    //-----------------------------
    echo '<fieldset>';
    echo legend('Product detail');


    $product_type[''] = '---Select product type---';
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Product type',
        'validated'=>1,
        'attr' => array(
            'name' => 'sav_acc_sav_pro_typ_id',
            'option' => $product_type
        )
    );
    echo get_form($data);


    echo '</fieldset>';
    //-----------------------------
    echo '<fieldset>';
    echo legend('General information');

//    $data = array(
//        'type' => 'text', // input type='text'
//        'label' => 'Account name',
//        'attr' => array(
//            'name' => 'accountname',
//        )
//    );
//    echo get_form($data);
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Currency',
        'validated'=>1,
        'attr' => array(
            'name' => 'currency',
            'option' => array('' => '---Select currency---', 201 => 'USD($)', 202 => 'Real(៛)')
        )
    );
    echo get_form($data);
    
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'GL Code',
        'validated'=>1,
        'attr' => array(
            'name' => 'glcode',
            'option' => array(''=>'---Select GL Code---',0 => 'Conpalsary Saving', 1 => 'Voluntary Saving')
        )
    );
    echo get_form($data);


    echo '</fieldset>';


    echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Save');
    echo anchor('saving/lists', 'Cancel', 'class="btn"');
    echo form_close();
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
                
                $.post(
                uri[0]+"saving/find_contact_by_code",
                    {
                        'con_cid':con_cid
                    },
                    function(data){
                        if(data.result == 0){
                            $('#dispayname').html("");
                            alert("Contact not found, please try another CID.");
                        }
                        else{
                            $('#dispayname').html(data.con_en_name+'-'+data.con_kh_name);
                            $('[name="cid"]').val(data.con_id);
                        }
                    },
                    'json'
                );
            });
        });
    })(jQuery);
</script>