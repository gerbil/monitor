<?php require('auth.php'); ?>
<!DOCTYPE html>
<html class="sidebar_default no-js" lang="en">
<head>
<meta charset="utf-8">
<title><?php bloginfo('name') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Jurijs Kobecs">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/css/images/favicon.png">
<!-- Le styles -->
<link href="<?php bloginfo('template_url'); ?>/css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/unminified/base.css" rel="stylesheet" data-noprefix>
<link href="<?php bloginfo('template_url'); ?>/css/twitter/responsive.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/countdown/style.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/js/plugins/reveal/reveal.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/responses/css/style.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>	

<!-- General scripts --> 
<script src="<?php bloginfo('template_url'); ?>/js/jquery.js" type="text/javascript"> </script>

<!-- Config for scripts --> 
<script src="<?php bloginfo('template_url'); ?>/js/config.js" type="text/javascript"> </script>

</head>

<body <?php body_class(); ?>>

<div id="loading"><img src="<?php bloginfo('template_url'); ?>/img/ajax-loader.gif"></div>
<div id="responsive_part">
  <div class="logo"> <a href="<?php echo site_url(); ?>"><span>Start</span><span class="icon"></span></a> </div>
  <ul class="nav responsive">
    <li>
      <button class="btn responsive_menu icon_item" data-toggle="collapse" data-target=".overview"> <i class="icon-reorder"></i> </button>
    </li>
  </ul>
</div>
<!-- Responsive part -->

<div id="sidebar" class="">
  <div class="scrollbar">
    <div class="track">
      <div class="thumb">
        <div class="end"></div>
      </div>
    </div>
  </div>
  <div class="viewport ">
    <div class="overview collapse">
      <ul id="sidebar_menu" class="navbar nav nav-list container full">	  
		<?php 		
			function curPageURL() {
			 $pageURL = 'http';
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 return $pageURL;
			}
		
			$slug = site_url();
			$curPageURL = curPageURL();
			
			//echo $slug;
			//echo $curPageURL;
		?>  
		<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?> 
			<li class="accordion-group <?php if ($curPageURL == $slug.'/') { echo "active"; }; ?> color_7"> <a class="alarms" href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/monitor.png"><span>Alarms</span></a></li>       
			<li class="accordion-group <?php if ($curPageURL == $slug.'/stats/') { echo "active"; }; ?> color_4"> <a class="dashboard " href="<?php echo site_url(); ?>/stats"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/graph.png"><span>Dashboard</span></a> </li>
			<li class="accordion-group <?php if ($curPageURL == $slug.'/wiki') { echo "active"; }; ?> color_7"> <a class="alarms" href="<?php echo site_url(); ?>/wiki"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/wiki.png"><span>Wiki</span></a></li>
			<li class="accordion-group <?php if ($curPageURL == $slug.'/journal') { echo "active"; }; ?> color_7"> <a class="alarms" href="<?php echo site_url(); ?>/journal"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/journal.png"><span>Journal</span></a></li>
			<li class="accordion-group <?php if ($curPageURL == $slug.'/lb') { echo "active"; }; ?> color_7"> <a class="lb" href="<?php echo site_url(); ?>/lb"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/lb.png"><span>Load balancer</span></a></li>
			<li class="accordion-group <?php if ($curPageURL == $slug.'/responses') { echo "active"; }; ?> color_7"> <a class="responses" href="<?php echo site_url(); ?>/responses"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/retry.png"><span>Responses</span></a></li>
            <li class="accordion-group <?php if ($curPageURL == $slug.'/jenkins') { echo "active"; }; ?> color_7"> <a class="jenkins" href="<?php echo site_url(); ?>/jenkins"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/jenkins.png"><span>Jenkins</span></a></li>
        <?php } else { ?>
			<li class="accordion-group <?php if ($curPageURL == $slug.'/responses') { echo "active"; }; ?> color_7"> <a class="responses" href="<?php echo site_url(); ?>/responses"><img src="<?php bloginfo('template_url'); ?>/img/menu_icons/retry.png"><span>Responses</span></a></li>
		<?php }; ?>
      </ul>
    </div>
  </div>
</div>
<div id="main">
  <div class="container">
    <div class="header row-fluid">
      <div class="logo"> <a href="<?php echo site_url(); ?>"><span>Provident monitor</span><span class="icon"></span></a> </div>
      <div class="top_right">
        <ul class="nav nav_menu">
		<?php if(is_user_logged_in()) { ?>
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="<?=bp_get_loggedin_user_link();?>">
            <div class="title"><span class="name"><?=bp_get_loggedin_user_fullname();?></span><span class="subtitle"><?php $update=get_usermeta( bp_loggedin_user_id(), 'bp_latest_update' ); echo $update['content'];?></span></div>
            <span class="icon"><?=bp_get_loggedin_user_avatar('width=80px');?></span>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="<?=bp_get_loggedin_user_link();?>"><i class=" icon-user"></i> My Profile</a></li>
              <!--<li><a href="forms_general.html"><i class=" icon-cog"></i>Settings</a></li>-->
              <li><a href="<?=wp_logout_url('./login');?>"><i class=" icon-unlock"></i>Log Out</a></li>
              <!--<li><a href="search.html"><i class=" icon-flag"></i><?=get_usermeta(bp_loggedin_user_id());?></a></li>-->
            </ul>
          </li>
		  <?php } else { ?>
			<div id="login_head">	 
				<div class="login-form">
				<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
				  <input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" /><input type="password" name="pwd" id="pwd" size="20" /><input type="submit" name="submit" value="" class="login" />				  				
				</form>
			  </div>
			</div>
		  <?php } ?>
        </ul>
      </div>
      <!-- End top-right --> 
    </div>