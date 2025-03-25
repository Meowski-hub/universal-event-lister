<?php
/**
 * Plugin Name: Universal Event Lister
 * Plugin URI: https://yourwebsite.com/universal-event-lister
 * Description: A universal event submission system that formats data for various event calendar sites.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: universal-event-lister
 * Domain Path: /languages
 * License: GPL v2 or later
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    die('Direct access not permitted.');
}

// Define plugin constants
define('UEL_VERSION', '1.0.0');
define('UEL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('UEL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('UEL_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Include required files
require_once UEL_PLUGIN_DIR . 'includes/class-uel-loader.php';
require_once UEL_PLUGIN_DIR . 'includes/class-uel-post-types.php';
require_once UEL_PLUGIN_DIR . 'includes/class-uel-form-handler.php';
require_once UEL_PLUGIN_DIR . 'includes/class-uel-admin.php';
require_once UEL_PLUGIN_DIR . 'includes/class-uel-integrations.php';
require_once UEL_PLUGIN_DIR . 'includes/class-uel-formatters.php';

/**
 * Main plugin class
 */
class Universal_Event_Lister {
    /**
     * Plugin instance
     */
    private static $instance = null;

    /**
     * Plugin loader
     */
    public $loader;

    /**
     * Post Types
     */
    public $post_types;

    /**
     * Form Handler
     */
    public $form_handler;

    /**
     * Admin
     */
    public $admin;

    /**
     * Integrations
     */
    public $integrations;

    /**
     * Formatters
     */
    public $formatters;

    /**
     * Get plugin instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->load_dependencies();
        $this->initialize_components();
        $this->register_hooks();
    }

    /**
     * Load plugin dependencies
     */
    private function load_dependencies() {
        // Additional dependencies can be loaded here
    }

    /**
     * Initialize plugin components
     */
    private function initialize_components() {
        $this->loader = new UEL_Loader();
        $this->post_types = new UEL_Post_Types();
        $this->form_handler = new UEL_Form_Handler();
        $this->admin = new UEL_Admin();
        $this->integrations = new UEL_Integrations();
        $this->formatters = new UEL_Formatters();
    }

    /**
     * Register plugin hooks
     */
    private function register_hooks() {
        // Register activation, deactivation, and uninstall hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Initialize plugin components through the loader
        $this->loader->run();
    }

    /**
     * Plugin activation
     */
    public function activate() {
        // Create custom database tables if needed
        // Set default options
        // Generate initial data structures
        
        // Flush rewrite rules after registering custom post types
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Clean up as needed
        flush_rewrite_rules();
    }
}

// Initialize the plugin
function universal_event_lister() {
    return Universal_Event_Lister::get_instance();
}

// Start the plugin
universal_event_lister();