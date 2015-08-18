<?php //echo( get_the_ID() ); ?>
<header><h2 class="title entry-title"><?php echo( get_post_meta( get_the_ID(), 'tvox_bd_title', true ) ); ?></h2></header>
<section class=""><?php the_excerpt(); ?></section>
artista: <?php echo( get_post_meta( get_the_ID(), 'tvox_bd_artist', true ) ); ?><br />
<?php //buddydrive_item_privacy();?>
inserito da: <a href="<?php echo( buddydrive_get_owner_link() ); ?>" title="<?php echo( __('Owner', 'buddydrive') ); ?>"><?php the_author(); ?></a> il <?php the_date(); //buddydrive_item_date(); ?><br />
download: <a href="<?php buddydrive_action_link(); ?>"><?php buddydrive_item_title(); ?></a> (<?php buddydrive_item_mime_type(); ?>) <br />
<br />
<?php //woo_post_inside_after(); ?>
<?php //buddydrive_item_attribute(); ?>