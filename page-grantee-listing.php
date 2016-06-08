<?php
/**
 * Template Name: Grantees
 */
?>

<ul>
<?php


$args = array( 'posts_per_page' => 5);

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>

<?php 
//select grantees
//fill these with post data from the select dropdowns
$cat='';
$meta_key='';
$meta_value='';

$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => $cat,
	'orderby'          => 'meta_value_num',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => $meta_key,
	'meta_value'       => $meta_value,
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args );
echo "# of posts:".count($posts);
$counter=0;

if( $posts ):
	foreach( $posts as $post ): 
		if ($counter==0) :
			echo '<div class="row">';
		endif;
			echo '<div class="col-sm-4 grantee-item">';
				//load the grantee template
				include( locate_template( 'templates/content-grantee-item.php' ) );
			echo '</div>';
		if ($counter==0) :
			echo '</div>';
		endif;

		if ($counter<3) :
			$counter++;
		else:
			$counter=0;
		endif;
	endforeach;
endif;
wp_reset_postdata();

?>

            
