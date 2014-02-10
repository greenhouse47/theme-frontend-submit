<?php get_header(); ?>
	

	<!-- #primary BEGIN -->
	<div id="primary">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<!-- .hentry BEGIN -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<!-- .post-title BEGIN -->
				<div class="post-title">

					<h2><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h2>

				</div>

				<!-- .post-entry BEGIN -->
				<div class="post-entry">

					<?php the_content(__('Read more...', 'framework')); ?>

					<div class="clearfix"></div>

				</div><!-- .post-entry END -->

			</div><!-- .hentry END -->

        	<?php endwhile; else: ?>

				<!-- #post-0 BEGIN-->
				<div id="post-0" <?php post_class(); ?>>

					<!-- .post-title BEGIN -->
					<div class="post-title">

						<h2><?php _e('Error 404 - Not Found', 'framework') ?></h2>

					</div>

					<!-- .post-entry BEGIN -->
					<div class="post-entry">

						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>

					</div><!-- .post-entry END -->

			<?php endif; ?> 

	</div><!-- #primary END -->

<?php get_footer(); ?>
