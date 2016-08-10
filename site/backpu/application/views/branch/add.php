<!-- Author DIM Bunthoeurn -->

<!--<style type="text/css">
    div#container_group legend, div#marrital_status legend{
        font-size: 17px !important;
    }
</style>-->
<?php
echo form_open(site_url(segment(1) . '/add'), array('name' => 'form_branch', 'id' => 'form_branch'));
?>
<div id="accordion">
    <!--<h3>Branch Information</h3>-->
    <div>
        <span id="msg-error"></span>
        <div class="span">
            <div class="span4">
                <?php
//                echo '<div>' . validation_errors() . '</div>';
                echo form_label('Branch Name <span>*</span>', 'lbl_branch_name');
                echo form_input(array('name' => 'txt_branch_name', 'placeholder' => 'Branch name', 'value' => set_value('txt_branch_name'), 'class' => 'required'));
                echo "<span class=' alert-error'>".validation_errors()."</span>";
                ?>
            </div>
            <div class="span4">
                                   <?php
                    echo form_label('Branch Address <span>*</span>', 'lbl_branch_address');
                    $data = array(
                        'name' => 'txt_branch_address',
                        'id' => 'branch_address',
                        'placeholder' => 'Branch address',
                        'rows' => '1',
                        'class' => 'required',
                        'style' => 'width:100%',
                        'value' => set_value('txt_branch_address')
                    );
                    echo form_input($data);
                    ?>
            </div>
        </div>
<!--        <table border="0" width="100%">
            <tr>
                <td>-->
                    <?php
                    // echo $test;
//                    echo '<div>' . validation_errors() . '</div>';
//                    echo form_label('Branch Name <span>*</span>', 'lbl_branch_name');
//                    echo form_input(array('name' => 'txt_branch_name', 'placeholder' => 'Branch name', 'value' => set_value('txt_branch_name'), 'class' => 'required'));
                    ?>
<!--                </td>
                <td>-->
                    <?php
//                    echo form_label('Branch Address <span>*</span>', 'lbl_branch_address');
//                    $data = array(
//                        'name' => 'txt_branch_address',
//                        'id' => 'branch_address',
//                        'placeholder' => 'Branch address',
//                        'rows' => '1',
//                        'class' => 'required',
//                        'style' => 'width:100%',
//                        'value' => set_value('txt_branch_address')
//                    );
//                    echo form_input($data);
                    ?>
<!--            </tr>
        </table>-->
    </div>
</div>
<div class="control_manager span10">
    <button type="submit" class="btn btn-mini"><i class="icon-plus-sign"></i> Save Branch</button>
    <?php
    echo nbs();
    echo anchor(site_url(segment(1)), '<i class="icon-circle-arrow-left"></i>Back', 'class="btn btn-mini" id="back" title="Back"');
    ?>
</div>
<?php
echo form_close();
?>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function () {
        jq('.numeric').numberOnly();
        //set collapse content
//        jq("#accordion").accordion({
//            collapsible: true,
//            heightStyle: "auto"
//        });

        function isRequired() {
            var cnt = 0;
            jq.each(jq('.required'), function () {
                var th = jq(this);
                if (!validateForm(th))
                    cnt++;
            });
            return cnt;
        }
        jq(document).on('change blur keyup', '.required', function () {
            var th = jq(this);
            validateForm(th);
        });

        function validateForm(th) {
            var txt = th.val();
            if (txt == '') {
                th.parent().addClass('control-group error');
                return false;
            } else {
                th.parent().removeClass('control-group error');
                return true;
            }
        }
        //        jq('form#form_contact').submit(function () {
        jq('form#form_branch').live('submit', function () {
            //              alert(isRequired());
            if (isRequired()) {
                return false;
            } else {
                return true;
            }
            //            jq.ajax({
            //                url: jq(this).attr('action'),
            //                type: 'post',
            //                data: jq(this).serialize(),
            //                dataType: 'json',
            //                success: function (response) {
            //                    if (response.result == 'error') {
            //                        jq('#msg-error').html(response.msg);
            //                    }
            //                    if (response.result == 'ok') {
            //                        window.location = "<?php echo site_url('contacts'); ?>";
            //                    }
            //                }
            //            });
            //            return true;
        });
    });
</script>