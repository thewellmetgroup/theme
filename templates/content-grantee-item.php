<div class="item-wrapper">
	<div class="thumb">
		<?php
		// Check if the post has a Post Thumbnail assigned to it.
		if ( has_post_thumbnail() ) {
    		echo '<a href="'. esc_url( get_permalink() ) .'">';
    		the_post_thumbnail('medium');
    		echo '</a>';
		} 
		?>
	</div>
	<div class="title content-padding">
		<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a></h3>
	</div>
	<div class="excerpt content-padding">
		<?php 	if (has_excerpt()): the_excerpt();
				else:
				echo trunc(get_field('description'), '25');
				endif;
		 ?>
	</div>
	<div class="more-button content-padding">
		<a class="cr_btn" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e( 'Read more', 'sage' ); ?></a>
	</div>
</div>