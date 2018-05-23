<?php
/*  Related posts function
/* ------------------------------------ */
if ( ! function_exists( 'setwood_related_posts' ) ) {

	function setwood_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 3
		);
		// Related by categories
		if ( setwood_get_option('related_post') == 'category' ) {

			$cats = get_post_meta($post->ID, 'related-cat', true);

			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( setwood_get_option('related_posts') == 'tags' ) {

			$tags = get_post_meta($post->ID, 'related-tag', true);

			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}

		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}

} ?>


<?php $related = setwood_related_posts(); ?>

<?php if ( $related->have_posts() ): ?>
<div id="related-posts" class="related-posts">
<div class="block-title"><h3><span><?php esc_html_e( 'You may also like', 'setwood' ); ?></span></h3></div>
<div class="col-3">
	<?php while ( $related->have_posts() ) : $related->the_post(); ?>

	<article <?php post_class('grid-item'); ?>>
	    <figure class="post-thumbnail">
	        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	            <?php the_post_thumbnail(); ?>
	            <?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-play"></i></span>'; ?>
	            <?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-music"></i></span>'; ?>
	            <?php if ( is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-star"></i></span>'; ?>
	        </a>
	    </figure><!--/.post-thumbnail-->


	        <header class="entry-header">
	            <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h3>
	            <p class="entry-meta-header meta">
                    <?php
                    setwood_posted_on();
                    ?>
                </p>
	        </header>

	</article>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>
</div><!--/.related-posts hentry-->
<?php endif; ?>

<?php wp_reset_query(); ?>
