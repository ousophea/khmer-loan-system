<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//echo control_manager();
//if ($this->session->flashdata('success'))
//    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
//if ($this->session->flashdata('error'))
//    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';


echo "<div class='tbl_trn'>";
echo form_open('trn_search', 'search_trn', 'journals/add');
echo "<div class='search_tool_bar row-fluid'>";
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
field('text', 'txt_dis_date', 'Start Date :', NULL, array('attribute' => array('id' => 'sta_date')));
field('text', 'txt_dis_date', 'End Date :', NULL, array('attribute' => array('id' => 'end_date')));
field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));

echo close_form();
echo "<p class='text-center'>Loan Disbursment Report By Size By Credit Officer Name</p>";
echo "<span id='tbl_trn_data'></span>";
echo "</div>";
?>

<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function () {
        setDate('txt_dis_date');
        //todo retrieve data after reload
        setData();

        jq('.search_tool_bar .control-group').attr('class', "control-group span2");

        jq('#btn_search').click(function () {
            get_disbursment();
        });

        function get_disbursment() {
            var cur = jq("#dro_cur");
            if (cur.val() != "") {
                setData();
            } else {
                alert("Currecy is require!");
                cur.focus();
            }
            return false;
        }
        function setData() {
            var url = '<?php echo site_url('reports/ajax_get_disbursment') ?>';
            var dataString = {
                "currency": jq("#dro_cur").val(), 
                sta_date: jq('#sta_date').val(),
                end_date:jq('#end_date').val()
            };
            var ele = "#tbl_trn_data";
            getData(url, dataString, ele);
        }
    });
</script>