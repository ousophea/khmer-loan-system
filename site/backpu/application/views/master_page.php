<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<link href="<?php echo site_url('images/ico.ico'); ?>" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keyword" content="<?php echo (isset($meta_key))?$meta_key:'N/A' ?>" />
		<meta name="description" content="<?php echo (isset($meta_description))?$meta_description:'N/A' ?>" />
		<title><?php echo (isset($title))?$title:'Home' ?> - Riel Micro Finance</title>
		<link href="<?php echo site_url('css/style.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('css/main-style.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('css/menu.css'); ?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo site_url('css/jquery-ui.css'); ?>" />
		<!-- will be removed after merging CSS-->
		<link rel="stylesheet" href="<?php echo site_url('css/contacts.css'); ?>" />
		<script type="text/javascript" language="javascript" src="<?php echo site_url('js/jquery-1.8.2.js'); ?>" ></script>
		<script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>
		<script type="text/javascript" language="javascript" src="<?php echo site_url('js/jq_action_manager.js'); ?>" ></script>
                <!--form popup-->
                <script src="<?php echo site_url('bootstrap/js/jquery.colorbox-min.js'); ?>"></script>
                <link href="<?php echo site_url('bootstrap/css/colorbox.css'); ?>" rel="stylesheet" media="all">
                
		<!-- Bootstrap -->
		<link href="<?php echo site_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
	</head>

	<body>
		<script src="<?php echo site_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
		<div id="wraper">
		  <div class="header">
		    <div id="header">
		      <div id="signin"> <strong class="welcome">admin</strong> <strong><a href=""> | Logout</a></strong> </div>
		      <div class="clear"></div>
		      <!-- Logo --> 
		      <!-- Remove inline style when switching back to regular logo-->
		      <!--<div id="ssslogo"> <a href="<?php echo base_url(); ?>"> <img title="Riel Micro Finance" class="logo" src="<?php echo site_url('images/logod.png'); ?>" alt="Logo"></a></div>-->
		      <!-- Menu -->
		      
		      <div id="contain-menu3">
		        <ul class="sf-menu sf-js-enabled">
		          <li id="pan" class="off<?php echo (!segment(1))?' current':''?>"><?php echo anchor(base_url(),'Panel'); ?></li>
		          <li id="gra" class="off<?php echo (segment(1) == 'contacts')?' current':''?>"><?php echo anchor(site_url('contacts'),'Contacts','class="sf-with-ul"'); ?></li>
		          <li id="tew" class="off<?php echo (segment(1) == 'savings')?' current':''?>"><?php echo anchor(site_url('savings'),'Savings','class="sf-with-ul"'); ?></li>
		          <li id="cla" class="off<?php echo (segment(1) == 'loans')?' current':''?>"><?php echo anchor(site_url('loans'),'Loans','class="sf-with-ul"'); ?></li>
		          <li class="off dropdown"> <a class="dropdown-toggle"
		    data-toggle="dropdown"
		    href="#"> Reports <b class="caret"></b> </a>
		            <ul class="dropdown-menu">
		              <li><a tabindex="-1" href="#">Finance report</a></li>
		              <li><a tabindex="-2" href="#">Another action</a></li>
		              <li><a tabindex="-3" href="#">Something else here</a></li>
		            </ul>
		          </li>
		          <li id="use" class="off"><a onclick="return false" href="" class="sf-with-ul">User</a> </li>
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
                        
		    	<!--
		    	<div class="menu_manager">
		      		<?php echo anchor(site_url(segment(1).'/add'),'Add New','id="add_manager"'); ?> | 
					<?php echo anchor(site_url(segment(1).'/edit'),'Edit','id="edit_manager"'); ?> | 
					<?php echo anchor(site_url(segment(1).'/delete'),'Delete','id="delete_manager"'); ?> 
		      	</div>
		      -->
		      <legend><?php echo (isset($title))?$title:'Riel Micro Finance Homepage Manager'; ?></legend>
		      <!--<div class="panel-control">-->
		        <?php
					$this->load->view(segment(1).'/'.((segment(2))?segment(2):'index'));
				?>
		      <!--</div>-->
		    </div>
		  </div>
		  <div id="top_footer"></div>
		  <div id="footer"> <span style="float:left">© Copy Right 2013 </span> <span style="float:right">® All Right Reserved</span> </div>
		</div>
		<script type="text/javascript" language="javascript">
			$(document).ready(function(e) {
		        
				$('.dropdown-toggle').dropdown();
		    });
					
		</script>
	</body>
</html>