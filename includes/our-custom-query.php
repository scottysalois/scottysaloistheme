<?php 
function university_adjust_queries($query) {
    if ( ! is_admin() && is_post_type_archive( 'campus' ) && $query->is_main_query() ) {
        $query->set( 'posts_per_page', -1 );
    }
	$today = date('Ymd');
	if ( ! is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query() ) {
            $query->set( 'meta_key', 'event_date' );
            $query->set( 'orderby', 'meta_value_num' );
            $query->set( 'order', 'ASC' );
            $query->set( 'meta_query', array(
            	'key'       => 'event_date',
            	'compare'   => '>=',
            	'value'     => $today,
            	'type'      => 'numeric',
        ));
    }
    if ( ! is_admin() && is_post_type_archive( 'program' ) && $query->is_main_query() ) {
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'ASC' );
            $query->set( 'posts_per_page', '-1' );
    }
}
add_action('pre_get_posts', 'university_adjust_queries');