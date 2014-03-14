<!-- Author: Vannak -->
<?php
echo form_open('', array('name' => 'frm_contact', 'id' => 'frm_contact'));
echo control_manager();
if ($this->session->flashdata('success'))
    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
if ($this->session->flashdata('error'))
    echo '<div class="alert alert-fail">' . $this->session->flashdata('error') . '</div>';
$arr_select_field = array(
    'ID' => 'con_id',
    'Card ID' => 'con_cid',
    'EN First Name' => 'con_en_first_name',
    'EN Last Name' => 'con_en_last_name',
    'Kh First Name' => 'con_kh_first_name',
    'Kh Last Name' => 'con_kh_last_name',
    'Group Type' => 'con_typ_title',
    'Job' => 'con_job_title',
    'Address' => 'con_det_address_detail'
);
echo table_manager($query_all, $arr_select_field, TRUE);
echo form_close();
?>