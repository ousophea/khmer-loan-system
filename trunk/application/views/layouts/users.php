<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from twitter.github.com/bootstrap/examples/signin.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 01 Mar 2013 04:18:39 GMT -->
    <head>
        <meta charset="utf-8">
        <title>Sign in &middot; Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url();?>css/users.css" rel="stylesheet">
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url();?>bootstrap/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>bootstrap/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>bootstrap/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>bootstrap/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>bootstrap/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url();?>bootstrap/ico/favicon.png">
    </head>

    <body>

        <div class="container">

            <?php $this->load->view($this->uri->segment(1).'/'.$this->uri->segment(2)); ?>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url();?>bootstrap/js/jquery.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-transition.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-alert.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-modal.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-scrollspy.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-tab.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-popover.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-button.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-carousel.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap-typeahead.js"></script>

    </body>

    <!-- Mirrored from twitter.github.com/bootstrap/examples/signin.html by HTTrack Website Copier/3.x [XR&CO'2008], Fri, 01 Mar 2013 04:18:39 GMT -->
</html>
