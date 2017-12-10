<?php
/**
 * Template Name: Magazine
 *
 * Home page template
 * content slider at the top and a grid of posts below it.
 *
 * @package Tvox Child
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main tvox" role="main">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				//get_template_part( 'content', 'page' );
				get_template_part( 'loop', 'magazine' );
				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				//do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();

//Oswald",arial,sans-serif
