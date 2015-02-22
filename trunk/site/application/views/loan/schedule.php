<?php
$saving_total = NULL;
$rate_total = NULL;
if ($sum_result_query->num_rows() > 0) {
    foreach ($sum_result_query->result() as $row_sum_result) {
        $rate_total = $row_sum_result->rate_total;
        $saving_total = $row_sum_result->sav_total;
        $principle_total = $row_sum_result->total_principle_amount_repayment;
        $repayment_total = $row_sum_result->total_repayment;
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($title)) ? $title . ' : Khmer Loan System' : 'Khmer Loan System' ?></title>
        <style type="text/css">
            @font-face {
                font-family: kmSBBICsys;
                src: url(<?php echo site_url(FONT_PATH . 'kmSBBICsys.ttf'); ?>);
            }
        </style>
        <link rel="shortcut icon" href="<?php echo site_url(IMAGES_PATH . 'favicon.ico') ?>"></link>
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'style.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'main-style.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'menu.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'saving.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'jquery-ui.css'); ?>" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'users.css'); ?>" rel="stylesheet" media="screen">

        <!--<script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'jquery-2.0.0.min.js'); ?>" ></script>-->
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery-1.8.3.min.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery-ui.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap.min.js'); ?>" ></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-button.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-dropdown.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-typeahead.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form_model.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jq_action_manager.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery.PrintArea.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form_model.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jq_action_manager.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'input_number_only.js'); ?>"></script>  <!--number only plugin-->

        <!--=============== For printing==============-->
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'style.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'main-style.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'menu.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'saving.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'jquery-ui.css'); ?>" rel="stylesheet" type="text/css" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'bootstrap.min.css'); ?>" rel="stylesheet" media="print">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'users.css'); ?>" rel="stylesheet" media="print">

    </head>

    <body>
        <div class="print_preview_menu">
            <div class="tools">
                <a class="btn btn-mini " href="<?php echo base_url() . 'loan/voucher'; ?>" title="Loan disbusement voucher"><i class="icon-book icon-white"></i> Voucher</a>
                <a  disabled="disabled"  class="btn btn-mini btn-success" href="#" title="View loan account"><i class="icon-calendar"></i> Repayment Schedule</a>
                <a class="btn btn-mini btn_print" href="#" title="Edit loan account"><i class="icon-print"></i> Print</a>
                <a class="btn" href="<?php echo base_url() . 'loan/open'; ?>" style="float: right;" title="Edit loan account"><i class="icon-chevron-left"></i> Back</a>
            </div>
        </div>
        <div class="print_preview">
            <?php
            if ($loan_info->num_rows() > 0) {
                foreach ($loan_info->result() as $row) {
                    ?>
                    <div class="vouchers">
                        <div class="voucher_header">
                            <div class="voucher_logo form-horizontal">
                                <?php
                                acc_info('<img title="Riel Micro Finance" class="logo" src="' . base_url() . IMAGES_PATH . 'logo.png" alt="Logo">', 'logo_name', '<img title="Riel Micro Finance" class="logo" src="' . base_url() . IMAGES_PATH . 'logo_name.png" alt="Logo">'
                                );
                                ?>
                            </div>

                        </div>
                        <div class="voucher_content">
                            <div class="sub_title">
                                <h3>តារាងកាលវិភាគសង់ប្រាក់ និង ដាក់ប្រាក់សន្សំ</h3>

                            </div>
                            <div class="loan_info">

                                <?php
                                echo open_span(5);
                                echo '<div class="form-horizontal">';

                                acc_info('អតិថិជនឈ្មោះ:', '', $row->con_kh_first_name . " " . $row->con_kh_last_name);
                                acc_info('លេខគណនីឥណទាន:', '', $row->loa_acc_code);
                                acc_info('ចំនួនប្រាក់កំចី:', '', formatMoney($row->loa_acc_amount, TRUE) . " " . $row->cur_title);
                                echo '<span id="field_interest">';
                                acc_info('អត្រាការប្រាក់ប្រចាំ' . $row->rep_fre_type_kh . ':', "", formatMoney($row->loa_ins_interest_rate, TRUE) . "%");
                                echo '</span>';
                                acc_info('រយះពេលខ្ចី:', '', $row->loa_ins_num_ins . " " . $row->rep_fre_type_kh);
                                acc_info('ថ្ងៃចេញទុន(ថ្ងៃខែឆ្នាំ):', '', $row->loa_acc_disbustment);
//                                acc_info('អាស័យដ្ឋាន:', '', $con_info['con_address']);
                                echo '<span class="sign">';
                                acc_info('អាស័យដ្ដាន', '', $con_info['con_address']);
                                echo '</span>';
                                echo '</div>';
                                echo close_span();

                                echo open_span(5);
                                echo '<div class="form-horizontal">';
                                acc_info('លេខគណនីសន្សំ:', '');
                                echo '<div class="sub_title_contant">ពត៍មានសង្ខេបពីប្រាក់កំចី</div>';
                                echo '<span id="field_total_interest">';
                                acc_info('ការប្រាក់សរុប:', '', $rate_total);
                                echo '</span>';
                                acc_info('សរុបការប្រាក់់ និង ប្រាក់ដើម:', '', $row->loa_acc_amount + $rate_total);
                                acc_info('សរុបប្រាក់សន្សំ:', '', $saving_total);
                                echo '<div class="schedule_fotter">
                    <div>ហត្ថលេខាអ្នករៀបចំ</div>
                    <div>ស្នាមមេដៃអតិថិជន</div>
                </div>';

                                echo '</div>';
                                echo close_span();
                                echo '</div> <br />';
                                ?>
                            </div>
                            <div class="schedule_table">
                                <?php
                                $arr_field_sch_table = array(
                                    'ល.រ' => 'rep_sch_num',
                                    'ថ្ចៃសងប្រាក់' => 'rep_sch_date_repay', // Due date
                                    'សមតុល្យដើមគ្រា' => 'rep_sch_balance', //Outstanding
                                    'ប្រាក់ដើម' => 'rep_sch_principle_amount_repayment', // Principal
                                    'សរុបប្រាក់ត្រូវបង់' => 'rep_sch_total_repayment',
                                    'ការប្រាក់' => 'rep_sch_rate_repayment', //Interest
                                    'ប្រាក់សន្សំ' => 'rep_sch_saving', //Outstanding
//                                    'Instalment' => 'rep_sch_instalment'
                                );


                                echo "<span id='rep_tbl'></span>";
                                echo table_manager($repayment_sch, $arr_field_sch_table, FALSE, 3, array($principle_total, $repayment_total, $rate_total, $saving_total));
                                ?>
                            </div>
                            <p><span style="text-decoration: underline">បញ្ជាក់ៈ</span> ថ្ងៃធ្វើការ ចាប់ពីថ្ងៃសុក្រ ពីម៉ោង ៧:៣០ ដល់ម៉ោង ២:០០</p>
                        </div>

                    </div>

                    <?php
                }
            }
            ?>

        </div>
        <div class="print_preview_menu">
            <div class="tools">
                <a class="btn btn-mini " href="<?php echo base_url() . 'loan/voucher'; ?>" title="Loan disbusement voucher"><i class="icon-book icon-white"></i> Voucher</a>
                <a  disabled="disabled"  class="btn btn-mini btn-success" href="#" title="View loan account"><i class="icon-calendar"></i> Repayment Schedule</a>
                <a class="btn btn-mini btn_print" href="#" title="Edit loan account"><i class="icon-print"></i> Print</a>
                <a class="btn" href="<?php echo base_url() . 'loan/open'; ?>" style="float: right;" title="Edit loan account"><i class="icon-chevron-left"></i> Back</a>
            </div>
        </div>
        <script>

            jQuery.noConflict();
            (function($) {
             
             
                $(function() {
               
                    $('.btn_print').click(function(){
                        $('.print_preview_menu').hide();
                        $('#field_interest').hide();
                        $('#field_total_interest').hide();
                        window.print();
                        $('.print_preview_menu').show();
                        $('#field_interest').show();
                        $('#field_total_interest').show();

                    });

                
                });
            
        
            })(jQuery);
        
        
        </script>
    </body>
</html>