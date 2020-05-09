<?php

//includ navwalker class for bootstrap navigation menu
require_once('wp-bootstrap-navwalker.php');
//add futured image support
add_theme_support('post-thumbnails');

/******* function  to add my styles  **
***Powred by El mahdi kharbouchi
***wp_enqueue_style()
***/
function mystyles(){
	
	wp_enqueue_style('cssbootstrap',get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('cssfontawesome',get_template_directory_uri().'/css/all.min.css');
	wp_enqueue_style('cssfontawesome',get_template_directory_uri().'/css/fontawesome.min.css');
	wp_enqueue_style('cssmain',get_template_directory_uri().'/css/main.css');
	
}

/******* function  to add my script  **
***Powred by El mahdi kharbouchi
***wp_enqueue_style()
***/
function myscript(){
	// start jquery
	wp_deregister_script('jquery');//romove jquery registred in header
	wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),false,'',true);
	wp_enqueue_script('jquery');
	//end jquery 
	
	wp_enqueue_script('jsbootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
	wp_enqueue_script('jsmain',get_template_directory_uri().'/js/main.js',array(),false,true);
	
}


/* add custum menu */

 function myregister_custume_menu(){
	 register_nav_menus(array(
	 'bootstrap-menu' => ('navigation bar'),
	 'footer-menu' => 'footer menu'
	 
	 ));
	  
 }
 
 function bootstrapnavmenu(){
	 
 wp_nav_menu( array(
 'theme-location'=>'bootstrap-menu',
 'menu_class'=>'navbar-nav ml-auto',
 'container' => false,
 'depth'     => 2,
 'walker'   => new wp_bootstrap_navwalker() 
 
 ));
 }
 
 /*
 **********
 customize the excerpt word length and read more dots
 *********
 */
 function post_excerpt_length($length){
	 if(is_author()){
		 return 5;
	 }else{
	 
	 return 10;
	 }
 }
 add_filter('excerpt_length','post_excerpt_length');
 function post_excerpt_change_dots($more){
	 return '...';
 }
 add_filter('excerpt_more','post_excerpt_change_dots');
 
 /* add actions */
 //add styles
add_action('wp_enqueue_scripts','mystyles');
//add scrpts
add_action('wp_enqueue_scripts','myscript');
//register cutome menu
add_action('init','myregister_custume_menu');

//pagination number
/*
function pagination_numbers(){
	
	global $wp_query;//make wp_query global
	
	$all_pages = $wp_query -> max_num_pages;//get all posts
	
    $current_page = max(1,get_query_var('paged'));//get current paged
	
	if($all_pages > 1){//check if total pages>1
	
	return paginate_links(array(
	
	'base'    => get_pagenum_link(1).'%_%',
	'format'  => 'page/%#%',
	'current' => $current_page ,
	
	));
		
	}
	
	
}*/

/**
 * A pagination function
 * @param integer $range: The range of the slider, works best with even numbers
 * Used WP functions:
 * get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
 * previous_posts_link(' ‚ '); - returns the Previous page link
 * next_posts_link(' é '); - returns the Next page link
 */
function get_pagination($range = 4) {
	global $paged, $wp_query;

	// How much pages do we have?
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}

	// We need the pagination only if there is more than 1 page
	if ( $max_page > 1 ) {
		if ( !$paged ) $paged = 1;

		echo '<div class="postpagination">';

		// To the previous page
		previous_posts_link('Prev');

		if ( $max_page > $range + 1 ) :
			if ( $paged >= $range ) echo '<a href="' . get_pagenum_link(1) . '">1</a>';
			if ( $paged >= ($range + 1) ) echo '<span class="page-numbers">&hellip;</span>';
		endif;

		// We need the sliding effect only if there are more pages than is the sliding range
		if ( $max_page > $range ) {
			// When closer to the beginning
			if ( $paged < $range ) {
				for ( $i = 1; $i <= ($range + 1); $i++ ) {
						echo ( $i != $paged ) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
				}
			// When closer to the end
			} elseif ( $paged >= ($max_page - ceil(($range/2))) ) {
				for ( $i = $max_page - $range; $i <= $max_page; $i++ ) {
					echo ( $i != $paged ) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
				}
			// Somewhere in the middle
			} elseif ( $paged >= $range && $paged < ($max_page - ceil(($range/2))) ) {
				for ( $i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++ ) {
					echo ($i != $paged) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
				}
			}
		// Less pages than the range, no sliding effect needed
		} else {
			for ( $i = 1; $i <= $max_page; $i++ ) {
					echo ($i != $paged) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
				}
		}
		if ( $max_page > $range + 1 ) :
			// On the last page, don't put the Last page link
			if ( $paged <= $max_page - ($range - 1) ) echo '<span class="page-numbers">&hellip;</span><a href="' . get_pagenum_link($max_page) . '">' . $max_page . '</a>';
		endif;

		// Next page
		next_posts_link('Next');

		echo '</div><!-- postpagination -->';
	}
}




