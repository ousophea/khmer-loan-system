<!-- Author PEN Vannak -->
<?php
//get job and paste to array
$arr_option_job = array(''=>'-select job-');
if($query_job->num_rows() > 0){
	foreach ($query_job->result() as $rows) {
		$arr_option_job[$rows->con_job_id] = $rows->con_job_title;
	}
}
//get income and paste to array
$arr_option_income = array(''=>'-select income-');
if($query_income->num_rows() > 0){
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
function getOptions($data){
	$res = '';
	foreach($data as $key=>$val){
		$res .= '<option value="'.$key.'">'.$val.'</option>';
	}
	return $res;
}
$couple_job = getOptions($arr_option_job);
$couple_income = getOptions($arr_option_income);

?>

<script type="text/javascript" language="JavaScript">
var g_ind = 0;
var gp_ind = 0;
var jq = jQuery.noConflict();
function _getData(url,data){
	var res = {};
	jq.ajax({
		url:url,
		type:'post',
		async:false,
		data:data,
		dataType:'json',
		success:function(response){
			res = response;
		}
	});
	return res;
}
function getDistricts(id,selected){
	selected = typeof(selected)!='undefined'?selected:0;
	console.log(selected);
	//todo clear the old
	jq('select[name="detail\\[con_det_dis_id\\]"] option[value!=""]').remove();
	jq('select[name="detail\\[con_det_com_id\\]"] option[value!=""]').remove();
	jq('select[name="detail\\[con_det_vil_id\\]"] option[value!=""]').remove();
	if(id>0){
		var url = "<?php echo site_url('ajax_action/ajaxGetData') ?>";
		var dataString = {"field_where":"dis_pro_id","field_value":id,"table":"districts"};
		var data = _getData(url,dataString);			
		for(ind=0; ind<data.length; ind++){
			var row = data[ind]				
			var name = row.dis_en_name+'('+ row.dis_kh_name + ')';
			jq('select[name="detail\\[con_det_dis_id\\]"]').get(0).options[ind+1] = new Option(name,row.dis_id);
		}
		jq('select[name="detail\\[con_det_dis_id\\]"]').val(selected);
	}
}

function getCommunes(id,selected){
	selected = typeof(selected)!='undefined'?selected:0;
	//todo clear the old		
	jq('select[name="detail\\[con_det_com_id\\]"] option[value!=""]').remove();
	jq('select[name="detail\\[con_det_vil_id\\]"] option[value!=""]').remove();
	if(id>0){
		var url = "<?php echo site_url('ajax_action/ajaxGetData') ?>";
		var dataString = {"field_where":"com_dis_id","field_value":id,"table":"communes"};
		var data = _getData(url,dataString);			
		for(ind=0; ind<data.length; ind++){
			var row = data[ind];			
			var name = row.com_en_name+'('+ row.com_kh_name + ')';
			jq('select[name="detail\\[con_det_com_id\\]"]').get(0).options[ind+1] = new Option(name,row.com_id);
		}
		jq('select[name="detail\\[con_det_com_id\\]"]').val(selected);
	}
}
function getVillages(id,selected){
	selected = typeof(selected)!='undefined'?selected:0;
	//todo clear the old
	jq('select[name="detail\\[con_det_vil_id\\]"] option[value!=""]').remove();
	if(id>0){
		var url = "<?php echo site_url('ajax_action/ajaxGetData') ?>";
		var dataString = {"field_where":"vil_com_id","field_value":id,"table":"villages"};
		var data = _getData(url,dataString);		
		for(ind=0; ind<data.length; ind++){
			var row = data[ind];				
			var name = row.vil_en_name+'('+ row.vil_kh_name + ')';
			jq('select[name="detail\\[con_det_vil_id\\]"]').get(0).options[ind+1] = new Option(name,row.vil_id);
		}
		jq('select[name="detail\\[con_det_vil_id\\]"]').val(selected);
	}
}
function checkCivilStatus(status, data){
	if(status == '2'){
		jq('#marrital_status').empty();
		getForm('Couple Infor','couple','couple','#marrital_status',data,'add');		
	}else{
		jq('#marrital_status').empty();
	}
}

function getForm(title,eleName,jqueryName,eleId,data,opt){
	var rem = '<span class="btn_remove_group" style="cursor: pointer;" name="fieldset_'+g_ind+'"><img src="../images/trash.png" alt="" /></span>';
	var bRemove = g_ind>0?rem:''; 
	var html = '<fieldset id="fieldset_'+g_ind+'"><legend>'+title + bRemove+'</legend>';
	html += '<table border="0" width="100%">';
	html += '<tr>';
	html += '<td><label for="lbl_con_kh_first_name_couple">Family Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="គោត្តនាម" name="'+eleName+'[con_kh_first_name]"></td>';
	html += '<td><label for="lbl_con_kh_last_name_couple">Sure Name in Khmer <span>*</span></label><input type="text" class="required" placeholder="នាម" name="'+eleName+'[con_kh_last_name]"></td>';
	html += '<td><label for="lbl_con_kh_nick_name_couple">Nick Name in Khmer</label><input type="text" placeholder="នាមហៅក្រៅ" name="'+eleName+'[con_kh_nickname]"></td></tr>';
	html += '<tr>';
	html += '<td><label for="lbl_con_en_first_name_couple">Family Name in English <span>*</span></label><input type="text" class="required" value="" name="'+eleName+'[con_en_first_name]"></td>';
	html += '<td><label for="lbl_con_en_last_name_couple">Sure Name in English <span>*</span></label><input type="text" class="required" value="" name="'+eleName+'[con_en_last_name]"></td>';
	html += '<td><label for="lbl_con_en_nick_name_couple">Nick Name in English</label><input type="text" value="" name="'+eleName+'[con_en_nickname]"></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td><label for="lbl_con_sex">Sext<span>*</span></label><select name="'+eleName+'[con_sex]"><option value="m">Male</option><option value="f">Female</option></select></td>'
	html += '<td><label for="lbl_con_national_identity_card_couple">Identity Card / Passport<span>*</span></label><input type="text" class="required" value="" name="'+eleName+'[con_national_identity_card]"></td>';
	html += '<td><label for="lbl_con_job_couple">Job<span>*</span></label><select class="required" name="'+eleName+'[con_con_job_id]"><?php echo $couple_job;?></select></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td><label for="lbl_con_income_couple">Income Per Month<span>*</span></label><select class="required" name="'+eleName+'[con_con_inc_id]"><?php echo $couple_income;?></select></td>';
	html += '<td colspan="3"><label for="lbl_con_phone_couple">Phone<span>*</span></label><input class="required" type="text" value="" name="'+eleName+'[phone][con_num_line]"></td>';
	html += '</tr>';
	html += '</table></fieldset>';
	html += '<input type="hidden" value="0" name="'+eleName+'[con_id]"/>';
	if(opt=='add'){
		jq(eleId).html(html);
	}else{
		jq(eleId).append(html);
	}
	if(data){		
		jq('input[name='+jqueryName+'\\[con_kh_first_name\\]]').val(data.con_kh_first_name);
		jq('input[name='+jqueryName+'\\[con_kh_last_name\\]]').val(data.con_kh_last_name);
		jq('input[name='+jqueryName+'\\[con_kh_nickname\\]]').val(data.con_kh_nickname);
		jq('input[name='+jqueryName+'\\[con_en_first_name\\]]').val(data.con_en_first_name);
		jq('input[name='+jqueryName+'\\[con_en_last_name\\]]').val(data.con_en_last_name);
		jq('input[name='+jqueryName+'\\[con_en_nickname\\]]').val(data.con_en_nickname);
		
		jq('select[name='+jqueryName+'\\[con_sex\\]]').val(data.con_sex);
		jq('input[name='+jqueryName+'\\[con_national_identity_card\\]]').val(data.con_national_identity_card);
		jq('select[name='+jqueryName+'\\[con_con_job_id\\]]').val(data.con_con_job_id);
		jq('select[name='+jqueryName+'\\[con_con_inc_id\\]]').val(data.con_con_inc_id);
		jq('input[name='+jqueryName+'\\[phone\\]\\[con_num_line\\]]').val(data.con_num_line);
		jq('input[name='+jqueryName+'\\[con_id\\]]').val(data.con_id);
	}
	g_ind++;
}

jq(document).ready(function() {
	//set collapse content
	jq( "#accordion" ).accordion({
		collapsible: true,
		heightStyle: "auto"
	});
	//set date picker
	jq( "input[name='detail\\[con_det_dob\\]']" ).datepicker({ 
		defaultDate: '-30y',
		buttonText: "Choose",
		dateFormat: "yy-mm-dd" 
	});
	
	
	//add div in case marital status has been checked 
	jq('input[name="detail\\[con_det_civil_status\\]"]').click(function(){
		var status = jq(this).val();
		checkCivilStatus(status,{})
	});
	
	//ajax get district after province selected
	jq('select[name="detail\\[con_det_pro_id\\]"]').change(function(){
		var th = jq(this);
		getDistricts(th.val());		
	});
	
	//ajax get commune after district selected
	jq(document).on('change','select[name="detail\\[con_det_dis_id\\]"]',function(){
		var th = jq(this);
		getCommunes(th.val());	
	});
	
	//ajax get village after commune selected
	jq(document).on('change','select[name="detail\\[con_det_com_id\\]"]',function(){
		var th = jq(this);
		getVillages(th.val());	
	});
	
	//check radio box if selected
	jq('input[name=info\\[con_con_typ_id\\]]').click(function(){
		var txt = jq(this).val();
		var eleId = '#container_group';
		if(txt == '1'){
			jq('#add_more_group').css({'display':'block'});
			getForm('Group Member 1','group\[0\]','group\\[0\\]',eleId,{},'add');			
		}else{
			jq(eleId).empty();
			jq('#add_more_group').css('display','none');
		}
	});
	
	jq('#add_more_phone_e').click(function(){
		gp_ind++;
		var html = '<div id="box_'+gp_ind+'"><input type="text" class="required" value="" name=phone['+gp_ind+'][con_num_line]"> ';
		html += '<span class="btn_remove_phone" style="cursor: pointer;" name="box_'+gp_ind+'">';
		html += '<img src="../images/trash.png" alt="" /></span><div>';
		jq('#phone_container').append(html);
		
		return false;
	});
	
	//add more group member form	
	jq('#add_more_group').click(function(){
		if (g_ind > 5) return false;
		
		var title = 'Group Member ' + (g_ind+1);
		var eleName = 'group\['+g_ind+'\]';
		var jqueryName = 'group\\['+g_ind+'\\]';
		var eleId = '#container_group';
		getForm(title,eleName,jqueryName,eleId,{},'append');
		
		g_ind++;
		
		return false;
	});
	
	function isRequired(){
		var cnt = 0;			
		jq.each(jq('.required'),function(){
			var th = jq(this);
			if(!validateForm(th)) cnt++;
		});
		return cnt;
	}
	jq(document).on('change blur keyup','.required',function(){
		var th = jq(this);
		validateForm(th);
	});
	
	function validateForm(th){			
		var txt = th.val();
		if(txt==''){
			th.parent().addClass('control-group error');
			return false;
		}else{
			th.parent().removeClass('control-group error');
			return true;
		}
	}
	jq('form#form_contact').submit(function(){
		if(isRequired()){
			return false;
		}
		return true;
	});
});
</script>

<?php
echo form_open(site_url(segment(1).'/edit_save'),array('name'=>'form_contact','id'=>'form_contact'));
?>
	<div id="accordion">
		<h3>Basic Information</h3>
		<div>
			<table border="0" width="100%">
				<tr>
					<td colspan="3">
					<?php
						echo form_label('Customer ID <span>*</span>','lbl_cus_id_first_name'); 
						echo form_input(array('name'=>'info[con_cid]','placeholder'=>'Customer ID','value'=>set_value('info[con_cid]',$cm->con_cid),'class'=>'required'));
					?>
					</td>
				</tr>
				<tr>
					<td>					
					<?php
						echo form_label('Family Name in Khmer <span>*</span>','lbl_con_kh_first_name'); 
						$input = array('name'=>'info[con_kh_first_name]','placeholder'=>'គោត្តនាម','value'=>set_value('info[con_kh_first_name]',$cm->con_kh_first_name),'class'=>'required');
						echo form_input($input);
						echo form_hidden('cid',$cm->con_id);
					?>
					</td>
					<td>
					<?php 
						echo form_label('Sure Name in Khmer <span>*</span>','lbl_con_kh_last_name');
						$input = array('name'=>'info[con_kh_last_name]','placeholder'=>'នាម','value'=>set_value('info[con_kh_last_name]',$cm->con_kh_last_name),'class'=>'required');
						echo form_input($input);
					?>
					</td>
					<td>
					<?php 
						echo form_label('Nick Name in Khmer','lbl_con_kh_nick_name');
						$input = array('name'=>'info[con_kh_nickname]','placeholder'=>'នាមហៅក្រៅ','value'=>set_value('info[con_kh_nickname]',$cm->con_kh_nickname));
						echo form_input($input);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						echo form_label('Family Name in English <span>*</span>','lbl_con_en_first_name'); 
						$input = array('name'=>'info[con_en_first_name]','placeholder'=>'Family Name in English','value'=>set_value('info[con_en_first_name]',$cm->con_en_first_name),'class'=>'required');
						echo form_input($input);
					?>
					</td>
					<td>
					<?php
						echo form_label('Sure Name in English <span>*</span>','lbl_con_en_last_name');
						$input = array('name'=>'info[con_en_last_name]','placeholder'=>'Sure Name in English','value'=>set_value('info[con_en_last_name]',$cm->con_en_last_name),'class'=>'required');
						echo form_input($input);
					?>
					</td>
					<td>
					<?php 
						echo form_label('Nick Name in English','lbl_con_en_nick_name');
						$input = array('name'=>'info[con_en_nickname]','placeholder'=>'Nick Name in English','value'=>set_value('info[con_en_nickname]',$cm->con_en_nickname));
						echo form_input($input);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						echo form_label('Sex <span>*</span>', 'lbl_con_sex');
						$selected = set_value('infor[con_sex]',$cm->con_sex);
						echo form_dropdown('infor[con_sex]',array('m'=>'Male','f'=>'Female'),$selected);
					?>
					</td>
					<td>
					<?php
						echo form_label('Identity Card / Passport <span>*</span>', 'lbl_con_national_identity_card');
						$input = array('name'=>'infor[con_national_identity_card]','placeholder'=>'Identity Card / Passport','value'=>set_value('infor[con_national_identity_card]',$cm->con_national_identity_card),'class'=>'required');
						echo form_input($input);
					?>
					</td>
					<td>
					<?php
						echo form_label('Job <span>*</span>', 'lbl_con_job');
						$selected = set_value('info[con_con_job_id]',$cm->con_con_job_id);
						echo form_dropdown('info[con_con_job_id]',$arr_option_job,$selected,'class="required"');
					?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php
						echo form_label('Income Per Month <span>*</span>', 'lbl_con_income');
						$selected = set_value('info[con_con_inc_id]',$cm->con_con_inc_id);
						echo form_dropdown('info[con_con_inc_id]',$arr_option_income,$selected,'class="required"');
					?>
					</td>
					<td colspan="2">
					<div>
					<?php
						echo form_label('Phone <span>*</span>', 'lbl_con_phone');
						$_ind = 0;
						foreach($cphone as $crow){							
							if($_ind==0){
								$input = array('name'=>'phone['.$_ind.'][con_num_line]','value'=>set_value('phone['.$_ind.'][con_num_line]',$crow['con_num_line']),'class'=>'required');
								echo form_input($input);
								echo anchor('#',' <img src="'.site_url('images/plus.png').'" alt="add" title="add more" />','id="add_more_phone_e"');								
							}else{
								echo "<div id='box_{$_ind}'>";
								$input = array('name'=>'phone['.$_ind.'][con_num_line]','value'=>set_value('phone['.$_ind.'][con_num_line]',$crow['con_num_line']),'class'=>'required');
								echo form_input($input);
								echo '<span class="btn_remove_phone" style="cursor: pointer;" name="box_'.$_ind.'"> <img src="../images/trash.png" alt="" /></span><div>';
								echo '</div>';								
							}
							$_ind++;
						}
						if($_ind==0){
							echo form_input(array('name'=>'phone[0][con_num_line]','class'=>'required'));
							echo anchor('#','<img src="'.site_url('images/plus.png').'" alt="add" title="add more" />','id="add_more_phone_e"');
						}
						
					?>
					</div>
						<script>
							gp_ind = parseInt(<?php echo $_ind;?>) + 1;							
						</script>
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
						<span>
						<?php
							echo form_label('Address <span>*</span>', 'lbl_con_address');
							//echo form_textarea(array('name'=>'txt_con_address','cols'=>100,'rows'=>5));
							$arr_option_province = array(''=>'-select province-');
							if($query_pronvince->num_rows() > 0){
								foreach($query_pronvince->result() as $rows){
									$arr_option_province[$rows->pro_id] = $rows->pro_en_name.'('.(($rows->pro_kh_name == '')?'no set':$rows->pro_kh_name).')';
								}
							}
							$selected = set_value('detail[con_det_pro_id]',$cm->con_det_pro_id);
							echo form_dropdown('detail[con_det_pro_id]',$arr_option_province,$selected,'style="width:208px !important;" class="required"');							
						?>
						</span>
						<script>
							jq(document).ready(function(){
								getDistricts(<?php echo $cm->con_det_pro_id; ?>,<?php echo $cm->con_det_dis_id; ?>);
							});
						</script>
						<span>
						<?php
							$district_option = array(''=>'-khan/district-');
							echo form_dropdown('detail[con_det_dis_id]',$district_option,'','style="width:208px !important;" class="required"');
						?>
						</span>
						<script>
							jq(document).ready(function(){
								getCommunes(<?php echo $cm->con_det_dis_id; ?>,<?php echo $cm->con_det_com_id; ?>);
							});
						</script>
						<span>
						<?php
							$commune_option = array('-sangkat/commune-','Teok Laak 3','Ou San Dan');
							echo form_dropdown('detail[con_det_com_id]',$commune_option,'','style="width:208px !important;" class="required"');
						?>
						</span>
						<script>
							jq(document).ready(function(){
								getVillages(<?php echo $cm->con_det_com_id; ?>,<?php echo $cm->con_det_vil_id; ?>);
							});
						</script>
						<span>
						<?php
							$village_option = array('-village-');
							echo form_dropdown('detail[con_det_vil_id]',$village_option,'','style="width:208px !important;" class="required"');
						?>
						</span>
						<span>
						<?php
							$input = array('name'=>'detail[con_det_address_detail]','value'=>set_value('detail[con_det_address_detail]',$cm->con_det_address_detail),'class'=>'required');
							echo form_input($input);
						?>
						</span>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						echo form_label('Email', 'lbl_con_email');
						$input = array('name'=>'detail[con_det_email]','placeholder'=>'Email','value'=>set_value('detail[con_det_email]',$cm->con_det_email));
						echo form_input($input);
					?>
					</td>
					<td>
					<?php
						echo form_label('Date Of Birth <span>*</span>', 'lbl_con_dob');
						$input = array('name'=>'detail[con_det_dob]','placeholder'=>'Date Of Birth','value'=>set_value('detail[con_det_dob]',$cm->con_det_dob),'class'=>'required');
						echo form_input($input);
					?>
					</td>
					<td>
					<?php
						echo form_label('Marital Status <span>*</span>', 'lbl_con_civil_status');						
						echo form_radio('detail[con_det_civil_status]','1',TRUE).' Single ';
						echo form_radio('detail[con_det_civil_status]','2').' Married ';
						echo form_radio('detail[con_det_civil_status]','3').' Divorce ';
						echo form_radio('detail[con_det_civil_status]','4').' Other';
						echo form_hidden('couple_id',(isset($couple->con_cou_couple)?$couple->con_cou_couple:0));
						echo form_hidden('group_id',$group_id);
					?>
					<script>
						jq(document).ready(function(){
							var _sta = "<?php echo set_value('detail[con_det_civil_status]',$cm->con_det_civil_status);?>";							
							jq('input[name=detail\\[con_det_civil_status\\]][value="'+_sta+'"]').prop('checked','checked');
							var _data = <?php echo json_encode($couple);?>;							
							checkCivilStatus(_sta, _data);
						});
					</script>
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
							echo form_radio('info[con_con_typ_id]','2', TRUE).' Individual ';
							echo form_radio('info[con_con_typ_id]','1').' Group ';
						?>
						<script>
							jq(document).ready(function(){
								var _gro = "<?php echo set_value('info[con_con_typ_id]',$cm->con_con_typ_id);?>";								
								jq('input[name=info\\[con_con_typ_id\\]][value="'+_gro+'"]').prop('checked','checked');															
								if(_gro=='1'){
									var _gdata = <?php echo json_encode(isset($group)?$group:array());?>;									
									var len = _gdata.length; 
									if(len>0){
										for(var ind=0; ind<len; ind++){
											var _row = _gdata[ind];
											var _title = 'Group Member ' + (g_ind+1);
											var _eleName = 'group\['+g_ind+'\]';
											var _jqueryName = 'group\\['+g_ind+'\\]';
											var _eleId = '#container_group';
											getForm(_title,_eleName,_jqueryName,_eleId,_row,'append');
											g_ind++;
										}
									}else{
										var _row = {};
										var _title = 'Group Member ' + (g_ind+1);
										var _eleName = 'group\['+g_ind+'\]';
										var _jqueryName = 'group\\['+g_ind+'\\]';
										var _eleId = '#container_group';
										getForm(_title,_eleName,_jqueryName,_eleId,_row,'append');
										g_ind++;
									}
									jq('#add_more_group').css({'display':'block'});
								}
							});
						</script>
						<div id="container_group"></div>
						<?php echo anchor('#','<i class="icon-plus-sign"></i>Add More Group','class="btn btn-mini" id="add_more_group" style="display: none; width: 108px;" title="Add More Group"'); ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="control_manager">
	<?php 
		echo anchor('#','<i class="icon-plus-sign"></i>Save Contact','class="btn btn-mini" id="add_save_contact" title="Save Contact"');
		echo nbs();
		echo anchor(site_url(segment(1)),'<i class="icon-circle-arrow-left"></i>Back','class="btn btn-mini" id="back" title="Back"'); 
	?>
	</div>
<?php
echo form_close();
?>
