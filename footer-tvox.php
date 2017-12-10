<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php
	/**
	 * Functions hooked in to storefront_before_footer action
	 *
	 * @hooked tvox_close_grid_container        - 10
	 * @hooked tvox_open_footer_grid_container  - 20
	 */
	do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full-3">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?
        /**
         * Functions hooked in to storefront_after_footer action
         *
         * @hooked tvox_close_footer_grid_container  - 10
         */
	   do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
