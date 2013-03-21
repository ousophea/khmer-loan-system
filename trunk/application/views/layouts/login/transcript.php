<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loan System</title>
        <link href="<?php echo base_url(); ?>css/transcript/css/style.css" rel="stylesheet" type="text/css">

        <script src="js/jquery.js"></script>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>css/transcript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <script src="<?php echo base_url(); ?>css/transcript/bootstrap/js/bootstrap.min.js"></script>
        <div id="wraper">
            <div class="header">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
            <div id="login-content">
                <div id="login_form">
                    <div id="login_form_logo">
                        <img src="<?php echo base_url(); ?>css/transcript/images/logo.png" width="178">
                    </div>
                    <div id="form">
                        <?php
                        echo form_open('users/login', array('class' => 'form-signin'));
                        echo (!empty($login)) ? $login : '';
                        echo form_error($dbf->getF_username());
                        echo form_error($dbf->getF_password());
                        ?>
                            <table width="100%"  border="0">
                                <tr>
                                    <td colspan="3" ><h1 class="form_title">User Login</h1></td>
                                </tr>
                                <tr>
                                    <td width="8" rowspan="3" id="v_rule">&nbsp;</td>
                                    <td  colspan="2"><label class="input">User name:</label>
                                        <?php
                                        echo form_input(array('name' => $dbf->getF_username(), 'required class'=>'txt_input', 'id'=>'user_name', 'size'=>'35', 'placeholder' => 'Username'), set_value($dbf->getF_username()));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td  colspan="2">
                                        <label class="input">Password:</label>
                                        <?php
                                        echo form_password(array('name' => $dbf->getF_password(),'required size'=>'35',  'class'=>'txt_input','id' => 'user_password', 'placeholder' => 'Password'), set_value($dbf->getF_password()));
                                        ?>
                                        
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td width="82"><input name="btn_login" type="image" id="btn_login" value="Submit" src="<?php echo base_url(); ?>css/transcript/images/tbn_login.png" ></td>
                                    <td width="196"><a href="#">Forget your password?</a></td>
                                </tr>
                            </table>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
            <br class="clr" />
            <div id="footer">
                <span style="float:left">© Copyright 2013,</span>
                <span style="float:right">® All right resource</span>
            </div>
        </div>
    </body>
</html>
