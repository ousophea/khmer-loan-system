<?php
//Get currency list
$array_currency = array();
foreach ($currency_query->result() as $currency_rows) {
    $array_currency[""] = '-----Select-----';
    $array_currency[$currency_rows->cur_id] = $currency_rows->cur_title;
}

//echo control_manager();
//if ($this->session->flashdata('success'))
//    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
//if ($this->session->flashdata('error'))
//    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';


echo "<div class='tbl_trn'>";
echo form_open('reports/collection', 'id="search_collection"');
echo "<div class='search_tool_bar row-fluid'>";
//echo form_dropdown('currency', $array_currency, set_value('currency', $this->session->userdata('currency')), 'id="dro_cur');
field('select', 'currency', 'Currency :', $this->session->userdata('currency'), array('options' => $array_currency, 'attribute' => array('id' => 'dro_cur')), TRUE);
?>
<?php
field('text', 'txt_dis_sdate', 'Start Date :', set_value('txt_dis_sdate'), array('attribute' => array('id' => 'txt_dis_sdate', 'class' => 'pick_date')), TRUE);
field('text', 'txt_dis_edate', 'End Date :', set_value('txt_dis_edate'), array('attribute' => array('id' => 'txt_dis_edate', 'class' => 'pick_date')), true);

//field("button", 'btn_search', '&nbsp;', '<i class="icon-search"></i> Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_search')));
field("submit", 'btn_searchds', '&nbsp;', 'Search', array('attribute' => array('class' => 'btn', 'id' => 'btn_searchs')));
echo close_form();

//echo "<span id='tbl_trn_data'></span>";
//echo "</div>";
?>
<!--<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>-->
<table class="table table-bordered">
    <tr>
        <th colspan="10">Loan Collection Report By Credit Officer Name<br />
            <?php
               echo "Currency: " . $array_currency[$this->session->userdata('currency')] . "<br />";
            echo "From: " . date("d-M-Y", strtotime($setStart)) . " To " . date("d-M-Y", strtotime($setEnd));
            ?>
        </th>
    </tr>
    <tr >
        <th  rowspan="2">Co Name</th>
        <th colspan="4" > Principal Collection</th>
        <th colspan="4" > Interest Collection</th>
        <th rowspan="2">Penalty</th>
    </tr>
    <tr>
        <th>Overdue</th>
        <th>Current</th>
        <th >Prepaid</th>
        <th>Total Principal </th>
        <th>Overdue</th>
        <th>Current</th>
        <th>Prepaid</th>
        <th>Total Interest</th>
    </tr>

    <?php
    if ($data == true) {
        $i = $lateRepay = $totalPriciple = $totalForward = $totalPri = $lateRate = $sumPriciple = $paidRate = $forwardRate = $totalRate = 0;
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {
                $sumPriciple = 0;
                //            ====Calculate for total view=============
                $i++;
                $lateRepay += $row['lateRepay'];
                $totalPriciple += $row['totalPriciple'];
                $totalForward += $row['totalForward'];
                $sumPriciple = $row['lateRepay'] + $row['totalPriciple'] + $row['totalForward'];
                $totalPri += $sumPriciple;
                $lateRate += $row['lateRate'];
                $paidRate += $row['paidRate'];
                $forwardRate += $row['forwardRate'];
                $sumRate = $row['lateRate'] + $row['paidRate'] + $row['forwardRate'];
                $totalRate += $sumRate;
//            ====================================
                ?>
                <tr>
                    <td><?php echo $row['coname']; ?></td>
                    <td><?php echo formatMoney($row['lateRepay'], TRUE); ?></td>
                    <td><?php echo formatMoney($row['totalPriciple'], true); ?></td>
                    <td><?php echo formatMoney($row['totalForward'], true); ?></td>
                    <td><?php echo formatMoney($sumPriciple, true); ?></td>
                    <td><?php echo formatMoney($row['lateRate'], true); ?></td>
                    <td><?php echo formatMoney($row['paidRate'], true); ?></td>
                    <td><?php echo formatMoney($row['forwardRate'], true); ?></td>
                    <td><?php echo formatMoney($sumRate, true); ?></td>
                    <td>0</td>
                </tr>

            <?php } ?>
            <tr class="total">
                <td>Total: </td>
                <td><?php echo formatMoney($lateRepay, TRUE); ?></td>
                <td><?php echo formatMoney($totalPriciple, TRUE); ?></td>
                <td><?php echo formatMoney($totalForward, TRUE); ?></td>
                <td><?php echo formatMoney($totalPri, TRUE); ?></td>
                <td><?php echo formatMoney($lateRate, TRUE); ?></td>
                <td><?php echo formatMoney($paidRate, TRUE); ?></td>
                <td><?php echo formatMoney($forwardRate, TRUE) ?></td>
                <td><?php echo formatMoney($totalRate, TRUE); ?></td>
                <td>0</td>
                </srong>
            </tr>
            <?php
        }else {
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
            jq('#search_collection').submit();
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