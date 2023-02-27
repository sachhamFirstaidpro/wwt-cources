<?php
/**
 * Plugin Name: WWT Courses Management Without Mode
 * Plugin URI: http://www.worldwebtechnology.com
 * Description: WWT Courses Management Without Mode
 * Version: 1.0.9
 * Author: World Web
 * Author URI: http://www.worldwebtechnology.com
 */

/**
 * Basic plugin definitions 
 * 
 * @package WWT Courses Management
 * @since 1.0.0
 */
if( !defined( 'WWTC_DIR' ) ) {
  define( 'WWTC_DIR', dirname( __FILE__ ) );      // Plugin dir
}
if( !defined( 'WWTC_VERSION' ) ) {
  define( 'WWTC_VERSION', '1.0.9' );      // Plugin Version
}
if( !defined( 'WWTC_URL' ) ) {
  define( 'WWTC_URL', plugin_dir_url( __FILE__ ) );   // Plugin url
}
if( !defined( 'WWTC_PLUGIN_BASENAME' ) ) {
	define( 'WWTC_PLUGIN_BASENAME', basename( WWTC_DIR ) ); //Plugin base name
}
if( !defined( 'WWTC_INC_DIR' ) ) {
  define( 'WWTC_INC_DIR', WWTC_DIR.'/includes' );   // Plugin include dir
}
if( !defined( 'WWTC_INC_URL' ) ) {
  define( 'WWTC_INC_URL', WWTC_URL.'includes' );   // Plugin include dir
}
if( !defined( 'WWTC_ADMIN_DIR' ) ) {
  define( 'WWTC_ADMIN_DIR', WWTC_INC_DIR.'/admin' );  // Plugin admin dir
}
if( !defined( 'WWTC_POST_TYPE' )) {
	define( 'WWTC_POST_TYPE','wwtc_courses' );
}
if( !defined( 'WWTC_TAXONOMY_LOCATION' )) {
	define( 'WWTC_TAXONOMY_LOCATION','wwtc_courses_location' );
}
if( !defined( 'WWTC_SHORTCODE' )) {
	define( 'WWTC_SHORTCODE','course_booking' );	
}
if( !defined( 'WWTC_DISCOUNT_SHORTCODE' )) {
	define( 'WWTC_DISCOUNT_SHORTCODE','discount_course_booking' );	
}
if( !defined( 'WWTC_BUTTON_SHORTCODE' )) {
	define( 'WWTC_BUTTON_SHORTCODE','course_booknow_button' );	
}
if( !defined( 'WWTC_DISCOUNT_BUTTON_SHORTCODE' )) {
	define( 'WWTC_DISCOUNT_BUTTON_SHORTCODE','discount_course_booknow_button' );	
}
if( !defined( 'WWTC_IFRAME_SHORTCODE' )) {
	define( 'WWTC_IFRAME_SHORTCODE','course_booking_iframe' );	
}
if( !defined( 'WWTC_DISCOUNT_IFRAME_SHORTCODE' )) {
	define( 'WWTC_DISCOUNT_IFRAME_SHORTCODE','discount_course_booking_iframe' );	
}
if( !defined( 'WWTC_REVERSE_SHORTCODE' )) {
	define( 'WWTC_REVERSE_SHORTCODE','course_booking_location' );	
}
if( !defined( 'WWTC_BUTTON_REVERSE_SHORTCODE' )) {
	define( 'WWTC_BUTTON_REVERSE_SHORTCODE','course_booknow_button_location' );	
}

/**
 * Plugin Activation hook
 * 
 * This hook will call when plugin will activate
 * 
 * @package WWT Courses Management
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wwtc_install' );

function wwtc_install() {
	
	global $wpdb;
	
	//IMP Call of Function
	//Need to call when custom post type is being used in plugin
	flush_rewrite_rules();
	
}


/**
 * Plugin Deactivation hook
 * 
 * This hook will call when plugin will deactivate
 * 
 * @package WWT Courses Management
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wwtc_uninstall' );

function wwtc_uninstall() {
	
	global $wpdb;
	
	//IMP Call of Function
	//Need to call when custom post type is being used in plugin
	flush_rewrite_rules();
}

/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package WWT Courses Management
 * @since 1.0.0
 */
function wwtc_load_textdomain() {
	
 // Set filter for plugin's languages directory
	$wwtc_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wwtc_lang_dir	= apply_filters( 'wwtc_languages_directory', $wwtc_lang_dir );
	
	// Traditional WordPress plugin locale filter
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wwtcourses' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wwtcourses', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $wwtc_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . WWTC_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/wwt-courses folder
		load_textdomain( 'wwtcourses', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { // Look in local /wp-content/plugins/wwt-courses/languages/ folder
		load_textdomain( 'wwtcourses', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'wwtcourses', false, $wwtc_lang_dir );
	}  
}

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package WWT Courses Management
 * @since 1.0.0
 */
function wwtc_plugin_loaded() {
 
	// load first plugin text domain
	wwtc_load_textdomain();
}
//add action to load plugin
add_action( 'plugins_loaded', 'wwtc_plugin_loaded' );


// Global variables
global $wwtc_admin, $wwtc_public, $wwtc_scripts;

// handles post type and taxonomy creation
include_once( WWTC_INC_DIR . '/wwtc-post-type.php' );

// Misc handles all misc functions
include_once( WWTC_INC_DIR .'/wwtc-misc-functions.php' );

// Script class include scripts and styles of plugin
include_once( WWTC_INC_DIR .'/class-wwtc-scripts.php' );
$wwtc_scripts = new WWTC_Scripts();
$wwtc_scripts->add_hooks();

//Handles admin side functionalities
include_once( WWTC_ADMIN_DIR . '/class-wwtc-admin.php' );
$wwtc_admin = new WWTC_Admin();
$wwtc_admin->add_hooks();

// Public class handles most of fronted functionalities of plugin
include_once( WWTC_INC_DIR .'/class-wwtc-public.php' );
$wwtc_public = new WWTC_Public();
$wwtc_public->add_hooks();