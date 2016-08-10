<?php
//var_dump($query);
//
// $arr_field_sch_table = array(
//                                    'ល.រ' => 'rep_sch_num',
//                                    'ថ្ចៃសងប្រាក់' => 'rep_sch_date_repay', // Due date
//                                    'សមតុល្យដើមគ្រា' => 'rep_sch_balance', //Outstanding
//                                    'ប្រាក់ដើម' => 'rep_sch_principle_amount_repayment', // Principal
//                                    'សរុបប្រាក់ត្រូវបង់' => 'rep_sch_total_repayment',
//                                    'ការប្រាក់' => 'rep_sch_rate_repayment', //Interest
//                                    'ប្រាក់សន្សំ' => 'rep_sch_saving', //Outstanding
////                                    'Instalment' => 'rep_sch_instalment'
//                                );
     
//echo' <div class="print_preview_menu">
//            <div class="tools">
//                <a disabled="disabled" class="btn btn-mini btn-success" href="#" title="Loan disbusement voucher"><i class="icon-book icon-white"></i> Voucher</a>
//                <a class="btn btn-mini" href="'.base_url().'loan/schedule" title="View loan account"><i class="icon-calendar"></i> Repayment Schedule</a>
//                <a class="btn btn-mini btn_print" href="'.base_url() . 'loan/schedule" title="Edit loan account"><i class="icon-print"></i> Print</a>
//                <a class="btn" href="'.base_url() . 'loan/open" style="float: right;" title="Edit loan account"><i class="icon-chevron-left"></i> Back</a>
//            </div>
//        </div>';

echo' <div class="print_preview_menu">
            <div class="tools">
                <a class="btn btn-mini btn_print" href="'.base_url() . 'loan/schedule" title="Edit loan account"><i class="icon-print"></i> Print</a>
               </div>
        </div>';
echo "<span id='rep_tbl'></span>";
echo '<div class="content-list">';
echo table_manager($report_data_table, $arr_field_sch_table, FALSE);
echo '</div>';
?>

     <script>

            jQuery.noConflict();
            (function($) {
             
             
                $(function() {
               
                    $('.btn_print').click(function(){
                        $('.print_preview_menu').hide();
                        window.print();
                    });

                
                });
            
        
            })(jQuery);
        
        
        </script>