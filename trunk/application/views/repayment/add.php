<?php

if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';

$list_acc_number = "";
$list_acc_number .= '<datalist id="gl_code">';
foreach ($acc_num_query->result() as $acc_num_rows) {

    $list_acc_number .='<option value="' . $acc_num_rows->loa_acc_code . '">';
}
$list_acc_number.= '</datalist>';
?>

<?php

echo'<div id="disbursment_form" class="single_large">';
start_form_model(1);


open_form('dis_acc_info', 'Principal Owner Information', "disbursments/search_acc_num");


field("text", "account_number", "Accoundt Number: ", NULL, array('attribute' => array('list' => "list_account_number", 'class' => 'numeric', 'id' => "account_number", 'style' => "width:124px;"))
        , TRUE, '<datalist id="list_account_number">' . $list_acc_number . '</datalist>
<a class="btn account_number btn_search_gl gl_code" style=" padding: 4px 8px;"  id="search_customer_by_code" href="#"><i class="icon-search loader"></i> Search</a>');
echo '<span id="account_number_des"></span>'; ///=========View Saving account information ===============//


field("text", "firstrepayment_date", "First Repayment:", NULL, array('attribute' => array('class' => 'txtdate')), TRUE);

field("text", "num_installments", "Num Installments:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
field("text", "lead_interest", "Lead interest:", NULL, array('attribute' => array('disabled' => 'disabled')));
field("text", "principal_start", "Principal Start:", NULL, array('attribute' => array('disabled' => 'disabled')));
field("text", "principal_frequency", "Principal Frequency:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
field("text", "interest_rate", "Interest Rate:", NULL, array('attribute' => array('class' => "numeric")), TRUE);
field("text", "ins_amount", "Installment Amount:", NULL, array('attribute' => array('class' => "numeric")), TRUE);

echo form_submit(array('name' => 'Save', 'class' => 'btn btn-success'), 'Confirm');
echo anchor('loan/lists', 'Cancel', 'class="btn"');
echo '</div></div>';

close_form();

//echo"</div>"; // close form disburement

close_form_model();
echo"</div>";
?>
