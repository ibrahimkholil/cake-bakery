<?php
if( !isset($data) ){
    $data = cb_get_theme_options();
}

update_option('cake_bakery_dynamic_styles',0);

$default_options = array(
    'cb_logo_width'									=> "",
    'cb_device_logo_width'								=> "",
//    'ts_product_rating_style'							=> 'fill',
//    'ts_custom_font_ttf'								=> array( 'url' => '' )
);
foreach( $default_options as $option_name => $value ){
    if( isset($data[$option_name]) ){
        $default_options[$option_name] = $data[$option_name];
    }
}

extract($default_options);
?>

header .logo img{
width: <?php echo absint($cb_device_logo_width); ?>px;
}


<?php update_option('cake_bakery_dynamic_styles', 1);  //uncomment after finished this file ?>
