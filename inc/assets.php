<?php


function cb_register_scripts(){
    $theme_version= cb_get_theme_version();
    // theme styles
    wp_enqueue_style('bootstrap-5',get_template_directory_uri(). '/assets/css/plugins/plugins.min.css',array(), $theme_version);
    wp_enqueue_style('bootstrap-5',get_template_directory_uri(). '/assets/css/responsive.css',array(), $theme_version);
    wp_enqueue_style('cake-bakery-style',get_stylesheet_uri(),array(),$theme_version);

    // theme scripts
    // wp_enqueue_script( 'bakershop-script', get_template_directory_uri() . '/js/main.js', array('jquery'), $theme_version, true );
    wp_enqueue_script( 'cake-bakery-script', get_template_directory_uri() . '/assets/js/plugins/plugins.min.js', array('jquery'), $theme_version, true );
    wp_enqueue_script( 'cake-bakery-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $theme_version, true );

}

add_action('wp_enqueue_scripts','cb_register_scripts');

