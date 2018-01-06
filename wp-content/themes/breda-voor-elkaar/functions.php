<?php

require_once('keys.php');

define( 'DISALLOW_FILE_EDIT', true ); //Disable theme and plugin editors
add_filter( 'jetpack_development_mode', '__return_true' ); // Sets Jetpack to dev mode

//Change logo
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/themes/breda-voor-elkaar/logo.png);
            width: 320px;
            background-size: 200px;
			height: 100px;
        }
    </style>
<?php }

function add_custom_gp () {
    // CSS
    wp_enqueue_style('custom-style-from-gulp', get_stylesheet_directory_uri().'/gulp/dist/style.css');
    
    // Javascript
    wp_enqueue_script ( 'custom-script-from-gulp', get_stylesheet_directory_uri() . '/gulp/dist/custom.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'add_custom_gp');

/* =======================================
 * 	JobCareer Functions - Child Theme
 */

// register theme menu
function cs_jobcareer_child_my_menus() {
    register_nav_menus(
            array(
                'main-menu' => __('Main Menu', 'jobcareer'),
                'footer-menu' => __('Footer Menu', 'jobcareer'),
            )
    );
}
add_action('init', 'cs_jobcareer_child_my_menus');

if (!get_option('cs_jobcareer_child')) {
    update_option('cs_jobcareer_child', 'jobcareer_child_theme');
    $theme_mod_val = array();
    $term_exists = term_exists('main-menu', 'nav_menu');
    if (!$term_exists) {
        $wpdb->insert(
                $wpdb->terms, array(
            'name' => 'Main Menu',
            'slug' => 'main-menu',
            'term_group' => 0
                ), array(
            '%s',
            '%s',
            '%d'
                )
        );
        $insert_id = $wpdb->insert_id;
        $theme_mod_val['main-menu'] = $insert_id;
        $wpdb->insert(
                $wpdb->term_taxonomy, array(
            'term_id' => $insert_id,
            'taxonomy' => 'nav_menu',
            'description' => '',
            'parent' => 0,
            'count' => 0
                ), array(
            '%d',
            '%s',
            '%s',
            '%d',
            '%d'
                )
        );
    } else {
        $theme_mod_val['main-menu'] = $term_exists['term_id'];
    }
    $term_exists = term_exists('top-menu', 'nav_menu');
    if (!$term_exists) {
        $wpdb->insert(
                $wpdb->terms, array(
            'name' => 'Top Menu',
            'slug' => 'top-menu',
            'term_group' => 0
                ), array(
            '%s',
            '%s',
            '%d'
                )
        );
        $insert_id = $wpdb->insert_id;
        $theme_mod_val['top-menu'] = $insert_id;
        $wpdb->insert(
                $wpdb->term_taxonomy, array(
            'term_id' => $insert_id,
            'taxonomy' => 'nav_menu',
            'description' => '',
            'parent' => 0,
            'count' => 0
                ), array(
            '%d',
            '%s',
            '%s',
            '%d',
            '%d'
                )
        );
    } else {
        $theme_mod_val['top-menu'] = $term_exists['term_id'];
    }

    $term_exists = term_exists('footer-menu', 'nav_menu');
    if (!$term_exists) {
        $wpdb->insert(
                $wpdb->terms, array(
            'name' => 'Footer Menu',
            'slug' => 'footer-menu',
            'term_group' => 0
                ), array(
            '%s',
            '%s',
            '%d'
                )
        );
        $insert_id = $wpdb->insert_id;
        $theme_mod_val['footer-menu'] = $insert_id;
        $wpdb->insert(
                $wpdb->term_taxonomy, array(
            'term_id' => $insert_id,
            'taxonomy' => 'nav_menu',
            'description' => '',
            'parent' => 0,
            'count' => 0
                ), array(
            '%d',
            '%s',
            '%s',
            '%d',
            '%d'
                )
        );
    } else {
        $theme_mod_val['footer-menu'] = $term_exists['term_id'];
    }
    set_theme_mod('nav_menu_locations', $theme_mod_val);
}
