<?php
/**
 * Test file to check if the module is being registered
 */

// Add this to your functions.php or create a simple test
add_action( 'wp_footer', function() {
    if ( current_user_can( 'manage_options' ) ) {
        echo '<!-- Directorist Divi Extension Test -->';
        echo '<!-- Plugin Active: ' . ( class_exists( 'DirectoristDiviExtension' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Module Class: ' . ( class_exists( 'DirectoristDiviAllListings' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Divi Builder: ' . ( class_exists( 'ET_Builder_Module' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Directorist: ' . ( class_exists( 'Directorist_Base' ) ? 'YES' : 'NO' ) . ' -->';
    }
});
