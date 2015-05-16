
<?php
//echo form_open('', array('name' => 'frm_contact', 'id' => 'frm_contact'));
//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error')) {
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
}


//$datestring = "%Y-%m-%d - %h:%i %a";
//$time = time();
// Get CO infimation
//$array_co = array('' => '-----Select-----');
//foreach ($co_list->result() as $row) {
//    $co_id = $row->co_id;
//    $co_name = $row->co_name;
//    $txt = "{$co_name}";
//    $array_co[$txt] = $txt;
//}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($title)) ? $title . ' : Khmer Loan System' : 'Khmer Loan System' ?></title>
 <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'bootstrap.min.css'); ?>" rel="stylesheet" media="print">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.print-card.js"></script>
        <!--=============== For printing==============-->
<!--        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'style.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'main-style.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'menu.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'saving.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'jquery-ui.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'bootstrap.min.css'); ?>" rel="stylesheet" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'users.css'); ?>" rel="stylesheet" media="print">-->
    </head>

    <body>

        <div class="filter">
            <form  role="form" method="post" action="<?php echo base_url(); ?>repayment/repayList">
                <div class="filter form-inline">
                    <div class="form-group">
                        <!--                <label class="sr-only" for="date_col">Date to be collected:</label>-->
                        <div class="form-group span3">
                            <select name="co_name" class="form-control" id="co_id">
                                <option value="">--All Credit officer--</option>
                                <?php
                                var_dump($co_list);

                                foreach ($co_list as $key => $value) {
                                    echo '<option value="' . $key . '" ' . set_select('co_name', $key) . '>' . $value . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group span3">
                            <input type="text" class=" input-sm form-control input-sm datepicker input-4" data-provide ="datepicker" id="date_col" name="date" value="" placeholder="Collection Date">
                        </div>
                        <div class="form-group span3">
                            <button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
                        </div>
                    </div>
                    <!--<a href="" onclick="return false;" class="print btn btn-sm btn-success "><i class="glyphicon glyphicon-print"></i> Print </a>-->                  
                <a class="btn btn-mini btn_print" href="#" title="Edit loan account"><i class="icon-print"></i> Print</a>
                </div>

            </form>
            <br/><br/>
        </div>
        <div class="printable">
            <?php
///////// Table data
            $username = $this->session->userdata("use_name");
            echo'<div class="row-fluid">';
            echo '<div class="span4"> Name of CO: ' . $username . '</div>';
//echo '<div class="span6"> Date to be collected: ' . mdate($datestring, $time) . '</div>';
            echo '<div class="span6"> Date to be collected: ' . $this->session->userdata('col_date') . '</div>';
            echo "</div>";
            ?>
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Repay Date</th>
                    <th>Card ID </th>
                    <th>Kh Name</th>
                    <th>EN Name</th>
                    <th>Address</th>
                    <th>CO Name</th>
                    <th>Loan Size</th>
                    <th>Principle</th>
                    <th>Amount to be received</th>
                    <th>Status</th>
                    <th>Comment</th>
                </tr>
                <?php
                if ($query_all->num_rows() > 0) {
                    $total = 0;
                    ?>

                    <?php
                    foreach ($query_all->result_array() as $row) {
                        $total += $row['rep_sch_total_repayment'];
                        ?>

                        <tr>
                            <td><?php echo $row['rep_sch_date_repay']; ?></td>
                            <td><?php echo $row['con_cid']; ?></td>
                            <td><?php echo $row['kh_name']; ?></td>
                            <td><?php echo $row['en_name']; ?></td>
                            <td><?php echo $row['con_det_address_detail'] ?></td>
                            <td><?php echo $row['co_name'] ?></td>
                            <td><?php echo formatMoney($row['loa_acc_amount'], TRUE) ?></td>
                            <td><?php echo formatMoney($row['rep_sch_total_repayment'], TRUE) ?></td>
                            <td><?php echo formatMoney($row['rep_sch_total_repayment'], TRUE) ?></td>
                            <td><?php echo $row['rep_sta_name']; ?></td>
                            <td><?php echo $row['rep_sch_description'] ?></td>
                        </tr>

                    <?php } ?>
                    <tr class="text-info">
                        <td colspan="6">&nbsp;</td><td>Total:</td>
                        <td><?php echo formatMoney($total, TRUE) ?></td>  
                        <td colspan="3">&nbsp;</td>
                    </tr>

                <?php } else { ?>
                    <tr><td colspan="10">Empty</td></tr>
                <?php } ?>
            </table>
        </div>
<!--    </body>
</html>-->
    <script type="text/javascript">
        var js = jQuery.noConflict();
        js(document).ready(function () {
            js('.datepicker').datepicker({
            });

            js(".btn_print").attr("href", "javascript:void( 0 )").click(function () {

                js(".printable").print();
                return(false);
            });


        });
    </script>