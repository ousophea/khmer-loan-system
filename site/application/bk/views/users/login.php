<?php

echo form_open('users/login', array('class' => 'form-signin'));
echo (!empty($login)) ? $login : '';
echo form_error($dbf->getF_username());
echo form_error($dbf->getF_password());
echo heading('Please sign in', 3,"class='form-signin-heading'");
echo form_input(array('name' => $dbf->getF_username(), 'class' => 'input-block-level', 'placeholder' => 'Username'), set_value($dbf->getF_username()));
echo form_password(array('name' => $dbf->getF_password(), 'class' => 'input-block-level', 'placeholder' => 'Password'), set_value($dbf->getF_password()));
//echo '<label class="checkbox" >'.form_checkbox(array('name' => 'remember','value'=>TRUE)).'Remember me</label>';
echo form_submit(array('class' => 'btn btn-primary', 'value' => 'Sign in'));
echo form_close();
?>
