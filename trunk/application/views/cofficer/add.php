<?php
echo form_open(site_url(segment(1).'/save'),array('name'=>'form-cofficer'));
?>
	<table border="0" width="100%">
		<tr>
			<td>
			<?php
				echo form_label('អត្តសញ្ញាណ <span class="text-error">*</span>','lbl_card_id'); 
				echo form_input(array('name'=>'cofficer[co_card_id]','placeholder'=>'អត្តសញ្ញាណ','class'=>"required"));
			?>
			</td>
			<td>
			<?php 
				echo form_label('ឈ្មោះ <span class="text-error">*</span>','lbl_co_name');
				echo form_input(array('name'=>'cofficer[co_name]','placeholder'=>'នាម','class'=>"required"));
			?>
			</td>
			<td>
			<?php 
				echo form_label('ភេទ ', 'lbl_con_sex');				
				echo form_dropdown('cofficer[co_sex]',array('m'=>'Male','f'=>'Female'));
			?>
			</td>
		</tr>
		<tr>
			<td>
			<?php
				echo form_label('ប្រធាន ', 'lbl_chief');				
				echo form_dropdown('cofficer[chif_co_id]',array(''=>'ជ្រើសរើស')+$chiefs);
			?>
			</td>
			<td>
			<?php
				echo form_label('តំណែង <span class="text-error">*</span>', 'lbl_co_position');				
				echo form_dropdown('cofficer[co_position]',array('0'=>'Member','1'=>'Manager'));
			?>
			</td>
			<td>
			<?php 
				echo form_label('ទូរស័ព្ទ');
				echo form_input(array('name'=>'cofficer[co_tel]','placeholder'=>'ទូរស័ព្ទ'));
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<?php
				echo form_label('អាស័យដ្ឋាន ​ ', 'lbl_co_address');
				echo form_textarea(array('name'=>'cofficer[co_address]','style'=>'width:85%;height:50px;'));
			?>
			</td>
			<td>
			<?php
				echo form_label('សាខា <span class="text-error">*</span>', 'lbl_branch');
				echo form_dropdown('branches[]',$brands,null,'class="chosen-brand required" multiple="multiple"');
				
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
<style>
	.control-group.error .chosen-choices{
		border-color:#b94a48 !important;
	}
</style>
<script type="text/javascript" language="JavaScript">
	var jq = jQuery.noConflict();
	jq(document).on('click','#btn-save',function(){
		if(isValid()){
			return false;
		}else{
			var obj = jq('input[name=cofficer\\[co_card_id\\]]');
			var card_id = obj.val();
			var exists = getDataExists(card_id);
			if(exists){
				var txt = "Card Id: "+card_id+" is already exists.";
				alert(txt);
				obj.focus();
				return false
			}else{
				return true;
			}
		}		
	});
	
	function isValid(){
		var cnt = 0;			
		jq.each(jq('.required'),function(){
			var th = jq(this);			
			if(!validateForm(th)) cnt++;
		});
		return cnt;
	}
	
	function validateForm(th){			
		var txt = th.val();
		if(txt=='' || txt == null){
			th.parent().addClass('control-group error');
			return false;
		}else{
			th.parent().removeClass('control-group error');
			return true;
		}
	}
	jq(document).on('blur change keyup','.required',function(){
		validateForm(jq(this));
	});
	
	function getDataExists(card_id){
		var res = false;
		jq.ajax({
			url:"<?php echo site_url('cofficer/ajax_check_exist');?>",
			type:'post',
			async:false,
			data:{"card_id":card_id},
			dataType:'json',
			success:function(response){
				if(response.result=='exists'){
					res = true;
				}
			}
		});
		return res;
	}
</script>