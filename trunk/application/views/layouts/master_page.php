<?php
$dbf = new dbf();
//update
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo (isset($title)) ? $title . ' : Khmer Loan System' : 'Khmer Loan System' ?></title>
        <style type="text/css">
            @font-face {
                font-family: kmSBBICsys;
                src: url(<?php echo site_url(FONT_PATH . 'kmSBBICsys.ttf'); ?>);
            }
        </style>
        <link rel="shortcut icon" href="<?php echo site_url(IMAGES_PATH . 'favicon.ico') ?>"></link>
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'style.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'main-style.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'menu.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'saving.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'jquery-ui.css'); ?>" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url(CSS_PATH_BOOTSTRAP . 'users.css'); ?>" rel="stylesheet" media="screen">

        <!--<script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'jquery-2.0.0.min.js'); ?>" ></script>-->
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery-1.8.3.min.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery-ui.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap.min.js'); ?>" ></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-button.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-dropdown.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH_BOOTSTRAP . 'bootstrap-typeahead.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form_model.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jq_action_manager.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jquery.PrintArea.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'form_model.js'); ?>" ></script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'jq_action_manager.js'); ?>"></script>


    </head>

    <body>
        <?php echo form_open('', array('style' => 'margin:0px;')); ?>
        <input type="hidden" name="base_url" value="<?php echo base_url(); ?>" id="base_url" />
        <?php echo form_hidden('segment1', $this->uri->segment(1)); // for date paker get uri1  ?>
        <?php echo form_hidden('segment2', $this->uri->segment(2)); // for date paker get uri2  ?>
        <?php echo form_hidden('segment3', $this->uri->segment(3)); // for date paker get uri3 ?>
        <?php echo form_hidden('segment4', $this->uri->segment(4)); // for date paker get uri4 ?>
        <?php echo form_hidden('print_css', base_url() . 'bootstrap/css/print.css'); // for date paker get uri4 ?>

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
                            echo $username . ' ';
                            echo '(' . $role . ') ';
                            ?>
                        </strong>
                        <strong>
                            <a href="<?php echo base_url(); ?>users/signout"> | Logout</a>
                        </strong>
                    </div>
                    <div class="clear"></div>
                    <!-- Logo -->
                    <!-- Remove inline style when switching back to regular logo-->
                    <div id="logo"> <a href="<?php echo base_url(); ?>"> <img title="Riel Micro Finance" class="logo" src="<?php
                            echo base_url();
                            echo IMAGES_PATH;
                            ?>logo.png" alt="Logo"></a></div>
                    <div id="logo"> <a href="#"> <img title="" class="logo" src="<?php
                                                                              echo base_url();
                                                                              echo Variables::$images_path;
                            ?>logo.png" alt="Logo"></a></div>

                    <!-- Menu -->
                    <div class="dropdown">
                        <ul class="main-menu">
                            <li id="pan" class="off <?php echo (($this->uri->segment(1)) == "panel") ? 'current' : '' ?>" ><a href="<?php echo base_url(); ?>panel">Panel</a></li>

                            <?php if (strtolower($this->session->userdata('gro_name')) == strtolower(TELLER)) { ?>
                                <li id="graa" class="off <?php echo (($this->uri->segment(1)) == "cashs") ? 'current' : '' ?>"><a href="<?php echo base_url(); ?>cashs" >Tiller Cash</a></li>
                                <li id="graa" class="off <?php echo (($this->uri->segment(1)) == "disbursments") ? 'current' : '' ?>"><a href="<?php echo base_url(); ?>disbursments" >Disbursment</a></li>

                                        <!--<li id="graa" class="off <?php echo (($this->uri->segment(1)) == "paycash") ? 'current' : '' ?>"><a onclick="return false" href="" >Pay Cash</a></li>-->

                                <li id="" class="off <?php echo (segment(1) == "paycashs") ? 'current' : '' ?>"><a href="<?php echo site_url('paycashs#form_other_expanse'); ?>" >Other Expense</a></li>
                                <li id="tew" class="off <?php echo (($this->uri->segment(1)) == "receivecashs") ? 'current' : '' ?>"><a href="<?php echo base_url(); ?>receivecashs">Receive Cash</a></li>
                            <?php } else { ?>
                                
                                <?php
                            $current_contact = false;
                            $arr_menu_contact = array('contacts');
                            if (in_array(segment(1),$arr_menu_contact)) {
                                $current_contact = TRUE;
                            }
                            ?>   
                                <li class="off dropdown <?php echo ($current_contact== TRUE) ? 'current' : '' ?>"> 
                                    <a class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       href="#"> Contact <b class="caret"></b> </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?php echo base_url(); ?>contacts">New Contact</a></li>
                                        <li><a tabindex="-2" href="#">View Contact</a></li>
                                        <li><a tabindex="-2" href="#">Edit Contact</a></li>
                                        <li><a tabindex="-2" href="#">Delete Contact</a></li>
                                    </ul>
                                </li>


    <!--<li id="" class="off <?php echo (segment(1) == "contacts") ? 'current' : '' ?>" ><a href="<?php echo site_url('contacts'); ?>">Contact</a></li>-->
                                <li id="" class="off <?php echo (segment(1) == "journal") ? 'current' : '' ?>"><a href="<?php echo site_url('journals#form_journal'); ?>" >Journal Entry</a></li>

                                <li class="off dropdown <?php echo (segment(1) == "saving") ? 'current' : '' ?>"> 
                                    <a class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       href="#"> Saving <b class="caret"></b> </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?php echo base_url(); ?>saving">New Saving Acc</a></li>
                                        <li><a tabindex="-2" href="#">View Saving Acc</a></li>
                                        <li><a tabindex="-2" href="#">Edit Saving Acc</a></li>
                                        <li><a tabindex="-2" href="#">Close Saving Acc</a></li>
                                    </ul>
                                </li>

                                <li class="off dropdown <?php echo (segment(1) == "loan") ? 'current' : '' ?>"> 
                                    <a class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       href="#"> Loan Acc <b class="caret"></b> </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?php echo base_url(); ?>loan">New Loan Acc</a></li>
                                        <li><a tabindex="-2" href="#">View Loan Acc</a></li>
                                        <li><a tabindex="-2" href="#">Edit Loan Acc</a></li>
                                        <li><a tabindex="-2" href="#">Close Loan Acc</a></li>
                                    </ul>
                                </li>

                                    <!--<li id="cla" class="off <?php echo (($this->uri->segment(1)) == "saving") ? 'current' : '' ?>"><a href="<?php echo base_url(); ?>saving">Loan/Saving</a></li>-->
                            <?php
                            $current_report = false;
                            $arr_menu_report = array('transaction', 'reports');
                            if (in_array(segment(1),$arr_menu_report)) {
                                $current_report = TRUE;
                            }
                            ?> 
                                <li class="off"> 
                                    <a class="dropdown-toggle <?php echo ($current_report == TRUE) ? 'current' : '' ?>" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"> Reports <b class="caret"></b> </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li class="off <?php echo (segment(1) == "transaction") ? 'current' : '' ?>">
                                            <a tabindex="-1" href="<?php echo site_url('reports/transaction'); ?>">Transaction report</a></li>
                                        <li><a tabindex="-3" href="<?php echo site_url('reports/glreport'); ?>">GL report</a></li>
                                        <li><a tabindex="-3" href="#">Another action</a></li>
                                        <li><a tabindex="-4" href="#">Something else here</a></li>
                                    </ul>
                                </li>

                                    <!--<li id="use" class="off <?php echo (segment(1) == "users") ? 'current' : '' ?>"><a onclick="" href="<?php echo base_url(); ?>users/manage" class="sf-with-ul">User</a> </li>-->
                            <?php } ?>
                            <?php
                            $current_setting = false;
                            $arr_menu_setting = array('users', 'db', 'changpass');
                            if (in_array(segment(1),$arr_menu_setting)) {
                                $current_setting = TRUE;
                            }
                            ?>    
                            <li class="off dropdown <?php echo ($current_setting == TRUE) ? 'current' : '' ?>"> 
                                <a class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   href="#"> Setting <b class="caret"></b> </a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="#">Change password</a></li>
<?php if (strtolower($this->session->userdata('gro_name')) != strtolower(TELLER)) { ?>
                                        <li><a tabindex="-2" href="<?php echo base_url(); ?>users/manage">Manage User</a></li>
                                        <li><a tabindex="-2" href="#">Database backup</a></li>

<?php } ?>
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
                    <legend><?php echo (!empty($title)) ? $title : 'Untitle'; ?><i id="loader" class="icon-loader" style="display: none;"></i></legend>
<?php $this->load->view(segment(1) . '/' . ((segment(2)) ? segment(2) : 'index')); ?>
                </div>
            </div>
            <div id="top_footer"></div>
            <div id="footer"> <span style="float:left">© Copyright 2013,</span> <span style="float:right">® All right resource</span> </div>
        </div>
        <script type="text/javascript">
            
            var jq = jQuery.noConflict();
            (function(jq) {
                jq(function() {
                    jq('.dropdown-toggle').dropdown();
                    //jq('.btn').click(function(){jq('#loader').show();});
                });
            })(jQuery);
           
        </script>
        <script type="text/javascript" src="<?php echo site_url(JS_PATH . 'prints.js'); ?>"></script>
    </body>
</html>
