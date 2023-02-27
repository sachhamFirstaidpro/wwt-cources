<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */
class WWTC_Scripts {

    //class constructor
    function __construct() {        
    }

    /**
     * Enqueue Scripts on Admin Side
     * 
     */
    public function wwtc_admin_scripts( $hook_suffix ) {

        $needed_hook_suffix = array( 'wwtc_courses_page_wwtc_courses_management','wwtc_courses_page_wwtc_courses_states','wwtc_courses_page_wwtc_discount_courses_management' );

        //Check pages when you needed 
        if( in_array( $hook_suffix, $needed_hook_suffix ) ) {

            // add css for admin
            wp_register_style( 'wwtc-admin-style', WWTC_INC_URL . '/css/wwtc-admin-style.css', true, WWTC_VERSION .'.'.time()  );
            wp_enqueue_style( 'wwtc-admin-style' );

            //Register & Enqueue Script
            wp_register_script('wwtc-admin-script', WWTC_INC_URL . '/js/wwtc-admin-script.js', array('jquery' ), WWTC_VERSION .'.'.time(), true);
            wp_enqueue_script('wwtc-admin-script');

            // add js for select2
            wp_register_script('wwtc-select2-script', WWTC_INC_URL . '/js/select2.min.js', array(), WWTC_VERSION .'.'.time(), true);
            wp_enqueue_script('wwtc-select2-script');

            wp_register_style( 'wwtc-select2-style', WWTC_INC_URL . '/css/select2.css', true, WWTC_VERSION .'.'.time() );
            wp_enqueue_style( 'wwtc-select2-style' );

        }
    }
    
    /**
     * Register Scripts on front Side
     * 
     */
    public function wwtc_register_front_scripts() {

      wp_register_style( 'wwtc-front-style', WWTC_INC_URL . '/css/wwtc-front-style.css', true, WWTC_VERSION .'.'.time()  );

      wp_register_script('wwtc-front-script', WWTC_INC_URL . '/js/wwtc-front-script.js', array('jquery' ), WWTC_VERSION .'.'.time(), true);
      wp_register_style('wwtc-bootstrap-modal-style', WWTC_INC_URL . '/css/wwtc-bootstrap-modal.css');
      wp_register_script('wwtc-bootstrap-modal-script', WWTC_INC_URL . '/js/wwtc-bootstrap-modal.js');

    }

    /**
     * Enqueue Scripts on front Side
     * 
     */
    public function wwtc_enqueue_front_scripts() {
      wp_enqueue_style( 'wwtc-front-style' );
      wp_enqueue_script( 'wwtc-front-script' );
      wp_enqueue_style( 'wwtc-bootstrap-modal-style' );
      wp_enqueue_script( 'wwtc-bootstrap-modal-script' );
    }

    /**
     * Adding Hooks
     *
     * Adding hooks for the styles and scripts.
     *
     * @package WWT Courses Management
     * @since 1.0.0
     */
    function add_hooks() {

        //add admin scripts
        add_action('admin_enqueue_scripts', array($this, 'wwtc_admin_scripts'));

        // add front scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'wwtc_register_front_scripts' ) );
    }
}
?>