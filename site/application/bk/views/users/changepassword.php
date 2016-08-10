
<div>
    <?php 
    $dbf = new dbf();
    echo form_open('users/changepassword', array('class' => 'form-changepassword'));
    echo form_hidden($dbf->getF_user_id(),$this->uri->segment(3));
    ?>
    <table>
        <tr>
            <td><label>New password</label></td>
            <td><?php echo form_password($dbf->getF_password(), set_value($dbf->getF_password()));
    echo form_error($dbf->getF_password()); ?></td>
        </tr>
        <tr>
            <td><label>New password confirmation</label></td>
            <td><?php echo form_password($dbf->getF_password() . 'c', set_value($dbf->getF_password() . 'c'));
    echo form_error($dbf->getF_password() . 'c'); ?></td>
        </tr>
        <tr>
            <td>
<?php echo form_submit('changepassword', 'Save change', 'class="btn"'); ?> 
                <a class="btn" href="<?php echo base_url(); ?>users/manage"><i class="icon-circle-arrow-left"></i> Back</a>
            </td>
        </tr>
    </table>
<?php echo form_close(); ?>
</div>
