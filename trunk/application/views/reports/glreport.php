<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}
// Get Gl infimation
$list_gl = "";
$list_gl .= '<datalist id="gl_code">';
foreach ($gl_query->result() as $gl_rows) {
    $list_gl .='<option value="' . $gl_rows->gl_code . ':' . $gl_rows->gl_description . '">';
    // $list_gl .='<option value="'.$gl_rows->gl_code.'">'.$gl_rows->gl_description.'</option>'; 
}
$list_gl.= '</datalist>';


//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
//$arr_select_field = array(
//    'GL Code' => 'gl_code',
//    'GL Description' => 'gl_description',
//    'Trn Description' => 'tra_description',
//    'Trn Date' => 'tra_date',
//    'Currency' => 'cur_title',
//    'Debit' => 'tra_debit',
//    'Credit' => 'tra_credit',
//    'User' => 'use_name'
//);
//
//foreach ($total_dc->result() as $total_rows) {
//    $total_debit = $total_rows->total_debit;
//    $total_credit = $total_rows->total_credit;
//}



echo "<div class='tbl_trn'>";
echo form_open(NULL, array('name' => 'search_form', 'id' => 'search_form'));
echo "<div class='search_tool_bar row-fluid'>";
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
echo '<div id="txt_gl">';
field("text", "gl_code", "GL Code: ", NULL, array('attribute' => array('list' => "list_gl_code", 'id' => "gl_code", 'style' => "width:260px;"))
        , TRUE, '<datalist id="list_gl_code">' . $list_gl . '</datalist>');
echo '</div>';

field('text', 'txt_sta_date', 'From Date :', NULL, array('attribute' => array('id' => 'txt_sta_date')), TRUE);
field('text', 'txt_end_date', 'To Date :', NULL, array('attribute' => array('id' => 'txt_end_date')), TRUE);

field("submit", 'btn_search', '&nbsp;', 'Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));

//echo "</div>";
//======== More search option==============
//field('text', 'txt_trn_date', 'From Date :',NULL,array('attribute' => array('id' => 'txt_sta_date')));
//field('text', 'txt_trn_date', 'To Date :',NULL,array('attribute' => array('id' => 'txt_end_date')));

echo close_form();

echo "<span id='tbl_trn_data'>"; //============Table contan view by ajax========
//echo table_gl($query_all, $arr_select_field, FALSE, $total_debit, $total_credit);
echo '<h5>Please select currecy and GL code you want to view a report..!</h5>';
echo '</span>';

echo "</div>";
?>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        
        //=============Date input type============
        jq( "input[name='txt_sta_date']" ).datepicker({ 
            defaultDate: '-0y',
            buttonText: "Choose",
            dateFormat: "yy-mm-dd" 
        });
        jq( "input[name='txt_end_date']" ).datepicker({ 
            defaultDate: '-0y',
            buttonText: "Choose",
            dateFormat: "yy-mm-dd" 
        });
        //===========Add style for input box in onc row
        jq('.search_tool_bar .control-group').attr('class',"control-group span2");
        
        ///==================Button Search action
        jq('form#search_form').on('submit',function(){
            //jq('form#search_form').on('submit',true);
            //jq('form#search_form').submit();
            //
            var sta_date = jq('#txt_sta_date').val();
            var end_date = jq('#txt_end_date').val();

            
            var arr_gl_val =jq('#gl_code').val().split(':');
 
            //            alert(jq('#dro_cur').val());
            //            alert(jq('#txt_sta_date').val());
            //            alert(jq('#txt_end_date').val());
            //            return;
            var cur = jq("#dro_cur");
            if(sta_date <= end_date){
                var this_url = '<?php echo base_url() ?>reports/searchGL';
                var form_data = {
                    currency : cur.val(),
                    sta_date: jq('#txt_sta_date').val(),
                    end_date: jq('#txt_end_date').val(),
                    txt_gl:arr_gl_val[0],
                    txt_gldes:arr_gl_val[1]
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
                alert("Bad date input..!");
                jq('#txt_sta_date').focus();
            }
            
            return false;
        });
        
    });
</script>