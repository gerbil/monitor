<?php 
/*
Template Name: Login
*/
?>

<?php get_header(); ?>

<?php
global $user_ID, $user_identity;
get_currentuserinfo();
?>

<div id="login_page"> 
  <!-- Login page -->
  <div id="login">
    <div class="row-fluid fluid">
      <div class="span5"> <img src="<?php bloginfo('template_url'); ?>/img/user.png" height="200" /> </div>
      <div class="span7">
        <div class="title">
          <span class="name">%Anonymous%</span>
          <span class="subtitle">Locked</span>
        </div>
        <form class="form-horizontal" name="loginform" id="loginform" action="<?php echo get_settings('siteurl'); ?>/wp-login.php" method="post">
		
		<div class="control-group">
			<label class="control-label" for="log">Username</label>
			<div class="controls">
				<input type="text" name="log" id="log" value="" size="15" tabindex="1" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="pwd">Password</label>
			<div class="controls">
				<input type="password" name="pwd" id="pwd" value="" size="15" tabindex="2" />
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<button type="submit" name="Login" class="btn pull-right color_4">Go</button>
			</div>			
		</div>
		
        </form>
      </div>
    </div>
  </div>
  <!-- End #login --> 
  <!-- <img src="img/ajax-loader.gif"> --> 
</div>
<!-- End #loading --> 