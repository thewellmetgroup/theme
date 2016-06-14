<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/wp_bootstrap_navwalker.php' // Bootstrap nav walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


//Modify POSTS pages for Grantees
function wellmet_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Grantees';
    $submenu['edit.php'][5][0] = 'Grantees';
    $submenu['edit.php'][10][0] = 'Add Grantee';
    $submenu['edit.php'][16][0] = 'Grantee Tags';
    echo '';
}
function wellmet_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Grantees';
    $labels->singular_name = 'Grantees';
    $labels->add_new = 'Add Grantee';
    $labels->add_new_item = 'Add Grantee';
    $labels->edit_item = 'Edit Grantee';
    $labels->new_item = 'Grantees';
    $labels->view_item = 'View Grantees';
    $labels->search_items = 'Search Grantees';
    $labels->not_found = 'No Grantees found';
    $labels->not_found_in_trash = 'No Grantees found in Trash';
    $labels->all_items = 'All Grantees';
    $labels->menu_name = 'Grantees';
    $labels->name_admin_bar = 'Grantees';
}
 
add_action( 'admin_menu', 'wellmet_change_post_label' );
add_action( 'init', 'wellmet_change_post_object' );


//add custom columns to the grantee listing
add_filter('manage_posts_columns', 'my_columns');
function my_columns($columns) {
	
	//remove these from view
	unset($columns['author']);
    unset($columns['tags']);
    unset($columns['comments']);
    
	//re-order the others
	$date = $columns['date'];
	unset($columns['date']);
	$categories = $columns['categories'];
	unset($columns['categories']);
    $columns['year'] = __('Year','sage');
    $columns['grant_amount'] = __('Grant Amount','sage');
    $columns['borough'] = __('Borough','sage');
    $columns['categories'] = $categories;
    $columns['date'] = $date;
 
    return $columns;
}

add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
    global $post;
    switch ($name) {
        case 'year':
            $year = get_post_meta($post->ID, 'year', true);
            echo $year;
            break;
        
        case 'borough':
            $borough = get_post_meta($post->ID, 'borough', true);
            echo $borough;
            break;
        case 'grant_amount':
            $grant_amount = get_post_meta($post->ID, 'grant_amount', true);
            echo $grant_amount;
            break;
    }
   
}

function trunc($phrase, $max_words) {
   	$phrase_array = explode(' ',$phrase);
	if(count($phrase_array) > $max_words && $max_words > 0)
     	$phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   	return $phrase;
}

/**** END grantees *************/
