<?php


function cb_register_scripts(){
    $theme_version= cb_get_theme_version();
    // theme styles
    wp_enqueue_style('bootstrap-5',get_template_directory_uri(). '/assets/css/plugins/plugins.min.css',array(), $theme_version);
    wp_enqueue_style('reset',get_template_directory_uri(). '/assets/css/reset.css',array(), $theme_version);
    wp_enqueue_style('cake-bakery-style',get_stylesheet_uri(),array(),$theme_version);
    wp_enqueue_style('responsive',get_template_directory_uri(). '/assets/css/responsive.css',array(), $theme_version);

    // theme scripts
    // wp_enqueue_script( 'bakershop-script', get_template_directory_uri() . '/js/main.js', array('jquery'), $theme_version, true );
    wp_enqueue_script( 'cake-bakery-script', get_template_directory_uri() . '/assets/js/plugins/plugins.min.js', array('jquery'), $theme_version, true );
    wp_enqueue_script( 'single-product', get_template_directory_uri() . '/assets/js/single-product.js', array('jquery'), $theme_version, true );
    wp_enqueue_script( 'cake-bakery-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $theme_version, true );

    $ajax_url = admin_url('admin-ajax.php', 'relative');

    $script_params = array(
      'ajax_url'					=> $ajax_url,
    'sticky_header'			=> (int)cb_get_theme_options('ts_enable_sticky_header'),
    'ajax_search'				=> (int)( cb_get_theme_options('ts_ajax_search') && cb_get_theme_options('ts_header_layout') != 'v5' ),
    'flexslider' 				=> apply_filters(
        'mydecor_quickshop_product_carousel_options',
        array(
          'rtl'             => is_rtl()
        ,'animation'      => 'slide'
        ,'smoothHeight'   => true
        ,'directionNav'   => false
        ,'controlNav'     => 'thumbnails'
        ,'slideshow'      => false
        ,'animationSpeed' => 500
        ,'animationLoop'  => false // Breaks photoswipe pagination if true.
        ,'allowOneSlide'  => false
        )
      )
    );

    wp_localize_script( 'cake-bakery-main', 'cb_params', $script_params );

    /* Custom JS */
    if( $custom_js = cb_get_theme_options('cb_custom_javascript_code') ){
        wp_add_inline_script( 'cake-bakery-main', stripslashes( trim( $custom_js ) ) );
    }

}

add_action('wp_enqueue_scripts','cb_register_scripts');

function cb_get_last_save_theme_options(){
    $transients = get_option('cb_theme_options-transients', array());
    if( isset($transients['last_save']) ){
        return $transients['last_save'];
    }
    return time();
}
/*
 * dynamic css create path
 */
add_action('update_option_cb_theme_options', 'cb_create_dynamic_css', 10, 2);
function cb_create_dynamic_css( $option, $value ){
    cb_update_dynamic_css($value, $value, $option);
}
add_action('update_option_cb_theme_options', 'cb_update_dynamic_css', 10, 3);
/**
 * @param $old_value
 * @param $value
 * @param $option
 * @return dynamic css update
 */
function cb_update_dynamic_css($old_value,$value,$option){
    if( is_array($value) ){
        $data = $value;
        $upload_dir = wp_get_upload_dir();
        $filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        ob_start();
        include get_template_directory() . '/inc/dynamic_styles.php';
        $dynamic_css = ob_get_contents();
        ob_end_clean();

        global $wp_filesystem;
        if( empty( $wp_filesystem ) ) {
            require_once ABSPATH .'/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $creds = request_filesystem_credentials($filename_dir, '', false, false, array());
        if( ! WP_Filesystem($creds) ){
            return false;
        }

        if( $wp_filesystem ) {
            $wp_filesystem->put_contents(
              $filename_dir,
              $dynamic_css,
              FS_CHMOD_FILE
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'cb_register_dynamic_and_custom_styles', 9999);

function cb_register_dynamic_and_custom_styles(){
    $upload_dir = wp_get_upload_dir();
    $theme_name = strtolower( str_replace( ' ', '', wp_get_theme()->get('Name') ) );
    $filename = trailingslashit($upload_dir['baseurl']) . $theme_name . '.css';
    $filename_dir = trailingslashit($upload_dir['basedir']) . $theme_name . '.css';

    $custom_css = cb_get_theme_options('cb_custom_css_code');
    if( file_exists( $filename_dir ) ){
        wp_enqueue_style( 'cb-dynamic-css', $filename, array(), cb_get_last_save_theme_options() );
        if( $custom_css ){
            wp_add_inline_style( 'cb-dynamic-css', $custom_css );
        }
    }
    else{
        ob_start();
        include_once get_template_directory() . '/inc/dynamic_styles.php';
        $dynamic_css = ob_get_contents();
        ob_end_clean();
        wp_add_inline_style( 'cb-style', $dynamic_css );
        if( $custom_css ){
            wp_add_inline_style( 'cb-style', $custom_css );
        }
    }
}

