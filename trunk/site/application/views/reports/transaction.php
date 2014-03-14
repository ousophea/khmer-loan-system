<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
$arr_select_field = array(
    'GL Code' => 'gl_code',
    'GL Description' => 'gl_description',
    'Trn Description' => 'tra_description',
    'Trn Date' => 'tra_date',
    'Currency' => 'cur_title',
    'Debit' => 'tra_debit',
    'Credit' => 'tra_credit',
    'User' => 'use_name'
);

foreach ($total_dc->result() as $total_rows) {
    $total_debit = $total_rows->total_debit;
    $total_credit = $total_rows->total_credit;
}



echo "<div class='tbl_trn'>";
echo form_open('trn_search','search_trn','journals/add');
    echo "<div class='search_tool_bar row-fluid'>";
    field('select', 'currency', 'Currency :', '1', array('options' => $array_currency,'attribute' => array('id' => 'dro_cur')), TRUE);
    field('text', 'txt_trn_date', 'Date :',NULL,array('attribute' => array('id' => 'txt_date')));
    field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', 
            array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));
    //echo "</div>";
    //======== More search option==============
    //field('text', 'txt_trn_date', 'From Date :',NULL,array('attribute' => array('id' => 'txt_sta_date')));
    //field('text', 'txt_trn_date', 'To Date :',NULL,array('attribute' => array('id' => 'txt_end_date')));
   
echo close_form();

echo "<span id='tbl_trn_data'>"; //============Table contan view by ajax========
echo table_gl($query_all, $arr_select_field, FALSE, $total_debit, $total_credit);
echo '</span>';

echo "</div>";
?>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        
        //=============Date input type============
        jq( "input[name='txt_trn_date']" ).datepicker({ 
            defaultDate: '-0y',
            buttonText: "Choose",
            dateFormat: "yy-mm-dd" 
	});
        //===========Add style for input box in onc row
        jq('.search_tool_bar .control-group').attr('class',"control-group span2");
        
        ///==================Button Search action
        jq('#btn_search').click(function(){
            var cur = jq("#dro_cur");
            if(cur.val() !=""){
                var this_url = '<?php echo base_url()?>reports/searchCurrency';
                var form_data = {
                    currency : cur.val(),
                    txt_date:jq('#txt_date').val()
                    //sta_date: jq('#txt_sta_date').val(),
                    //end_date: jq('#txt_end_date').val()
                };
                jq.ajax({ 
                    url: this_url,
                    type: 'POST',
                    async : false,
                    data: form_data,
                    success: function(output_string){
                        jq("#tbl_trn_data").html(output_string);
                    }
                
                });
                
            }else{
                alert("Currecy is require!");
                cur.focus();
            }
            return false;
        });
    });
</script>