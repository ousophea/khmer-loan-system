<!-- Author DIM Bunthoeurn -->

<!--<style type="text/css">
    div#container_group legend, div#marrital_status legend{
        font-size: 17px !important;
    }
</style>-->
<?php
echo form_open(site_url(segment(1) . '/edit/' . segment(3)), array('name' => 'form_branch', 'class' => 'form', 'id' => 'form_branch'));
//echo form_open(site_url(segment(1) . '/edit'), array('name' => 'form_branch', 'class' => 'form', 'id' => 'form_branch'));
?>
<div id="accordion">
    <h3>Branch Information</h3>
    <div>
        <div id="msg-error">
        </div>
        <table border="0" width="100%">
            <tr>
                <td colspan="3">
                    <?php
                    echo form_label('Branch ID <span>*</span>', 'lbl_branch_name');
                    echo form_input(array('name' => 'bra_id', 'placeholder' => 'Branch ID', 'value' => set_value('info[bra_id]', $br[0]['bra_id']), 'disabled' => 'disabled', 'class' => 'required numeric'));
                    ?>
                </td>					
            </tr>
            <tr>
                <td>
                    <?php
                    // echo $test;
                    echo form_label('Branch Name <span>*</span>', 'lbl_branch_name');
                    $input = array('name' => 'bra_name', 'placeholder' => 'Branch name', 'value' => set_value('branch[bra_name]', $br[0]['bra_name']));
                    echo form_input($input);
                    echo form_hidden('bra_id', $br[0]['bra_id']);
                    echo "<span class=' alert-error'>".validation_errors()."</span>";
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Branch Address <span>*</span>', 'lbl_branch_address');
                    $data = array(
                        'name' => 'bra_address',
                        'id' => 'branch_address',
                        'placeholder' => 'Branch address',
                        'rows' => '1',
                        'class' => 'required',
                        'style' => 'width:100%',
                        'value' => set_value('branch[bra_address]', $br[0]['bra_address'])
                    );
                    echo form_input($data);
                    ?>
            </tr>
        </table>
    </div>
</div>
<div class="control_manager">
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
        jq("#accordion").accordion({
            collapsible: true,
            heightStyle: "auto"
        });

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