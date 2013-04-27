<?php
    echo form_open('users',array('name'=>'form_action'));
    if($this->session->flashdata('success'))
        echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'
?>

<div class="tools">
    <a class="btn btn-mini" href="open" title="Open new saving account"><i class="icon-plus-sign"></i>Open Saving</a>
    <span id="edit" class="btn btn-mini" title="Edit"><i class="icon-edit"></i> Edit</span>
    <span id="changepassword" class="btn btn-mini" title="Change password"><i class="icon-wrench"></i> Change password</span>
    <span id="delete" class="btn btn-mini" title="Delete"><i class="icon-remove-sign"></i> Delete</span>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10px;">
                <?php 
                echo form_checkbox(array('name'=>'check_all','id'=>'check_all'));
                ?>
            </th>
            <th>Account CODE</th>
            <th>English Name</th>
            <th>Khmer Name</th>
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
                    echo '<td>'.$row->con_en_name.'</td>';
                    echo '<td>'.$row->con_kh_name.'</td>';
                    echo '</tr>';
                }
            }
            else{
                echo '<tr>';
                echo '<td collspan="">Emty</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php
echo form_close();
?>