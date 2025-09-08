<?php
/**
 * Plugin Name: Directorist Divi Extension
 * Description: Add Directorist modules to Divi Builder
 * Version: 1.0.0
 * Author: wpWax
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'DDE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DDE_URL', plugin_dir_url( __FILE__ ) );

// Register the module when Divi is ready
add_action( 'et_builder_ready', 'dde_register_modules' );

function dde_register_modules() {
    // Load the module class
    require_once DDE_PATH . '/includes/modules/class-all-listings.php';
    
    // Register the module
    new DirectoristDiviAllListings();
}
