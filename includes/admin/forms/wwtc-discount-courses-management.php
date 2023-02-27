<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */

$wwtc_options = get_option( 'wwtc_discount_courses_data' );
$wwtc_option_default_iframe = '';

$data = array();
if( !empty( $wwtc_options ) ){
	
	$wwtc_option_default_iframe = $wwtc_options['default_course_iframe'];   
	foreach($wwtc_options as $key => $val){ 
	    if($key == 'default_course_iframe'){
	    	 unset($wwtc_options['default_course_iframe']); 
	    }else {
	        $wwtc_options[$key] = $val; 
	    }
	}
}
if(!empty($wwtc_options)) {
	$total = count($wwtc_options);
} else {
	$total = 0;
}
$wwtc_courses_list = wwtc_course_list();

?> 
<!-- . begining of wrap -->
<div class="wrap">
	<?php
		echo "<h2>" . __('Discount Courses Management', 'wwtcourses' ) . "</h2>";	
	
	// settings reset	
	 if( isset( $_GET['settings-updated'] ) && !empty( $_GET['settings-updated'] ) ) { // Check settings updated or not
		
		echo '<div id="message" class="updated fade notice is-dismissible"><p><strong>' . __( 'Changes Saved Successfully.', 'wwtcourses' ) . '</strong></p></div>'; 
	 }

	?>
	
	<!-- beginning of the plugin options form -->
	<form method="POST" action="<?php echo admin_url('options.php');?>" id="wwtc-settings-form">

	<?php settings_fields( 'wwtc_discount_courses_options' ); ?>
		<!-- beginning of the general settings meta box -->
		<div id="wwtc-general-settings" class="post-box-container">
			<div class="metabox-holder">	
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">	
						<div class="inside">
							<table class="form-table wwtc_default_iframe_table">
								<tbody>
									<tr>
										<th><?php _e( 'Default Shortcode', 'wwtcourses' ); ?></th>
										<td>
											<textarea name="wwtc_discount_courses_data[default_course_iframe]" id="wwtc_default_course_iframe" class="wwtc_default_course_iframe" placeholder="<?php _e( 'Default Shortcode', 'wwtcourses' ); ?>"><?php echo $wwtc_option_default_iframe; ?></textarea>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="form-table wwtc_course_table">
								<tbody>
									<tr>
										<th><?php _e( 'Course', 'wwtcourses' ); ?></th>
										<th><?php _e( 'Location', 'wwtcourses' ); ?></th>
										<th><?php _e( 'Course Page', 'wwtcourses' ); ?></th>
										<th><?php _e( 'Course Shortcode', 'wwtcourses' ); ?></th>
									</tr>
									<?php if($total>0){
											$i=0;
											foreach($wwtc_options as $wwtc_option) {
												$wwtc_option_course = $wwtc_option['course'];
												$wwtc_option_location = $wwtc_option['location'];
												$wwtc_option_course_page = $wwtc_option['course_page'];
												$wwtc_option_course_iframe = $wwtc_option['course_iframe'];
									?>
										<tr>
											<td>
												<select name="wwtc_discount_courses_data[<?php echo $i; ?>][course]" id="wwtc_course" class="wwtc_select_course" data-id="<?php echo $i; ?>">
													<option value=""><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
													<?php
													if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
									                    foreach($wwtc_courses_list as $key => $course_value){
									                        $selected = ($key == $wwtc_option_course) ? ' selected="" ' : '';
									                ?>
									                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php _e( $course_value, 'wwtcourses' ); ?></option>
									                <?php } } ?>
												</select>
											</td>							
											<td>
												<select name="wwtc_discount_courses_data[<?php echo $i; ?>][location]" id="wwtc_booking_location" class="wwtc_select_location" data-id="<?php echo $i; ?>">
													<option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
													<?php
									                    $statearr = get_option('wwtc_location_states');
									                    if( !empty( $statearr ) ){
										                    foreach($statearr as $state_key => $state_value){
										                ?>
										                	<optgroup label="<?php echo $state_value; ?>">
										                		<?php
												                    $city_list = wwtc_get_cities_by_state($state_key);
												                    foreach($city_list as $city_key => $city_value){
												                        $city_selected = ($city_key == $wwtc_option_location) ? ' selected="" ' : '';
												                ?>
										                    		<option value="<?php echo $city_key; ?>" <?php echo $city_selected; ?>><?php _e( $city_value, 'wwtcourses' ); ?></option>
										                    	<?php } ?>
										                    </optgroup>
										            <?php } } ?>
												</select>
											</td>
											<td>
												<?php $fetch_pages = get_pages(); ?>
												<select name="wwtc_discount_courses_data[<?php echo $i; ?>][course_page]" id="wwtc_course_page" class="wwtc_select_course_page multiselect" data-id="<?php echo $i; ?>">
													<option value=""><?php _e( 'Select Page', 'wwtcourses' ); ?></option>
													<?php
														if(!empty($fetch_pages)) {
															foreach ( $fetch_pages as $page ) {
																$course_page_selected = ($page->ID == $wwtc_option_course_page) ? ' selected="" ' : '';				
																$option = '<option value="' . $page->ID . '" ' . $course_page_selected . '>';
																$option .= $page->post_title;
																$option .= '</option>';
																echo $option;
															}
														}
													?>
												</select>
											</td>
											<td class="course_iframe_td">
												<textarea name="wwtc_discount_courses_data[<?php echo $i; ?>][course_iframe]" id="wwtc_course_iframe" class="wwtc_select_course_iframe" data-id="<?php echo $i; ?>" placeholder="<?php _e( 'Course Shortcode', 'wwtcourses' ); ?>"><?php echo $wwtc_option_course_iframe; ?></textarea>
											</td>
											<td>
												<a href="javascript:void(0);" class="remove_button"><?php _e( 'Remove', 'wwtcourses' ); ?></a>
											</td>
										</tr>
									<?php $i++; } } ?>
									<?php $next_id = $total; ?>
									 <tr class="tr_clone" data-id="<?php echo $next_id; ?>">
										<td>
											<select name="wwtc_discount_courses_data[<?php echo $next_id; ?>][course]" id="wwtc_course" class="wwtc_select_course" data-id="<?php echo $next_id; ?>">
												<option value=""><?php _e( 'Select Course', 'wwtcourses' ); ?></option>
												<?php
												if( is_array($wwtc_courses_list) && !empty($wwtc_courses_list) ){
								                    foreach($wwtc_courses_list as $key => $course_value){
								                ?>
								                    <option value="<?php echo $key; ?>"><?php _e( $course_value, 'wwtcourses' ); ?></option>
								                <?php } } ?>
											</select>
										</td>
										<td>
											<select name="wwtc_discount_courses_data[<?php echo $next_id; ?>][location]" id="wwtc_booking_location" class="wwtc_select_location" disabled="" data-id="<?php echo $next_id; ?>">
												<option value=""><?php _e( 'Select Location', 'wwtcourses' ); ?></option>
												<?php
								                    $statearr = get_option('wwtc_location_states');
								                    if( !empty( $statearr ) ) {
									                    foreach($statearr as $state_key => $state_value){
									                ?>
									                	<optgroup label="<?php echo $state_value; ?>">
									                		<?php
											                    $city_list = wwtc_get_cities_by_state($state_key);
											                    foreach($city_list as $city_key => $city_value){
											                ?>
									                    		<option value="<?php echo $city_key; ?>"><?php _e( $city_value, 'wwtcourses' ); ?></option>
									                    	<?php } ?>
									                    </optgroup>
								                <?php } } ?>
											</select>
										</td>
										<td>
											<?php $fetch_pages = get_pages(); ?>
											<select name="wwtc_discount_courses_data[<?php echo $next_id; ?>][course_page]" id="wwtc_course_page" class="wwtc_select_course_page multiselect" disabled="" data-id="<?php echo $next_id; ?>">
												<option value=""><?php _e( 'Select Page', 'wwtcourses' ); ?></option>
												<?php
													if(!empty($fetch_pages)) {
														foreach ( $fetch_pages as $page ) {
															$option = '<option value="' . $page->ID . '">';
															$option .= $page->post_title;
															$option .= '</option>';
															echo $option;
														}
													}
												?>
											</select>
										</td>
										<td>
											<textarea name="wwtc_discount_courses_data[<?php echo $next_id; ?>][course_iframe]" id="wwtc_course_iframe" class="wwtc_select_course_iframe" disabled="" data-id="<?php echo $next_id; ?>" placeholder="<?php _e( 'Course Shortcode', 'wwtcourses' ); ?>"></textarea>
										</td>
										<td>
											<a href="javascript:void(0);" class="add_button" id=""><?php _e( 'Add', 'wwtcourses' ); ?></a>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="hidden" name="row_id" id="row_id" value="<?php echo $total+1; ?>">
											<input type="submit" id="wwtc-settings-submit" name="wwtc_settings_submit" class="button-primary" value="<?php _e('Save Changes', 'wwtcourses' );?>" />
										</td>
									</tr>
								</tbody>
							 </table>
						</div><!-- .inside -->
					</div><!-- #api -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->			
		</div>		
	</form>
</div>