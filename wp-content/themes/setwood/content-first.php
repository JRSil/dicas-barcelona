<?php
/**
 * Template used to display post content.
 *
 * @package setwood
 */

global $wp_query;
$featured_post = setwood_get_featured_post( $wp_query );

if ( $featured_post ) :

	// Set featured post global var
	global $is_setwood_featured_post;
	$is_setwood_featured_post = true;

	// Query featured post
	$args = apply_filters( 'setwood_featured_post_args', array(
		'post_type'     => 'post',
		'no_found_rows' => true,
		'post__in'      => array( $featured_post ),
	) );
	$setwood_query = new WP_Query( $args );

	// Display featured post
	if ( $setwood_query->have_posts() ) :
		while ( $setwood_query->have_posts() ) : $setwood_query->the_post();
			// Get entry template part
			get_template_part( 'content', 'full' );
		endwhile;
	$is_setwood_featured_post = false;
	endif;
	// Restore original post data
	wp_reset_postdata(); ?>

<?php endif; ?>
