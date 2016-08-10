<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[''] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}
echo "<div class='tbl_trn'>";
echo form_open('trn_search', 'search_trn', 'journals/add');
echo "<div class='search_tool_bar row-fluid'>";
echo "<div class='span2'>";
field('select', 'currency', 'Currency :', '1', array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
echo "</div>";
echo "<div class='span2'>";
field('text', 'txt_trn_sdate', 'Start Date :', NULL, array('attribute' => array('id' => 'txt_sdate', 'class' => 'pick_date')), true);
echo "</div>";
echo "<div class='span2'>";
field('text', 'txt_trn_edate', 'Ent Date :', NULL, array('attribute' => array('id' => 'txt_edate', 'class' => 'pick_date')), true);
echo "</div>";
echo "<div class='span2'>";
field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));
echo "</div>";
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
        jq('#btn_search').click(function () {
            get_transaction();
        });

        function get_transaction() {
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
            var url = '<?php echo site_url('reports/ajax_transaction') ?>';
            var dataString = {"currency": jq("#dro_cur").val(), txt_sdate: jq('#txt_sdate').val(),txt_edate: jq('#txt_edate').val()};
            var ele = "#tbl_trn_data";
            getData(url, dataString, ele);
        }
    });
</script>