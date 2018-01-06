<?php

function add_custom_child_theme () {
    // CSS
    wp_enqueue_style('custom-style-from-gulp', get_stylesheet_directory_uri().'/gulp/dist/style.css');
    
    // Javascript
    wp_enqueue_script ( 'custom-script-from-gulp', get_stylesheet_directory_uri() . '/gulp/dist/custom.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'add_custom_child_theme');

function my_theme_enqueue_styles() {
    
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // wp_enqueue_style( 'child-style',
    //     get_stylesheet_directory_uri() . '/style.css',
    //     array( $parent_style ),
    //     wp_get_theme()->get('Version')
    // );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

?>