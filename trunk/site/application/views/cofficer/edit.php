<?php
echo form_open(site_url('cofficer/update/' . $id), array('name' => 'form-cofficer'));
?>
<table border="0" width="100%">
    <tr>
        <td>
            <?php
            echo form_label('អត្តសញ្ញាណ <span class="text-error">*</span>', 'lbl_card_id');
            $data_input = array('name' => 'cofficer[co_card_id]', 'placeholder' => 'អត្តសញ្ញាណ', 'class' => "required", 'value' => set_value('cofficer[co_card_id]', $data->co_card_id));
            echo form_input($data_input);
            ?>
        </td>
        <td>
            <?php
            echo form_label('ឈ្មោះ <span class="text-error">*</span>', 'lbl_co_name');
            echo form_input(array('name' => 'cofficer[co_name]', 'placeholder' => 'នាម', 'class' => "required", 'value' => set_value('cofficer[co_name]', $data->co_name)));
            ?>
        </td>
        <td>
            <?php
            echo form_label('ភេទ ', 'lbl_con_sex');
            echo form_dropdown('cofficer[co_sex]', array('m' => 'Male', 'f' => 'Female'), $data->co_sex);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo form_label('ប្រធាន ', 'lbl_chief');
            echo form_dropdown('cofficer[chif_co_id]', array('' => 'ជ្រើសរើស') + $chiefs, $data->chif_co_id);
            ?>
        </td>
        <td>
            <?php
            echo form_label('តំណែង <span class="text-error">*</span>', 'lbl_co_position');
            echo form_dropdown('cofficer[co_position]', array('0' => 'Member', '1' => 'Manager'), $data->co_position);
            ?>
        </td>
        <td>
            <?php
            echo form_label('ទូរស័ព្ទ');
            echo form_input(array('name' => 'cofficer[co_tel]', 'placeholder' => 'ទូរស័ព្ទ', 'value' => set_value('cofficer[co_tel]', $data->co_tel)));
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo form_label('Start Date: <span>*</span>', 'lbl_con_dob');
            echo form_input(array('name' => 'cofficer[co_start_date]', 'class' => 'required txt_con_dob', 'value' => set_value('cofficer[co_start_date]', $data->co_start_date)));
            ?>
        </td>
        <td>
            <?php
            echo form_label('Salary');
            echo form_input(array('class'=>'numeric' ,'name' => 'salary', 'placeholder' => 'salary', 'value' => set_value('cofficer[cos_salary]', $data->cos_salary)));
            ?>
            <span id="create-user" class="btn btn-navbar" style="margin-bottom: 9px;"> <span class="icon-edit"></span></span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php
            echo form_label('អាស័យដ្ឋាន ​ ', 'lbl_co_address');
            echo form_textarea('cofficer[co_address]', $data->co_address, "style='width:85%;height:50px;'");
            ?>
        </td>
        <td>
            <?php
            echo form_label('សាខា <span class="text-error">*</span>', 'lbl_branch');
            $selected = array();
            foreach ($data->branch as $item) {
                array_push($selected, $item['bra_id']);
            }
            echo form_dropdown('branches[]', $brands, $selected, 'class="chosen-brand required" multiple="multiple"');
            ?>		
        </td>
    </tr>

</table>
<div class="control_manager">
    <button type="submit" class="btn btn-default" id="btn-save" title="Save"><i class="icon-ok-circle"></i> Save</button>
    <a href="<?php echo site_url(segment(1)); ?>" class="btn btn-default" id="back" title="Back"><i class="icon-circle-arrow-left"></i> Back</a>
</div>
<?php
echo form_close();
?>
<div id="divdeps" style="display:none" title="Edit Salary">
    <form>
        <fieldset>
            
            <label for="old_salary">Old salary</label>
            <?php
            echo form_hidden("cos_id",$data->cos_id);
                echo form_input(array("disabled"=>"disabled",'name' => 'oldSalary','class'=>'disable', 'placeholder' => 'salary', 'value' => set_value('cofficer[cos_salary]', $data->cos_salary)));
            ?>
            <label for="new_salary">New Salary</label>
            <input type="text" name="new_salary" class="numeric" id="newSalary" value="" >
            <span id="ms"></span>

        </fieldset>
    </form>
</div>

<style>
    .control-group.error .chosen-choices{
        border-color:#b94a48 !important;
    }
</style>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq('.numeric').numberOnly();
    
    jq(".txt_con_dob").datepicker({
        defaultDate: '-5y',
        buttonText: "Choose",
        dateFormat: "yy-mm-dd"
    });
    jq(document).on('click', '#btn-save', function () {
        if (isValid()) {
            return false;
        } else {
            var obj = jq('input[name=cofficer\\[co_card_id\\]]');
            var card_id = obj.val();
            var exists = getDataExists(card_id);
            if (exists) {
                var txt = "Card Id: " + card_id + " is already exists.";
                alert(txt);
                obj.focus();
                return false
            } else {
                return true;
            }
        }
    });

    function isValid() {
        var cnt = 0;
        jq.each(jq('.required'), function () {
            var th = jq(this);
            if (!validateForm(th))
                cnt++;
        });
        return cnt;
    }

    function validateForm(th) {
        var txt = th.val();
        if (txt == '' || txt == null) {
            th.parent().addClass('control-group error');
            return false;
        } else {
            th.parent().removeClass('control-group error');
            return true;
        }
    }
    jq(document).on('blur change keyup', '.required', function () {
        validateForm(jq(this));
    });
    function getDataExists(card_id) {
        var res = false;
        var id = '<?php echo $id; ?>';
        jq.ajax({
            url: "<?php echo site_url('cofficer/ajax_check_exist'); ?>",
            type: 'post',
            async: false,
            data: {"card_id": card_id},
            dataType: 'json',
            success: function (response) {
                if (response.result == 'exists') {
                    var remote_id = response.data.co_id;
                    if (id != remote_id) {
                        res = true;
                    }
                }
            }
        });
        return res;
    }
//    For incress salary
    jq(function () {
        var dialog = jq("#divdeps").dialog({
            autoOpen: false,
            show: 'slide',
            resizable: false,
            position: 'center',
            stack: true,
            height: 'auto',
            width: '300',
            modal: true,
            buttons:
                    {"Cancel": function () {
                            jq(this).dialog("close")
                        },
                        "Submit": function () {
                            addUser();
                        }
                    }

        });
        jq("#create-user").button().on("click", function () {
            jq("#divdeps").dialog("open");
        });

        function addUser() {
            var salary = jq('#newSalary').val();
             var cosId = jq('input[name=cos_id]').val();
            jq.ajax({
                url: "<?php echo site_url('cofficer/inc_salary'); ?>",
                type: 'post',
                async: false,
                data: {"cos_id":cosId,"salary": salary},
                dataType: 'json',
                success: function () {
                    alert("Success update..!")
                    dialog.dialog("close")
                    jq('input[name=salary]').val(salary);
                }
            });
        }
    });
</script>