<?php

/**
 * Library Loop Prova
 *
 * Inspired by BuddyPress Activity Loop
 *
 * @package BuddyDrive
 * @since  version (1.0)
 */


//////////////////////////////////////////
$term =	$wp_query->queried_object;
global $buddydrive_template;
$buddydrive_template = new  Tvox_BD_Library();
$buddydrive_template->get_by_term( $term->term_id );

$title_before = '<h1 class="archive_header">';
$title_after = '</h1>';
woo_loop_before();
woo_archive_title( $title_before, $title_after );
woo_archive_description();
sva_archive_children();
?>

<?php if ( $buddydrive_template->query->have_posts() ): ?>

	<?php while ( $buddydrive_template->query->have_posts() ) : buddydrive_the_item(); ?>

		<?php //buddydrive_item_title(); echo '<br />' ?>	
		<?php bp_get_template_part( 'media-library-entry' );?>
		<?php //woo_get_template_part( 'content', get_post_type() ); ?>
		
		
	<?php endwhile; ?>
	<?php woo_pagenav($buddydrive_template->query); ?>
	
<?php else : ?>

	<?php get_template_part( 'content', 'noposts' ); ?>
	
<?php endif; 

//$the_query = new WP_Query( $args );

// The Loop

//$the_query = new WP_Query( $args);

// The Loop
/*
if ( $the_query->have_posts() ) {
	echo '<br />';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$tvox_bd_id = get_the_ID();
		echo '<b>'.get_post_meta( $tvox_bd_id, 'tvox_bd_title', true ).'</b> - <i>' . get_the_title().'</i><br />';		
		echo 'posted by '.get_the_author().' - ';
		the_date();
		$tvox_bd_url=site_url('buddydrive/file/').$the_query->post->post_name;
		echo ' - <a href="'.$tvox_bd_url.'">'.$tvox_bd_url.'</a>';
		echo '<br />'.get_post_meta( $tvox_bd_id, 'tvox_bd_artist', true ).'<br />';
		the_content();
		echo '<br />';
	}
	echo '';
} else {
	echo 'no posts found';
}
*/
/* Resotore original Post Data */
//wp_reset_postdata();
?>





