<?php
/**
 * Magazine Featured Content Template
 *
 * This template is used for the posts in the featured area on the
 * "Magazine" page template.
 *
 * @package Tvox Child
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to storefront_loop_post action.
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_meta            - 20
	 * @hooked storefront_post_content         - 30
	 */
	//do_action( 'storefront_loop_post' );
	?>


		<header class="tvox-entry-header">
			<?php
			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-meta">
			
				<?php
					echo esc_attr( __( 'By ', 'storefront' ) );
					echo '<span class="author">' . the_author_posts_link() . '</span>';				
					storefront_posted_on();
					$categories_list = get_the_category_list( __( ', ', 'storefront' ) );
					if ( $categories_list ) : 
					echo esc_attr( __( 'in ', 'storefront' ) );
					echo wp_kses_post( $categories_list );
					endif; // End if categories.
				?>
        </div>


			<?php storefront_post_thumbnail( 'full' ); ?>

</article><!-- #post-## -->