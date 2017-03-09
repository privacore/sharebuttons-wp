<?php

/*
Plugin Name: Privacore Social Share Buttons
Plugin URI: https://www.privacore.com
Description: Sharing buttons that doesn't track user behaviour.
Version: 1.1
Author: Privacore
Author URI: https://www.privacore.com
*/

//Include functions file with all necessary code
require_once  'functions.php';


//Setup plugin options on activation
if( class_exists( 'PrivacoreSSBSetup' ) ) {
    $pssbs = new PrivacoreSSBSetup();

    //Call Activation method plugin activation
    register_activation_hook( __FILE__, array( &$pssbs, 'pssbActivate') );
}

//Load Textdomain after plugin is loaded
add_action( 'plugins_loaded', 'pssb_load_textdomain' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0
 */
function pssb_load_textdomain() {
    load_plugin_textdomain( 'privacore-ssb', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

//Initialize Frontend/Admin
$adminInstance = new PrivacoreSSBAdmin();
$frontendInstance = new PrivacoreSSBFrontend();
