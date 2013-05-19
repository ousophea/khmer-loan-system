<script type="text/javascript" language="JavaScript">
var jq = jQuery.noConflict();
jq(document).ready(function() {
	//set collapse content
	jq( "#accordion" ).accordion({
		collapsible: true,
		heightStyle: "auto"
	});
	//set date picker
	jq( "input[name='txt_con_dob']" ).datepicker({ 
		defaultDate: '-30y',
		buttonText: "Choose",
		dateFormat: "yy-mm-dd" 
	});
});
</script>
<style type="text/css">
	div#container_group legend, div#marrital_status legend{
		font-size: 17px !important;
	}
</style>
<?php
echo form_open(site_url(segment(1).'/add_save'),array('name'=>'form_contact'));
?>
	<div id="accordion">
		<h3>Basic Information</h3>
		<div>
			<table border="0" width="100%">
				<tr>
					<td>
					<?php
						echo form_label('Family Name in Khmer <span>*</span>','lbl_con_kh_first_name'); 
						echo form_input('txt_con_kh_first_name','គោត្តនាម');
					?>
					</td>
					<td>
					<?php 
						echo form_label('Sure Name in Khmer <span>*</span>','lbl_con_kh_last_name');
						echo form_input('txt_con_kh_last_name','នាម');
					?>
					</td>
					<td>
					<?php 
						echo form_label('Nick Name in Khmer','lbl_con_kh_nick_name');
						echo form_input('txt_con_kh_nick_name','នាមហៅក្រៅ');
					?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						echo form_label('Family Name in English <span>*</span>','lbl_con_en_first_name'); 
						echo form_input('txt_con_en_first_name');
					?>
					</td>
					<td>
					<?php
						echo form_label('Sure Name in English <span>*</span>','lbl_con_en_last_name');
						echo form_input('txt_con_en_last_name');
					?>
					</td>
					<td>
					<?php 
						echo form_label('Nick Name in English','lbl_con_en_nick_name');
						echo form_input('txt_con_en_nick_name');
					?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						echo form_label('Sex <span>*</span>', 'lbl_con_sex');
						echo form_dropdown('txt_con_sex',array('m'=>'Male','f'=>'Female'));
					?>
					</td>
					<td>
					<?php
						echo form_label('Identity Card / Passport <span>*</span>', 'lbl_con_national_identity_card');
						echo form_input('txt_con_national_identity_card');
					?>
					</td>
					<td>
					<?php
						echo form_label('Job <span>*</span>', 'lbl_con_job');
						echo form_input('txt_con_job');
					?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php
						echo form_label('Income Per Month <span>*</span>', 'lbl_con_income');
						echo form_input('txt_con_income');
					?>
					</td>
					<td colspan="2">
					<?php
						echo form_label('Phone <span>*</span>', 'lbl_con_phone');
						echo form_input('txt_con_phone[]');
						echo anchor('#','<img src="'.site_url('images/plus.png').'" alt="add" title="add more" />','id="add_more_phone"');
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
						$pro_option = array('-city/province-','Phnom Penh','Battamborng');
						echo form_dropdown('txt_con_province',$pro_option,'','style="width:208px !important;"');
						$district_option = array('-khan/district-','Tuol Kok','Krakor');
						echo form_dropdown('txt_con_district',$district_option,'','style="width:208px !important;"');
						$commune_option = array('-sangkat/commune-','Teok Laak 3','Ou San Dan');
						echo form_dropdown('txt_con_commune',$commune_option,'','style="width:208px !important;"');
						$village_option = array('-village-','Putream','Ou Bakeom');
						echo form_dropdown('txt_con_village',$village_option,'','style="width:208px !important;"');
						echo form_input('txt_con_address_detail');
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
						echo form_input('txt_con_dob');
					?>
					</td>
					<td>
					<?php
						echo form_label('Marital Status <span>*</span>', 'lbl_con_civil_status');
						echo form_radio('txt_con_civil_status','1',TRUE).' Single ';
						echo form_radio('txt_con_civil_status','2').' Married ';
						echo form_radio('txt_con_civil_status','3').' Divorce ';
						echo form_radio('txt_con_civil_status','4').' Other';
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
					<td width="160" valign="top">
					<?php
						echo form_label('Group / Individual <span>*</span>', 'lbl_con_group');
						echo form_radio('txt_con_group','individual', TRUE).' Individual ';
						echo form_radio('txt_con_group','group').' Group ';
					?>
					</td>
					<td>
						<div id="container_group"></div>
						<?php echo anchor('#','<i class="icon-plus-sign"></i>Add More Group','class="btn btn-mini" id="add_more_group" style="display: none; width: auto;" title="Add More Group"'); ?>
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