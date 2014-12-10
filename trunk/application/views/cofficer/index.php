<!-- Author: Vannak -->
<?php
echo form_open('cofficer', array('name' => 'form_action', 'id' => 'form-cofficer'));
?>

	<div class="control_manager">
		<a class="btn btn-mini" href="<?php echo site_url('cofficer/add');?>" id="c)add" title="Add new"><i class="icon-plus-sign"></i> Add new</a>
		<a data-url="<?php echo site_url('cofficer/edit');?>" id="c_edit" class="btn btn-mini" title="Edit"><i class="icon-edit"></i> Edit</a>
		<a data-url="<?php echo site_url('cofficer/delete');?>" id="c_delete" class="btn btn-mini" title="Delete"><i class="icon-remove-sign"></i> Delete</a>
	</div>
	<?php
	if ($this->session->flashdata('success'))
		echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
	if ($this->session->flashdata('error'))
		echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
	?>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th><input type="checkbox" class="check_all"></th>
				<th>Card ID</th>
				<th>Name</th>
				<th>Sex</th>
				<th>Position</th>
				<th>Chief</th>
				<th>Brand</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $row): ?>
			<tr>
				<td><input type="checkbox" class="check" name="check_select[]" value="<?php echo $row['co_id'];?>"></td>
				<td><?php echo $row['co_card_id'];?></td>
				<td><?php echo $row['co_name'];?></td>
				<td><?php echo $row['co_sex']=='m'?'Male':'Female';?></td>
				<td><?php echo $row['co_position']==0?'Memember':'Manager';?></td>
				<td><?php echo $row['chief_name'];?>
				<td>
					<?php
						$brands = $row['brands'];
						foreach($brands as $brand):
						echo $brand['bra_name'].br();
						endforeach;
					?>
				</td>
			</tr>
			<?php 
				endforeach;
				if(count($data)==0){
					echo "<tr><td colspan='7'>No data</td></tr>";
				}
			?>
			
		</tbody>
	</table>
<?php
echo form_close();
?>

<script>
	var jq = jQuery.noConflict();
	jq(document).on('click','.control_manager #c_edit',function(){
		doSubmit(jq(this));
	});
	jq(document).on('click','.control_manager #c_delete',function(){
		doSubmit(jq(this));
	});
	function doSubmit(th){
		var chk = checkSelected();
		if(!chk){
			alert('Please select at least one checkbox')
			return;
		}
		var id = th.attr('id');
		if(id=='c_delete'){
			var conf = confirm("Are you sure to delete?");
			if(!conf){
				return;
			}
		}
		var act = th.attr('data-url');
		var frm = jq('#form-cofficer');
		frm.attr('action',act);
    	frm.submit();
	}
	
	function checkSelected(){
		return jq('.check:checked').length;
	}
</script>