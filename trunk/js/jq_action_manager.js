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
    	jq('#frm_contact').attr('action','contacts/edit');
    	jq('#frm_contact').submit();
    	return false;
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
		var conf = confirm('are you sure to delete');
		if(conf){
			jq('#frm_contact').attr('action','contacts/delete');
			jq('#frm_contact').submit();
		}
    	return false;
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
	
	//form action edit manager
	jq('#edit_manager').click(function(){
		
	});
	
});
