<?php
/**
 * CAKE_BAKERY functions and definitions
 * *
 * @package WordPress
 * @subpackage CAKE_BAKERY
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'CAKE_BAKERY_THEME_VERSION', '1.0.0' );
define( 'CAKE_BAKERY_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'CAKE_BAKERY_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// After theme setup functions
require_once CAKE_BAKERY_THEME_DIR . '/inc/after-theme-setup.php';
require_once CAKE_BAKERY_THEME_DIR . '/inc/theme_filters.php';
// After theme setup functions
require_once CAKE_BAKERY_THEME_DIR . '/inc/assets.php';
// Theme Functions
require_once CAKE_BAKERY_THEME_DIR . '/inc/theme-functions.php';
// Tgma plugin
require_once CAKE_BAKERY_THEME_DIR . '/lib/class-tgm-plugin-activation.php';
// Required plugin
require_once CAKE_BAKERY_THEME_DIR . '/lib/installer.php';
// Theme Option file
require_once CAKE_BAKERY_THEME_DIR . '/lib/theme-options/theme-options.php';
// Theme Option file
require_once CAKE_BAKERY_THEME_DIR . '/lib/class-wp-bootstrap-mega-navwalker.php';
// Theme Option file
require_once CAKE_BAKERY_THEME_DIR . '/inc/woocommerce-functions.php';
require_once CAKE_BAKERY_THEME_DIR . '/inc/quickshop.php';

require_once CAKE_BAKERY_THEME_DIR . '/inc/woo_functions.php';
require_once CAKE_BAKERY_THEME_DIR . '/inc/woo_hooks.php';

require_once CAKE_BAKERY_THEME_DIR . '/inc/theme_controls.php';
// Theme Option file
//require_once CAKE_BAKERY_THEME_DIR . '/inc/dynamic_styles.php';
