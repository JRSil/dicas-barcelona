<?php
/**
 * The template for displaying all single posts.
 *
 * @package setwood
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post();

			do_action( 'setwood_single_post_before' );

			get_template_part( 'content', 'single' );

			/**
			 * Functions hooked in to setwood_single_post_after action
			 *
			 * @hooked setwood_post_nav         - 10
			 * @hooked setwood_display_comments - 20
			 */
			do_action( 'setwood_single_post_after' );

		endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'setwood_sidebar' );
get_footer();
