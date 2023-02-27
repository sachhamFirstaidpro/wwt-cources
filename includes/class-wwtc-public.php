<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Public Class
 *
 * Manage Public Class
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */

class WWTC_Public {

    public $scripts;

    //class constructor
    function __construct() {

        global $wwtc_scripts;
        $this->scripts = $wwtc_scripts;
    }

    /**
     * Shortcode for Course Booking
     * 
     */
    public function wwtc_course_booking_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking booking-form-main">
                <form name="course_booking_frm" id="course_booking_frm" method="post">
                    <div id="wwtc_courses_main" class="wwtc_courses_main">
                        <div id="wwtc_courses_field" class="wwtc_courses_field">
                            <select name="wwtc_course" id="wwtc_course" class="wwtc_select_course">
                                <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                <?php
                                    if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                        foreach($wwtc_courses_list as $course_id => $course_value){
                                    ?>
                                    <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div id="wwtc_location_field" class="wwtc_courses_field">
                            <select name="wwtc_location" id="wwtc_location" class="wwtc_select_location" disabled="">
                                <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                            </select>
                        </div>
                        <div id="wwtc_button_field" class="wwtc_courses_field">
                            <button type="button" class="course-book-now-button"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>
                        </div>

                        <input type="hidden" name="wwtc_action_url" id="wwtc_action_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                    </div>
                </form>
            </div>
            <?php
            $result_course_booking = ob_get_clean();
            return $result_course_booking;        
    }

    /**
     * Shortcode for Course Booking
     * 
     */
    public function wwtc_discount_course_booking_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_discount_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking booking-form-main">
                <form name="course_booking_frm" id="course_booking_frm" method="post">
                    <div id="wwtc_courses_main" class="wwtc_courses_main">
                        <div id="wwtc_courses_field" class="wwtc_courses_field">
                            <select name="wwtc_course" id="wwtc_discount_course" class="wwtc_select_course">
                                <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                <?php
                                    if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                        foreach($wwtc_courses_list as $course_id => $course_value){
                                    ?>
                                    <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div id="wwtc_location_field" class="wwtc_courses_field">
                            <select name="wwtc_location" id="wwtc_location1" class="wwtc_select_location" disabled="">
                                <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                            </select>
                        </div>
                        <div id="wwtc_button_field" class="wwtc_courses_field">
                            <button type="button" class="course-book-now-button"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>
                        </div>

                        <input type="hidden" name="wwtc_action_url" id="wwtc_action_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                    </div>
                </form>
            </div>
            <?php
            $result_course_booking = ob_get_clean();
            return $result_course_booking;        
    }

    /**
     * Shortcode for Course Booking
     * 
     */
    public function wwtc_course_booking_location_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        // $wwtc_options = get_option( 'wwtc_courses_data' );
        $wwtc_location_list = wwtc_location_list();
        ?>
            <div class="course_booking booking-form-main">
                <form name="course_booking_frm" id="course_booking_frm" method="post">
                    <div id="wwtc_courses_main" class="wwtc_courses_main">
                        <div id="wwtc_location_field" class="wwtc_courses_field">
                            <select name="wwtc_location_reverse" id="wwtc_location_reverse" class="wwtc_select_location_reverse">
                                <?= $wwtc_location_list ?>
                            </select>
                        </div>
                        <div id="wwtc_courses_field" class="wwtc_courses_field">
                            <select name="wwtc_course_reverse" id="wwtc_course_reverse" class="wwtc_select_course" disabled="">
                                <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                            </select>
                        </div>
                        <div id="wwtc_button_field" class="wwtc_courses_field">
                            <button type="button" class="course-book-now-button"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>
                        </div>

