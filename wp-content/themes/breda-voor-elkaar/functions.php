<?php

add_filter( 'jetpack_development_mode', '__return_true' ); // Sets Jetpack to dev mode
define( 'WP_AUTO_UPDATE_CORE', true ); // Allows WordPress to automatically update the core
define( 'DISALLOW_FILE_EDIT', true ); // Disable theme and plugin editors
add_filter( 'auto_update_plugin', '__return_true' ); // Update plugins automatically
add_filter( 'auto_update_theme', '__return_true' ); // Update themes automatically
error_reporting(0); @ini_set(‘display_errors’, 0); // Turn off error reporting

require_once('keys.php');
require_once('inc/add-tracking-codes.php');
require_once('inc/change-user-roles.php');
require_once('inc/custom-login-logo.php');
require_once('inc/enqueue-scripts.php');
require_once('inc/jobcareer-functions.php');
//require_once('inc/cleanup.php');