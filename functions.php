<?php
require_once( __DIR__ . '/includes/header-page-banner.php');
require_once( __DIR__ . '/includes/our-styles.php');
require_once( __DIR__ . '/includes/our-features.php');
require_once( __DIR__ . '/includes/our-custom-query.php');



	
function sunset_add_admin_page() {
	
	//Generate Sunset Admin Page
	add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'alecaddd_sunset' );
	
	//Generate Sunset Admin Sub Pages
	add_submenu_page( 'alecaddd_sunset', 'Sunset Theme Options', 'General', 'manage_options', 'alecaddd_sunset', 'sunset_theme_create_page' );
	add_submenu_page( 'alecaddd_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'alecaddd_sunset_css', 'sunset_theme_settings_page');
	
	
	
}
add_action( 'admin_menu', 'sunset_add_admin_page' );

function ourMapKey($api){
    $api['key'] = '';
    return $api;
}

add_filter('acf/fields/google_map/api', 'ourMapKey');
