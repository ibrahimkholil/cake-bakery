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


//register sidebar
function mydecor_get_list_sidebars(){
    $default_sidebars = array(
      array(
        'name' => esc_html__( 'Home Sidebar', 'mydecor' ),
        'id' => 'home-sidebar',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    ,array(
        'name' => esc_html__( 'Blog Sidebar', 'mydecor' ),
        'id' => 'blog-sidebar',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    ,array(
        'name' => esc_html__( 'Blog Detail Sidebar', 'mydecor' ),
        'id' => 'blog-detail-sidebar',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    ,array(
        'name' => esc_html__( 'Product Category Sidebar', 'mydecor' ),
        'id' => 'product-category-sidebar',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    ,array(
        'name' => esc_html__( 'Filter Widget Area', 'mydecor' ),
        'id' => 'filter-widget-area',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    ,array(
        'name' => esc_html__( 'Product Detail Sidebar', 'mydecor' ),
        'id' => 'product-detail-sidebar',
        'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
        'after_title' => '</h3></div>',
      )
    );

    $custom_sidebars = mydecor_get_custom_sidebars();
    if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
        foreach( $custom_sidebars as $name ){
            $default_sidebars[] = array(
              'name' => ''.$name.'',
              'id' => sanitize_title($name),
              'description' => '',
              'class'			=> 'ts-custom-sidebar',
              'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
              'after_widget' => '</section>',
              'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
              'after_title' => '</h3></div>',
            );
        }
    }

    return $default_sidebars;
}

function mydecor_register_widget_area(){
    $default_sidebars = mydecor_get_list_sidebars();
    foreach( $default_sidebars as $sidebar ){
        register_sidebar($sidebar);
    }
}
add_action( 'widgets_init', 'mydecor_register_widget_area' );

/* Custom Sidebar */
add_action( 'sidebar_admin_page', 'mydecor_custom_sidebar_form' );
function mydecor_custom_sidebar_form(){
    ?>
    <form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="ts-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php esc_attr_e('Custom Sidebar Name', 'mydecor'); ?>" />
        <input type="hidden" id="ts_custom_sidebar_nonce" value="<?php echo wp_create_nonce('ts-custom-sidebar'); ?>" />
        <button class="button-primary" id="ts-add-sidebar"><?php esc_html_e('Add Sidebar', 'mydecor'); ?></button>
    </form>
    <?php
}

function mydecor_get_custom_sidebars(){
    $option_name = 'ts_custom_sidebars';
    $custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars)?$custom_sidebars:array();
}

add_action('wp_ajax_mydecor_add_custom_sidebar', 'mydecor_add_custom_sidebar');
function mydecor_add_custom_sidebar(){
    if( isset($_POST['sidebar_name']) ){
        check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');

        $option_name = 'ts_custom_sidebars';
        if( !get_option($option_name) || get_option($option_name) == '' ){
            delete_option($option_name);
        }

        $sidebar_name = $_POST['sidebar_name'];

        if( get_option($option_name) ){
            $custom_sidebars = mydecor_get_custom_sidebars();
            if( !in_array($sidebar_name, $custom_sidebars) ){
                $custom_sidebars[] = $sidebar_name;
            }
            $result = update_option($option_name, $custom_sidebars);
        }
        else{
            $custom_sidebars = array();
            $custom_sidebars[] = $sidebar_name;
            $result = add_option($option_name, $custom_sidebars);
        }

        if( $result ){
            die( esc_html__('Successfully added the sidebar', 'mydecor') );
        }
        else{
            die( esc_html__('Error! It seems that the sidebar exists. Please try again!', 'mydecor') );
        }
    }
    die('');
}

add_action('wp_ajax_mydecor_delete_custom_sidebar', 'mydecor_delete_custom_sidebar');
function mydecor_delete_custom_sidebar(){
    if( isset($_POST['sidebar_name']) ){
        check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');

        $option_name = 'ts_custom_sidebars';
        $del_sidebar = trim($_POST['sidebar_name']);
        $custom_sidebars = mydecor_get_custom_sidebars();
        foreach( $custom_sidebars as $key => $value ){
            if( $value == $del_sidebar ){
                unset($custom_sidebars[$key]);
                break;
            }
        }
        $custom_sidebars = array_values($custom_sidebars);
        update_option($option_name, $custom_sidebars);
        die( esc_html__('Successfully deleted the sidebar', 'mydecor') );
    }
    die('');
}
