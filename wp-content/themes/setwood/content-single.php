<?php
/**
 * @package setwood
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * @hooked setwood_post_header - 10
     * @hooked setwood_post_thumbnail - 15
	 * @hooked setwood_post_meta - 20
	 * @hooked setwood_post_content - 30
	 */
	do_action( 'setwood_single_post' );
	?>

</article><!-- #post-## -->
