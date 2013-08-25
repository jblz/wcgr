<?php
/*
 * Plugin Name: Presentation ONLY Settings
 * Description: Set up WordPress to be presentation-friendly ( allow wp-admin in an iframe ) *** DON'T Run this on anything public ***
 * Author: jblz
 * Version: 0.00000001
 * Author URI: http://get2see.me

 */
remove_action( 'login_init', 'send_frame_options_header' );
remove_action( 'admin_init', 'send_frame_options_header' );