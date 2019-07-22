<?php
function university_features() {
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
	register_nav_menus( array( 
	'Main' => 'Main menu',
	'Footer 1' => 'footer 1',
	'Footer 2' => 'footer 2'
	));
}
add_action( 'after_setup_theme', 'university_features' );