                        <input type="hidden" name="wwtc_action_url_reverse" id="wwtc_action_url_reverse" value="<?php echo admin_url('admin-ajax.php'); ?>">
                    </div>
                </form>
            </div>
            <?php
            $result_course_booking = ob_get_clean();
            return $result_course_booking;        
    }
    
    /**
     * Fetch location data from selected course
     * 
     */
    public function wwtc_locations_from_course()
    {
        $course_id = $_POST['course_id'];
        $flag = $_POST['flag'];

        $location_options_html = '<option value="" disabled selected>' . __( 'Select Location', 'wwtcourses' ) . '</option>';

        $wwtc_options = get_option( 'wwtc_courses_data' );

        $course_location_arr = array();
        if( !empty( $wwtc_options ) ){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option[$flag]!= '')
                {
                    $course_location_arr[] = $wwtc_option['location'];
                }
            }
        }

        $statearr = get_option('wwtc_location_states');
        
        if(!empty($statearr)){

            foreach($statearr as $state_key => $state_value){

                $city_exist = $this->wwtc_get_cities_by_state_exist($state_key, $course_location_arr);
                if(!empty($city_exist)){
                    $location_options_html .= '<optgroup label="'.$state_value.'">';

                    $city_list = wwtc_get_cities_by_state($state_key);
                    if(!empty($city_list)){
                        foreach($city_list as $city_key => $city_value){

                            if(!in_array($city_key, $course_location_arr)){
                                $disabled_location = " disabled";
                            }else {
                                $disabled_location = "";
                            }
                            if(empty($disabled_location)){
                                $location_options_html .= '<option value="'.$city_key.'" '.$disabled_location.' data-cid="'.$course_id.'">'.$city_value.'</option>';    
                            }                            
                        }
                    }
                    $location_options_html .= '</optgroup>';
                }
            }
        }

        echo $location_options_html;
        die;
    }

    public function wwtc_get_cities_by_state_exist($state_key , $course_location_arr){
        $city_list = wwtc_get_cities_by_state($state_key);
        $exist = array();
        if(!empty($city_list)){
            foreach($city_list as $city_key => $city_value){

                if(!in_array($city_key, $course_location_arr)){
                    $disabled_location = " disabled";
                }else {
                    $disabled_location = "";
                }
                if(empty($disabled_location)){
                   $exist[] = 1; 
                }
                
            }
        }
        return $exist;
    }

     /**
     * Fetch location data from selected course
     * 
     */
    public function wwtc_discount_locations_from_course()
    {
        $course_id = $_POST['course_id'];
        $flag = $_POST['flag'];

        $location_options_html = '<option value="" disabled selected>' . __( 'Select Location', 'wwtcourses' ) . '</option>';

        $wwtc_options = get_option( 'wwtc_discount_courses_data' );

        $course_location_arr = array();
        if( !empty( $wwtc_options ) ){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option[$flag]!= '')
                {
                    $course_location_arr[] = $wwtc_option['location'];
                }
            }
        }

        $statearr = get_option('wwtc_location_states');
        if(!empty($statearr)){

            foreach($statearr as $state_key => $state_value){
                $city_exist = $this->wwtc_get_cities_by_state_exist($state_key, $course_location_arr);
                if(!empty($city_exist)){
                    $location_options_html .= '<optgroup label="'.$state_value.'">';

                    $city_list = wwtc_get_cities_by_state($state_key);
                    if(!empty($city_list)){
                        foreach($city_list as $city_key => $city_value){

                            if(!in_array($city_key, $course_location_arr)){
                                $disabled_location = " disabled";
                            }else {
                                $disabled_location = "";
                            }
                            if(empty($disabled_location)){
                                $location_options_html .= '<option value="'.$city_key.'" '.$disabled_location.' data-cid="'.$course_id.'">'.$city_value.'</option>';
                            }
                        }
                    }
                    $location_options_html .= '</optgroup>';
                }
            }
        }

        echo $location_options_html;
        die;
    }

    /**
     * Fetch course data from selected location
     * 
     */
    public function wwtc_course_from_locations()
    {
        $location_id = $_POST['location_id'];
        $flag = $_POST['flag'];

        $course_options_html = '<option value="" disabled selected>' . __( 'Select Course', 'wwtcourses' ) . '</option>';

        $wwtc_options = get_option( 'wwtc_courses_data' );

        $course_location_arr = array();
        if( !empty( $wwtc_options ) ){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['location'] == $location_id)
                {
                    $course_location_arr[] = $wwtc_option['course'];
                }
            }
        }

        $getCourses = wwtc_course_list();
        foreach($getCourses as $course_id => $course){
            if(in_array($course_id,$course_location_arr)){
                $course_options_html .= '<option value="'.$course_id.'" >'.$course.'</option>';
            }
        }
        echo $course_options_html;
        die;
    }

    /**
     * Fetch course pages from selected course and location
     * 
     */
    public function wwtc_coursepage_from_location()
    {
        $course_id = $_POST['course_id'];
        $location_id = $_POST['location_id'];
        
        $wwtc_options = get_option( 'wwtc_courses_data' );
        if(!empty($wwtc_options)){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option['location'] == $location_id && $wwtc_option['course_page']!= '')
                {
                    $course_page = $wwtc_option['course_page'];
                }
            }
        }
        echo get_permalink($course_page);
        die;
    }

       /**
     * Fetch course pages from selected course and location
     * 
     */
    public function wwtc_discount_coursepage_from_location()
    {
        $course_id = $_POST['course_id'];
        $location_id = $_POST['location_id'];
        
        $wwtc_options = get_option( 'wwtc_discount_courses_data' );
        if(!empty($wwtc_options)){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option['location'] == $location_id && $wwtc_option['course_page']!= '')
                {
                    $course_page = $wwtc_option['course_page'];
                }
            }
        }
        echo get_permalink($course_page);
        die;
    }
    /**
     * Fetch course pages from selected course and location
     * 
     */
    public function wwtc_course_iframe_from_location()
    {
        $course_id = $_POST['course_id'];
        $location_id = $_POST['location_id'];
        
        $wwtc_options = get_option( 'wwtc_courses_data' );
        if(!empty($wwtc_options)){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option['location'] == $location_id && $wwtc_option['course_iframe']!= '' )
                {
                    $course_iframe = $wwtc_option['course_iframe'];
                }
            }
        }
        echo do_shortcode( $course_iframe );
        die;
    }

    public function wwtc_discount_course_iframe_from_location()
    {
        $course_id = $_POST['course_id'];
        $location_id = $_POST['location_id'];
        
        $wwtc_options = get_option( 'wwtc_discount_courses_data' );
            if(!empty($wwtc_options)){
            foreach($wwtc_options as $wwtc_option){
                if($wwtc_option['course'] == $course_id && $wwtc_option['location'] == $location_id && $wwtc_option['course_iframe']!= '' )
                {
                    $course_iframe = $wwtc_option['course_iframe'];
                }
            }
        }
        echo do_shortcode( $course_iframe );
        die;
    }

    /**
     * Shortcode for Book Now button and popup
     * 
     */
    public function wwtc_course_booknow_button_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking book-now-main">

                <button type="button" class="book-now-button" data-toggle="modal" data-target="#BookNowButtonModal"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>

                <div class="modal fade course-modal" id="BookNowButtonModal" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <?php _e( 'Course Calendar', 'wwtcourses' ); ?>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="wwtc_booking_shortcode">
                                    <div class="course_booking">
                                        <form name="course_booking_frm" id="course_booking_frm" method="post">
                                            <div id="wwtc_courses_main" class="wwtc_courses_main">
                                                <div id="wwtc_courses_field" class="wwtc_courses_field">
                                                    <select name="wwtc_course" id="wwtc_course" class="wwtc_select_course">
                                                        <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                                        <?php
                                                            if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                                                foreach($wwtc_courses_list as $course_id => $course_value){
                                                            ?>
                                                            <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <div id="wwtc_location_field" class="wwtc_courses_field">
                                                    <select name="wwtc_location" id="wwtc_location" class="wwtc_select_location" disabled="">
                                                        <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="wwtc_action_url" id="wwtc_action_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

            </div>
            <?php
            $result_booknow_button = ob_get_clean();
            return $result_booknow_button;      
    }

    /**
     * Shortcode for Book Now button and popup discount code
     * 
     */
    public function wwtc_discount_course_booknow_button_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_discount_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking book-now-main">

                <button type="button" class="book-now-button discount-book-now-button" data-toggle="modal" data-target="#BookNowButtonModaldiscount"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>

                <div class="modal fade course-modal" id="BookNowButtonModaldiscount" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <?php _e( 'Course Calendar', 'wwtcourses' ); ?>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="wwtc_booking_shortcode">
                                    <div class="course_booking">
                                        <form name="course_booking_frm" id="course_booking_frm" method="post">
                                            <div id="wwtc_courses_main" class="wwtc_courses_main">
                                                <div id="wwtc_courses_field" class="wwtc_courses_field">
                                                    <select name="wwtc_course" id="wwtc_discount_course" class="wwtc_select_course">
                                                        <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                                        <?php
                                                            if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                                                foreach($wwtc_courses_list as $course_id => $course_value){
                                                            ?>
                                                            <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <div id="wwtc_location_field" class="wwtc_courses_field">
                                                    <select name="wwtc_location" id="wwtc_location1" class="wwtc_select_location" disabled="">
                                                        <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="wwtc_action_url" id="wwtc_action_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

            </div>
            <?php
            $result_booknow_button = ob_get_clean();
            return $result_booknow_button;      
    }

    public function wwtc_course_booknow_button_location_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        // $wwtc_options = get_option( 'wwtc_courses_data' );
        $wwtc_location_list = wwtc_location_list();
        ?>
            <div class="course_booking book-now-main">

                <button type="button" class="book-now-button" data-toggle="modal" data-target="#BookNowButtonModalReverse"><?php _e( 'BOOK NOW', 'wwtcourses' ); ?></button>

                <div class="modal fade course-modal" id="BookNowButtonModalReverse" role="dialog">
                    <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <?php _e( 'Course Calendar', 'wwtcourses' ); ?>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="wwtc_booking_shortcode">
                                    <div class="course_booking">
                                        <form name="course_booking_frm" id="course_booking_frm" method="post">
                                            <div id="wwtc_courses_main" class="wwtc_courses_main">
                                                <div id="wwtc_location_field" class="wwtc_courses_field">
                                                    <select name="wwtc_location_reverse_popup" id="wwtc_location_reverse_popup" class="wwtc_select_location_reverse">
                                                        <?= $wwtc_location_list ?>
                                                    </select>
                                                </div> 
                                                <div id="wwtc_courses_field" class="wwtc_courses_field">
                                                    <select name="wwtc_course_reverse_popup" id="wwtc_course_reverse_popup" class="wwtc_select_course" disabled="">
                                                        <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="wwtc_action_url_reverse_popup" id="wwtc_action_url_reverse_popup" value="<?php echo admin_url('admin-ajax.php'); ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

            </div>
            <?php
            $result_booknow_button = ob_get_clean();
            return $result_booknow_button;      
    }

    /**
     * Shortcode for Course Iframe
     * 
     */
    public function wwtc_course_iframe_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking booking-iframe-main">
                <form name="course_booking_frm" id="course_booking_frm" method="post">
                    <div id="wwtc_courses_main" class="wwtc_courses_main">
                        <div id="wwtc_courses_field" class="wwtc_courses_field">
                            <select name="wwtc_course" id="wwtc_course" class="wwtc_select_course">
                                <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                <?php
                                    if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                        foreach($wwtc_courses_list as $course_id => $course_value){
                                    ?>
                                    <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div id="wwtc_location_field" class="wwtc_courses_field">
                            <select name="wwtc_location" id="wwtc_location" class="wwtc_select_location" disabled="">
                                <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                            </select>
                        </div>
                        <input type="hidden" name="wwtc_action_url" id="wwtc_action_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                    </div>
                </form>
                <?php if( !empty( $wwtc_options ) ){
                    $wwtc_option_default_iframe = $wwtc_options['default_course_iframe']; ?>
                    <div id="show_course_iframe"><?php if(!empty($wwtc_option_default_iframe)) { echo do_shortcode( $wwtc_option_default_iframe ); } ?></div>
                <?php } ?>
            </div><?php
            
            $result_course_booking_iframe = ob_get_clean();
            return $result_course_booking_iframe;        
    }

     /**
     * Shortcode for discount Course Iframe
     * 
     */
    public function wwtc_discount_course_iframe_callback( $atts ) {

        ob_start();

        // define attributes and their defaults
        extract( shortcode_atts( array (), $atts ) );

        $this->scripts->wwtc_enqueue_front_scripts();

        $wwtc_options = get_option( 'wwtc_discount_courses_data' );
        $wwtc_courses_list = wwtc_course_list();
        ?>
            <div class="course_booking booking-iframe-main-discount">
                <form name="course_booking_frm" id="course_booking_frm1" method="post">
                    <div id="wwtc_courses_main" class="wwtc_courses_main">
                        <div id="wwtc_courses_field1" class="wwtc_courses_field">
                            <select name="wwtc_course" id="wwtc_course1" class="wwtc_select_course">
                                <option value="" disabled selected><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
                                <?php
                                    if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
                                        foreach($wwtc_courses_list as $course_id => $course_value){
                                    ?>
                                    <option value="<?php echo $course_id; ?>"><?php _e( $course_value ); ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div id="wwtc_location_field" class="wwtc_courses_field">
                            <select name="wwtc_location" id="wwtc_location1" class="wwtc_select_location" disabled="">
                                <option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
                            </select>
                        </div>
                        <input type="hidden" name="wwtc_action_url" id="wwtc_action_url1" value="<?php echo admin_url('admin-ajax.php'); ?>">
                    </div>
                </form>
                <?php if( !empty( $wwtc_options ) ){
                    $wwtc_option_default_iframe = $wwtc_options['default_course_iframe']; ?>
                    <div id="show_course_iframe1"><?php if(!empty($wwtc_option_default_iframe)) { echo do_shortcode( $wwtc_option_default_iframe ); } ?></div>
                <?php } ?>
            </div>
        <?php
            $result_course_booking_iframe = ob_get_clean();
            return $result_course_booking_iframe;        
    }
    /**
     * Adding Hooks
     *
     * @package WWT Courses Management
     * @since 1.0.0
     */
    function add_hooks() {

        // shortcode for course booking
        add_shortcode( WWTC_SHORTCODE, array( $this, 'wwtc_course_booking_callback') );
        add_shortcode( WWTC_REVERSE_SHORTCODE, array( $this, 'wwtc_course_booking_location_callback') );
        add_shortcode( WWTC_DISCOUNT_SHORTCODE, array( $this, 'wwtc_discount_course_booking_callback') );
        // fetch locations from selected course
        add_action("wp_ajax_get_course_locations" , array( $this, 'wwtc_locations_from_course') );
        add_action("wp_ajax_nopriv_get_course_locations" , array( $this, 'wwtc_locations_from_course') );
        add_action("wp_ajax_get_discount_course_locations" , array( $this, 'wwtc_discount_locations_from_course') );
        add_action("wp_ajax_nopriv_get_discount_course_locations" , array( $this, 'wwtc_discount_locations_from_course') );

        // fetch locations from selected course
        add_action("wp_ajax_get_location_course" , array( $this, 'wwtc_course_from_locations') );
        add_action("wp_ajax_nopriv_get_location_course" , array( $this, 'wwtc_course_from_locations') );

        // fetch course_page from selected location
        add_action("wp_ajax_get_location_coursepage" , array( $this, 'wwtc_coursepage_from_location') );
        add_action("wp_ajax_nopriv_get_location_coursepage" , array( $this, 'wwtc_coursepage_from_location') );

        add_action("wp_ajax_get_discount_location_coursepage" , array( $this, 'wwtc_discount_coursepage_from_location') );
        add_action("wp_ajax_nopriv_get_discount_location_coursepage" , array( $this, 'wwtc_discount_coursepage_from_location') );

        // shortcode for course booking book now button
        add_shortcode( WWTC_BUTTON_SHORTCODE, array( $this, 'wwtc_course_booknow_button_callback') );
        add_shortcode( WWTC_DISCOUNT_BUTTON_SHORTCODE, array( $this, 'wwtc_discount_course_booknow_button_callback') );
        // shortcode for course booking book now button
        add_shortcode( WWTC_BUTTON_REVERSE_SHORTCODE, array( $this, 'wwtc_course_booknow_button_location_callback') );

        // shortcode for course booking iframe
        add_shortcode( WWTC_IFRAME_SHORTCODE, array( $this, 'wwtc_course_iframe_callback') );

        // shortcode for course booking iframe
        add_shortcode( WWTC_DISCOUNT_IFRAME_SHORTCODE, array( $this, 'wwtc_discount_course_iframe_callback') );

        // fetch course_iframe from selected location
        add_action("wp_ajax_get_location_course_iframe" , array( $this, 'wwtc_course_iframe_from_location') );
        add_action("wp_ajax_nopriv_get_location_course_iframe" , array( $this, 'wwtc_course_iframe_from_location') );


        // fetch course_iframe from selected location
        add_action("wp_ajax_get_discount_location_course_iframe" , array( $this, 'wwtc_discount_course_iframe_from_location') );
        add_action("wp_ajax_nopriv_get_discount_location_course_iframe" , array( $this, 'wwtc_discount_course_iframe_from_location') );

    }   
}