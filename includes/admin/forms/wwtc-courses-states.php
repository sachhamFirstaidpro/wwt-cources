<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page
 *
 * @package WWT Courses Management
 * @since 1.0.0
 */

$wwtc_location_states = get_option( 'wwtc_location_states' );
if(!empty($wwtc_location_states)) {
	$total = count($wwtc_location_states);
} else {
	$total = 0;
}
?> 
<!-- . begining of wrap -->
<div class="wrap">
	<?php
		echo "<h2>" . __('State Management', 'wwtcourses' ) . "</h2>";	
	
	// settings reset	
	 if( isset( $_GET['settings-updated'] ) && !empty( $_GET['settings-updated'] ) ) { // Check settings updated or not
		
		echo '<div id="message" class="updated fade notice is-dismissible"><p><strong>' . __( 'Changes Saved Successfully.', 'wwtcourses' ) . '</strong></p></div>'; 
	 }
	?>
	
	<!-- beginning of the plugin options form -->
	<form method="POST" action="<?php echo admin_url('options.php');?>" id="wwtc-settings-form">

	<?php settings_fields( 'wwtc_courses_state_options' ); ?>
		<!-- beginning of the general settings meta box -->
		<div id="wwtc-general-settings" class="post-box-container">
			<div class="metabox-holder">	
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">	
						<div class="inside">
							<table class="form-table wwtc_course_state_table">
								<tbody>
									<?php if($total>0){
									$i=0;
									$state_id_arr = array();
									foreach($wwtc_location_states as $state_key => $state_value){
										$state_id = $state_key;
										$state_name = $state_value;
										$state_id_arr[] = $state_id; 
									?>
										<tr>
											<td>
												<input name="wwtc_location_states[<?php echo $state_id; ?>]" id="wwtc_course_state" class="wwtc_course_state" data-id="<?php echo $state_id; ?>" placeholder="<?php _e( 'State', 'wwtcourses' ); ?>" value="<?php echo $state_name; ?>">
											</td>
											<td>
												<a href="javascript:void(0);" class="remove_button_state">Remove</a>
											</td>
										</tr>
									<?php $i++; } } ?>
									<?php $max_stateid = max($state_id_arr); $next_id = ($max_stateid+1); ?>
									 <tr class="tr_clone" data-id="<?php echo $next_id; ?>">
										<td>
											<input name="wwtc_location_states[<?php echo $next_id; ?>]" id="wwtc_course_state" class="wwtc_course_state" data-id="<?php echo $next_id; ?>" placeholder="<?php _e( 'State', 'wwtcourses' ); ?>">
										</td>
										<td>
											<a href="javascript:void(0);" class="add_button_state" id=""><?php _e( 'Add', 'wwtcourses' ); ?></a>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="hidden" name="row_id" id="row_id" value="<?php echo ($next_id+1); ?>">
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