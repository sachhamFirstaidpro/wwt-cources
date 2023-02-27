<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */

class WWTC_Admin {

	//class constructor
	function __construct() {
	}

    /*
    * Add Seeting Menu
    */
    public function wwtc_add_admin_menu() {
        
        add_submenu_page(
            'edit.php?post_type='.WWTC_POST_TYPE,
            __( 'Courses Management', 'wwtcourses' ),
            __( 'Courses Management', 'wwtcourses' ),
            'manage_options',
            'wwtc_courses_management',
            array( $this, 'wwtc_courses_management_callback' )
        );
        add_submenu_page(
            'edit.php?post_type='.WWTC_POST_TYPE,
            __( 'Location States', 'wwtcourses' ),
            __( 'Location States', 'wwtcourses' ),
            'manage_options',
            'wwtc_courses_states',
            array( $this, 'wwtc_courses_states_callback' )
        );
        add_submenu_page(
            'edit.php?post_type='.WWTC_POST_TYPE,
            __( 'Discount Courses Management Book' , 'wwtcourses' ),
            __( 'Discount Courses Management Book', 'wwtcourses' ),
            'manage_options',
            'wwtc_discount_courses_management',
            array( $this, 'wwtc_discount_courses_management_callback' )
        );
    }

    function wwtc_register_settings() {
        register_setting( 'wwtc_courses_options', 'wwtc_courses_data', 'wwtc_validate_options' );
        register_setting( 'wwtc_courses_state_options', 'wwtc_location_states', 'wwtc_validate_state_options' );
        register_setting( 'wwtc_discount_courses_options', 'wwtc_discount_courses_data', 'wwtc_validate_options' );
    }

    /**
     * Admin Options Page
     * 
     * Handles to display settings for admin
     */
    public function wwtc_courses_management_callback(){
        
        //admin options page
        include_once( WWTC_ADMIN_DIR .'/forms/wwtc-courses-management.php');
    }

    public function wwtc_discount_courses_management_callback(){
        
        //admin options page
        include_once( WWTC_ADMIN_DIR .'/forms/wwtc-discount-courses-management.php');
    }

    /**
     * Admin Options Page
     * 
     * Handles add/edit/delete states for admin
     */
    public function wwtc_courses_states_callback(){
        
        //admin options page
        include_once( WWTC_ADMIN_DIR .'/forms/wwtc-courses-states.php');
    }

	/**
	 * Adding Hooks
	 *
	 * @package WWT Courses Management
	 * @since 1.0.0
	 */
	function add_hooks() {

        //register admin menu
        add_action ( 'admin_menu', array( $this, 'wwtc_add_admin_menu' ) );
        
        add_action( 'admin_init', array( $this, 'wwtc_register_settings') );

	}
}