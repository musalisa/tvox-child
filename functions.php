<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;


/*-----------------------------------------------------------------------------------*/
/* Fact Boxes - box
/*-----------------------------------------------------------------------------------*/
/*

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


/*-----------------------------------------------------------------------------------*/
/* Intro - div
/*-----------------------------------------------------------------------------------*/
/*

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
/* Header TVOX
/*-----------------------------------------------------------------------------------*/

add_action( 'storefront_header_before', 'tvox_header_table' );
function tvox_header_table(){
	get_template_part('templates/tvox_header_table');
}

function remove_sf_actions() {

	//remove_action( 'storefront_header', 'storefront_product_search', 40 );
	remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
	remove_action( 'storefront_header', 'storefront_header_cart', 60 );

}
add_action( 'init', 'remove_sf_actions' );

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
/* Tvox Sripts */
/*------------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'tvox_child_scripts' );
function tvox_child_scripts() {
	wp_enqueue_script( 'tvox', get_stylesheet_directory_uri(). '/includes/js/tvox.js', array('jquery'));
}

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


?>
