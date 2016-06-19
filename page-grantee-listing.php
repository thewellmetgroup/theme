<?php
/**
 * Template Name: Grantees
 */
?>
<?php
//select grantees
//fill these with post data from the select dropdowns
global $post;

$cat='';
$meta_array=array();
$selected_year='';
$selected_boro='';
if (!empty($_POST)):
	if (isset($_POST["sector"]) && $_POST["sector"]!="0") {
		$cat=$_POST["sector"];
	}
	if (isset($_POST["borough"]) && $_POST["borough"]!="Borough") {
		$borough_data =  array (
			'key' => 'borough',
			'value' => $_POST["borough"]
      	);
      	$selected_boro = $_POST["borough"];
      	//push into the meta_array
      	array_push($meta_array,$borough_data);
	}
	if (isset($_POST["grantee-year"]) && $_POST["grantee-year"]!="Year") {
		$year_data =  array (
			'key' => 'year',
			'value' => $_POST["grantee-year"]
      	);
      	$selected_year = $_POST["grantee-year"];
      	//push into the meta_array
      	array_push($meta_array,$year_data);
	}
endif;
?>

<div class="row page-leader">
	<div class="col-sm-4">
		<h1><?php echo get_the_title(); ?></h1>
	</div>
	<div class="col-sm-8 grantee-filters">
		<form id="grantee-search" name="grantee-search" class="grantee-search" method="post" action="<?php echo get_page_link(); ?>">
			<labeL>Filter by:</labeL> &nbsp;
       				<select name="grantee-year">
                    	<?php
                    		// must add field key of the field you want
        					$args = get_posts(array(
        						'posts_per_page'   => -1,
        						'offset'           => 0,
        						'post_status'      => 'publish'
        					) );
        					$myposts = get_posts( $args );
        					$year_array = array();
        					foreach ( $myposts as $post ) : setup_postdata( $post );
        						$my_year = get_field('year');
        						if(!in_array(get_field('year'), $year_array)){
        							$year_array[]=get_field('year');
        						}
        					endforeach; 
        					//print_r($year_array);
        					wp_reset_postdata();
        					
        					//loop through out array of available years and print options
        					rsort($year_array, SORT_NUMERIC);
        					echo '<option value="Year">'.__('Year','sage').'</option>';
        					foreach ($year_array as $value) {
        						echo '<option value="'.$value.'"'.(($value==$selected_year)?'selected="selected"':"").'>'.$value.'</option>';
        					}
						?>
						
                        
                    </select> 
                    &nbsp;
                    <select name="borough">
                    	<option value="Borough">Borough</option>
                    	<?php
                    	$boro_array = array('Brooklyn','Manhattan','Queens','Staten Island','The Bronx');
                    	foreach ($boro_array as $value) {
        					echo '<option value="'.$value.'"'.(($value==$selected_boro)?'selected="selected"':"").'>'.$value.'</option>';
        					}
        				?>
                    </select>
                    &nbsp;
                    
                    	<?php wp_dropdown_categories( array(
        						'show_option_all'    => __('Sector','sage'),
								'show_option_none'   => '',
								'option_none_value'  => 'Sector',
								'orderby'            => 'name', 
								'order'              => 'ASC',
								'show_count'         => 0,
								'hide_empty'         => 1, 
								'selected'           => $cat,
								'name'               => 'sector',
								'id'                 => 'sector',
								'class'              => 'postform',
								'depth'              => 0,
								'tab_index'          => 0,
								'taxonomy'           => 'category',
								'hide_if_empty'      => false,
								'value_field'	     => 'term_id',
    							) ); ?>
    				&nbsp;
    				<a href="javascript:void(0);" onclick="document.getElementById('grantee-search').submit(); return false;">Go!</a>

		</form>
	</div>
</div>

<?php

$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'category'         => $cat,
	'category_name'    => '',
	'orderby'          => 'meta_value_num',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_query'       => $meta_array,
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);

$myposts = get_posts( $args );
$counter=0;

if (!empty($myposts)) :
	foreach ( $myposts as $post ) : setup_postdata( $post );
		if ($counter==0) :
			echo '<div class="row">';
		endif;
				echo '<div class="col-sm-6 col-md-3 grantee-item">';
				//load the grantee template
				include( locate_template( 'templates/content-grantee-item.php' ) );				
			echo '</div>';
		if ($counter<4) :
			$counter++;
		else:
			$counter=0;
		endif;
		if ($counter==4) :
			echo '</div>';		
		endif;
	endforeach; 
	wp_reset_postdata();
else:
	echo '<div class="no-results">';
	echo '<h3>'.__('Oh no! We couldn’t find anything!','sage').'</h3>';
	echo '<p>'.__('Try different filters?','sage').'</p>';
	echo '<i class="fa fa-frown-o" aria-hidden="true"></i>';
	echo '</div>';
endif;

?>

