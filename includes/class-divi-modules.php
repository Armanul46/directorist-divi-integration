<?php
/**
 * Directorist Divi Modules Loader
 *
 * @package DirectoristDiviExtension
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class DirectoristDiviModules {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'et_builder_ready', [ $this, 'register_modules' ] );
    }
    
    /**
     * Register all Divi modules
     */
    public function register_modules() {
        // Load and register All Listings module
        require_once DDE_PATH . '/includes/modules/class-all-listings.php';
        new DirectoristDiviAllListings();
    }
}
