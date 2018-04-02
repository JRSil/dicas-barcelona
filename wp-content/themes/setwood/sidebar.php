<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package setwood
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .widget-area -->
<?php endif; ?>
