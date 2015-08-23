<?php
/**
 * Magazine Featured Content Template
 *
 * This template is used for the posts in the featured area on the
 * "Magazine" page template.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */

 global $woo_options, $more;
 $more = 0;

 $title_before = '<h2 class="title entry-title"><a href="' . get_permalink( get_the_ID() ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
 $title_after = '</a></h2>';

 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

 woo_post_before();
?>
<article <?php post_class(); ?>>
<?php
	woo_post_inside_before();

	if ( ( ( isset($woo_options['woo_magazine_f_w']) ) && ( ( $woo_options['woo_magazine_f_w'] <= 0 ) || ( $woo_options['woo_magazine_f_w'] == '')  ) ) || ( !isset($woo_options['woo_magazine_f_w']) ) ) {	$woo_options['woo_magazine_f_w'] = '100'; }
	if ( ( isset($woo_options['woo_magazine_f_h']) ) && ( $woo_options['woo_magazine_f_h'] <= 0 )  ) { $woo_options['woo_magazine_f_h'] = '100'; }

?>
<?php
	woo_post_inside_before();
?>
	<header>
		<?php the_title( $title_before, $title_after ); ?>
	</header>
<?php
	woo_post_meta();
	if ( isset( $woo_options['woo_magazine_featured_post_content'] ) &&  has_post_thumbnail() ) {
		?> 
			<a href="<?php echo get_permalink(); ?>"><?php woo_image( 'link=img&width='.$woo_options['woo_magazine_f_w'].'&height='.$woo_options['woo_magazine_f_h'].'&class=thumbnail '.$woo_options['woo_magazine_f_align'] ); ?></a>
		<?php
		}
?>
	<section class="entry">
	    <?php
	    	if ( isset( $woo_options['woo_magazine_featured_post_content'] ) && has_excerpt() ) {
	    		the_excerpt();    		
	    	} else {
	    		the_content( '', TRUE );
	    	}
	    ?>
	</section><!-- /.entry -->
	<div class="fix"></div>
<?php
	woo_post_inside_after();
?>
</article><!-- /.post -->
<?php
	woo_post_after();
?>