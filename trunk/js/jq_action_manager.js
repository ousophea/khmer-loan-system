/**
 * @author vannak.pen
 * @description the file for working on the data action manager such add, edit, delete, select_all, disselect, ... It need jquery to work with 
 */
var jq = jQuery.noConflict();
jq(document).ready(function(){
	//work for add record manager
	jq('#add_manager').click(function(){
		
		//return false;
	});
	
	//work for edit record manager
	jq('#edit_manager').click(function(){
		var get_val = [];
        jq('.check:checked').each(function(i){
          get_val[i] = jq(this).val();
        });
        if(get_val.length != 1){
        	alert('Please make sure you have selected the item to be edited and the item selected must be only one!');
        	return false;
        }
	});
	
	//work for delete record manager
	jq('#delete_manager').click(function(){
		var get_val = [];
        jq('.check:checked').each(function(i){
          get_val[i] = jq(this).val();
        });
        if(get_val.length < 1){
        	alert('Please make sure you have selected the item to be edited and the item selected must be only one!');
        	return false;
        }
	});
	
	//check all / uncheck all
	jq('.check_all').click(function(){
		if(jq(this).is(':checked')){
			jq('.check').prop('checked',true);
		}else{
			jq('.check').prop('checked',false);
		}
	});
	
	//add more phone button
	var phone_index = 1;
	jq('#add_more_phone').click(function(){
		phone_index++;
		var html = '<div id="box_'+phone_index+'"><input type="text" value="" name="txt_con_phone[]"> <span class="btn_remove_phone" style="cursor: pointer;" name="box_'+phone_index+'"><img src="../images/trash.png" alt="" /></span><div>';
		jq('#phone_container').append(html);
		return false;
	});
	
	//remove sub child of phone box
	jq('.btn_remove_phone').live('click',function(){
		var name = jq(this).attr('name');
		jq('#'+name).remove();
	});
	
	//check radio box if selected
	jq('input[name="txt_con_group"]').click(function(){
		if(jq(this).val() == 'group'){
			var html = '<fieldset><legend>Group Member 1</legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_group">Family Name in Khmer <span>*</span></label><input type="text" value="គោត្តនាម" name="txt_con_kh_first_name_group[]"></td><td><label for="lbl_con_kh_last_name_group">Sure Name in Khmer <span>*</span></label><input type="text" value="នាម" name="txt_con_kh_last_name_group[]"></td></tr><tr><td><label for="lbl_con_en_first_name_group">Family Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_first_name_group[]"></td><td><label for="lbl_con_en_last_name_group">Sure Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_last_name_group[]"></td></tr><tr><td><label for="lbl_con_sex_group">Sex <span>*</span></label><select name="txt_con_sex_group[]"><option value="m">Male</option><option value="f">Female</option></select></td><td><label for="lbl_con_phone_group">Phone <span>*</span></label><input type="text" value="" name="txt_con_phone_group[]"></td></tr><tr><td><label for="lbl_con_national_identity_card_group">Identity Card / Passport <span>*</span></label><input type="text" value="" name="txt_con_national_identity_card_group[]"></td><td><label for="lbl_con_email_group">Email</label><input type="text" value="" name="txt_con_email_group[]"></td></tr></table></fieldset>';
			jq('#container_group').html(html);
			jq('#add_more_group').css('display','block');
		}else{
			jq('#container_group').empty();
			jq('#add_more_group').css('display','none');
		}
	});
	
	//add more group member form
	var group_index = 2;
	jq('#add_more_group').click(function(){
		var html = '<fieldset id="fieldset_'+group_index+'"><legend>Group Member '+group_index+' <span class="btn_remove_group" style="cursor: pointer;" name="fieldset_'+group_index+'"><img src="../images/trash.png" alt="" /></span></legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_group">Family Name in Khmer <span>*</span></label><input type="text" value="គោត្តនាម" name="txt_con_kh_first_name_group[]"></td><td><label for="lbl_con_kh_last_name_group">Sure Name in Khmer <span>*</span></label><input type="text" value="នាម" name="txt_con_kh_last_name_group[]"></td></tr><tr><td><label for="lbl_con_en_first_name_group">Family Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_first_name_group[]"></td><td><label for="lbl_con_en_last_name_group">Sure Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_last_name_group[]"></td></tr><tr><td><label for="lbl_con_sex_group">Sex <span>*</span></label><select name="txt_con_sex_group[]"><option value="m">Male</option><option value="f">Female</option></select></td><td><label for="lbl_con_phone_group">Phone <span>*</span></label><input type="text" value="" name="txt_con_phone_group[]"></td></tr><tr><td><label for="lbl_con_national_identity_card_group">Identity Card / Passport <span>*</span></label><input type="text" value="" name="txt_con_national_identity_card_group[]"></td><td><label for="lbl_con_email_group">Email</label><input type="text" value="" name="txt_con_email_group[]"></td></tr></table></fieldset>';
		jq('#container_group').append(html);
		group_index++;
		return false;
	});
	
	//add div in case marital status has been checked 
	jq('input[name="txt_con_civil_status"]').click(function(){
		if(jq(this).val() == '2'){
			var html = '<fieldset><legend>Couple Info</legend><table border="0" width="100%"><tr><td><label for="lbl_con_kh_first_name_couple">Family Name in Khmer <span>*</span></label><input type="text" value="គោត្តនាម" name="txt_con_kh_first_name_couple"></td><td><label for="lbl_con_kh_last_name_couple">Sure Name in Khmer <span>*</span></label><input type="text" value="នាម" name="txt_con_kh_last_name_couple"></td><td><label for="lbl_con_kh_nick_name_couple">Nick Name in Khmer <span>*</span></label><input type="text" value="នាមហៅក្រៅ" name="txt_con_kh_nick_name_couple"></td></tr><tr><td><label for="lbl_con_en_first_name_couple">Family Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_first_name_couple"></td><td><label for="lbl_con_en_last_name_couple">Sure Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_last_name_couple"></td><td><label for="lbl_con_en_nick_name_couple">Nick Name in English <span>*</span></label><input type="text" value="" name="txt_con_en_nick_name_couple"></td></tr><tr><td><label for="lbl_con_sex_couple">Sex<span>*</span></label><select name="txt_con_sex_couple"><option value="m">Male</option><option value="f">Female</option></select></td><td><label for="lbl_con_national_identity_card_couple">Identity Card / Passport<span>*</span></label><input type="text" value="" name="txt_con_national_identity_card_couple"></td><td><label for="lbl_con_job_couple">Job<span>*</span></label><input type="text" value="" name="txt_con_job_couple"></td></tr><tr><td valign="top"><label for="lbl_con_income_couple">Income Per Month<span>*</span></label><input type="text" value="" name="txt_con_income_couple"></td><td colspan="2"><label for="lbl_con_phone_couple">Phone<span>*</span></label><input type="text" value="" name="txt_con_phone_couple"></td></tr></table></fieldset>';
			jq('#marrital_status').empty();
			jq('#marrital_status').html(html);
		}else{
			jq('#marrital_status').empty();
		}
	});
	
	//remove group after added
	jq('.btn_remove_group').live('click',function(){
		var name = jq(this).attr('name');
		jq('#'+name).remove();
	});
	
	//submit form
	jq('#add_save_contact').click(function(){
		jq('form[name="form_contact"]').submit();
		return false;
	});
	
});
