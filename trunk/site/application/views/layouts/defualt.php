<?php
$dbf = new dbf();
?>
<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from twitter.github.com/bootstrap/examples/fluid.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 01 Mar 2013 04:18:39 GMT -->
    <head>
        <meta charset="utf-8">
        <title>Loan System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/users.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            @media (max-width: 980px) {
                /* Enable use of floated navbar text */
                .navbar-text.pull-right {
                    float: none;
                    padding-left: 5px;
                    padding-right: 5px;
                }
            }
        </style>
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url(); ?>bootstrap/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>bootstrap/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>bootstrap/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>bootstrap/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>bootstrap/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>bootstrap/ico/favicon.png">
    </head>

    <body>

        <?php echo form_open('',array('style'=>'margin:0px;')); ?>
        <input type="hidden" name="base_url" value="<?php echo base_url(); ?>" id="base_url" />
        <?php echo form_hidden('segment1', $this->uri->segment(1)); // for date paker get uri1 ?>
        <?php echo form_hidden('segment2', $this->uri->segment(2)); // for date paker get uri2 ?>
        <?php echo form_hidden('segment3', $this->uri->segment(3)); // for date paker get uri3 ?>
        <?php echo form_hidden('segment4', $this->uri->segment(4)); // for date paker get uri4 ?>
        <?php echo form_close(); ?>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="#">Loan System</a>
                    <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right">
                            Logged in as 
                            <?php
                            $username = $this->session->userdata($dbf->getF_username());
                            $role = $this->session->userdata($dbf->getF_rol_name());
                            echo $username.' ';
                            echo '('.$role.') ';
                            //echo anchor('#', $username, array('class'=>'navbar-link')).' | ';
                            echo anchor('users/signout', 'Sign out', array('class'=>'navbar-link'));
                            ?>
                        </p>
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2"> <!-- span1, span2,... -->
                    <div class="well sidebar-nav">
                        <ul class="nav nav-list">
                            <li class="nav-header">Sidebar</li>
                            <li class="active"><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li class="nav-header">Sidebar</li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li class="nav-header">Sidebar</li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                        </ul>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span10">
                    <h5><?php echo $title; ?></h5>
                    <?php 
                    $this->load->view($this->uri->segment(1).'/'.$this->uri->segment(2));
                    ?>
                </div><!--/span-->
            </div><!--/row-->

            <hr>

            <footer>
                <p>&copy; Company 2013</p>
            </footer>

        </div><!--/.fluid-container-->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>bootstrap/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-transition.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-alert.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-modal.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-scrollspy.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tab.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-popover.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-button.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-carousel.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-typeahead.js"></script>
        <script src="<?php echo base_url(); ?>js/form.js"></script>

    </body>

    <!-- Mirrored from twitter.github.com/bootstrap/examples/fluid.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 01 Mar 2013 04:18:39 GMT -->
</html>
