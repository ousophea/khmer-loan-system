<?php
$roles[''] = '--- Select role ---';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div>
            <?php echo form_open('users/register',array('class'=>'form-signin')); ?>
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
                    <td><?php echo form_submit('Submit','Register'); echo anchor('users/login','Login'); ?></td>
                </tr>
            </table>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>
