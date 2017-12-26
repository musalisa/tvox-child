<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

$tvox_current_child =  substr( end(explode("/",get_stylesheet_directory_uri())), 0, -6);
//$tvox_current_child = '';
//$tvox_child_layout = $tvox_current_child . '_layout';
$tvox_child_blog = $tvox_current_child . '_blog';
$GLOBALS['TVOX_CURRENT_CHILD'] = $tvox_current_child;
$GLOBALS['TVOX_CHILD_LAYOUT'] = $tvox_child_layout;
$GLOBALS['TVOX_CHILD_BLOG'] = $tvox_child_blog;
//$tvox_current_child =  '';

/*----------------------------------------------------------------------------------*/
/* TVOX Theme setup
/*-----------------------------------------------------------------------------------*/

function tvox_setup() {

  // load_theme_textdomain( 'twentyseventeen' );

  add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
  //add_theme_support( 'post-thumbnails' );
	//add_image_size( 'tvox-featured-image', 2000, 1200, true );
	//add_image_size( 'tvox-thumbnail-avatar', 100, 100, true );
  
}
add_action( 'after_setup_theme', 'tvox_setup' );

/*****************************************************************************************
 /* customizzazioni Storefront */
/*****************************************************************************************/
//require 'inc/tvox-functions.php';
//require 'inc/tvox-template-hooks.php';
require 'includes/tvox-template-functions.php';

if ( $tvox_child_layout == 'tvox_layout' ) {
    
    function tvox_actions_layout() {
    
        global $storefront;
        
        // header
        //add_action( 'storefront_header', 'tvox_header', 10 );
        //remove_action( 'storefront_header', 'storefront_site_branding', 40 );
        remove_action( 'storefront_header', 'storefront_product_search', 40 );
        remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
        //remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
        remove_action( 'storefront_header', 'storefront_header_cart', 60 );
        remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
        remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
        
        //content
        //remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );
        
        
        // cambio il caricamento dei css
        //remove_action( 'wp_enqueue_scripts', array( $storefront->main, 'child_scripts' ), 30 );
        remove_action( 'wp_enqueue_scripts', array( $storefront->customizer, 'add_customizer_css' ), 130 );
        //remove_action( 'wp_enqueue_scripts', array( $storefront->woocommerce, 'woocommerce_scripts' ),  20 );
        //remove_action( 'storefront_footer', 'storefront_credit',  20 );
        
        add_action( 'storefront_before_header', 'tvox_open_grid_container', 10 );
        add_action( 'storefront_before_footer', 'tvox_close_grid_container' , 10);
        add_action( 'storefront_before_footer', 'tvox_open_footer_grid_container', 20 );
        add_action( 'storefront_after_footer', 'tvox_close_footer_grid_container', 10 );
        add_action( 'storefront_before_content', 'tvox_sx_grid_area', 10 );
        
    
    }
    add_action( 'init', 'tvox_actions_layout' );
       
    function tvox_scripts_layout() {
        wp_enqueue_style( 'tvox-layout', get_stylesheet_directory_uri(). '/tvox-grid.css' );
        wp_enqueue_script( 'tvox', get_stylesheet_directory_uri(). '/includes/js/tvox.js', array('jquery'));
    }
    add_action( 'wp_enqueue_scripts', 'tvox_scripts_layout', 1000 );
}

if ( $tvox_child_blog == 'tvox_blog' ) {
    
    function tvox_actions_single_post() {
        
        global $storefront;
        
        // post single
        remove_action( 'storefront_single_post', 'storefront_post_header', 10);
        add_action( 'storefront_single_post', 'tvox_single_post_header', 10);
        remove_action( 'storefront_single_post', 'storefront_post_meta', 20);
        //remove_action( 'storefront_single_post', 'storefront_post_content', 30);
        remove_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10);
        
        //add_action( 'storefront_single_post', 'tvox_post_content', 30);
        add_action( 'storefront_single_post', 'storefront_post_meta', 40);
        
        //loop
        //remove_action( 'storefront_loop_post', 'storefront_post_meta', 20);
        
    }
    add_action( 'init', 'tvox_actions_single_post' );
    
    function tvox_scripts_blog() {
        wp_enqueue_style( 'tvox-layout', get_stylesheet_directory_uri(). '/tvox-blog.css' );
    }
    add_action( 'wp_enqueue_scripts', 'tvox_scripts_blog', 1100 );
}

/*-----------------------------------------------------------------------------------*/
/* Tvox Shorcodes - da rivedere
/*-----------------------------------------------------------------------------------*/

/*
 Factbox
Optional arguments:
 - align: left, right
 - width: n° di pixel senza px
 - style: da definire
*/
function sva_shortcode_factbox( $atts, $content = null ) {
   extract( shortcode_atts( array(      'align' => 'right',
                                                                        'width' => '',
                                                                        'style' => ''
                                                                        ), $atts ) );

        $custom = '';
        if ( $width )
                $custom = ' style="width:'.$width.'px;"';
        else
                $custom = ' style="width:300px;"';

        return '<div class="sva-sc-factbox ' . esc_attr( $align ) . ' ' . esc_attr( $style ) . '"' . $custom . '>' . wp_kses_post( do_shortcode(  wpautop( $content) ) ) . '</div>';
} // End sva_shortcode_factbox()

