<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package setwood
 *
 */

get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main <?php echo entry_classes();?>">
        <header class="archive-header">
        <?php
            the_archive_title( '<h1 class="archive-title">', '</h1>' );
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
        </header><!-- .page-header -->
            
		<?php if ( have_posts() ) : ?>

			<?php get_template_part( 'loop' );

		else :

			get_template_part( 'content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
do_action( 'setwood_sidebar' );
get_footer();
