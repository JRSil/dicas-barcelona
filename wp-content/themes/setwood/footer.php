<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package setwood
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'setwood_before_footer' ); ?>

	<footer id="colophon" class="site-footer">

			<?php
			/**
			 * Functions hooked in to setwood_footer action
			 *
			 * @hooked setwood_footer_widgets - 10
			 * @hooked setwood_credit         - 20
			 */
			do_action( 'setwood_footer' ); ?>

	</footer><!-- #colophon -->

	<?php do_action( 'setwood_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
