<?php
	
$page_slug = trim( $_SERVER["REQUEST_URI"], 'monitor/' );

if( (!is_user_logged_in()) && ($page_slug != 'log')  ) { header('Location: monitor/login'); };
	