<?php
	
/**
 * Hide update nags and notifications to all but admin users
 * ----------------------------------------------------------------------------
 */
 
function hide_update_notice_to_all_but_admin_users()
{
    //if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
        echo "<style>.notice, .update-nag, .error, .updated{ display:none !important; }</style>";
    //}
}
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin_users', 1 );
/**
 * Clean up Dashboard
 * ----------------------------------------------------------------------------
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	// Yoast SEO
	unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
	// Gravity Forms
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
	// BackWPup
	unset($wp_meta_boxes['dashboard']['normal']['core']['backwpup_become_inpsyder']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

/**
 * Hide Welcome on Dashboard
 * ----------------------------------------------------------------------------
 */
function hide_welcome_screen() {
    $user_id = get_current_user_id();
    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}
add_action( 'load-index.php', 'hide_welcome_screen' );

/**
 * Start cleanup functions
 * ----------------------------------------------------------------------------
 */
add_action('after_setup_theme','start_cleanup');
function start_cleanup() {
    // launching operation cleanup
    add_action('init', 'cleanup_head');
    // remove WP version from RSS
    add_filter('the_generator', 'remove_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'gallery_style');
    
    // additional post related cleaning
    add_filter('get_image_tag_class', 'image_tag_class', 0, 4);
    add_filter('get_image_tag', 'image_editor', 0, 4);
    add_filter( 'the_content', 'img_unautop', 30 );
} 

/**
 * Clean up head
 * ----------------------------------------------------------------------------
 */
function cleanup_head() {
    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // Category feed links
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    // Post and comment feed links
    remove_action( 'wp_head', 'feed_links', 2 );
    
    // Windows Live Writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // Index link
    remove_action( 'wp_head', 'index_rel_link' );
    // Previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // Start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // Canonical
    remove_action('wp_head', 'rel_canonical', 10, 0 );
    // Shortlink
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    // Links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // WP version
    remove_action( 'wp_head', 'wp_generator' );
    // Remove WP version from css
    add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
    // Remove WP version from scripts
    add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );
    // Prevent unneccecary info from being displayed
    add_filter('login_errors',create_function('$a', "return null;"));
} 

// remove WP version from RSS
function remove_rss_version() { return ''; }
// remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
// remove injected CSS for recent comments widget
function remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
// remove injected CSS from recent comments widget
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}
// remove injected CSS from gallery
function gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}