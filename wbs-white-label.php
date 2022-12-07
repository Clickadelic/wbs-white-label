<?php
/*
Plugin Name: WBS White Label
Plugin URI:  https://github.com/Clickadelic/wbs-white-label
Description: A plugin to white label your WordPress installation (hide all logos, etc.).
Version:     0.0.1
Author:      Tobias Hopp
Author URI:  https://www.tobias-hopp.de
License:     GPL2
License URI: u-known
Text Domain: wbs-white-label
Domain Path: /languages
*/

// If there is no absolute path, kick out the request > Security
if(!defined('ABSPATH')) {
	exit('NaNa nAnA NaNa nAnA NaNa nAnA Batman!');
}

/**
 * 
 * Hookname: wp_before_admin_bar_render
 * 
 * add_action('HOOKNAME', 'FUNCTION') fügt diesem Hook eine "Aktion/Funktion" hinzu"
 * Dann wird das $wp_admin_bar Objekt als global deklariert,
 * um darauf zuzugreifen bzw. es zu manipulieren
 */
function filter_admin_bar_items() {
	// Declare the $wp_admin_bar object as global
	global $wp_admin_bar;
	// Remove Wordpress Icon in the admin bar
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'filter_admin_bar_items', 0);


/**
 *  Let's add some CSS and scripts to our login page
 * 
 *  Hook: login_enqueue_scripts
 */
function wbs_white_label_login_scripts() {
	$wbs_white_label_login_stylesheet = esc_url(plugins_url('/assets/css/wbs-white-label-login-style.css', __FILE__ ));
	$wbs_white_label_login_script = esc_url(plugins_url('/assets/js/wbs-white-label-login-script.js', __FILE__ ));
    
	wp_enqueue_style(
		'wbs-white-label-login-style',
		$wbs_white_label_login_stylesheet
	);

	wp_enqueue_script(
		'wbs-white-label-login-script',
		$wbs_white_label_login_script,
		false,
		false,
		true
	);
    
}
add_action('login_enqueue_scripts', 'wbs_white_label_login_scripts' );


/**
 *  Let's filter the backend-footer text
 * 	
 *  Hookname: admin_footer_text
 */

function wbs_white_label_admin_footer_text(){
    echo '<span class="backend-footer-credits">This project is powered by <a href="https://example.com/" title="WDG007 Website ;-)" target="_blank">WDG007</a></span>';
}
add_filter('admin_footer_text', 'wbs_white_label_admin_footer_text');