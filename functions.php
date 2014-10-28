<?php
// REMOVE THE WORDPRESS ADMIN BAR
add_filter( 'show_admin_bar', '__return_false' );

function wpbeginner_remove_version() {
	return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

// REMOVE THE WORDPRESS FOOTER ADMIN
function remove_footer_admin () {
	echo '';
}

add_filter('admin_footer_text', 'remove_footer_admin');


// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT SYSADMIN
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// REDIRECT AFTER SUCCESS LOGIN
function admin_default_page() {
  return '/monitor';
}

add_filter('login_redirect', 'admin_default_page');