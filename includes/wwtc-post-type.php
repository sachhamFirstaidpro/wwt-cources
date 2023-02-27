<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//creating custom post type
add_action( 'init', 'wwtc_courses_post_type'); //creating custom post

/**
 * Register Courses Post Type
 *
 * Register Custom Post Type for managing registered taxonomy
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */

function wwtc_courses_post_type() {  

    $labels = array(
        'name' => _x('Courses', 'post type general name', 'wwtcourses'),
        'singular_name' => _x('Course', 'post type singular name', 'wwtcourses'),
        'add_new' => _x('Add New', 'course', 'wwtcourses'),
        'add_new_item' => __('Add New Course', 'wwtcourses'),
        'edit_item' => __('Edit Course', 'wwtcourses'),
        'new_item' => __('New Course', 'wwtcourses'),
        'view_item' => __('View Course', 'wwtcourses'),
        'search_items' => __('Search Course', 'wwtcourses'),
        'not_found' =>  __('No course have been added yet', 'wwtcourses'),
        'not_found_in_trash' => __('Nothing found in Trash', 'wwtcourses'),
        'parent_item_colon' => ''
    );

    $args = array(  
        'labels' => $labels,  
        'public' => false,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'rewrite' => array( 'slug' => 'courses', 'with_front' => false ),
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'taxonomies' => array(WWTC_POST_TYPE)
       );  
    
    register_post_type( WWTC_POST_TYPE , $args );  

    add_action( 'in_admin_header', 'wwtc_courses_admin_header' );
}  

function wwtc_courses_admin_header() {
    global $wp_meta_boxes;
    unset( $wp_meta_boxes[get_current_screen()->id]['side']['core']['wwtc_courses_locationdiv'] );
}

//add categories add/update/delete of wordpress without any extra tables
add_action('init','wwtc_courses_taxonomy');

/**
 * Register Category/Taxonomy
 *
 * Register Category like wordpress
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */
function wwtc_courses_taxonomy()
{
    $location_labels = array(
        'name'              => _x( 'Courses Locations', 'taxonomy general name', 'wwtcourses' ),
        'singular_name'     => _x( 'Courses Locations', 'taxonomy singular name', 'wwtcourses' ),
        'search_items'      => __( 'Search Location', 'wwtcourses' ),
        'all_items'         => __( 'All Locations', 'wwtcourses' ),
        'parent_item'       => __( 'Parent Location', 'wwtcourses' ),
        'parent_item_colon' => __( 'Parent Location:', 'wwtcourses' ),
        'edit_item'         => __( 'Edit Location', 'wwtcourses' ),
        'update_item'       => __( 'Update Location', 'wwtcourses' ),
        'add_new_item'      => __( 'Add New Location', 'wwtcourses' ),
        'new_item_name'     => __( 'New Location', 'wwtcourses' ),
        'menu_name'         => __( 'Courses Locations', 'wwtcourses' ),
        'not_found'         => __( 'No locations found.', 'wwtcourses' ),
    );
	$location_args = array(
	    "labels" 						=> $location_labels, 
	    'public'                        => false,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	register_taxonomy( WWTC_TAXONOMY_LOCATION, WWTC_POST_TYPE, $location_args );
}

// ADD FIELD TO CATEGORY TERM PAGE
add_action( WWTC_TAXONOMY_LOCATION.'_add_form_fields', 'add_form_field_wwtc_location_state' );

function add_form_field_wwtc_location_state() { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'wwtc_location_state_nonce' ); ?>
    <div class="form-field term-meta-text-wrap">
        <label for="term-meta-text"><?php _e( 'State', 'wwtcourses' ); ?></label>
        <select name="wwtc_location_state" id="wwtc_location_state">
			<option value=""><?php _e( 'Select State', 'wwtcourses' ); ?></option>
            <?php
                $statearr = get_option('wwtc_location_states');
                if( !empty( $statearr ) ){
                    foreach($statearr as $key => $value){
                ?>
                    <option value="<?php echo $key; ?>"><?php _e( $value, 'wwtcourses' ); ?></option>
                <?php } } ?>
		</select>
    </div>
<?php }

// ADD FIELD TO CATEGORY EDIT PAGE
add_action( WWTC_TAXONOMY_LOCATION.'_edit_form_fields', 'edit_form_field_wwtc_location_state' );

function edit_form_field_wwtc_location_state( $term ) {

    $wwtc_location_state_value  = get_wwtc_location_state( $term->term_id );

    if ( ! $wwtc_location_state_value )
        $wwtc_location_state_value = ""; ?>

    <tr class="form-field term-meta-text-wrap">
        <th scope="row"><label for="term-meta-text"><?php _e( 'State', 'wwtcourses' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'wwtc_location_state_nonce' ); ?>
            <select name="wwtc_location_state" id="wwtc_location_state">
				<option value=""><?php _e( 'Select State', 'wwtcourses' ); ?></option>
				<?php
                    $statearr = get_option('wwtc_location_states');
                    if( !empty( $statearr ) ){
                        foreach($statearr as $key => $value){
                            $selected = ($key == $wwtc_location_state_value) ? ' selected="" ' : '';
                    ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php _e( $value, 'wwtcourses' ); ?></option>
                    <?php } } ?>
			</select>
        </td>
    </tr>
<?php }

// SAVE TERM META (on term edit & create)
add_action( 'edit_'.WWTC_TAXONOMY_LOCATION,   'save_wwtc_location_state' );
add_action( 'create_'.WWTC_TAXONOMY_LOCATION, 'save_wwtc_location_state' );

function save_wwtc_location_state( $term_id ) {

    // verify the nonce --- remove if you don't care
    if ( ! isset( $_POST['wwtc_location_state_nonce'] ) || ! wp_verify_nonce( $_POST['wwtc_location_state_nonce'], basename( __FILE__ ) ) )
        return;

    $old_value  = get_wwtc_location_state( $term_id );
    $new_value = isset( $_POST['wwtc_location_state'] ) ? sanitize_text_field( $_POST['wwtc_location_state'] ) : '';

    if ( $old_value && '' === $new_value )
        delete_term_meta( $term_id, '__wwtc_location_state' );

    else if ( $old_value !== $new_value )
        update_term_meta( $term_id, '__wwtc_location_state', $new_value );
}

// MODIFY COLUMNS (add our meta to the list)
add_filter( 'manage_edit-'.WWTC_TAXONOMY_LOCATION.'_columns', 'edit_term_columns', 10, 3 );
function edit_term_columns( $columns ) {

    $columns['__wwtc_location_state'] = __( 'State', 'wwtcourses' );
    return $columns;
}

// RENDER COLUMNS (render the meta data on a column)
add_filter( 'manage_'.WWTC_TAXONOMY_LOCATION.'_custom_column', 'manage_term_custom_column', 10, 3 );
function manage_term_custom_column( $out, $column, $term_id ) {

    if ( '__wwtc_location_state' === $column ) {
        $value  = get_wwtc_location_state( $term_id );
        $statenm = wwtc_get_statename_from_id($value);
        if ( ! $value )
            $statenm = '-';
        $out = sprintf( '<span class="term-meta-text-block" style="" >%s</div>', esc_attr( $statenm ) );
    }
    return $out;
}
?>