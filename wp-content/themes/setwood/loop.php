<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
 *
 * @package setwood
 */

do_action( 'setwood_loop_before' );

// Check if featured post is enabled
$featured_post_enabled = setwood_get_option( setwood_layout_prefix().'_first_full');

if ( is_search() ) {
	$featured_post_enabled = false;
}

// Get query
global $wp_query;

// Get featured post ID
$featured_post = setwood_get_featured_post( $wp_query );

// Featured Post
if ( $featured_post_enabled ) :

    get_template_part( 'content', 'first' );

endif;

while ( have_posts() ) : the_post();
    /**
     * Include the Post-Format-specific template for the content.
     * If you want to override this in a child theme, then include a file
     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
     */

    // Exclude featured post
    if ( $featured_post == get_the_ID() && $featured_post_enabled ) {
        continue;
    }
				
    get_template_part('content', setwood_get_post_entry_layout() );
					

endwhile;

/**
 * Functions hooked in to setwood_paging_nav action
 *
 * @hooked setwood_paging_nav - 10
 */
do_action( 'setwood_loop_after' );
