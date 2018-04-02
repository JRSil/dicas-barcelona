<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package setwood
 */

if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</div><!-- .widget-area -->
<?php endif; ?>
