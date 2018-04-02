<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package setwood
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to setwood_page add_action
	 *
	 * @hooked setwood_page_header			-10
	 * @hooked setwood_post_thumbnail		-15
	 * @hooked setwood_page_content			-20
	 * @hooked setwood_init_structured_data	-25
	 * @hooked setwood_display_comments		-30
	 */
	do_action( 'setwood_page' );
	?>
</div><!-- #post-## -->

