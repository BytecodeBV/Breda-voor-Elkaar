<?php

add_filter( 'jetpack_development_mode', '__return_true' ); // Sets Jetpack to dev mode
define( 'DISALLOW_FILE_EDIT', true ); //Disable theme and plugin editors

require_once('keys.php');
require_once('inc/custom-login-logo.php');
require_once('inc/enqueue-scripts.php');
require_once('inc/jobcareer-functions.php');
