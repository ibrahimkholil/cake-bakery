<?php

$cb_theme_options = cb_get_theme_options();


$header_classes = array();
if( $cb_theme_options['bs_enable_sticky_header'] ){
    $header_classes[] = 'has-sticky';
}

if( !$cb_theme_options['bs_enable_tiny_shopping_cart'] ){
    $header_classes[] = 'hidden-cart';
}

if( !$cb_theme_options['bs_enable_tiny_wishlist'] || !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
    $header_classes[] = 'hidden-wishlist';
}

//if( !$cb_theme_options['bs_header_currency'] ){
//    $header_classes[] = 'hidden-currency';
//}
//
//if( !$cb_theme_options['bs_header_language'] ){
//    $header_classes[] = 'hidden-language';
//}

//if( !$cb_theme_options['bs_enable_search'] ){
//    $header_classes[] = 'hidden-search';
//}
?>

<header class="bs-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <div class="header-logo navbar-brand p-0 m-0">

                <div class="logo-wrapper"><?php cb_theme_logo(); ?></div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'bakershop' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="bs-menu ms-auto">

                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu( array(
                      'theme_location'    => 'primary',
                      'depth'             => 2,
                      'container'         => 'div',
                      'container_class'   => 'collapse navbar-collapse main-menu',
                      'container_id'      => 'bs-example-navbar-collapse-1',
                      'menu_class'        => 'nav navbar-nav',
                      'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                      'walker'            => new WP_Bootstrap_Navwalker(),
                    ) );
                } else {
                    wp_nav_menu(array('container' => 'div', 'container_class' => 'collapse navbar-collapse main-menu'));
                }
                ?>
            </div>
            <div class="header-right ms-4">

                    <div class="search-button hidden-phone">
				  <span>
				  <i class="fa-solid fa-magnifying-glass"></i>
				  </span>
                    </div>



                    <div class="my-account-wrapper hidden-phone">
                        <?php echo cb_header_account(); ?>
                    </div>

                <?php if( class_exists('YITH_WCWL') ): ?>
                    <div class="my-wishlist-wrapper hidden-phone"><?php echo cb_header_wishlist(); ?></div>
                <?php endif; ?>


                    <div class="shopping-cart-wrapper">
                        <?php echo cb_header_cart(); ?>
                    </div>


            </div>

    </nav>
</header>
