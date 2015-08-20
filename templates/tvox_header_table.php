<?php 

$tvox_stories_url = home_url('category/stories');
$tvox_is_stories = '';
$tvox_library_url = home_url('media/library');
$tvox_links_url = home_url('p/links.html');
$tvox_news_url = home_url('category/news');
$tvox_forum_url = home_url('forums');
$tvox_shop_url = home_url('p/shop.html');
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
<table id="tvox-header-tb">
<tr i="tvox-header-tr"> 
<td id="tvox-logo-td"><div id="tvox-logo-div"><a href="<?php echo(home_url()); ?>"><img src="<?php echo($tvox_images_url);?>theremin.gif" /></a></div></td><td id="tvox-logo1-td"><div id="tvox-logo1-div"><a href="<?php echo(home_url()); ?>"><img src="<?php echo($tvox_images_url);?>thereminvox_com.gif" /></a></div><div id="tvox-logo2-div"><a href="<?php echo(home_url()); ?>"><img src="<?php echo($tvox_images_url);?>claim.gif" /></a></div></td>
<td id="tvox-pulsantiera-td">
<table id="tvox-pulsantiera-tb">
<tr>
<td><div class="tvox-puls"><a href="<?php echo(home_url()); ?>"><img id="bot-home" src="<?php echo($tvox_images_url);?>bottone_<?php if (is_home()) echo ('att'); ?>.gif" alt="Home" /></a><a href="<?php echo(home_url()); ?>"><img id="label-home" src="<?php echo($tvox_images_url);?>home_<?php if (is_home()) echo ('att'); ?>.gif" alt="Home" /></a></div></td>
<td><div class="tvox-puls"><a href="<?php echo $tvox_stories_url;?>"><img id="bot-stories" src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_stories ); ?>.gif" alt="Stories" /></a><a href="<?php echo $tvox_stories_url;?>"><img id="label-stories" src="<?php echo($tvox_images_url);?>stories_<?php echo( $tvox_is_stories ); ?>.gif" alt="Stories" /></a></div></td>
<td><div class="tvox-puls"><a href="<?php echo $tvox_library_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_<?php if (is_tax('media')) echo ('att'); ?>.gif" alt="Library" /></a><a href="<?php echo $tvox_library_url;?>"><img src="<?php echo($tvox_images_url);?>library_<?php if (is_tax('media')) echo ('att'); ?>.gif" alt="Library" /></a></div></td>
<td><div class="tvox-puls"><a href="<?php echo $tvox_links_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Links" /></a><a href="<?php echo $tvox_links_url;?>"><img src="<?php echo($tvox_images_url);?>links_.gif" alt="Links" /></a></div></td>
</tr>
<tr>
<td><div class="tvox-puls"><a href="<?php echo $tvox_news_url;?>"><img id="bot-news" src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_news ); ?>.gif" alt="News" /></a><a href="<?php echo $tvox_news_url;?>"><img id="label-news" src="<?php echo($tvox_images_url);?>news_<?php echo( $tvox_is_news ); ?>.gif" alt="News" /></a></div></td>
<td><div class="tvox-puls"><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Search" /><img src="<?php echo($tvox_images_url);?>search_.gif" alt="Search" /></div></td>
<td><div class="tvox-puls"><a href="<?php echo $tvox_forum_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_<?php echo( $tvox_is_forum ); ?>.gif" alt="Forum" /></a><a href="<?php echo $tvox_forum_url;?>"><img src="<?php echo($tvox_images_url);?>forum_<?php echo( $tvox_is_forum ); ?>.gif" alt="Forum" /></a></div></td>
<td><div class="tvox-puls"><a href="<?php echo $tvox_shop_url;?>"><img src="<?php echo($tvox_images_url);?>bottone_.gif" alt="Shop" /></a><a href="<?php echo $tvox_shop_url;?>"><img src="<?php echo($tvox_images_url);?>shop_.gif" alt="Shop" /></a></div></td>
</tr>
</table>
</td></tr>
</table>

