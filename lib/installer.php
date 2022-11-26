<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* Install Required Plugins */
add_action( 'tgmpa_register', 'cake_baker_register_required_plugins' );
function cake_baker_register_required_plugins(){
    $plugin_dir_path = get_template_directory() . '/lib/plugins/';
    $plugins = array(

      array(
        'name'                => 'ThemeSky'
      ,'slug'               => 'themesky'
      ,'source'             => $plugin_dir_path . 'themesky.zip'
      ,'required'           => true
      ,'version'            => '1.0.0'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'One Click Demo Import'
      ,'slug'               => 'one-click-demo-import'
      ,'source'             => 'https://downloads.wordpress.org/plugin/one-click-demo-import.3.0.2.zip'
      ,'required'           => false
      ,'version'            => '3.0.2'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'Redux Framework'
      ,'slug'               => 'redux-framework'
      ,'source'             => 'https://downloads.wordpress.org/plugin/redux-framework.4.3.11.zip'
      ,'required'           => true
      ,'version'            => '4.3.11'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'WooCommerce'
      ,'slug'               => 'woocommerce'
      ,'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.6.2.1.zip'
      ,'required'           => true
      ,'version'            => '6.2.1'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'Elementor'
      ,'slug'               => 'elementor'
      ,'source'             => 'https://downloads.wordpress.org/plugin/elementor.3.5.6.zip'
      ,'required'           => true
      ,'version'            => '3.5.6'
      ,'external_url'       => ''
      )
//    ,array(
//        'name'                => 'Slider Revolution'
//      ,'slug'               => 'revslider'
//      ,'source'             => $plugin_dir_path . 'revslider.zip'
//      ,'required'           => false
//      ,'version'            => '6.5.17'
//      ,'external_url'       => ''
//      )
    ,array(
        'name'                => 'Contact Form 7'
      ,'slug'               => 'contact-form-7'
      ,'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.5.5.6.zip'
      ,'required'           => false
      ,'version'            => '5.5.6'
      ,'external_url'       => ''
      )
//    ,array(
//        'name'                => 'MailChimp for WordPress'
//      ,'slug'               => 'mailchimp-for-wp'
//      ,'source'             => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.8.6.zip'
//      ,'required'           => false
//      ,'version'            => '4.8.6'
//      ,'external_url'       => ''
//      )
    ,array(
        'name'                => 'YITH WooCommerce Wishlist'
      ,'slug'               => 'yith-woocommerce-wishlist'
      ,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.3.6.0.zip'
      ,'required'           => false
      ,'version'            => '3.6.0'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'YITH WooCommerce Compare'
      ,'slug'               => 'yith-woocommerce-compare'
      ,'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-compare.2.11.0.zip'
      ,'required'           => false
      ,'version'            => '2.11.0'
      ,'external_url'       => ''
      )
    ,array(
        'name'                => 'Photo Reviews for WooCommerce'
      ,'slug'               => 'woo-photo-reviews'
      ,'required'           => false
      )

    );

    $config = array(
      'id'           	=> 'tgmpa'
    ,'default_path' => ''
    ,'menu'         => 'tgmpa-install-plugins'
    ,'parent_slug'  => 'themes.php'
    ,'capability'   => 'edit_theme_options'
    ,'has_notices'  => true
    ,'dismissable'  => true
    ,'dismiss_msg'  => ''
    ,'is_automatic' => false
    ,'message'      => ''
    );

    tgmpa( $plugins, $config );
}
