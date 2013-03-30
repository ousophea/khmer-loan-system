<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loan System</title>
        <link href="<?php echo base_url(); ?>css/transcript/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/transcript/css/main-style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/transcript/css/menu.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>css/transcript/js/jquery-1.8.2.js" ></script>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>css/transcript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>css/users.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url(); ?>css/transcript/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    </head>

    <body>
        <?php echo form_open('',array('style'=>'margin:0px;')); ?>
        <input type="hidden" name="base_url" value="<?php echo base_url(); ?>" id="base_url" />
        <?php echo form_hidden('segment1', $this->uri->segment(1)); // for date paker get uri1 ?>
        <?php echo form_hidden('segment2', $this->uri->segment(2)); // for date paker get uri2 ?>
        <?php echo form_hidden('segment3', $this->uri->segment(3)); // for date paker get uri3 ?>
        <?php echo form_hidden('segment4', $this->uri->segment(4)); // for date paker get uri4 ?>
        <?php echo form_close(); ?>
        <div id="wraper">
            <div class="header">
                <div id="header">
                    <div id="signin">
                        <strong class="welcome">
                            Logged in as 
                            <?php
                            $username = $this->session->userdata($dbf->getF_username());
                            $role = $this->session->userdata($dbf->getF_rol_name());
                            echo $username.' ';
                            echo '('.$role.') ';
                            ?>
                        </strong>
                        <strong>
                            <a href="<?php echo base_url(); ?>users/signout"> | Logout</a>
                        </strong>
                    </div>
                    <div class="clear"></div>
                    <!-- Logo -->
                    <!-- Remove inline style when switching back to regular logo-->
                    <div id="logo"> <a href="http://localhost/transcript/"> <img title="Passerelles Numeriques Cambodia" class="logo" src="<?php echo base_url(); ?>css/transcript/images/logo.png" alt="Logo"></a></div>
                    <!-- Menu -->

                    <div id="contain-menu3">
                        <ul class="sf-menu sf-js-enabled">
                            <li id="pan" class="off current"><a href="<?php echo base_url(); ?>panel">Panel</a></li>
                            <li id="gra" class="off"><a onclick="return false" href="" class="sf-with-ul">Pay Cash</a></li>
                            <li id="tew" class="off"><a href="">Recive Cash</a></li>
                            <li id="cla" class="off"><a href="">Loan/Saving</a></li>
                            <li class="off dropdown"> <a class="dropdown-toggle"
                                                         data-toggle="dropdown"
                                                         href="#"> Reports <b class="caret"></b> </a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="#">Finance report</a></li>
                                    <li><a tabindex="-2" href="#">Another action</a></li>
                                    <li><a tabindex="-3" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li id="use" class="off"><a onclick="" href="<?php echo base_url(); ?>users/manage" class="sf-with-ul">User</a> </li>
                            <li class="off dropdown"> <a class="dropdown-toggle"
                                                         data-toggle="dropdown"
                                                         href="#"> Setting <b class="caret"></b> </a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="#">Change password</a></li>
                                    <li><a tabindex="-2" href="#">Database backup</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <!-- Sub Menu -->

                        <div id="submenu"></div>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="wraper-control">
                    <?php echo $this->session->flashdata('error'); ?>
                    <legend><?php echo $title; ?></legend>
                    <?php $this->load->view($this->uri->segment(1).'/'.$this->uri->segment(2)); ?>
                </div>
            </div>
            <div id="top_footer"></div>
            <div id="footer"> <span style="float:left">© Copyright 2013,</span> <span style="float:right">® All right resource</span> </div>
        </div>
        <script type="text/javascript" language="javascript">
            $(document).ready(function(e) {

                $('.dropdown-toggle').dropdown();
            });

        </script>
        <script src="<?php echo base_url(); ?>js/form.js"></script>
    </body>
</html>
