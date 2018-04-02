<?php
/**
 * Template used to display post content.
 *
 * @package setwood
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>

	<?php
	/**
	 * Functions hooked in to setwood_loop_post action.
	 *
	 * @hooked setwood_post_thumbnail		- 05
	 * @hooked setwood_post_wrapper 		- 10
	 * @hooked setwood_post_header 			- 20
	 * @hooked setwood_loop_content 		- 30
	 * @hooked setwood_init_structured_data	- 40
	 * @hooked setwood_post_meta_footer 	- 50
	 * @hooked setwood_post_wrapper_close 	- 60
	 */
	do_action( 'setwood_grid_loop_post' );
	?>

</article><!-- #post-## -->
