<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$i = 0;
$typethread=NULL;
foreach ($contacts->result() as $row) {
    
    echo form_hidden('_'.$row->con_cid,$row->con_id);
    if($i == 0){
        $typethread .= '["'.$row->con_cid.'"';
    }
    else {
       $typethread .= ',"'.$row->con_cid.'"';    
    }
    $i++;
}
$i=0;
$typethread .= ']';
?>
<div class="tools">
    <a class="btn btn-mini" href="register" title="Add new"><i class="icon-plus-sign"></i> Add new</a>
    <span id="edit" class="btn btn-mini" title="Edit"><i class="icon-edit"></i> Edit</span>
    <span id="changepassword" class="btn btn-mini" title="Change password"><i class="icon-wrench"></i> Change password</span>
    <span id="delete" class="btn btn-mini" title="Delete"><i class="icon-remove-sign"></i> Delete</span>
</div>
<div>
    <?php
    echo form_open('saving/open', array('class' => 'form-horizontal', 'name' => 'open_form'));
    
    echo '<fieldset>';
    echo legend('Customer information');
    echo form_hidden('cid');
    ?>
    <div class="control-group">
        <label class="control-label" for="cid">CID</label>
        <div class="controls">
          <input autocomplete="off" data-source='<?php echo $typethread ?>' data-provide='typeahead' data-items='10' name="con_cid" type="text" id="con_cid" placeholder="CID">
          <?php echo form_button(array('content'=>'Search','class'=>'btn btn-success','data-loading-text'=>"Loading..."), 'search'); ?>
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
            'text' => 'Jonh Son',
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'label', // input type='text'
        'label' => 'Date of birth',
        'attr' => array(
            'name' => 'dob',
            'text' => '08-11-1988',
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'label', // input type='text'
        'label' => 'HID',
        'attr' => array(
            'name' => 'hid',
            'text' => '2KKHGG556',
        )
    );
    echo get_form($data);
    echo '</fieldset>';
    
    //-----------------------------
    echo '<fieldset>';
    echo legend('Product detail');

    
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Product type',
        'attr' => array(
            'name' => 'sav_acc_sav_pro_typ_id',
            'option'=>$product_type
        )
    );
    echo get_form($data);


    echo '</fieldset>';
    //-----------------------------
    echo '<fieldset>';
    echo legend('General information');
    
    $data = array(
        'type' => 'text', // input type='text'
        'label' => 'Account name',
        'attr' => array(
            'name' => 'accountname',
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Currency',
        'attr' => array(
            'name' => 'currency',
            'option'=>array(''=>'---Select currency---',201=>'USD($)',202=>'Real(៛)')
        )
    );
    echo get_form($data);
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'GL Code',
        'attr' => array(
            'name' => 'glcode',
            'option'=>array(0=>'Conpalsary Saving',1=>'Voluntary Saving')
        )
    );
    echo get_form($data);


    echo '</fieldset>';
    
    
    echo form_submit(array('name'=>'Save','class'=>'btn btn-success'), 'Save');
    echo anchor('saving/lists','Cancel','class="btn"');
    echo form_close();
    ?>
    
</div>
<script>

    jQuery.noConflict();
        (function($) {
            $(function() {
                $('#con_cid').blur(function(){
                    var con_cid = $('#con_cid').val();
                    var con_id = $('[name="_'+con_cid+'"]').val();
                    $('[name="cid"]').val(con_id);
                });
            });
    })(jQuery);
</script>