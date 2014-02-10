<?php

	/*-----------------------------------------------------------------------------------*/
	/*	Includes
	/*-----------------------------------------------------------------------------------*/

	include('include/post-meta.php');

	/*-----------------------------------------------------------------------------------*/
	/*	WP3.0+ Menus
	/*-----------------------------------------------------------------------------------*/

	function register_menu() {
		register_nav_menu('navigation', __('Primary Menu'));
	}
	add_action('init', 'register_menu');


	/*-----------------------------------------------------------------------------------*/
	/*	Edit Excerpt
	/*-----------------------------------------------------------------------------------*/

	function vsip_excerpt_length($length) {
	return 25; }

	add_filter('excerpt_length', 'vsip_excerpt_length');

	function vsip_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt); }
	add_filter('wp_trim_excerpt', 'vsip_excerpt_more');


	/*-----------------------------------------------------------------------------------*/
	/*	Register JS
	/*-----------------------------------------------------------------------------------*/

	function vsip_enqeue_scripts() 
	{
		// Register our scripts

		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');

		// validation
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery');	

		// Register our Custom JS Script
		wp_register_script('custom_js', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE);


		// Enqueue our scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('validation');
		wp_enqueue_script('custom_js');

	}

	add_action('wp_enqueue_scripts', 'vsip_enqeue_scripts');

	/*-----------------------------------------------------------------------------------*/
	/*	Browser Detection
	/*-----------------------------------------------------------------------------------*/

	function browser_body_class($classes) {

		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) $classes[] = 'ie';
		else $classes[] = 'unknown';

		if($is_iphone) $classes[] = 'iphone';

		return $classes;

	}

	add_filter('body_class','browser_body_class');
