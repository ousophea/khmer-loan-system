<!-- Author PEN Vannak -->
<?php
//get job and paste to array
$arr_option_job = array('' => '-select job-');
if ($query_job->num_rows() > 0) {
    foreach ($query_job->result() as $rows) {
        $arr_option_job[$rows->con_job_id] = $rows->con_job_title;
    }
}
//get income and paste to array
$arr_option_income = array('' => '-select income-');
if ($query_income->num_rows() > 0) {
    foreach ($query_income->result() as $rows) {
        $arr_option_income[$rows->con_inc_id] = $rows->con_inc_range;
    }
}
?>
<style type="text/css">
    div#container_group legend, div#marrital_status legend{
        font-size: 17px !important;
    }
</style>
<?php
echo form_open(site_url(segment(1) . '/add_save'), array('name' => 'form_contact', 'id' => 'form_contact'));
?>
<div id="accordion">
    <h3>Basic Information</h3>
    <div>
		<div id="msg-error">
		</div>
        <table border="0" width="100%">
            <tr>
                <td colspan="3">
                    <?php
                    echo form_label('Customer ID <span>*</span>', 'lbl_cus_id_first_name');
                    echo form_input(array('name' => 'txt_con_cid', 'placeholder' => 'Customer ID','max'=>'5', 'class' => 'required numeric',"maxlength"=>"6"));
                    ?>
                </td>					
            </tr>
            <tr>
                <td>
                    <?php
                    echo form_label('Family Name in Khmer <span>*</span>', 'lbl_con_kh_first_name');
                    echo form_input(array('name' => 'txt_con_kh_first_name', 'placeholder' => 'គោត្តនាម', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Sure Name in Khmer <span>*</span>', 'lbl_con_kh_last_name');
                    echo form_input(array('name' => 'txt_con_kh_last_name', 'placeholder' => 'នាម', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Nick Name in Khmer', 'lbl_con_kh_nick_name');
                    echo form_input(array('name' => 'txt_con_kh_nick_name', 'placeholder' => 'នាមហៅក្រៅ'));
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo form_label('Family Name in English <span>*</span>', 'lbl_con_en_first_name');
                    echo form_input(array('name' => 'txt_con_en_first_name', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Sure Name in English <span>*</span>', 'lbl_con_en_last_name');
                    echo form_input(array('name' => 'txt_con_en_last_name', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Nick Name in English', 'lbl_con_en_nick_name');
                    echo form_input('txt_con_en_nick_name');
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo form_label('Sex <span>*</span>', 'lbl_con_sex');
                    echo form_dropdown('txt_con_sex', array('m' => 'Male', 'f' => 'Female'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Identity Card / Passport <span>*</span>', 'lbl_con_national_identity_card');
                    echo form_input(array('name' => 'txt_con_national_identity_card', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Job <span>*</span>', 'lbl_con_job');
                    echo form_dropdown('txt_con_job', $arr_option_job, '', 'class="required"');
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?php
                    echo form_label('Income Per Month <span>*</span>', 'lbl_con_income');
                    echo form_dropdown('txt_con_income', $arr_option_income, '', 'class="required"');
                    ?>
                </td>
                <td colspan="2">
                    <?php
                    echo form_label('Phone <span>*</span>', 'lbl_con_phone');
                    echo form_input('txt_con_phone[]');
                    echo anchor('#', '<img src="' . site_url('images/plus.png') . '" alt="add" title="add more" />', 'id="add_more_phone"');
                    ?>
                    <div id="phone_container"></div>
                </td>
            </tr>
        </table>
    </div>
    <h3>Detail Information</h3>
    <div>
        <table border="0" width="100%">
            <tr>
                <td colspan="3" class="address">
                    <?php
                    echo form_label('Address <span>*</span>', 'lbl_con_address');
                    //echo form_textarea(array('name'=>'txt_con_address','cols'=>100,'rows'=>5));
                    $arr_option_province = array('' => '-select province-');
                    if ($query_pronvince->num_rows() > 0) {
                        foreach ($query_pronvince->result() as $rows) {
                            $arr_option_province[$rows->pro_id] = $rows->pro_en_name . '(' . (($rows->pro_kh_name == '') ? 'no set' : $rows->pro_kh_name) . ')';
                        }
                    }
                    echo '<span>' . form_dropdown('txt_con_province', $arr_option_province, '', 'style="width:208px !important;" class="required"') . '</span>';
                    $district_option = array('' => '-khan/district-');
                    ?>
                    <span id="ajax_district">
                        <?php echo form_dropdown('txt_con_district', $district_option, '', 'style="width:208px !important;" class="required"'); ?>
                    </span>
                    <?php
                    $commune_option = array('' => '-sangkat/commune-');
                    ?>
                    <span id="ajax_commune">
                        <?php echo form_dropdown('txt_con_commune', $commune_option, '', 'style="width:208px !important;" class="required"'); ?>
                    </span>
                    <?php
                    $village_option = array('' => '-village-');
                    ?>
                    <span id="ajax_village">
                        <?php echo form_dropdown('txt_con_village', $village_option, '', 'style="width:208px !important;"'); ?>
                        <?php // echo form_dropdown('txt_con_village',$village_option,'','style="width:208px !important;" class="required"');?>
                    </span>
                    <?php
                    echo form_input(array('name' => 'txt_con_address_detail'));
//						echo form_input(array('name'=>'txt_con_address_detail','class'=>'required'));
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo form_label('Email', 'lbl_con_email');
                    echo form_input('txt_con_email');
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Date Of Birth <span>*</span>', 'lbl_con_dob');
                    echo form_input(array('name' => 'txt_con_dob', 'class' => 'required'));
                    ?>
                </td>
                <td>
                    <?php
                    echo form_label('Marital Status <span>*</span>', 'lbl_con_civil_status');
                    echo form_radio('txt_con_civil_status', '1', TRUE) . ' Single ';
                    echo form_radio('txt_con_civil_status', '2') . ' Married ';
                    echo form_radio('txt_con_civil_status', '3') . ' Divorce ';
                    echo form_radio('txt_con_civil_status', '4') . ' Other';
                    ?>
                </td>
            </tr>
        </table>
        <div id="marrital_status"></div>
    </div>
    <h3>Other Information</h3>
    <div>
        <table border="0" width="100%">
            <tr>
                <td width="160" valign="top" colspan="2">
                    <?php
                    echo form_label('Group / Individual <span>*</span>', 'lbl_con_group');
                    echo form_radio('txt_con_group', 'individual', TRUE) . ' Individual ';
                    echo form_radio('txt_con_group', 'group') . ' Group ';
                    ?>
                    <div id="container_group"></div>
                    <?php echo anchor('#', '<i class="icon-plus-sign"></i>Add More Group', 'class="btn btn-mini" id="add_more_group" style="display: none; width: 108px;" title="Add More Group"'); ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="control_manager">
    <button type="submit" class="btn btn-mini"><i class="icon-plus-sign"></i> Save Contact</button>
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
        //set date picker
        jq("input[name='txt_con_dob']").datepicker({
            defaultDate: '-30y',
            buttonText: "Choose",
            dateFormat: "yy-mm-dd"
        });

        //add div in case marital status has been checked 
        jq('input[name="txt_con_civil_status"]').click(function () {
            if (jq(this).val() == '2') {
<?php
$options_job = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_job_couple', $arr_option_job, '', 'class="required"'));
$options_income = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_income_couple', $arr_option_income, '', 'class="required"'));
?>
                var html = '<fieldset><legend>Couple Info</legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_couple">Family Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="គោត្តនាម" name="txt_con_kh_first_name_couple"></td><td><label for="lbl_con_kh_last_name_couple">Sure Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="នាម" name="txt_con_kh_last_name_couple"></td><td><label for="lbl_con_kh_nick_name_couple">Nick Name in Khmer</label><input type="text" placeholder="នាមហៅក្រៅ" name="txt_con_kh_nick_name_couple"></td></tr><tr><td><label for="lbl_con_en_first_name_couple">Family Name in English <span>*</span></label><input type="text" class="required" value="" name="txt_con_en_first_name_couple"></td><td><label for="lbl_con_en_last_name_couple">Sure Name in English <span>*</span></label><input type="text" class="required" value="" name="txt_con_en_last_name_couple"></td><td><label for="lbl_con_en_nick_name_couple">Nick Name in English</label><input type="text" value="" name="txt_con_en_nick_name_couple"></td></tr><tr><td><label for="lbl_con_national_identity_card_couple">Identity Card / Passport<span>*</span></label><input type="text" value="" class="required" name="txt_con_national_identity_card_couple"></td><td><label for="lbl_con_job_couple">Job<span>*</span></label>' + '<?php echo $options_job; ?>' + '</td><td><label for="lbl_con_income_couple">Income Per Month<span>*</span></label>' + '<?php echo $options_income; ?>' + '</td></tr><tr><td colspan="3"><label for="lbl_con_phone_couple">Phone<span>*</span></label><input type="text" value="" class="required" name="txt_con_phone_couple"></td></tr></table></fieldset>';
                jq('#marrital_status').empty();
                jq('#marrital_status').html(html);
            } else {
                jq('#marrital_status').empty();
            }
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
		jq('form#form_contact').submit(function () {
			if (isRequired()) {
				return false;
			}
			jq.ajax({
				url: jq(this).attr('action'),
				type: 'post',
				data: jq(this).serialize(),
				dataType: 'json',
				success: function (response) {
					if(response.result=='error'){
						jq('#msg-error').html(response.msg);
					}
					if(response.result=='ok'){
						window.location = "<?php echo site_url('contacts');?>";
					}
				}
			});
			return false;
		});
        //ajax get district after province selected
        jq('select[name="txt_con_province"]').change(function () {
            jq.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax_action/district') ?>",
                data: {province: jq(this).val()}
            }).done(function (data) {
                jq('#ajax_district').html(data);
                jq('#ajax_commune').html('<select name="txt_con_commune"><option value="">-sangkat/commune-</option></select>');
                jq('#ajax_village').html('<select name="txt_con_village"><option value="">-village-</option></select>');
            });
        });

        //ajax get commune after district selected
        jq('select[name="txt_con_district"]').live('change', function () {
            jq.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax_action/commune') ?>",
                data: {district: jq(this).val()}
            }).done(function (data) {
                jq('#ajax_commune').html(data);
                jq('#ajax_village').html('<select name="txt_con_village"><option value="">-village-</option></select>');
            });
        });

        //ajax get village after commune selected
        jq('select[name="txt_con_commune"]').live('change', function () {
            jq.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax_action/village') ?>",
                data: {commune: jq(this).val()}
            }).done(function (data) {
                jq('#ajax_village').html(data);
            });
        });

        //check radio box if selected
        jq('input[name="txt_con_group"]').click(function () {
<?php
$options_job = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_job_group[]', $arr_option_job, '', 'class="required"'));
$options_income = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_income_group[]', $arr_option_income, '', 'class="required"'));
?>
            if (jq(this).val() == 'group') {
                var html = '<fieldset><legend>Group Member 1</legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_group">Family Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="គោត្តនាម" name="txt_con_kh_first_name_group[]"></td><td><label for="lbl_con_kh_last_name_group">Sure Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="នាម" name="txt_con_kh_last_name_group[]"></td><td><label for="lbl_con_kh_nick_name_group">Nick Name in Khmer</label><input type="text" placeholder="នាមហៅក្រៅ" name="txt_con_kh_nick_name_group[]"></td></tr><tr><td><label for="lbl_con_en_first_name_group">Family Name in English <span>*</span></label><input class="required" type="text" value="" name="txt_con_en_first_name_group[]"></td><td><label for="lbl_con_en_last_name_group">Sure Name in English <span>*</span></label><input type="text" class="required" value="" name="txt_con_en_last_name_group[]"></td><td><label for="lbl_con_en_nick_name_group">Nick Name in English</label><input type="text" value="" name="txt_con_en_nick_name_group[]"></td></tr><tr><td><label for="lbl_con_sex_group">Sex <span>*</span></label><select name="txt_con_sex_group[]"><option value="m">Male</option><option value="f">Female</option></select></td><td><label for="lbl_con_national_identity_card_group">Identity Card / Passport <span>*</span></label><input type="text" class="required" value="" name="txt_con_national_identity_card_group[]"></td><td><label for="lbl_con_job_group">Job<span>*</span></label>' + '<?php echo $options_job; ?>' + '</td></tr><tr><td><label for="lbl_con_income_group">Income Per Month<span>*</span></label>' + '<?php echo $options_income; ?>' + '</td><td><label for="lbl_con_phone_group">Phone <span>*</span></label><input type="text" class="required" value="" name="txt_con_phone_group[]"></td></tr></table></fieldset>';
                jq('#container_group').html(html);
                jq('#add_more_group').css('display', 'block');
            } else {
                jq('#container_group').empty();
                jq('#add_more_group').css('display', 'none');
            }
        });

        //add more group member form
        var group_index = 2;
        jq('#add_more_group').click(function () {
<?php
$options_job = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_job_group[]', $arr_option_job, '', 'class="required"'));
$options_income = preg_replace('/[\n\r]/', '', form_dropdown('txt_con_income_group[]', $arr_option_income, '', 'class="required"'));
?>
            if (group_index > 5)
                return false;
            var html = '<fieldset id="fieldset_' + group_index + '"><legend>Group Member ' + group_index + ' <span class="btn_remove_group" style="cursor: pointer;" name="fieldset_' + group_index + '"><img src="../images/trash.png" alt="" /></span></legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_group">Family Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="គោត្តនាម" name="txt_con_kh_first_name_group[]"></td><td><label for="lbl_con_kh_last_name_group">Sure Name in Khmer <span>*</span></label><input class="required" type="text" placeholder="នាម" name="txt_con_kh_last_name_group[]"></td><td><label for="lbl_con_kh_nick_name_group">Nick Name in Khmer</label><input type="text" placeholder="នាមហៅក្រៅ" name="txt_con_kh_nick_name_group[]"></td></tr><tr><td><label for="lbl_con_en_first_name_group">Family Name in English <span>*</span></label><input type="text" class="required" value="" name="txt_con_en_first_name_group[]"></td><td><label for="lbl_con_en_last_name_group">Sure Name in English <span>*</span></label><input type="text" class="required" value="" name="txt_con_en_last_name_group[]"></td><td><label for="lbl_con_en_nick_name_group">Nick Name in English</label><input type="text" value="" name="txt_con_en_nick_name_group[]"></td></tr><tr><td><label for="lbl_con_sex_group">Sex <span>*</span></label><select name="txt_con_sex_group[]"><option value="m">Male</option><option value="f">Female</option></select></td><td><label for="lbl_con_national_identity_card_group">Identity Card / Passport <span>*</span></label><input type="text" class="required" value="" name="txt_con_national_identity_card_group[]"></td><td><label for="lbl_con_job_group">Job<span>*</span></label>' + '<?php echo $options_job; ?>' + '</td></tr><tr><td><label for="lbl_con_income_group">Income Per Month<span>*</span></label>' + '<?php echo $options_income; ?>' + '</td><td><label for="lbl_con_phone_group">Phone <span>*</span></label><input type="text" value="" class="required" name="txt_con_phone_group[]"></td></tr></table></fieldset>';
            jq('#container_group').append(html);
            group_index++;
            return false;
        });
    });
</script>