<?php global $is_setwood_featured_post; ?>
<?php if( in_the_loop() || $is_setwood_featured_post ): ?>
<div class="social-share">
	<ul>
		<?php
			$thumb_id = get_post_thumbnail_id();

			$facebook = add_query_arg( array(
				'u' => get_permalink(),
			), 'https://www.facebook.com/sharer.php' );

			$twitter = add_query_arg( array(
				'text'=>get_the_title(),
				'url' => get_permalink(),
			), 'https://twitter.com/share' );

			$gplus = add_query_arg( array(
				'url' => get_permalink(),
			), 'https://plus.google.com/share' );

			$pinterest = add_query_arg( array(
				'url'         => get_permalink(),
				'description' => get_the_title(),
				'media'       => setwood_get_featured_image_url($thumb_id, 'large'),
			), 'https://pinterest.com/pin/create/bookmarklet/' );
		?>
		<li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>
		<li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
		<li><a href="<?php echo esc_url( $gplus ); ?>" target="_blank"><i class="fa fa-google-plus"></i> <span>Google Plus</span></a></li>
		<?php if ( ! empty( $thumb_id ) ): ?>
			<li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>
</div>
