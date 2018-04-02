<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package setwood
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

			<section class="error-404 not-found">

				<div class="page-content">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'setwood' ); ?></h1>
					</header><!-- .page-header -->

					<p class="text-center"><?php esc_html_e( 'Sorry but we cannot find the page you were looking for.', 'setwood' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
