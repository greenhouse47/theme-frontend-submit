<?php /* Template Name: Edit Posts */ 

$query = new WP_Query(array('post_type' => 'post', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	
	if(isset($_GET['post'])) {
		
		if($_GET['post'] == $post->ID)
		{
			$current_post = $post->ID;

			$title = get_the_title();
			$content = get_the_content();

			$custom_one = get_post_meta($current_post, 'vsip_custom_one', true);
			$custom_two = get_post_meta($current_post, 'vsip_custom_two', true);
		}
	}

endwhile; endif;
wp_reset_query();

global $current_post;

$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}

	$post_information = array(
		'ID' => $current_post,
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post-type' => 'post',
		'post_status' => 'pending'
	);

	$post_id = wp_update_post($post_information);

	if($post_id)
	{

		// Update Custom Meta
		update_post_meta($post_id, 'vsip_custom_one', esc_attr(strip_tags($_POST['customMetaOne'])));
		update_post_meta($post_id, 'vsip_custom_two', esc_attr(strip_tags($_POST['customMetaTwo'])));

		wp_redirect( home_url() ); exit;
	}

}

?>

<?php get_header(); ?>

	<!-- #primary BEGIN -->
	<div id="primary">

		<form action="" id="primaryPostForm" method="POST">

			<fieldset>

				<label for="postTitle"><?php _e('Post\'s Title:', 'framework') ?></label>

				<input type="text" name="postTitle" id="postTitle" value="<?php echo $title; ?>" class="required" />

			</fieldset>

			<?php if($postTitleError != '') { ?>
				<span class="error"><?php echo $postTitleError; ?></span>
				<div class="clearfix"></div>
			<?php } ?>

			<fieldset>
						
				<label for="postContent"><?php _e('Post\'s Content:', 'framework') ?></label>

				<textarea name="postContent" id="postContent" rows="8" cols="30"><?php echo $content; ?></textarea>

			</fieldset>

			<fieldset>

				<label for="customMetaOne"><?php _e('Custom Meta One:', 'framework') ?></label>

				<input type="text" name="customMetaOne" id="customMetaOne" value="<?php echo $custom_one; ?>" />

			</fieldset>

			<fieldset>

				<label for="customMetaTwo"><?php _e('Custom Meta Two:', 'framework') ?></label>

				<input type="text" name="customMetaTwo" id="customMetaTwo" value="<?php echo $custom_two; ?>" />

			</fieldset>

			<fieldset>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit"><?php _e('Update Post', 'framework') ?></button>

			</fieldset>

		</form>


	</div><!-- #primary END -->


<?php get_footer(); ?>
