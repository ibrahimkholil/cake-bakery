<?php

/*** Theme Setup ***/
function cake_bakery_theme_setup(){
    /* Add editor-style.css file*/
    add_editor_style();

    /* Add Theme Support */
    add_theme_support( 'post-formats', array( 'audio', 'gallery', 'quote', 'video' ) );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'title-tag' );

    add_theme_support( 'custom-header' );

    $defaults = array(
      'default-color'         => ''
    ,'default-image'        => ''
    );
    add_theme_support( 'custom-background', $defaults );

    add_theme_support( 'woocommerce' );

    add_theme_support( 'wc-product-gallery-slider' );

    remove_theme_support( 'widgets-block-editor' );

    if ( ! isset( $content_width ) ){ $content_width = 1200; }

    /* Translation */
    load_theme_textdomain( 'cake-bakery', get_template_directory() . '/languages' );

    /* Register Menu Location */
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary Navigation', 'cake-bakery' ),
    ) );
    register_nav_menus( array(
      'vertical' => esc_html__( 'Vertical Navigation', 'cake-bakery' ),
    ) );
    register_nav_menus( array(
      'mobile' => esc_html__( 'Mobile Navigation', 'cake-bakery' ),
    ) );
}
add_action( 'after_setup_theme', 'cake_bakery_theme_setup');
