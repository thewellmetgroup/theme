<?php
/**
 * Template Name: Home
 */
?>
<?php 
//select featured grantees
$posts = get_posts(array(
	'posts_per_page'	=> -1,
	'post_type'			=> 'post',
	'meta_key'			=> '_featured',
));
//randomize the array
shuffle( $posts );
if( $posts ):
	foreach( $posts as $post ): 
		//load the grantee template
		include( locate_template( 'templates/content-grantee.php' ) );
		break;
	endforeach;
	wp_reset_postdata();

endif; ?>
            
