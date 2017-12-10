<?php
/*
 * articolo
 */
function tvox_post_title_header() {
	?>
	<header class="entry-header">
	<?php
	if ( is_single() ) {
		//storefront_posted_on();
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		if ( 'post' == get_post_type() ) {
			//storefront_posted_on();
		}

		the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
	}
	?>
	</header><!-- .entry-header -->
	<?php
    ?>
	<aside class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search.

		?>
		<div class="author">
			<?php
				//echo get_avatar( get_the_author_meta( 'ID' ), 128 );
				echo '<div class="label">' . esc_attr( __( 'by', 'storefront' ) ) . '</div>';
				the_author_posts_link();
			?>
		</div>
		<?php
		/* translators: used between list items, there is a space after the comma */
		
		$categories_list = get_the_category_list( __( ', ', 'storefront' ) );

		if ( $categories_list ) : ?>
			<div class="cat-links">
				<?php
				echo '<div class="label">' . esc_attr( __( 'in', 'storefront' ) ) . '</div>';
				echo wp_kses_post( $categories_list );
				?>
			</div>
		<?php endif; // End if categories. ?>

		<?php
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'storefront' ) );

		if ( $tags_list ) : ?>
			<div class="tags-links">
				<?php
				echo '<div class="label">' . esc_attr( __( 'Tagged', 'storefront' ) ) . '</div>';
				echo wp_kses_post( $tags_list );
				?>
			</div>
		<?php endif; // End if $tags_list. ?>

	<?php endif; // End if 'post' == get_post_type(). ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<div class="comments-link">
				<?php echo '<div class="label">' . esc_attr( __( 'Comments', 'storefront' ) ) . '</div>'; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'storefront' ), __( '1 Comment', 'storefront' ), __( '% Comments', 'storefront' ) ); ?></span>
			</div>
		<?php endif; ?>
	</aside>
	<?php
	tvox_posted_on();
}



/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tvox_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
    }
    
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
        );
    
    $posted_on = sprintf(
        _x( 'Posted on %s', 'post date', 'storefront' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
    
    echo wp_kses( apply_filters( 'storefront_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
        'span' => array(
            'class'  => array(),
        ),
        'a'    => array(
            'href'  => array(),
            'title' => array(),
            'rel'   => array(),
        ),
        'time' => array(
            'datetime' => array(),
            'class'    => array(),
        ),
    ) );
}


/*
 * layout
 */
function tvox_open_grid_container() {
	    ?>
    <div id="tvox-layout-grid-3">
	<?php
}

function tvox_close_grid_container() {
	    ?>
</div><!--  #tvox-layout-grid -->
<?php
}

function tvox_open_footer_grid_container() {
    ?>
<div id="tvox-footer-grid">
<?php
}

function tvox_close_footer_grid_container() {
	    ?>
</div><!--  #tvox-footer-grid -->
<?php
}

function tvox_sx_grid_area() {
    ?>
    <div id="tvox-gambe-grid-area">gambe</div>
    <div id="tvox-sx-grid-area">sx - <?php $tvox_current_child =  substr( end(explode("/",get_stylesheet_directory_uri())), 0, -6); echo($tvox_current_child); ?></div>
	<?php
}

if ( $tvox_current_child == 'tvox') {
    function storefront_site_branding() {
        ?>
    	<div id="tvox-site-branding">
    		<?php //storefront_site_title_or_logo(); ?>
    		<a href="https://wpdev.sva.net/" class="custom-logo-link" rel="home" itemprop="url"><img src="/wp-content/themes/tvox-child/includes/images/theremin.png" class="custom-logo" alt="WP dev 1" itemprop="logo" width="81" height="182"></a>
    		<a href="https://wpdev.sva.net/" class="tvox-com" rel="home" itemprop="url"><img src="/wp-content/themes/tvox-child/includes/images/thereminvox_com.gif"></a>
    		<a href="https://wpdev.sva.net/" class="tvox-claim" rel="home" itemprop="url"><img src="/wp-content/themes/tvox-child/includes/images/claim.gif"></a>
    	</div>
    	<?php
    }
    
    function storefront_primary_navigation() {
        ?>
    	<nav id="tvox-site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
    	<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
    		<?php     
    		/*
    		wp_nav_menu(
    			array(
    				'theme_location'	=> 'primary',
    				'container_class'	=> 'primary-navigation',
    				)
    		);
    		*/
    		get_template_part('templates/tvox_pulsantiera');
    		/*wp_nav_menu(
    			array(
    				'theme_location'	=> 'handheld',
    				'container_class'	=> 'handheld-navigation',
    				)
    		);*/
    		?>
    	</nav><!-- #site-navigation -->
    	<?php
    }
    
    function storefront_credit() {
        ?>
    	<div class="site-info">
    		<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . 'Valerio Saggini' . ' 2001-' . date( 'Y' ) ) ); ?>
    		<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
    		<!--  <br /> <?php printf( esc_attr__( '%1$s designed by %2$s.', 'storefront' ), 'Storefront', '<a href="http://www.woocommerce.com" title="WooCommerce - The Best eCommerce Platform for WordPress" rel="author">WooCommerce</a>' ); ?>
    		<?php } ?>
    	--></div><!-- .site-info -->
    	<?php
    }
}
	