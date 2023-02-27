<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// GETTER (will be sanitized)
function get_wwtc_location_state( $term_id ) {
  $value = get_term_meta( $term_id, '__wwtc_location_state', true );
  $value = sanitize_text_field( $value );
  return $value;
}

// fetch state name from state id
function wwtc_get_statename_from_id($sid)
{
	$statearr = get_option('wwtc_location_states');
	return $statearr[$sid];
}

// fetch location cities from term meta state
function wwtc_get_cities_by_state($state_id)
{
    $args_city = array(
        'hide_empty' => false, // also retrieve terms which are not used yet
        'meta_query' => array(
            array(
               'key'       => '__wwtc_location_state',
               'value'     => $state_id,
               'compare'   => 'LIKE'
            )
        ),
        'taxonomy'  => WWTC_TAXONOMY_LOCATION,
    );
    $terms_city = get_terms( $args_city );
    $terms_city_arr = array();
    if( !empty( $terms_city ) ){
        foreach($terms_city as $terms_city_new)
        {
            $terms_city_arr[$terms_city_new->term_id] = $terms_city_new->name;
        }
    }
    return $terms_city_arr;
}

// fetch course list
function wwtc_course_list()
{
    $args_courses = array(
                'post_type'     => WWTC_POST_TYPE,
                'post_status'   => 'publish',
                'orderby'       => 'date',
                'order'         => 'ASC',
                'posts_per_page'=> -1
            );
 
    $courses = new WP_Query( $args_courses );
    $course_arr = array();

    if( $courses->have_posts() ) {
        while( $courses->have_posts() ) {
            $courses->the_post();
            $course_arr[get_the_ID()] = get_the_title();
        }
        wp_reset_postdata();
    }
    return $course_arr;
}

// fetch course list HTML
function wwtc_location_list()
{
    $location_options_html = '<option value="" disabled selected>' . __( 'Select Location', 'wwtcourses' ) . '</option>';

    $wwtc_options = get_option( 'wwtc_courses_data' );

    $course_location_arr = array();
    if( !empty( $wwtc_options ) ){
        foreach($wwtc_options as $wwtc_option){
            if(!empty($wwtc_option['course']) && $wwtc_option['course_page']!= '')
            {
                $course_location_arr[] = $wwtc_option['location'];
            }
        }
    }

    $statearr = get_option('wwtc_location_states');
    if(!empty($statearr)){

        foreach($statearr as $state_key => $state_value){

            $location_options_html .= '<optgroup label="'.$state_value.'">';

            $city_list = wwtc_get_cities_by_state($state_key);
            if(!empty($city_list)){
                foreach($city_list as $city_key => $city_value){

                    if(!in_array($city_key, $course_location_arr)){
                        $disabled_location = " disabled";
                    }else {
                        $disabled_location = "";
                    }

                    $location_options_html .= '<option value="'.$city_key.'" '.$disabled_location.'>'.$city_value.'</option>';
                }
            }
            $location_options_html .= '</optgroup>';
        }
    }

    return $location_options_html;
}


function wwtc_validate_options($input)
{
    $data = array();
    foreach($input as $key => $val){ 
        if($key == 'default_course_iframe'){
            $data['default_course_iframe'] = $input['default_course_iframe'];       
        }
        if(!empty($val['course'])){
            $data[] = $val; 
        }
    }
    return $data;
}
function wwtc_validate_state_options($input)
{
    $data = array();
    foreach($input as $key => $val){
        if(!empty($val)){
            $data[$key] = $val; 
        }
    }
    return $data;
}
?>