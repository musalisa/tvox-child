<?php

$tvox_stories_url = home_url('category/stories');
$tvox_is_stories = '';
$tvox_library_url = home_url('media/library');
$tvox_links_url = home_url('p/links.html');
$tvox_news_url = home_url('category/news');
$tvox_forum_url = home_url('forums');
$tvox_shop_url = home_url('shop');
$tvox_images_url = get_stylesheet_directory_uri().'/includes/images/';
$tvox_object = get_queried_object();
$tvox_is_stories = '';
$tvox_is_news = '';
if ( isset( $tvox_object->term_id ) && isset( $tvox_object->taxonomy ) ) {
	if (  $tvox_object->slug == 'stories' || term_is_ancestor_of( get_term_by( 'slug', 'stories', 'category' ), $tvox_object, 'category' ) ) {
		$tvox_is_stories = 'att';
	}
}
if ( $tvox_object->post_type == 'post' ) {
	//Returns Array of Term ID's for "my_taxonomy"
	$tvox_term_list = wp_get_post_terms( $tvox_object->ID, 'category', array("fields" => "slugs"));
	if ( $tvox_term_list[0] == 'stories' || term_is_ancestor_of( get_term_by( 'slug', 'stories', 'category' ), get_term_by( 'slug', $tvox_term_list[0], 'category' ), 'category' ) ) {
		$tvox_is_stories = 'att';
	}
}
if ( isset( $tvox_object->term_id ) && isset( $tvox_object->taxonomy ) ) {
	if (  $tvox_object->slug == 'news' || term_is_ancestor_of( get_term_by( 'slug', 'news', 'category' ), $tvox_object, 'category' ) ) {
		$tvox_is_news = 'att';
	}
}
if ( $tvox_object->post_type == 'post' ) {
	//Returns Array of Term ID's for "my_taxonomy"
	$tvox_term_list = wp_get_post_terms( $tvox_object->ID, 'category', array("fields" => "slugs"));
	if ( $tvox_term_list[0] == 'news' || term_is_ancestor_of( get_term_by( 'slug', 'news', 'category' ), get_term_by( 'slug', $tvox_term_list[0], 'category' ), 'category' ) ) {
		$tvox_is_news = 'att';
	}
}
$tvox_perma_uri = explode ('/', str_replace( home_url(), "", get_permalink() ));
$tvox_perma_uri_1 = $tvox_perma_uri[1];
$tvox_is_forum = '';
if ( $tvox_perma_uri_1 == 'forums') {
	$tvox_is_forum = 'att';
}

?>

<ul aria-expanded="false" id="tvox-pulsantiera-ul">
<li><a href="<?php echo(home_url()); ?>"><img id="bot-home" src="<?php echo($tvox_images_url);?>bottone_<?php if (is_front_page()) echo ('att'); ?>.gif" alt="Home" /><img id="label-home" src="<?php echo($tvox_images_url);?>home_<?php if (is_front_page()) echo ('att'); ?>.gif" alt="Home" /></a></li>
<li><a href="<?php echo $tvox_stories_url;?>"><img id="bot-stories" src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_stories ); ?>.gif" alt="Stories" /><img id="label-stories" src="<?php echo($tvox_images_url);?>stories_<?php echo( $tvox_is_stories ); ?>.gif" alt="Stories" /></a></li>
<li><a href="<?php echo $tvox_library_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_<?php if (is_tax('media')) echo ('att'); ?>.gif" alt="Library" /><img src="<?php echo($tvox_images_url);?>library_<?php if (is_tax('media')) echo ('att'); ?>.gif" alt="Library" /></a></li>
<li><a href="<?php echo $tvox_links_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Links" /><img src="<?php echo($tvox_images_url);?>links_.gif" alt="Links" /></a></li>
<li><a href="<?php echo $tvox_news_url;?>"><img id="bot-news" src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_news ); ?>.gif" alt="News" /><img id="label-news" src="<?php echo($tvox_images_url);?>news_<?php echo( $tvox_is_news ); ?>.gif" alt="News" /></a></li>
<li><a href=""><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Search" /><img src="<?php echo($tvox_images_url);?>search_.gif" alt="Search" /></a></li>
<li><a href="<?php echo $tvox_forum_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_forum ); ?>.gif" alt="Forum" /><img src="<?php echo($tvox_images_url);?>forum_<?php echo( $tvox_is_forum ); ?>.gif" alt="Forum" /></a></li>
<li><a href="<?php echo $tvox_shop_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Shop" /><img src="<?php echo($tvox_images_url);?>shop_.gif" alt="Shop" /></a></li>
</ul>

