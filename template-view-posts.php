<?php /* Template Name: View Posts */ ?>

<?php get_header(); ?>

	<!-- #primary BEGIN -->
	<div id="primary">

		<?php if(isset($_GET['result'])) : ?>

			<?php if($_GET['result'] == 'success') : ?>

				<!-- .client_success BEGIN -->
				<div class="client_success">

					<span class="success">Successfully Added<span class="cross"><a href="#">X</a></span></span>

				</div><!-- .client_success END -->

			<?php endif; ?>

		<?php endif; ?>

		<table>

			<tr>
				<th>Post Title</th>
				<th>Post Excerpt</th>
				<th>Post Status</th>
				<th>Actions</th>
			</tr>

			<?php $query = new WP_Query(array('post_type' => 'post', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) ); ?>

			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

			<tr>
				<td><?php echo get_the_title(); ?></td>
				<td><?php the_excerpt(); ?></td>
				<td><?php echo get_post_status( get_the_ID() ) ?></td>

				<?php $edit_post = add_query_arg('post', get_the_ID(), get_permalink(61 + $_POST['_wp_http_referer'])); ?>

				<td>
					<a href="<?php echo $edit_post; ?>">Edit</a>

					<?php if( !(get_post_status() == 'trash') ) : ?>

						<a onclick="return confirm('Are you sure you wish to delete post: <?php echo get_the_title() ?>?')"href="<?php echo get_delete_post_link( get_the_ID() ); ?>">Delete</a>

					<?php endif; ?>
				</td>
			</tr>

		<?php endwhile; endif; ?>

		</table>

	</div><!-- #primary END -->


<?php get_footer(); ?>
