<?php
//Get currency list
$array_currency = array();
$array_currency[''] = '-----Select-----';
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}
// Get Gl infimation
$array_gl = array('' => '-----Select-----');
foreach ($gl_query->result() as $gl_rows) {
//    $gl_code = $gl_rows->gl_code;
     $gl_code ="";
    $gl_desc = $gl_rows->gl_kh_description;
//    $txt = "{$gl_code}:{$gl_desc}";
    $txt = $gl_desc;
    $array_gl[$txt] = $txt;
}


//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';

echo "<div class='tbl_trn'>";
echo form_open(NULL, array('name' => 'search_form', 'id' => 'search_form'));
echo "<div class='search_tool_bar row-fluid'>";
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
field('select', 'gl_code', 'GL Code :', '1', array('options' => $array_gl, 'attribute' => array('id' => 'gl_code', 'class' => 'chosen', 'style' => '200px !important;')), TRUE);
field('text', 'txt_sta_date', 'From Date :', NULL, array('attribute' => array('id' => 'txt_sta_date','class'=>'pick_date')), TRUE);
field('text', 'txt_end_date', 'To Date :', NULL, array('attribute' => array('id' => 'txt_end_date','class'=>'pick_date')), TRUE);
field("submit", 'btn_search', '&nbsp;', 'Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));
echo '</div>';
echo close_form();
echo "<span id='tbl_trn_data'></span>";
echo "</div>";
?>
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function () {
        jq('.pick_date').datepicker({
            format: "yyyy/mm/dd"
        });
        var incr = 0;
        jq('.search_tool_bar .control-group').each(function () {
            var th = jq(this);
            if (incr == 1) {
                th.addClass('span4');
            } else {
                th.addClass('span2');
            }
            incr++;
        });

        jq('form#search_form').on('submit', function () {
            var sta_date = jq('#txt_sta_date').val();
            var end_date = jq('#txt_end_date').val();
            var cur = jq("#dro_cur");
            if (sta_date <= end_date) {
                setData();
            } else {
                alert("Bad date input..!");
                jq('#txt_sta_date').focus();
            }

            return false;
        });

        function setData() {
            var url = '<?php echo site_url('reports/ajax_gl'); ?>';
            var arr_gl_val = jq('#gl_code').val().split(':');
            var form_data = {
                currency: jq("#dro_cur").val(),
                sta_date: jq('#txt_sta_date').val(),
                end_date: jq('#txt_end_date').val(),
                txt_gl: arr_gl_val[0],
                txt_gldes: arr_gl_val[1]
            };
            var ele = "#tbl_trn_data";
            getData(url, form_data, ele);
        }
    });
</script>