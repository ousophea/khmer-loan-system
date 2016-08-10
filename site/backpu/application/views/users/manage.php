<?php
    echo form_open('users',array('name'=>'form_action'));
    if($this->session->flashdata('success'))
        echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'
?>

<div class="tools">
    <a class="btn btn-mini" href="register" title="Add new"><i class="icon-plus-sign"></i> Add new</a>
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
            <th>Username</th>
            <th>Permission</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($data['users']->num_rows() > 0){
                $db = new dbf();
                foreach ($data['users']->result_array() as $row){
                    echo '<tr>';
                    echo '<td>'.form_checkbox(array('class'=>'child_check','id'=>$row[$db->getF_user_id()],'name'=>'child_check[]','value'=>$row[$db->getF_user_id()])).'</td>';
                    echo '<td>'.$row[$db->getF_username()].'</td>';
                    echo '<td>'.$row[$db->getF_rol_name()].'</td>';
                    echo '</tr>';
                }
            }
            else{
                
            }
        ?>
    </tbody>
</table>

<?php
echo form_close();
?>