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
$meta_key='';
$meta_value='';
$year='';
if (!empty($_POST)):
	if (isset($_POST["sector"])) {
		$cat=$_POST["sector"];
	}
	if (isset($_POST["borough"])) {
		$meta_key='borough';
		$meta_key=$_POST["borough"];
	}
	if (isset($_POST["year"])) {
		$meta_key='year';
		$meta_key=$_POST["year"];
	}
endif;
?>

<div class="row page-leader">
	<div class="col-sm-4">
		<h1><?php echo get_the_title(); ?></h1>
	</div>
	<div class="col-sm-8 grantee-filters">
		<form id="grantee-search" name="grantee-search" class="grantee-search" method="post" action="/grantees/">
			<labeL>Filter by:</labeL> &nbsp;
       				<select name="year">
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
        					echo '<option value="-1">'.__('Year','sage').'</option>';
        					foreach ($year_array as $value) {
        						echo '<option value="'.$value.'">'.$value.'</option>';
        					}
						?>
						
                        
                    </select> 
                    &nbsp;
                    <select name="borough">
                    	<option>Borough</option>
                        <option>Brooklyn</option>
                        <option>Manhattan</option>
                        <option>Queens</option>
                        <option>Staten Island</option>
                        <option>The Bronx</option>
                    </select>
                    &nbsp;
                    
                    	<?php wp_dropdown_categories( array(
        						'show_option_all'    => __('Sector','sage'),
								'show_option_none'   => '',
								'option_none_value'  => '-1',
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

$myposts = get_posts( $args );
$counter=0;


foreach ( $myposts as $post ) : setup_postdata( $post );
	if ($counter==0) :
		echo '<div class="row">';
	endif;
			echo '<div class="col-sm-4 grantee-item">';
				//load the grantee template
				include( locate_template( 'templates/content-grantee-item.php' ) );
			echo '</div>';
	if ($counter<3) :
		$counter++;
	else:
		$counter=0;
	endif;
	if ($counter==3) :
		echo '</div>';		
	endif;
endforeach; 
wp_reset_postdata();

?>

