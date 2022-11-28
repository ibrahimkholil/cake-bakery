<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

	<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php
	// mydecor_theme_favicon();
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>


<?php
if( function_exists('wp_body_open') ){
	wp_body_open();
}
?>

<div id="page" class="site">

     <?php cb_get_header_template(); ?>


	<?php do_action('cb_before_main_content'); ?>
    
	<div id="main" class="wrapper">
