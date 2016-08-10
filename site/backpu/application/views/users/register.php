<?php
$roles[''] = '--- Select role ---';
?>
        <div>
            <?php echo form_open('users/register',array('class'=>'form')); ?>
            <table>
                <tr>
                    <td><label>Username</label></td>
                    <td><?php echo form_input($dbf->getF_username(),  set_value($dbf->getF_username())); echo form_error($dbf->getF_username()); ?></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><?php echo form_password($dbf->getF_password(),  set_value($dbf->getF_password()));echo form_error($dbf->getF_password()); ?></td>
                </tr>
                <tr>
                    <td><label>Password confirmation</label></td>
                    <td><?php echo form_password($dbf->getF_password().'c',  set_value($dbf->getF_password().'c')); echo form_error($dbf->getF_password().'c'); ?></td>
                </tr>
                <tr>
                    <td><label>User role</label></td>
                    <td><?php echo form_dropdown($dbf->getF_rol_id(),$roles,  set_value($dbf->getF_rol_id())); echo form_error($dbf->getF_rol_id()); ?></td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo form_submit('Submit','Register','class="btn"'); ?> 
                        <a class="btn" href="<?php echo base_url(); ?>users/manage"><i class="icon-circle-arrow-left"></i> Back</a>
                    </td>
                </tr>
                
            </table>
            <?php echo form_close(); ?>
        </div>