add_shortcode( 'factbox', 'sva_shortcode_factbox' );


/*
Intro - div
Optional arguments:
- style

*/
function sva_shortcode_intro( $atts, $content = null ) {
   extract( shortcode_atts( array(      'style' => ''
                                                                        ), $atts ) );

        return '<div class="sva-sc-intro ' . esc_attr( $style ) . '"' .'>' . wp_kses_post( do_shortcode( wpautop( $content ) ) ) . '</div>';
}
add_shortcode( 'intro', 'sva_shortcode_intro' );
// End sva_shortcode_intro()


/*-----------------------------------------------------------------------------------*/
/* VECCHIO DA ELIMINARE !!!?????
 /*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* Header TVOX
/*-----------------------------------------------------------------------------------*/

add_action( 'storefront_header_before', 'tvox_header_table' );
function tvox_header_table(){
	get_template_part('templates/tvox_header_table');
}




/*-----------------------------------------------------------------------------------*/
// Both woo_breadcrumbs() and Yoast breadcrumbs need to be enabled in the WordPress admin for this to function.
/*
add_filter( 'woo_breadcrumbs', 'woo_custom_use_yoast_breadcrumbs' );
function woo_custom_use_yoast_breadcrumbs ( $breadcrumbs ) {
if ( function_exists( 'yoast_breadcrumb' ) ) {
$before = '<div class="breadcrumb breadcrumbs woo-breadcrumbs"><div class="breadcrumb-trail">';
$after = '</div></div>';
$breadcrumbs = yoast_breadcrumb( $before, $after, false );
}
return $breadcrumbs;
}
*/ // End woo_custom_use_yoast_breadcrumbs()


/*------------------------------------------------------------------------------------*/
/* POOTLE PRESS FUNCTIONS */
/*------------------------------------------------------------------------------------*/
/*
add_filter( 'template_include', 'woo_custom_maybe_load_bbpress_tpl', 99 );

function woo_custom_maybe_load_bbpress_tpl ( $tpl ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		$tpl = locate_template( 'bbpress.php' );
	}
	return $tpl;
} // End woo_custom_maybe_load_bbpress_tpl()

add_filter( 'bbp_get_template_stack', 'woo_custom_deregister_bbpress_template_stack' );

function woo_custom_deregister_bbpress_template_stack ( $stack ) {
	if ( 0 < count( $stack ) ) {
		$stylesheet_dir = get_stylesheet_directory();
		$template_dir = get_template_directory();
		foreach ( $stack as $k => $v ) {
			if ( $stylesheet_dir == $v || $template_dir == $v ) {
				unset( $stack[$k] );
			}
		}
	}
	return $stack;
}
*/
// End woo_custom_deregister_bbpress_template_stack()


/*------------------------------------------------------------------------------------*/
/* END - POOTLE PRESS FUNCTIONS */
/*------------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------*/
/* Tvox Sripts and styles */
/*------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/**
 * sva_archive_children()
 *
 * Mostra i figli dell'archive se ci sono senza un ordinamento.
 *
 * @since V1.0.0
 * @uses do_atomic(), get_queried_object(), get_term_children()
 * @echo string
 */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'sva_archive_children' ) ) {
	function sva_archive_children ( $echo = true ) {
		do_action( 'sva_archive_children' );

		// Archive children, if available.

		$term_obj = get_queried_object();

		$children_list = '';
		$termchildren = array();

		if ( isset( $term_obj->term_id ) && isset( $term_obj->taxonomy ) ) {
			$termchildren = get_terms( $term_obj->taxonomy, array( 'child_of' => $term_obj->term_id, 'parent' => $term_obj->term_id ) );
		}

		if ( count( $termchildren ) > 0 ) {
			$children_list = '<ul>';
			foreach ( $termchildren as $child ) {
				$children_list = $children_list . '<li><a href="' . get_term_link( $child, $term_obj->taxonomy ) . '">' . $child->name . '</a></li>';
			}
			$children_list = $children_list . '</ul>';
		}
		if ( isset( $children_list ) && '' != $children_list ) {
			// Allow child themes/plugins to filter here ( 1: text in DIV and paragraph, 2: term object )
			$children_list = apply_filters( 'sva_archive_children', '<div class="archive-children">' . $children_list . '</div><!--/.archive-description-->', $term_obj );
		}

		if ( $echo != true ) { return $children_list; }

		echo $children_list;
	} // End sva_archive_children()
}


/*-----------------------------------------------------------------------------------*/
/* Construct the query arguments for the "Home Page */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'tvox_get_home_query_args' ) ) {
    /**
     * Construct an array of arguments for use in the query for the "Magazine" grid.
     * @return array Constructed array of arguments.
     */
    function tvox_get_home_query_args () {
        // Exclude stored duplicates
        $exclude = '';
        $cats = array();
        $cats_exclude = array();

        // Exclude slider posts
        /*if ( $woo_options['woo_slider_magazine_exclude'] == 'true' ) {
            $exclude = get_option( 'woo_exclude' );*/

        $args = array(
            'post_type' => 'post'
        );

        if ( $paged > 1 ) {
            $args['paged'] = $paged;
        }

        if ( $exclude != '' ) {
            $args['post__not_in'] = $exclude;
        }

        return $args;
    } // End woo_get_magazine_query_args()
}

?>
