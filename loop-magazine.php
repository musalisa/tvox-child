<?php
/**
 * Loop - Magazine
 *
 * This is the loop logic file for the "Magazine" page template.
 *
 * @package Tvox Child
 */

$args = tvox_get_home_query_args();
$query = new WP_Query( $args );
do_action( 'storefront_loop_before' );

if ( $query->have_posts() ) { $count = 0; 
	while ( $query->have_posts() ) { $query->the_post(); $count++;
		// Featured Starts
			//woo_get_template_part( 'content', 'single' );
			get_template_part( 'content', 'magazine-featured' );
			continue;
	} // End WHILE Loop
} 

/**
 * Functions hooked in to storefront_paging_nav action
 *
 * @hooked storefront_paging_nav - 10
 */
//do_action( 'storefront_loop_after' );
