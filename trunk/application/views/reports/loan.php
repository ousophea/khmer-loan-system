<style>
	td{
		text-align:left !important;
	}
</style>
<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = ' All ';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';


echo "<div>";
	echo form_open('trn_search','search_trn','journals/add');
		echo "<div class='search_tool_bar row-fluid'>";
		field('select', 'currency', 'Currency', '', array('options' => $array_currency,'attribute' => array('id' => 'dro_cur','class'=>'chosen')));
		field('text', 'txt_trn_date', 'Loan Date',NULL,array('attribute' => array('id' => 'txt_date')));
		field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', 
				array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));
	   
	echo close_form();
?>
	<table id="loan-table" class="table table-bordered">
		<thead>
			<tr>
				<th>Client's name</th>
				<th>CID</th>
				<th>Address</th>
				<th>Account number</th>
				<th>Number loan requests</th>
				<th>Date of disburse</th>
				<th>Mature date</th>
				<th>Currency</th>
				<th>Amount</th>
				<th>Interest rate</th>
				<th>Type of payment</th>
				<th>No of instalment</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
<?php
echo "</div>";

?>

<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        setDate('txt_trn_date');
		//todo retrieve data after reload
		setData();
		
		jq('.search_tool_bar .control-group').attr('class',"control-group span2");
		
		jq('#btn_search').click(function(){
			setData();
		});		
		function setData(){
			var url = '<?php echo site_url('reports/ajax_loan')?>';
			var dataString = {"currency" : jq("#dro_cur").val(),txt_date:jq('#txt_date').val()};			
			jq.ajax({ 
				url: url,
				type: 'POST',
				data: dataString,
				dataType:'json',
				success: function(response){
					console.log(response);
					generateTable(response);
				}			
			});			
		}
		function generateTable(data){
			var res = '';
			for(var ind=0; ind<data.length; ind++){
				var row = data[ind];
				var cname = row.con_kh_first_name +' '+ row.con_kh_last_name;
				res += '<tr>';
				res += '	<td>'+cname+'</td>';
				res += '	<td>'+row.con_cid+'</td>';
				res += '	<td>'+row.con_cid+'</td>';
				res += '	<td>'+row.loa_acc_code+'</td>';
				res += '	<td></td>';
				res += '	<td></td>';
				res += '	<td></td>';
				res += '	<td>'+row.cur_title+'</td>';
				res += '	<td>'+row.loa_acc_amount+'</td>';
				res += '	<td>'+row.loa_ins_interest_rate+'</td>';
				res += '	<td></td>';
				res += '	<td>'+row.loa_ins_num_ins+'</td>';
				res += '</tr>';
			}
			if(res==''){
				res = '<tr><td colspan="12">No data!</td></tr>';
			}
			jq('#loan-table tbody').html(res);
		}
	});
</script>