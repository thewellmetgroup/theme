<?php 	$grantee_images= get_field('images');
		$grantee_mission=get_field('featured_mission');
		$grantee_description=get_field('description');
		
		function trunc($phrase, $max_words) {
   			$phrase_array = explode(' ',$phrase);
   			if(count($phrase_array) > $max_words && $max_words > 0)
      			$phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   			return $phrase;
		}
		
		//if the grantee mission if empty
		if (empty($grantee_mission)) {
			//set description excerpt as mission
			$grantee_mission = trunc($grantee_description,25);
		}
		
		//if there are images for this grantee
		if (!empty($grantee_images)) {
			//if more than 1
			if (count($grantee_images)>1) {
				shuffle( $grantee_images );
				$i=0;
	    		//print_r($grantee_images);
	    		foreach( $grantee_images as $image ): 
					if ($i==0) {
						$full_img_url = $image['sizes']['large'];
						$full_img_alt = $image['alt'];
					}
					if ($i==1) {
						$halfy_img_url = $image['sizes']['large'];
						$halfy_img_alt = $image['alt'];
						break;
					}
					$i++;
	  			endforeach;
	  		} else {
	  			//if just one
	  			$single_img_url = $grantee_images[0]['sizes']['large'];
				$single_img_alt = $grantee_images[0]['alt'];
	  		}
	  	}
	  	
	  	$rand=rand(1,4);
	  	$colors = array('#79b118','#00c3df','#ca195c','#f4c021');
	  	//#79b118; //green
	  	//#00c3df; //blue
		//#ca195c; //purple
		//#f4c021; //orange
	  	//shuffle 
	  	shuffle($colors);
	  	
	  	$picked_color=$colors[$rand-1];
	  	//print "RAND: ".$rand;
	  	//print "<br>PICKED: ".$picked_color;
	  	
	  	//create div arrays so we can randomize block positions
	  	function fuller() {
	  		global $full_img_url;
	  		global $picked_color;
	  		return '<div class="full bgstyle" style="background-image:url(\''.$full_img_url.'\')">
	  					 <div class="title">
        					<span class="header" style="color:'.$picked_color.';">Recent Grantee</span><br>
        					<span class="name">'.get_the_title().'</span>
        				 </div>
        			   </div>';
	  	}
        
        function halfy($pos,$bg_type) {
        	global $grantee_mission;
        	global $picked_color;
        	global $halfy_img_url;
        	global $halfy_img_alt;
        	if ($bg_type=='image') {
        		$css_value = 'background-image:url(\''.$halfy_img_url.'\')';
        		$halfy_content="";
        	} else {
        		$css_value = 'background-color:'.$picked_color.''; //must be the color
        		$halfy_content=$grantee_mission;
        	}
        	return '<div class="halfy '.$pos.' bgstyle" style="'.$css_value.'"><div class="halfy-content">'.$halfy_content.'</div></div>';
        }
        
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
        <?php
        //do this switcharoo if there are images and there's more than 1
        if ( count($grantee_images)>1 ) { ?>
        <div class="col-sm-6">
        	<?php 
        	switch ($rand) {
    			case "1":
        			echo fuller();
        			break;
    			case "2":
        			echo halfy('top','image');
        			echo halfy('bottom','color');
        			break;
    			case "3":
        			echo halfy('top','color');
        			echo halfy('bottom','image');
        			break;
        		case "4":
        			echo fuller();
        			break;
			} ?> 	
        </div>
        <div class="col-sm-6 right">
			<?php 
        	switch ($rand) {
    			case "1":
        			echo halfy('top','image');
        			echo halfy('bottom','color');
        			break;
    			case "2":
        			echo fuller();
        			break;
    			case "3":
        			echo fuller(); 
        			break;
        		case "4":
        			echo halfy('top','color');
        			echo halfy('bottom','image');
        			break;
			} ?>
        </div>
        <?php } else { ?>
        	<div class="col-xs-12">
        		<?php if (count($grantee_images)==1) { ?>
        			<div class="single-image"><img src="<?php echo $single_img_url; ?>" alt="<?php echo $single_img_alt; ?>"></div>
        		<?php } ?>
        		<div><?php echo $grantee_description; ?></div>
        	</div>
        
        <?php }  ?>
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
