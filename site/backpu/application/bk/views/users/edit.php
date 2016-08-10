<?php
$dbf = new dbf();
foreach ($data['user']->result_array() as $row){

?>

<div>
    <?php echo form_open('users/edit/'.$this->uri->segment(3), array('class' => 'form')); 
    echo form_hidden($dbf->getF_user_id(),$this->uri->segment(3));
    ?>
    <table>
        <tr>
            <td><label>Username</label></td>
            <td><?php echo form_input($dbf->getF_username(), $row[$dbf->getF_username()], 'disabled');//$row[$dbf->getF_user_rol_id()]
    echo form_error($dbf->getF_username()); ?></td>
        </tr>
        <tr>
            <td><label>User role</label></td>
            <td><?php echo form_dropdown($dbf->getF_user_rol_id(), $roles, $row[$dbf->getF_user_rol_id()]);
    echo form_error($dbf->getF_user_rol_id()); ?></td>
        </tr>
        <tr>
            <td>
<?php echo form_submit('Submit', 'Update', 'class="btn"'); ?> 
                <a class="btn" href="<?php echo base_url(); ?>users/manage"><i class="icon-circle-arrow-left"></i> Back</a>
            </td>
        </tr>
    </table>
<?php echo form_close(); ?>
</div>
<?php
// end foreach
}
?>