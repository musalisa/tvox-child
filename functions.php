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

        return '<div class="sva-sc-factbox ' . esc_attr( $align ) . ' ' . esc_attr( $style ) . '"' . $custom . '>' . wp_kses_post( do_shortcode( woo_remove_wpautop( $content ) ) ) . '</div>';
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

        return '<div class="sva-sc-intro ' . esc_attr( $style ) . '"' .'>' . wp_kses_post( do_shortcode( woo_remove_wpautop( $content ) ) ) . '</div>';
} // End sva_shortcode_intro()

add_shortcode( 'intro', 'sva_shortcode_intro' );
/*-----------------------------------------------------------------------------------*/
/* Header TVOX 
/*-----------------------------------------------------------------------------------*/

add_action( 'woo_header_inside', 'tvox_header_table' );
function tvox_header_table(){
	get_template_part('templates/tvox_header_table');
}

/*-----------------------------------------------------------------------------------*/
// Both woo_breadcrumbs() and Yoast breadcrumbs need to be enabled in the WordPress admin for this to function.
add_filter( 'woo_breadcrumbs', 'woo_custom_use_yoast_breadcrumbs' );
function woo_custom_use_yoast_breadcrumbs ( $breadcrumbs ) {
if ( function_exists( 'yoast_breadcrumb' ) ) {
$before = '<div class="breadcrumb breadcrumbs woo-breadcrumbs"><div class="breadcrumb-trail">';
$after = '</div></div>';
$breadcrumbs = yoast_breadcrumb( $before, $after, false ); 
}
return $breadcrumbs;
} // End woo_custom_use_yoast_breadcrumbs()


/*------------------------------------------------------------------------------------*/
/* POOTLE PRESS FUNCTIONS */
/*------------------------------------------------------------------------------------*/
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
} // End woo_custom_deregister_bbpress_template_stack()


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

?>