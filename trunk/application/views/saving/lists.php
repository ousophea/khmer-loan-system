<?php
    echo form_open('saving/delete',array('name'=>'form_action'));
    if($this->session->flashdata('success'))
        echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'
?>

<div class="tools">
    <a class="btn btn-mini" href="open" title="Open new saving account"><i class="icon-plus-sign"></i>Open Saving</a>
    <span id="delete" class="btn btn-mini" title="Delete"><i class="icon-remove-sign"></i> Delete</span>
    <span id="delete" class="print btn btn-mini" title="Print" print="listsaving"><i class="icon-print"></i> Print</span>
</div>
<div id="listsaving">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px;">
                <?php 
                echo form_checkbox(array('name'=>'check_all','id'=>'check_all'));
                ?>
            </th>
            <th>Account CODE</th>
            <th>EN Name</th>
            <th>KH Name</th>
            <th>Gender</th>
            <th>Identity Card</th>
            <th>Type</th>
            <th>Created</th>
            <th>Modified</th>
            <th>Currency</th>
            <th>GL</th>
            <th>Interest rate</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($saving_account->num_rows() > 0){
                $db = new dbf();
                foreach ($saving_account->result() as $row){
                    echo '<tr>';
                    echo '<td>'.form_checkbox(array('class'=>'child_check','id'=>$row->sav_acc_id,'name'=>'child_check[]','value'=>$row->sav_acc_id)).'</td>';
                    echo '<td>'.$row->sav_acc_code.'</td>';
                    echo '<td>'.$row->con_en_last_name.' '.$row->con_en_first_name.'</td>';
                    echo '<td>'.$row->con_kh_last_name.' '.$row->con_kh_first_name.'</td>';
                    echo '<td>'.strtoupper($row->con_sex).'</td>';
                    echo '<td>'.$row->con_national_identity_card.'</td>';
                    echo '<td>'.$row->sav_pro_typ_title.'</td>';
                    echo '<td>'.$row->sav_acc_create_date.'</td>';
                    echo '<td>'.$row->sav_acc_modified_date.'</td>';
                    echo '<td>'.$row->cur_title.'</td>';
                    echo '<td>'.$row->gl_description.'</td>';
                    echo '<td>'.$row->sav_acc_interest_rate.'</td>';
                    echo '<td>'.$row->con_det_address_detail.'</td>';
                    echo '</tr>';
                }
            }
            else{
                echo '<tr>';
                echo '<td colspan="9">Emty</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
</div>
<?php
echo form_close();
?>