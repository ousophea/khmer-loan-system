<!-- Author: Vannak -->
<?php
//echo form_open('', array('name' => 'frm_contact', 'id' => 'frm_contact'));
//echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
$arr_select_field = array(
    'Card ID' => 'con_cid',
    'EN Name' => 'en_name',
    'Kh Name' => 'kh_name',
    'Address' => 'con_det_address_detail',
    'Loan Size' => 'con_job_title',
    'Repayment Date' => 'rep_sch_date_repay',
    'Weed' => 'con_det_address_detail',
      'Principle' => 'con_det_address_detail',
      'Amount to be received' => 'con_det_address_detail',
      'Comment' => 'con_det_address_detail'
);
echo table_manager($query_all, $arr_select_field, FALSE,null,null,TRUE);
//echo form_close();
?>