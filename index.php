<?php
/*
	Plugin Name: d4youtube
	Plugin URI: https://github.com/d4advancedmedia/
	GitHub Theme URI: https://github.com/d4advancedmedia/
	GitHub Branch: master
	Description: D4 YouTube Feed
	Version: 0.1
	Author: D4 Adv. Media
	License: GPL2
*/

// Register and enqueue font-end plugin style sheets and scripts.
add_action( 'wp_enqueue_scripts', 'register_d4youtube_elements' );
function register_d4youtube_elements() {
	wp_register_style( 'd4youtube', plugins_url( 'css/d4youtube.css' , __FILE__ ) );
	wp_enqueue_style( 'd4youtube' );
	wp_register_script( 'd4youtube', plugins_url( 'js/d4youtube.js' , __FILE__ ), array( 'jquery' ), 'v20131005', true );
	wp_enqueue_script('d4youtube');
	wp_register_script( 'iframe_api', 'https://www.youtube.com/iframe_api');
	wp_enqueue_script('iframe_api');		
}

// Register and enqueue back-end plugin style sheets and scripts.
add_action('admin_enqueue_scripts', 'd4youtube_admin_elements');
add_action('login_enqueue_scripts', 'd4youtube_admin_elements');	
function d4youtube_admin_elements() {
    wp_register_style('d4youtube-admin-theme', plugins_url('css/d4youtube-admin.css', __FILE__) );
    wp_enqueue_style('d4youtube-admin-theme' );
    wp_register_script( 'd4youtube-admin-script', plugins_url( 'js/d4youtube-admin.js' , __FILE__ ), array( 'jquery' ), 'v20131005', true );
	wp_enqueue_script('d4youtube-admin-script');
}

//Plugin includes
include ('config.php');
include ('lib/functions.php');
include ('lib/shortcodes.php');
#include ('lib/posttypes.php');
#include ('lib/roles.php');

?>