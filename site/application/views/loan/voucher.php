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
                <a disabled="disabled" class="btn btn-mini btn-success" href="#" title="Loan disbusement voucher"><i class="icon-book icon-white"></i> Voucher</a>
                <a class="btn btn-mini" href="<?php echo base_url() . 'loan/schedule'; ?>" title="View loan account"><i class="icon-calendar"></i> Repayment Schedule</a>
                <!--<a class="btn btn-mini btn_print" href="<?php // echo base_url() . 'loan/schedule';  ?>" title="Edit loan account"><i class="icon-print"></i> Print</a>-->
                <a class="btn btn-mini btn_print" href="#" title="Edit loan account"><i class="icon-print"></i> Print</a>
                <a class="btn" href="<?php echo base_url() . 'loan/open'; ?>" style="float: right;" title="Edit loan account"><i class="icon-chevron-left"></i> Back</a>
            </div>
        </div>
        <div id="print_preview">
            <?php
            if ($loan_info->num_rows() > 0) {
                foreach ($loan_info->result() as $row) {

                    for ($i = 1; $i < 3; $i++) {
                        ?>
                        <div class="vouchers">
                            <div class="voucher_header">
                                <div class="voucher_logo form-horizontal">
                                    <?php
                                    acc_info('<img title="Riel Micro Finance" class="logo_to_print" src="' . base_url() . IMAGES_PATH . 'logo.png" alt="Logo">', 'logo_name', '<br /><img title="Riel Micro Finance" class="logo_name" src="' . base_url() . IMAGES_PATH . 'logo_name.png" alt="Logo">' );
                                    ?>
                                </div>
                                <div class="voucher_top_info"><div class="form-horizontal">
                                        <?php
                                        acc_info('ទំរង់លេខ:', 'voucher_id');
                                        acc_info('អតិថិជនលេខ:', 'con_number', $row->con_cid);
                                        acc_info('Loan Account:', 'voucher_id', $row->loa_acc_code);
                                        echo '<span class="info_bottom">';
                                        acc_info('', '', "Admin Copy");
                                        acc_info('', 'vouchering_date', date("d-M-Y / h:i", now()));
                                        echo '</span>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="voucher_content">
                                <div class="sub_title">
                                    <!--       <h3>សក្ខីប័ត្របញ្ចេញឥណទាន</h3>
                                               <h3>LOAN DISBURSEMENT VOUCHER</h3>-->
                                    <?php
                                    echo '<img title="Riel Micro Finance" src="' . base_url() . IMAGES_PATH . 'subtitle.png" alt="Logo">';
                                    ?>
                                </div>
                                <div class="loan_info">
                                    <?php
                                    echo open_span(5);
                                    echo '<div class="form-horizontal">';

                                    acc_info('ទីកន្លែងផ្តល់ប្រាក់/ Disbur. Location', '', "ភ្នំពេញ");
                                    acc_info('កិច្ចសន្យាលេខ/ Contract No', '', "");
                                    acc_info('ថ្អៃចេញទុន/ Disbursement Date', 'sdfsd', $row->loa_acc_disbustment);
                                    acc_info('អ្នកផ្តល់ប្រាក់/ Payer', '', $row->co_name);
                                    echo '<span class="sign sign_small">';
                                    acc_info('ហត្ថលេខា/ Signature', '');
                                    echo '</span>';
//                                    acc_info('លេខកូដគណនី/ GL Code', '', $row->loa_acc_gl_code);
//                                    acc_info('លេខគណនីអតិថិជនៈ/ Customer Code', '', $row->loa_acc_code);
                                    acc_info('ចំនូនទឹកប្រាក់បានទទួល/ Amount receiverd', "", formatMoney($row->loa_acc_amount, TRUE) . " " . $row->cur_title);
                                    acc_info('ជាអក្សរ/ In word', "", $row->loa_acc_amount_in_word);
                                    echo '</div>';
                                    echo close_span();

                                    echo open_span(5);
                                    echo '<div class="form-horizontal">';
                                    acc_info('អតិថិជនឈ្មោះ/ Customer Name', '', $row->con_kh_first_name . " " . $row->con_kh_last_name);
                                    acc_info('ភេទ/ Gender', '', ($row->con_sex == 'm') ? 'ប្រុស' : 'ស្រី');
                                    echo '<span class="sign">';
                                    acc_info('អាស័យដ្ឋាន/ Address', '', $con_info['con_address']);
                                    echo '</span>';
                                    echo '<span class="big_heigt">';
                                    acc_info('ស្នាមមេដៃអ្នកទទួល/ Fingerprint', '');
                                    echo '</span>';
                                    echo '</div>';
                                    echo close_span();
                                    echo '</div>';
                                    echo'
                        <div  class="voucher_fotter">
                            <div>
                                <p>រៀបចំដោយៈ រដ្ឋបាលប្រចាំសាខា/ Admin</p>
                                <p class="fotter_date">កាលបរិចេ្ឆទ/ Date: ' . date("d-M-Y", now()) . '</p>

                            </div>
                            <div>
                                <p>ត្រួតពិនិត្យដោយៈ ហេរញ្ញិកប្រចាំសាខា/ Treasure</p>
                                <p class="fotter_date">កាលបរិចេ្ឆទ/ Date: ' . date("d-M-Y", now()) . '</p></div>
                            <div>
                                <p>អនុម័តដោយៈ នាយុកសាខា/ Branch Manager</p>
                                <p class="fotter_date">កាលបរិចេ្ឆទ/ Date: ' . date("d-M-Y", now()) . '</p></div>
                        </div>
                        ';
                                    ?>

                                </div>
                            </div>
                        </div>

                        <?php
                        if ($i == 1) {
                            echo '<hr />';
                        }
                    }
                }
            }
            ?>
        </div>


        <div class="print_preview_menu">
            <div class="tools">
                <a disabled="disabled" class="btn btn-mini btn-success" href="#" title="Loan disbusement voucher"><i class="icon-book icon-white"></i> Voucher</a>
                <a class="btn btn-mini" href="<?php echo base_url() . 'loan/schedule'; ?>" title="View loan account"><i class="icon-calendar"></i> Repayment Schedule</a>
                <a class="btn btn-mini btn_print" href="<?php echo base_url() . 'loan/schedule'; ?>" title="Edit loan account"><i class="icon-print"></i> Print</a>
                <a class="btn" href="<?php echo base_url() . 'loan/open'; ?>" style="float: right;" title="Edit loan account"><i class="icon-chevron-left"></i> Back</a>
            </div>
        </div>
        <script>

            jQuery.noConflict();
            (function ($) {


                $(function () {

                    $('.btn_print').click(function () {
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