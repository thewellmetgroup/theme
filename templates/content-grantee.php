<?php 	$grantee_images= get_field('images');
		if ($grantee_images) {
			shuffle( $grantee_images );
		}
	    $i=0;
	    //print_r($grantee_images);
	    foreach( $grantee_images as $image ): 
			if ($i==0) {
				$grantee_image_url_0 = $image['sizes']['large'];
				$grantee_image_alt_0 = $image['alt'];
			}
			if ($i==1) {
				$grantee_image_url_1 = $image['sizes']['large'];
				$grantee_image_alt_1 = $image['alt'];
				break;
			}
			$i++;
	  	endforeach;
?>

<!--<div class="grantee-detail">
	<div class="row ">
		<div class="col-xs-12">
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</div>
	</div>
</div>-->

<div class="grantee-detail">
    <div class="row gutter-15">
        <div class="col-sm-6">
        	<div class="full bgstyle" style="background-image:url('<?php echo $grantee_image_url_0; ?>')">
        		<?php //if (!is_home()): ?>
        			<div class="title">
        				<span class="header">Recent Grantee</span><br>
        				<span class="name"><?php the_title(); ?></span>
        			</div>
        		<?php //endif; ?>
			</div>
        	
        </div>
        <div class="col-sm-6 right">
			<div class="halphy top bgstyle" style="background-image:url('<?php echo $grantee_image_url_1; ?>')">
			</div>
			<div class="halphy bottom" style="background-color:red;">
			</div>
        </div>
    </div>
</div>

<div class="grantee-detail">
    <div class="row">
    	<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<article <?php post_class(); ?>>
 			 
    			
    			<?php get_template_part('templates/entry-meta'); ?>
  		
  			<div class="entry-summary">
    			<?php the_excerpt(); ?>
  			</div>
			</article>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</div>
