<?php

	/*	---------------------------------------------------------------------	* 
	 *	Initialization
	 *	---------------------------------------------------------------------	*/

	// Custom Meta Box
	add_action( 'add_meta_boxes', 'vsip_project_add_meta');

	// Save Meta Data
	add_action('save_post', 'vsip_post_save_data');

	/*	---------------------------------------------------------------------	* 
	 *	Custom Project Meta Box
	 *	---------------------------------------------------------------------	*/

	// Field Array
	$prefix = 'vsip_';

	$vsip_post_meta_box = array(
		'id' => 'vsip-post-meta-box',
		'title' => __('Custom Meta', 'framework'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => __('Custom Input One: ', 'framework'),
				'desc' => __('Enter your custom meta 1', 'framework'),
				'id' => $prefix.'custom_one',
				'type' => 'text'
			),
			array(
				'name' => __('Custom Input Two: ', 'framework'),
				'desc' => __('Enter your custom meta 2', 'framework'),
				'id' => $prefix.'custom_two',
				'type' => 'text'
			),
		)
	);

	/*	---------------------------------------------------------------------	* 
	 *	Create / Add Meta Box
	 *	---------------------------------------------------------------------	*/

	// Custom Meta Box
	add_action( 'add_meta_boxes', 'vsip_project_add_meta');

	function vsip_project_add_meta()
	{
		global $vsip_post_meta_box;

		add_meta_box($vsip_post_meta_box['id'], $vsip_post_meta_box['title'], 'vsip_display_post_meta', $vsip_post_meta_box['page'], $vsip_post_meta_box['context'], $vsip_post_meta_box['priority']);

	} // END OF Function: vsip_project_add_meta

	/*	---------------------------------------------------------------------	* 
	 *	Ouput Project Meta Box
	 *	---------------------------------------------------------------------	*/

	function vsip_display_post_meta()
	{
		global $vsip_post_meta_box, $post;

		// Use nonce for verification
		echo '<input type="hidden" name="vsip_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />'; 

		echo '<table class="form-table">';

			foreach ($vsip_post_meta_box['fields'] as $field) 
			{
				
				// get current post meta data
				$meta = get_post_meta($post->ID, $field['id'], true);

				switch($field['type'])
				{

					// If Text
					case 'text':
					
					echo '<tr style="border-top:1px solid #eeeeee;">',
						'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; line-height: 20px; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					
					break;

				}

			}

		echo '</table>';

	} // END Of Function: vsip_display_post_meta

	/*	---------------------------------------------------------------------	* 
	 *	Save Client Meta Data
	 *	---------------------------------------------------------------------	*/

	function vsip_post_save_data($post_id)
	{
		global $vsip_post_meta_box;
		
		// verify nonce
		if (!isset($_POST['vsip_meta_box_nonce']) || !wp_verify_nonce($_POST['vsip_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	 
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	 
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	 
		foreach ($vsip_post_meta_box['fields'] as $field) 
		{

			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}

	} // END Of Function: vsip_post_save_data

	/*	---------------------------------------------------------------------	* 
	 *	Queue Scripts
	 *	---------------------------------------------------------------------	*/

	function vsip_project_scripts()
	{

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');

	} // END Of Function: vsip_project_scripts


	function vsip_project_styles()
	{
		wp_enqueue_style('thickbox');

	} // END Of Function: vsip_project_styles

	add_action('admin_print_scripts', 'vsip_project_scripts');
	add_action('admin_print_styles', 'vsip_project_styles');
