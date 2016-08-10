<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[""] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}
echo "<div class='tbl_trn'>";
echo form_open('reports/disbursment', 'id="search_dis"');
echo "<div class='search_tool_bar row-fluid'>";
field('select', 'currency', 'Currency :', $this->session->userdata('currency'), array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
?>
<?php
field('text', 'txt_dis_sdate', 'Start Date :', set_value('txt_dis_sdate'), array('attribute' => array('id' => 'txt_dis_sdate', 'class' => 'pick_date')), true);
field('text', 'txt_dis_edate', 'End Date :', set_value('txt_dis_edate'), array('attribute' => array('id' => 'txt_dis_edate', 'class' => 'pick_date')), true);
field("submit", 'btn_searchds', '&nbsp;', 'Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_searchs')));
//field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));

echo close_form();

//echo "<span id='tbl_trn_data'></span>";
//echo "</div>";
?>
<span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
</span>
<table class="table table-bordered">
    <tr>
        <th colspan="14">Loan Disbursment Report By Size By Credit Officer Name<br />
            <?php
            echo "Currency: " . $array_currency[$this->session->userdata('currency')] . "<br />";

            echo "From: " . date("d-M-Y", strtotime($setStart)) . " To " . date("d-M-Y", strtotime($setEnd));
            ?>
        </th>
    </tr>
    <tr>
        <th rowspan="2">CO Code</th>
        <th rowspan="2">CO Name</th>
        <th colspan="2">Micro <br>0 --> 500,000 RIEL
        <th colspan="2">Small <br>500,100 --> 700,000 RIEL</th>
        <th colspan="2">Medium <br>700,100 --> 1,000,000 RIEL</th>
        <th colspan="2">Large<br>1,000,100 --> 2,000,000 RIEL</th>
        <th colspan="2">Largest<br>GREATER 2000,000 RIEL</th>
        <th colspan="2">Total</th>
    </tr>
    <tr>
        <th>#</th>
        <th>Amount</th>
        <th>#</th>
        <th>Amount</th>
        <th>#</th>
        <th>Amount</th>
        <th>#</th>
        <th>Amount</th>
        <th>#</th>
        <th>Amount</th>
        <th>#</th>
        <th>Amount</th>
    </tr>

    <?php
    if ($data == TRUE) {
        $i = $count_Micro = $count_Small = $count_Medium = $count_Large = $count_Largest = $countTotal = 0;
        $total_Micro = $total_Small = $total_Medium = $total_Large = $total_Largest = $sumTotal = 0;
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {
//            ====Calculate for total view=============
                $i++;
                $count_Micro += $row['countMicro'];
                $total_Micro += $row['sumMicro'];
                $count_Small += $row['countSmall'];
                $total_Small += $row['sumSmall'];
                $count_Medium += $row['countMedium'];
                $total_Medium += $row['sumMedium'];
                $count_Large += $row['countLarge'];
                $total_Large += $row['sumLarge'];
                $count_Largest += $row['countLargest'];
                $total_Largest += $row['sumLargest'];
                $countTotal += $row['countTotal'];
                $sumTotal += $row['total'];



//            ====================================
                ?>
                <tr>
                    <td><?php echo $row['co_card_id']; ?></td>
                    <td><?php echo $row['co_name']; ?></td>
                    <td><?php echo$row['countMicro']; ?></td>
                    <td><?php echo formatMoney($row['sumMicro'], true); ?></td>
                    <td><?php echo $row['countSmall']; ?></td>
                    <td><?php echo formatMoney($row['sumSmall'], TRUE); ?></td>
                    <td><?php echo $row['countMedium']; ?></td>
                    <td><?php echo formatMoney($row['sumMedium'], TRUE); ?></td>
                    <td><?php echo $row['countLarge']; ?></td>
                    <td><?php echo formatMoney($row['sumLarge'], TRUE); ?></td>
                    <td><?php echo $row['countLargest']; ?></td>
                    <td><?php echo formatMoney($row['sumLargest'], TRUE); ?></td>
                    <td><?php echo $row['countTotal']; ?></td>
                    <td><?php echo formatMoney($row['total'], TRUE); ?></td>
                </tr>

            <?php } ?>
            <tr class="total">
                <td>Total: </td>
                <td><?php echo $i ?></td>
                <td><?php echo $count_Micro; ?></td>
                <td><?php echo formatMoney($total_Micro, true); ?></td>
                <td><?php echo $count_Small; ?></td>
                <td><?php echo formatMoney($total_Small, TRUE); ?></td>
                <td><?php echo $count_Medium; ?></td>
                <td><?php echo formatMoney($total_Medium, TRUE); ?></td>
                <td><?php echo $count_Large; ?></td>
                <td><?php echo formatMoney($total_Large, TRUE); ?></td>
                <td><?php echo $count_Largest; ?></td>
                <td><?php echo formatMoney($total_Largest, TRUE); ?></td>
                <td><?php echo $countTotal; ?></td>
                <td><?php echo formatMoney($sumTotal, TRUE); ?></td>
            </tr>
            <?php
        } else {
            echo '   <tr><td colspan="14" class="text-warning" style="text-align: left  !important;">No record found...!</td></tr>';
        }
    } else {
        ?>
    <tr><td colspan="14" class="text-warning" style="text-align: left  !important;">No record found...!</td></tr>
    <?php } ?>
</tbody>
</table>
<!--========For good view==========-->
</div>
<!--============================-->
<script type="text/javascript" language="JavaScript">
    var jq = jQuery.noConflict();
    jq(document).ready(function () {
        jq('.pick_date').datepicker({
            format: "yyyy/mm/dd"
        });
//        setDate('.date');
//        setDate('date');
        //todo retrieve data after reload
//        setData();

        jq('.search_tool_bar .control-group').attr('class', "control-group span2");
//
        jq('#btn_search').click(function () {
//            alert("Hello");
            jq('#search_dis').submit();
        });
//        jq("#btn_save").on('click', function () {
//            alert ("Hello");
//            jq('#disburs_search').submit();
//        });

//        function get_disbursment() {
//            var cur = jq("#dro_cur");
//            if (cur.val() != "") {
//                setData();
//            } else {
//                alert("Currecy is require!");
//                cur.focus();
//            }
//            return false;
//        }
        function setData() {
            var url = '<?php echo site_url('reports/ajax_get_disbursment') ?>';
            var dataString = {
                "currency": jq("#dro_cur").val(),
                sta_date: jq('#txt_dis_sdate').val(),
                end_date: jq('#txt_dis_edate').val()
            };
            var ele = "#tbl_trn_data";
            getData(url, dataString, ele);
        }
    });
</script>