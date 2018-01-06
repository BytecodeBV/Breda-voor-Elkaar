<?php

function add_custom_gp () {
    // CSS
    wp_enqueue_style('custom-style-from-gulp', get_stylesheet_directory_uri().'/gulp/dist/style.css');
    
    // Javascript
    wp_enqueue_script ( 'custom-script-from-gulp', get_stylesheet_directory_uri() . '/gulp/dist/custom.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'add_custom_gp');

?>