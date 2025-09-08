<?php
/**
 * Debug test file - Add this to your functions.php temporarily
 */

// Add this to your active theme's functions.php to test
add_action( 'wp_footer', function() {
    if ( current_user_can( 'manage_options' ) ) {
        echo '<!-- DEBUG TEST START -->';
        echo '<!-- Plugin File Exists: ' . ( file_exists( WP_PLUGIN_DIR . '/directorist-divi-extension/directorist-divi-extension.php' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Plugin Active: ' . ( is_plugin_active( 'directorist-divi-extension/directorist-divi-extension.php' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- DirectoristDiviExtension Class: ' . ( class_exists( 'DirectoristDiviExtension' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- DirectoristDiviAllListings Class: ' . ( class_exists( 'DirectoristDiviAllListings' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- ET_Builder_Module Class: ' . ( class_exists( 'ET_Builder_Module' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Directorist_Base Class: ' . ( class_exists( 'Directorist_Base' ) ? 'YES' : 'NO' ) . ' -->';
        echo '<!-- Current Theme: ' . get_template() . ' -->';
        echo '<!-- DEBUG TEST END -->';
    }
});
