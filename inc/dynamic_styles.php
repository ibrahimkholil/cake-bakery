<?php
if( !isset($data) ){
    $data = cb_get_theme_options();
}

update_option('cb_load_dynamic_style', 0);

$default_options = array(
  'ts_layout_fullwidth'								=> 0
,'cb_logo_width'									=> "155"
,'cb_device_logo_width'								=> "141"
,'ts_product_rating_style'							=> 'fill'
,'ts_custom_font_ttf'								=> array( 'url' => '' )
);

foreach( $default_options as $option_name => $value ){
    if( isset($data[$option_name]) ){
        $default_options[$option_name] = $data[$option_name];
    }
}

extract($default_options);

$default_colors = array(

  'ts_main_content_background_color'							=> "#ffffff"
,'ts_text_color'											=> "#707070"
,'ts_text_light_color'										=> "#999999"

,'ts_input_text_color'										=> "#161616"
,'ts_input_text_hover'										=> "#161616"
,'ts_input_border_color'									=> "#e5e5e5"
,'ts_input_border_hover'									=> "#d1d1d1"

,'ts_link_color'											=> "#161616"
,'ts_link_color_hover'										=> "#a20401"

,'ts_text_bold_color'										=> "#161616"

,'ts_primary_color'											=> "#a20401"
,'ts_text_color_in_bg_primary'								=> "#ffffff"

,'ts_border_color'											=> "#e5e5e5"

,'ts_button_text_color'										=> "#ffffff"
,'ts_button_text_hover'										=> "#ffffff"
,'ts_button_background_color'								=> "#161616"
,'ts_button_background_hover'								=> "#a20401"
,'ts_button_border_color'									=> "#161616"
,'ts_button_border_hover'									=> "#a20401"

,'ts_text_highlight_color'									=> "#a20401"

    // BREADCRUMB
,'ts_breadcrumb_text_color'									=> "#707070"
,'ts_breadcrumb_heading_color'								=> "#161616"
,'ts_breadcrumb_link_color_hover'							=> "#a20401"
,'ts_breadcrumb_background_color'							=> "#ffffff"
,'ts_breadcrumb_border_color'								=> "#ffffff"

,'ts_breadcrumb_img_text_color'								=> "#ffffff"
,'ts_breadcrumb_img_heading_color'							=> "#ffffff"
,'ts_breadcrumb_img_link_color_hover'						=> "#ffffff"

,'ts_shop_categories_background_color'						=> "#f6f5f6"

    // HEADER
,'ts_middle_header_background_color'						=> "#ffffff"
,'ts_middle_header_icon_color'								=> "#161616"
,'ts_middle_header_icon_color_hover'						=> "#a20401"
,'ts_middle_header_icon_border_color'						=> "#e5e5e5"
,'ts_middle_header_icon_border_hover'						=> "#a20401"

,'ts_header_cart_number_color'								=> "#ffffff"
,'ts_header_cart_number_background_color'					=> "#a20401"

,'ts_header_search_text_color'								=> "#707070"
,'ts_header_search_placeholder_text'						=> "#999999"
,'ts_header_search_icon_color'								=> "#161616"
,'ts_header_search_icon_hover_color'						=> "#a20401"
,'ts_header_search_background_color'						=> "#f6f5f6"
,'ts_header_search_border_color'							=> "#f6f5f6"

,'ts_bottom_header_background_color'						=> "#ffffff"
,'ts_bottom_header_border_color'							=> "#e5e5e5"


    // MENU
,'ts_menu_text_color'										=> "#161616"
,'ts_menu_text_hover'										=> "#a20401"

,'ts_sub_menu_background_color'								=> "#ffffff"
,'ts_sub_menu_text_color'									=> "#707070"
,'ts_sub_menu_text_hover'									=> "#a20401"
,'ts_sub_menu_heading_color'								=> "#161616"

,'ts_vertical_icon_color'									=> "#a20401"
,'ts_vertical_menu_background_color'						=> "#ffffff"
,'ts_vertical_menu_border_color'							=> "#e5e5e5"
,'ts_vertical_menu_text_color'								=> "#161616"
,'ts_vertical_menu_text_hover'								=> "#a20401"
,'ts_vertical_sub_menu_text_color'							=> "#707070"
,'ts_vertical_sub_menu_text_hover'							=> "#a20401"

,'ts_header_mobile_background_color'						=> "#ffffff"
,'ts_header_mobile_icon_color'								=> "#161616"
,'ts_header_mobile_icon_border_color'						=> "#e5e5e5"
,'ts_header_mobile_cart_number_text_color'					=> "#ffffff"
,'ts_header_mobile_cart_number_background_color'			=> "#a20401"

,'ts_tab_menu_mobile_text_color'							=> "#161616"
,'ts_tab_menu_mobile_text_hover'							=> "#ffffff"
,'ts_tab_menu_mobile_border_color'							=> "#161616"
,'ts_tab_menu_mobile_background_hover'						=> "#161616"
,'ts_menu_mobile_text_color'								=> "#161616"
,'ts_menu_mobile_text_hover'								=> "#a20401"
,'ts_menu_mobile_heading_color'								=> "#161616"
,'ts_menu_mobile_background_color'							=> "#ffffff"
,'ts_menu_mobile_border_color'								=> "#e5e5e5"
,'ts_bottom_menu_mobile_text_color'							=> "#707070"
,'ts_bottom_menu_mobile_background_color'					=> "#f6f5f6"

    // FOOTER
,'ts_footer_background_color'								=> "#ffffff"
,'ts_footer_border_color'									=> "#e5e5e5"
,'ts_footer_border_hover'									=> "#161616"
,'ts_footer_text_color'										=> "#707070"
,'ts_footer_text_hover'										=> "#a20401"
,'ts_footer_heading_color'									=> "#161616"

    // PRODUCT
,'ts_rating_color'											=> "#f9ac00"
,'ts_rating_fill_color'										=> "#f9ac00"

,'ts_product_name_text_color'								=> "#161616"
,'ts_product_name_text_hover'								=> "#a20401"

,'ts_product_button_thumbnail_text_color'					=> "#161616"
,'ts_product_button_thumbnail_text_hover'					=> "#ffffff"
,'ts_product_button_thumbnail_background_color'				=> "#ffffff"
,'ts_product_button_thumbnail_background_hover'				=> "#161616"

,'ts_product_sale_label_text_color'							=> "#ffffff"
,'ts_product_sale_label_background_color'					=> "#39b54a"
,'ts_product_new_label_text_color'							=> "#ffffff"
,'ts_product_new_label_background_color'					=> "#0b5fb5"
,'ts_product_feature_label_text_color'						=> "#ffffff"
,'ts_product_feature_label_background_color'				=> "#a20401"
,'ts_product_outstock_label_text_color'						=> "#ffffff"
,'ts_product_outstock_label_background_color'				=> "#989898"

,'ts_product_price_color'									=> "#000000"
,'ts_product_del_price_color'								=> "#848484"
,'ts_product_sale_price_color'								=> "#a20401"

);

$data = apply_filters('mydecor_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
    if( isset($data[$option_name]['rgba']) ){
        $default_colors[$option_name] = $data[$option_name]['rgba'];
    }
    else if( isset($data[$option_name]['color']) ){
        $default_colors[$option_name] = $data[$option_name]['color'];
    }
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
  'ts_body_font',
  'ts_heading_font',
  'ts_menu_font',
  'ts_sub_menu_font',
);
$font_size_option_names = array(
  'ts_h1_font',
  'ts_h2_font',
  'ts_h3_font',
  'ts_h4_font',
  'ts_h5_font',
  'ts_h6_font',
  'ts_small_font',
  'ts_button_font',
  'ts_h1_ipad_font',
  'ts_h2_ipad_font',
  'ts_h3_ipad_font',
  'ts_h4_ipad_font',
  'ts_h5_ipad_font',
  'ts_h6_ipad_font',
  'ts_h1_mobile_font',
  'ts_h2_mobile_font',
  'ts_h3_mobile_font',
  'ts_h4_mobile_font',
  'ts_h5_mobile_font',
  'ts_h6_mobile_font',
);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
    $default = array(
      $option_name 						=> 'inherit'
    ,$option_name . '_weight' 			=> 'normal'
    ,$option_name . '_style' 			=> 'normal'
    ,$option_name . '_size' 			=> 'inherit'
    ,$option_name . '_line_height' 		=> 'inherit'
    ,$option_name . '_letter_spacing' 	=> 'inherit'
    );
    if( is_array($data[$option_name]) ){
        if( !empty($data[$option_name]['font-family']) ){
            $default[$option_name] = $data[$option_name]['font-family'];
        }
        if( !empty($data[$option_name]['font-weight']) ){
            $default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
        }
        if( !empty($data[$option_name]['font-style']) ){
            $default[$option_name . '_style'] = $data[$option_name]['font-style'];
        }
        if( !empty($data[$option_name]['font-size']) ){
            $default[$option_name . '_size'] = $data[$option_name]['font-size'];
        }
        if( !empty($data[$option_name]['line-height']) ){
            $default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
        }
        if( !empty($data[$option_name]['letter-spacing']) ){
            $default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
        }
    }
    extract( $default );
}
?>

/*
1. FONT FAMILY
2. FONT SIZE
3. COLORS
4. RESPONSIVE
5. FULLWIDTH LAYOUT
*/
header .logo img{
width: <?php echo absint($cb_device_logo_width); ?>px;
}
@media only screen and (min-width: 1200px){
header .logo img,
#vertical-menu-sidebar .logo img{
width: <?php echo absint($cb_logo_width); ?>px;
}
}
<?php if( isset($data['ts_product_rating_style']) && $data['ts_product_rating_style'] == 'fill' ): ?>
    .ts-testimonial-wrapper .rating span:before,
    blockquote .rating span:before,
    .woocommerce .star-rating span:before,
    .product_list_widget .star-rating span:before{
    content: "\53\53\53\53\53";
    }
    .woocommerce p.stars a:before,
    .woocommerce p.stars:hover a:before,
    .woocommerce p.stars a:hover~a:before,
    .woocommerce p.stars.selected a.active:before,
    .woocommerce p.stars.selected a.active~a:before,
    .woocommerce p.stars.selected a:not(.active):before{
    content: "\53";
    }
<?php endif; ?>


/********** 1. FONT FAMILY **********/

<?php
/* Custom Font */
if( isset($ts_custom_font_ttf) && $ts_custom_font_ttf['url'] ):
    ?>
    @font-face {
    font-family: 'CustomFont';
    src:url('<?php echo esc_url($ts_custom_font_ttf['url']); ?>') format('truetype');
    font-weight: normal;
    font-style: normal;
    }
<?php endif; ?>
html,
body,
label,
input,
textarea,
keygen,
select,
button,
.menu-item[class^="ti-"],
.menu-item[class*=" ti-"],
.menu-item.fa,
.menu-item.fab,
.menu-item.fas,
.menu-item.fab,
.ts-feature-box li[class^="ti-"],
.ts-feature-box li[class*=" ti-"],
.ts-feature-box li.fa,
.ts-feature-box li.fas,
.ts-feature-box li.far,
.ts-feature-box li.fab,
body .font-body,
.product-name,
.mc4wp-form-fields label,
#ship-to-different-address label,
form table label,
form.cart table th,
.avatar-name a,
.woocommerce h3.product-name,
.woocommerce ul.cart_list h3.product-name a,
#order_review table .product-name strong,
.breadcrumb-title-wrapper .breadcrumbs,
.product-group-button .button-tooltip,
.woocommerce ul.product_list_widget li a,
article.single-post .entry-format blockquote,
.ts-twitter-slider.twitter-content h4.name > a,
.woocommerce #order_review table.shop_table tfoot td,
.woocommerce table.shop_table.order_details tfoot td,
.dokan-category-menu .sub-block h3,
.menu-wrapper nav > ul.menu li .menu-desc,
body .dataTables_wrapper,
body .compare-list,
.widget_display_stats > dl dt,
.rating-wrapper strong.rating,
.comment_list_widget blockquote.comment-body,
.woocommerce table.shop_table_responsive tr td:before,
.woocommerce-page table.shop_table_responsive tr td:before,
.woocommerce table.shop_attributes th,
.woocommerce-cart-form__contents .product-price .amount,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
#page .summary a.compare,
#yith-wcwl-popup-message,
header .my-wishlist-wrapper .header-wishlist span,
#order_review table th,
.woocommerce table.shop_table tbody th,
.woocommerce table.woocommerce-checkout-review-order-table tfoot td,
.woocommerce table.woocommerce-checkout-review-order-table tfoot th,
ul.wishlist_table .item-details .product-name h3,
.ts-product-video-button,
.ts-product-360-button,
.woocommerce .product-label span.onsale,
.woocommerce .product-label span,
.amount,
.quantity span.amount,
.ts-menu .elementor-widget-wp-widget-media_image > .elementor-widget-container > h5,
.ts-blogs-widget-wrapper:not(.style-list-item) h6.entry-title,
.meta-navigation h6,
.woocommerce table.shop_table th,
.woocommerce-shipping-destination strong,
.woocommerce ul#shipping_method .amount,
.wishlist_table.images_grid li .item-details table.item-details-table td.label,
.wishlist_table.mobile li .item-details table.item-details-table td.label,
.wishlist_table.mobile li table.additional-info td.label,
.wishlist_table.modern_grid li .item-details table.item-details-table td.label,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li.small-menu > a,
#group-icon-header nav > ul.menu > li.small-menu > a,
.category-name h3,
.meta-wrapper .ts-countdown .counter-wrapper .number,
#page .product-group-button-meta .loop-add-to-cart a,
.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
.woocommerce div.product form.cart .variations label,
div.product:not(.show-tabs-content-default) #reviews #comments > h2,
.woocommerce.archive #primary > .woocommerce-info{
font-family: <?php echo esc_html($ts_body_font); ?> , sans-serif;
font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>;
}

h1,h2,h3,
h4,h5,h6,
.h1,.h2,.h3,
.h4,.h5,.h6,
fieldset legend,
.cart-collaterals .cart_totals > h2,
.woocommerce-checkout #order_review_heading,
table thead th,
table th,
.widget_recent_entries .post-date,
.avatar-name a,
.woocommerce form .form-row label.inline,
.ts-blogs .button-readmore.button-text,
.widget_rss .rsswidget,
table#wp-calendar thead th,
body div.ppt,
.cart_list .quantity,
body .woocommerce table.compare-list .add-to-cart td a,
body table.compare-list tr.price td,
footer .mailchimp-subscription .widget-title,
.blank-page-template .mailchimp-subscription .widget-title,
a.button,
button,
input[type^="submit"],
.shopping-cart p.buttons a,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
#content button.button,
.woocommerce #respond input#submit,
#page .main-products.list .product-group-button-meta > div.loop-add-to-cart a,
.woocommerce .wishlist_table .product-add-to-cart a,
.woocommerce-account .woocommerce-MyAccount-navigation li a,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button,
.portfolio-info > span:first-child,
.woocommerce > form > fieldset legend,
.cloud-zoom-title,
body .product-edit-new-container .dokan-btn-lg,
.ts-search-result-container li a span.hightlight,
.ts-button,
body a.button-text,
.portfolio-inner h3 a,
.woocommerce div.product form.cart .quantity span,
body table.compare-list th,
.heading-title,
.woocommerce table.shop_attributes th,
.chart-table tr:first-child td,
.woocommerce div.product .entry-title,
.woocommerce table.shop_table.order_details tfoot th,
#add_payment_method .cart-collaterals .shipping-calculator-button,
.woocommerce-cart .cart-collaterals .shipping-calculator-button,
.woocommerce-checkout .cart-collaterals .shipping-calculator-button,
.woocommerce-message,
.woocommerce .woocommerce-message,
.woocommerce-error,
.woocommerce .woocommerce-error,
.woocommerce-info,
.woocommerce .woocommerce-info,
#ts-ajax-add-to-cart-message,
li.item-strong > a > .menu-label,
li.item-strong-color > a > .menu-label,
.ts-cart-checkout-process-bar .status,
#comments .wcpr-overall-rating-left-average,
#comments .wcpr-filter-button,
article.single .entry-meta-bottom > div > span,
div.product .single-navigation > a > span,
.elementor-image figcaption,
.widget_shopping_cart .total-title,
.tab-mobile-menu li span,
.filter-widget-area-button,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a,
article .cats-link a,
.widget_calendar caption,
.entry-author .author-info .author,
blockquote .author-role .author,
.ts-countdown .counter-wrapper .number,
.single-counter-wrapper .ts-countdown,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li > a,
.ts-product-categories-widget div > ul > li > a,
.ts-product-categories-widget-wrapper .all-categories,
.ts-product-deals-wrapper header .ts-countdown,
html body > h1,
#page rs-layer .product-group-button-meta > div.loop-add-to-cart a,
rs-layer .woocommerce .products .product ins .amount,
.ts-menu .elementor-widget-wp-widget-media_image > .elementor-widget-container > h5{
font-family: <?php echo esc_html($ts_heading_font); ?> , sans-serif;
font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
letter-spacing: <?php echo esc_html($ts_heading_font_letter_spacing); ?>;
}
header nav.main-menu > ul.menu > li > a,
header nav.main-menu > ul > li > a,
.mobile-menu-wrapper nav > ul > li > a{
font-family: <?php echo esc_html($ts_menu_font); ?> , sans-serif;
font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
letter-spacing: <?php echo esc_html($ts_menu_font_letter_spacing); ?>;
}
header nav > ul.menu ul.sub-menu,
header nav > ul.menu ul.sub-menu > li > a,
header nav > ul.menu .elementor-widget-wp-widget-nav_menu li > a{
font-family: <?php echo esc_html($ts_sub_menu_font); ?> , sans-serif;
font-weight: <?php echo esc_html($ts_sub_menu_font_weight); ?>;
letter-spacing: <?php echo esc_html($ts_sub_menu_font_letter_spacing); ?>;
}


/********** 2. FONT SIZE **********/

html,
body,
select option,
.woocommerce div.product p.price,
.mc4wp-form-fields label,
ul li .ts-megamenu-container,
.comment-text,
.woocommerce .order_details li,
.comment_list_widget .comment-body,
.post_list_widget .excerpt,
article.single-post .entry-format blockquote,
.woocommerce ul.products li.product .price del,
.woocommerce ul.products li.product .price,
.ts-tiny-cart-wrapper .form-content > label,
.shopping-cart-wrapper .ts-tiny-cart-wrapper,
.widget_calendar th,
.widget_calendar td,
.post_list_widget blockquote,
.woocommerce table.wishlist_table,
body table.compare-list tr.image td,
body table.compare-list tr.price td,
h3 > label,
.dokan-category-menu .sub-block h3,
.woocommerce div.product .woocommerce-tabs .panel,
.rating-wrapper strong.rating,
body .wpml-ls-legacy-list-vertical a,
body .wpml-ls-legacy-list-horizontal ul li a,
.mobile-button-custom *,
.ts-menu .elementor-widget-wp-widget-media_image > .elementor-widget-container > h5,
.ts-cart-checkout-process-bar h6,
.cart-collaterals .cart_totals > h2,
.woocommerce-checkout #order_review_heading,
.elementor-image figcaption,
/* COMPARE TABLE */
body table.compare-list,
body table.compare-list tr.image th,
body table.compare-list tr.image td,
body table.compare-list tr.title th,
body table.compare-list tr.title td,
body table.compare-list th,
body table.compare-list td,
body table.compare-list th{
font-size: <?php echo esc_html($ts_body_font_size); ?>;
line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
}
select,
.yith-wfbt-items label,
.woocommerce table.my_account_orders td,
.woocommerce table.shop_table.my_account_orders,
body .select2-container--default .select2-selection--single .select2-selection__rendered,
.ts-active-filters .widget_layered_nav_filters .widgettitle,
.mailchimp-subscription .mc4wp-alert,
.widget-container .product_list_widget .price .amount,
.woocommerce .product .category-name h3,
.ts-product-brand-wrapper .item .meta-wrapper h3,
.woocommerce .products .product .amount,
.popular-searches h6,
footer .widget-title,
.widget-title,
.ts-sidebar .wp-block-group__inner-container > h2,
.filter-widget-area .widget-title,
.post_list_widget h6.entry-title,
.product-meta .amount,
.price .amount,
.wishlist_table .amount,
.yith-wfbt-section .amount,
#page .fix-height .ts-product-deals-wrapper .product .price del .amount,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li.small-menu > a,
.woocommerce-account .addresses .title h3,
.woocommerce-account .addresses h2,
.woocommerce-customer-details .addresses h2,
#page .product-group-button-meta > div.loop-add-to-cart a,
.woocommerce div.product .images .product-label span,
.single-counter-wrapper .availability-bar .sold,
.summary .yith-wfbt-submit-block .total_price_label,
.woocommerce div.product form.cart .variations th.label > span:before,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta{
font-size: <?php echo esc_html($ts_body_font_size); ?>;
}
.tagcloud a{
font-size: <?php echo esc_html($ts_body_font_size); ?> !important;
line-height: <?php echo esc_html($ts_body_font_line_height); ?> !important;
}
input,
textarea,
keygen,
.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea,
.dokan-form-control,
#add_payment_method table.cart td.actions .coupon .input-text,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.woocommerce-checkout table.cart td.actions .coupon .input-text,
.woocommerce-columns > h3,
.hidden-title-form input[type="text"]{
font-size: <?php echo esc_html($ts_body_font_size); ?>;
line-height: 30px;/* default */
}
dt,
dd,
ol li,
ul li,
.woocommerce form .form-row label,
body .yith-wfbt-items label,
.mailchimp-subscription .mc4wp-alert{
line-height: 22px;/* default */
}

h1,
.h1{
font-size: <?php echo esc_html($ts_h1_font_size); ?>;
line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
}

h2,
.h2,
.ts-countdown:not(.style-inline) .counter-wrapper .number,
.breadcrumb-title h1{
font-size: <?php echo esc_html($ts_h2_font_size); ?>;
line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
}
h3,
.h3,
blockquote,
footer .mailchimp-subscription .widget-title,
.ts-sidebar-content h2,
.blank-page-template .mailchimp-subscription .widget-title,
.list-posts .entry-title,
.heading-shortcode > h3,
.heading-wrapper > h2,
#order_review_heading,
.woocommerce-account .page-container div.woocommerce > h2,
.account-content h2,
.woocommerce-MyAccount-content > h2,
.woocommerce-customer-details > h2,
.woocommerce-order-details > h2,
.woocommerce-billing-fields > h3,
.woocommerce-additional-fields > h3,
header.woocommerce-Address-title > h3,
.woocommerce div.wishlist-title h2,
.ts-portfolio-wrapper .shortcode-heading-wrapper > h2,
.theme-title .heading-title,
.woocommerce .ts-col-24 div.product .entry-title,
.shortcode-heading-wrapper h2,
.heading-tab h2,
.yith-wfbt-submit-block .total_price .amount{
font-size: <?php echo esc_html($ts_h3_font_size); ?>;
line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
}
h4,
.h4,
.ts-countdown:not(.style-inline) .ref-wrapper,
.ts-product-category-wrapper .shortcode-heading-wrapper h2,
footer .elementor-widget-wp-widget-woocommerce_product_tag_cloud > .elementor-widget-container > h5,
footer .elementor-widget-wp-widget-tag_cloud > .elementor-widget-container > h5,
.single-counter-wrapper .ts-countdown,
.yith-wfbt-submit-block .total_price_label,
.woocommerce div.product .summary p.price .amount,
div.product .summary .ts-variation-price .amount,
.woocommerce .show-tabs-content-default .product-content > h2:first-child,
.woocommerce .show-tabs-content-default .wc-tab > h2:first-child,
.woocommerce .show-tabs-content-default #comments > .woocommerce-Reviews-title,
.woocommerce div.product .woocommerce-tabs ul.tabs li,
.woocommerce div.product.summary-2-columns .woocommerce-tabs ul.tabs li,
.woocommerce .yith-wfbt-section > h3,
.woocommerce div.product.summary-2-columns .cross-sells > h2,
.woocommerce div.product.summary-2-columns .up-sells > h2,
.woocommerce div.product.summary-2-columns .related > h2,
.woocommerce .cross-sells > h2,
.woocommerce .up-sells > h2,
.woocommerce .related > h2,
.woocommerce div.product .entry-title,
.woocommerce div.product.summary-2-columns .entry-title,
.summary .yith-wfbt-submit-block .total_price .amount,
html body > h1,
.woocommerce.archive #primary > .woocommerce-info,
.ts-banner.style-button .ts-banner-button a.button,
.woocommerce .ts-banner.style-button .ts-banner-button a.button{
font-size: <?php echo esc_html($ts_h4_font_size); ?>;
line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
}

h5,
.h5,
.entry-content h1.blog-title,
.mc4wp-form-fields > h2.title,
.ts-banner.size-small h4,
.dropdown-container .cart-number,
.entry-author .author-info .author,
blockquote .author-role .author,
.yith-wfbt-section > h3,
.team-info h3.name,
.ts-portfolio-wrapper .heading-title,
.ts-blogs .entry-title{
font-size: <?php echo esc_html($ts_h5_font_size); ?>;
line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
}
h6,.h6,
.dropdown-container .dropdown-title,
#customer_login h2,
.woocommerce table.order_details tfoot .amount,
.woocommerce table.order_details tfoot .amount,
.dokan-pagination-container .dokan-pagination,
.woocommerce-tabs #comments > h2,
.comment-respond #reply-title,
.ts-product-brand-wrapper .item .meta-wrapper h3,
.single-post > .entry-content > .content-wrapper,
.ts-portfolio-wrapper .filter-bar li,
.elementor-widget-wp-widget-nav_menu .elementor-widget-container > h5,
.ts-list-of-product-categories-wrapper .heading-title,
.woocommerce div.product .summary .woocommerce-tabs ul.tabs li,
.wcpr-overall-rating-and-rating-count h2,
#page .summary .yith-wfbt-section > h3{
font-size: <?php echo esc_html($ts_h6_font_size); ?>;
line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
}
.ts-product-deals-wrapper header .ts-countdown{
font-size: <?php echo esc_html($ts_h6_font_size); ?>;
}

/* HEADER */
.wpcf7 p,
.my-wishlist-wrapper a,
.my-account-wrapper .account-control > a,
header .header-currency .wcml_currency_switcher > a,
header .header-language .wpml-ls > ul > li > a,
.woocommerce-cart .cart-collaterals .cart_totals .woocommerce-shipping-destination,
#add_payment_method .cart-collaterals .shipping-calculator-button,
.woocommerce-cart .cart-collaterals .shipping-calculator-button,
.woocommerce-checkout .cart-collaterals .shipping-calculator-button,
.woocommerce-cart .cart-collaterals .cart_totals .woocommerce-shipping-destination,
.woocommerce table.shop_table.order_details tfoot th,
.woocommerce #order_review table.shop_table th,
.cart_totals table tbody th,
.woocommerce #payment div.payment_box,
p.lost_password a,
.my-account-wrapper .forgot-pass a,
body .my-account-wrapper .form-content a.sign-up,
.woocommerce-product-rating .woocommerce-review-link,
.ts-active-filters .widget_layered_nav_filters ul li a,
.widget_rss .rss-date,
#cancel-comment-reply-link,
.woocommerce ul.product_list_widget li dl,
.breadcrumb-title-wrapper .breadcrumbs-container span:not(.current),
#ts-login-form .login-remember,
.woocommerce-form-login__rememberme,
#page .summary .compare,
#page .summary .yith-wcwl-add-to-wishlist,
.woocommerce .wishlist_table .product-add-to-cart a,
.woocommerce .wishlist_table .product-add-to-cart a.button,
#comments .wcpr-overall-rating-right .wcpr-overall-rating-right-total,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time,
article.single div.entry-meta-bottom > div > span,
.portfolio-info > span:first-child,
.availability-bar .sold,
.category-name .count,
.widget_rss cite,
.woocommerce .woocommerce-ordering .orderby-current,
.product-per-page-form ul.perpage > li span,
.widget_price_filter .price_slider_amount .price_label,
.woocommerce-widget-layered-nav-list__item a,
.ts-product-attribute > div,
.woocommerce table.shop_table th,
form.login p.lost_password,
.woocommerce #payment ul.payment_methods li label,
#order_review table.shop_table #shipping_method,
.yith-wcwl-share h4.yith-wcwl-share-title,
.wishlist_table tr td.product-stock-status span,
.wishlist_table.images_grid li .item-details table.item-details-table td,
.wishlist_table.mobile li .item-details table.item-details-table td,
.wishlist_table.mobile li table.additional-info td,
.wishlist_table.modern_grid li .item-details table.item-details-table td,
.menu-desc,
.breadcrumb-title-wrapper .breadcrumb-title,
.ts-product-attribute .button-tooltip,
.woocommerce .product-group-button .button-tooltip,
.product-group-button .button-tooltip,
.product-group-button-meta .button-in .button-tooltip,
#page .main-products.list .product-group-button-meta .button-in a,
.cart-dropdown-form .clear-cart-button,
#comment-wrapper .comment-edit-link,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce .yith-woocompare-widget a.compare.button,
.ts-product-video-button,
.ts-product-360-button,
.ts-product-size-chart-button,
.ts-social-sharing ul li a,
.tab-mobile-menu li,
.woocommerce .product-label span,
.category-best-selling .product-label.best-selling-label,
.filter-widget-area-button,
.product-per-page-form > span,
.product-on-sale-form label,
.woocommerce .woocommerce-ordering .orderby li,
.product-per-page-form ul.perpage li,
.ts-shop-result-count,
.entry-meta-top,
.comment_list_widget .meta,
blockquote .entry-meta-middle,
.entry-author .author-info .role,
body .comment-meta .button-text a,
.list-posts article .cats-link a,
.ts-portfolio-wrapper .cats-link a,
.single-post article .cats-link a,
.ts-blogs article .cats-link a,
.wishlist_table.images_grid li .item-details table.item-details-table td.label,
.wishlist_table.mobile li .item-details table.item-details-table td.label,
.wishlist_table.mobile li table.additional-info td.label,
.wishlist_table.modern_grid li .item-details table.item-details-table td.label,
.woocommerce table.shop_table_responsive tr td:before,
.woocommerce-page table.shop_table_responsive tr td:before,
.cart-item-wrapper .quantity input.qty,
.woocommerce .cart-item-wrapper .quantity input.qty,
.detail-meta-top .availability,
.ts-product-size-chart-button,
div.product .single-navigation > a > span,
.woocommerce div.product form.cart .variations th.label > span,
.woocommerce-message,
.woocommerce .woocommerce-message,
.woocommerce-error,
.woocommerce .woocommerce-error,
.woocommerce-info,
.woocommerce .woocommerce-info,
body #ts-ajax-add-to-cart-message{
font-size: <?php echo esc_html($ts_small_font_size); ?>;
}

/* MENU */
#group-icon-header .menu-title,
.mobile-menu-wrapper nav > ul li > a,
.mobile-menu-wrapper nav > ul li.fa:before,
.mobile-menu-wrapper nav > ul li.fas:before,
.mobile-menu-wrapper nav > ul li.far:before,
.mobile-menu-wrapper nav > ul li.fab:before,
.menu-wrapper nav > ul.menu > li > a,
.menu-wrapper nav > ul > li > a,
.menu-wrapper nav > ul.menu > li.menu-item:before{
font-size: <?php echo esc_html($ts_menu_font_size); ?>;
line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
}
.mobile-menu-wrapper span.ts-menu-drop-icon:before{
line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
}
.menu-wrapper nav > ul.menu ul li.menu-item:before,
.menu-wrapper nav > ul.menu ul.sub-menu,
.menu-wrapper nav > ul.menu ul.sub-menu > li > a,
.menu-wrapper nav > ul.menu .elementor-widget-wp-widget-nav_menu li > a{
font-size: <?php echo esc_html($ts_menu_font_size); ?>;
line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
}
header .header-currency  ul li,
header .header-language ul li,
header .wpml-ls-legacy-dropdown a{
line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
}

/* VERTICAL MENU */
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li > a,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu ul.sub-menu > li > a{
font-size: <?php echo esc_html($ts_h6_font_size); ?>;
line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
}
#vertical-menu-sidebar .vertical-menu-wrapper .ts-menu-drop-icon{
line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
}

/* PRODUCT */
h3.product-name,
body table.compare-list tr.title td,
.single-navigation .product-info > div > span:first-child,
ul.wishlist_table .item-details .product-name h3,
#ts-search-result-container ul li a{
font-size: <?php echo esc_html($ts_body_font_size); ?>;
line-height: 22px;
}
.product-brands,
.woocommerce .products .product .product-categories,
.products .product .product-sku,
body table.compare-list tr.price .amount,
body table.compare-list tr.price del .amount,
body table.compare-list tr.price th,
body table.compare-list tr.price td,
.woocommerce .products .product .price,
.single-navigation .product-info > div > span:first-child,
ul.wishlist_table .item-details .product-name h3{
line-height: 22px;
}
/* BUTTON */
.woocommerce a.button.added:before,
.woocommerce button.button.added:before,
.woocommerce input.button.added:before,
a.ts-button,
a.button,
button,
input[type^="submit"],
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce a.button.disabled,
.woocommerce a.button:disabled,
.woocommerce a.button:disabled[disabled],
.woocommerce button.button.disabled,
.woocommerce button.button:disabled,
.woocommerce button.button:disabled[disabled],
.woocommerce input.button.disabled,
.woocommerce input.button:disabled,
.woocommerce input.button:disabled[disabled],
.woocommerce #respond input#submit,
.shopping-cart p.buttons a,
html body.woocommerce table.compare-list tr.add-to-cart td a:before,
html body table.compare-list tr.add-to-cart td a:before,
.woocommerce-account .woocommerce-MyAccount-navigation li a,
body .product-edit-new-container .dokan-btn-lg,
.woocommerce .hidden-title-form a.hide-title-form,
#comments .wcpr-filter-button,
.woocommerce .wishlist_table .product-add-to-cart a,
#page .main-products.list .product-group-button-meta > div.loop-add-to-cart a,
/* Compare */
body .woocommerce table.compare-list .add-to-cart td a,
/* Dokan */
input[type="submit"].dokan-btn,
a.dokan-btn,
.dokan-btn{
font-size: <?php echo esc_html($ts_button_font_size); ?>;
line-height: 30px;/* default */
}
.ts-banner-button a.button:after,
a.button-text{
font-size: <?php echo esc_html($ts_button_font_size); ?>;
}

@media
only screen and (max-width: 1200px) and (min-width: 768px){
h1,
.h1,
.blank-page-template h1.h2{
font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
}

h2,
.h2,
.ts-countdown:not(.style-inline) .counter-wrapper .number,
.breadcrumb-title h1,
.single-ts_portfolio article.single .entry-title{
font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
}
h3,
.h3,
blockquote,
footer .mailchimp-subscription .widget-title,
.ts-sidebar-content h2,
.blank-page-template .mailchimp-subscription .widget-title,
.list-posts .entry-title,
.heading-shortcode > h3,
.heading-wrapper > h2,
#order_review_heading,
.woocommerce-account .page-container div.woocommerce > h2,
.account-content h2,
.woocommerce-MyAccount-content > h2,
.woocommerce-customer-details > h2,
.woocommerce-order-details > h2,
.woocommerce-billing-fields > h3,
.woocommerce-additional-fields > h3,
header.woocommerce-Address-title > h3,
.woocommerce div.wishlist-title h2,
.ts-portfolio-wrapper .shortcode-heading-wrapper > h2,
.theme-title .heading-title,
.woocommerce div.product .entry-title,
.woocommerce .ts-col-24 div.product .entry-title,
.shortcode-heading-wrapper h2,
.heading-tab h2,
.yith-wfbt-submit-block .total_price .amount,
article.single h2.entry-title,
.woocommerce div.product.summary-2-columns .entry-title,
.summary .yith-wfbt-submit-block .total_price .amount,
html body > h1{
font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
}
h4,
.h4,
.ts-countdown:not(.style-inline) .ref-wrapper,
.ts-product-category-wrapper .shortcode-heading-wrapper h2,
footer .elementor-widget-wp-widget-woocommerce_product_tag_cloud > .elementor-widget-container > h5,
footer .elementor-widget-wp-widget-tag_cloud > .elementor-widget-container > h5,
.single-counter-wrapper .ts-countdown,
.woocommerce div.product .summary p.price .amount,
div.product .summary > .ts-variation-price .amount,
.woocommerce .show-tabs-content-default .product-content > h2:first-child,
.woocommerce .show-tabs-content-default .wc-tab > h2:first-child,
.woocommerce .show-tabs-content-default #comments > .woocommerce-Reviews-title,
.woocommerce div.product.summary-2-columns .woocommerce-tabs ul.tabs li,
.woocommerce div.product .woocommerce-tabs ul.tabs li,
.woocommerce div.product.summary-2-columns .yith-wfbt-section > h3,
.woocommerce .yith-wfbt-section > h3,
.woocommerce div.product.summary-2-columns .cross-sells > h2,
.woocommerce div.product.summary-2-columns .up-sells > h2,
.woocommerce div.product.summary-2-columns .related > h2,
.woocommerce .cross-sells > h2,
.woocommerce .up-sells > h2,
.woocommerce .related > h2,
.woocommerce.archive #primary > .woocommerce-info,
.ts-banner.style-button .ts-banner-button a.button,
.woocommerce .ts-banner.style-button .ts-banner-button a.button{
font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
}

h5,
.h5,
.entry-content h1.blog-title,
.mc4wp-form-fields > h2.title,
.ts-banner.size-small h4,
.dropdown-container .cart-number,
.entry-author .author-info .author,
blockquote .author-role .author,
.woocommerce .show-tabs-content-default .product-content > h2:first-child,
.woocommerce .show-tabs-content-default .wc-tab > h2:first-child,
.woocommerce .show-tabs-content-default #comments > .woocommerce-Reviews-title,
.yith-wfbt-section > h3,
.team-info h3.name,
.ts-portfolio-wrapper .heading-title,
.ts-blogs .entry-title,
#page .summary .yith-wfbt-section > h3{
font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
}
h6,.h6,
.dropdown-container .dropdown-title,
#customer_login h2,
.woocommerce table.order_details tfoot .amount,
.woocommerce table.order_details tfoot .amount,
.dokan-pagination-container .dokan-pagination,
.woocommerce-tabs #comments > h2,
.comment-respond #reply-title,
.ts-product-brand-wrapper .item .meta-wrapper h3,
.single-post > .entry-content > .content-wrapper,
.ts-portfolio-wrapper .filter-bar li,
.woocommerce div.product .images .product-label span,
.elementor-widget-wp-widget-nav_menu .elementor-widget-container > h5,
.ts-list-of-product-categories-wrapper .heading-title,
.woocommerce div.product .summary .woocommerce-tabs ul.tabs li,
.wcpr-overall-rating-and-rating-count h2,
.yith-wfbt-submit-block .total_price_label{
font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
}
}
@media
only screen and (max-width: 991px) and (min-width: 768px){
.ts-banner h4{
font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
}
}
@media
only screen and (max-width: 767px){
h1,
.h1{
font-size: <?php echo esc_html($ts_h1_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h1_mobile_font_line_height); ?>;
}

h2,
.h2,
.ts-countdown:not(.style-inline) .counter-wrapper .number{
font-size: <?php echo esc_html($ts_h2_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h2_mobile_font_line_height); ?>;
}
h3,
.h3,
.breadcrumb-title h1,
blockquote,
footer .mailchimp-subscription .widget-title,
.ts-sidebar-content h2,
.blank-page-template .mailchimp-subscription .widget-title,
.list-posts .entry-title,
.heading-shortcode > h3,
.heading-wrapper > h2,
#order_review_heading,
.woocommerce-account .page-container div.woocommerce > h2,
.account-content h2,
.woocommerce-MyAccount-content > h2,
.woocommerce-customer-details > h2,
.woocommerce-order-details > h2,
.woocommerce-billing-fields > h3,
.woocommerce-additional-fields > h3,
header.woocommerce-Address-title > h3,
.woocommerce div.wishlist-title h2,
.ts-portfolio-wrapper .shortcode-heading-wrapper > h2,
.theme-title .heading-title,
.woocommerce div.product .entry-title,
.woocommerce .ts-col-24 div.product .entry-title,
.shortcode-heading-wrapper h2,
.heading-tab h2,
.yith-wfbt-submit-block .total_price .amount,
article.single h2.entry-title,
.woocommerce div.product.summary-2-columns .entry-title,
.summary .yith-wfbt-submit-block .total_price .amount,
html body > h1{
font-size: <?php echo esc_html($ts_h3_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h3_mobile_font_line_height); ?>;
}
h4,
.h4,
.ts-countdown:not(.style-inline) .ref-wrapper,
.ts-product-category-wrapper .shortcode-heading-wrapper h2,
footer .elementor-widget-wp-widget-woocommerce_product_tag_cloud > .elementor-widget-container > h5,
footer .elementor-widget-wp-widget-tag_cloud > .elementor-widget-container > h5,
.single-counter-wrapper .ts-countdown,
.woocommerce div.product .summary p.price .amount,
div.product .summary > .ts-variation-price .amount,
.woocommerce .show-tabs-content-default .product-content > h2:first-child,
.woocommerce .show-tabs-content-default .wc-tab > h2:first-child,
.woocommerce .show-tabs-content-default #comments > .woocommerce-Reviews-title,
.woocommerce div.product.summary-2-columns .woocommerce-tabs ul.tabs li,
.woocommerce div.product .woocommerce-tabs ul.tabs li,
.woocommerce div.product.summary-2-columns .yith-wfbt-section > h3,
.woocommerce .yith-wfbt-section > h3,
.woocommerce div.product.summary-2-columns .cross-sells > h2,
.woocommerce div.product.summary-2-columns .up-sells > h2,
.woocommerce div.product.summary-2-columns .related > h2,
.woocommerce .cross-sells > h2,
.woocommerce .up-sells > h2,
.woocommerce .related > h2{
font-size: <?php echo esc_html($ts_h4_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h4_mobile_font_line_height); ?>;
}

h5,
.h5,
.entry-content h1.blog-title,
.mc4wp-form-fields > h2.title,
.ts-banner.size-small h4,
.dropdown-container .cart-number,
.entry-author .author-info .author,
blockquote .author-role .author,
.woocommerce .show-tabs-content-default .product-content > h2:first-child,
.woocommerce .show-tabs-content-default .wc-tab > h2:first-child,
.woocommerce .show-tabs-content-default #comments > .woocommerce-Reviews-title,
.yith-wfbt-section > h3,
.team-info h3.name,
.ts-portfolio-wrapper .heading-title,
.ts-blogs .entry-title,
#page .summary .yith-wfbt-section > h3,
.woocommerce.archive #primary > .woocommerce-info,
.ts-banner.style-button .ts-banner-button a.button,
.woocommerce .ts-banner.style-button .ts-banner-button a.button{
font-size: <?php echo esc_html($ts_h5_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h5_mobile_font_line_height); ?>;
}
h6,.h6,
.dropdown-container .dropdown-title,
#customer_login h2,
.woocommerce table.order_details tfoot .amount,
.woocommerce table.order_details tfoot .amount,
.dokan-pagination-container .dokan-pagination,
.woocommerce-tabs #comments > h2,
.comment-respond #reply-title,
.ts-product-brand-wrapper .item .meta-wrapper h3,
.single-post > .entry-content > .content-wrapper,
.ts-portfolio-wrapper .filter-bar li,
.woocommerce div.product .images .product-label span,
.elementor-widget-wp-widget-nav_menu .elementor-widget-container > h5,
.ts-list-of-product-categories-wrapper .heading-title,
.woocommerce div.product .summary .woocommerce-tabs ul.tabs li,
.wcpr-overall-rating-and-rating-count h2,
.yith-wfbt-submit-block .total_price_label{
font-size: <?php echo esc_html($ts_h6_mobile_font_size); ?>;
line-height: <?php echo esc_html($ts_h6_mobile_font_line_height); ?>;
}
}

/********** 3. COLORS **********/

/* Background Content Color */
body #main,
body.dokan-store #main:before,
#cboxLoadedContent,
.shopping-cart-wrapper .dropdown-container:before,
.my-account-wrapper .dropdown-container:before,
form.checkout div.create-account,
.ts-popup-modal .popup-container,
.ts-floating-sidebar .ts-sidebar-content,
#ts-mobile-button-bottom,
body .select2-container--default .select2-selection--single .select2-selection__rendered,
#yith-wcwl-popup-message,
.dataTables_wrapper,
body > .compare-list,
.single-navigation > div .product-info:before,
.single-navigation .product-info:before,
.archive.ajax-pagination .woocommerce > .products:after,
#page div.product .summary a.compare.loading:after,
#yith-woocompare table.compare-list tr.remove td > a .blockOverlay:after,
#page div.product .summary .yith-wcwl-add-to-wishlist a.loading:after,
.woocommerce div.blockUI.blockOverlay:after,
div.product .summary .yith-wcwl-add-to-wishlist a.loading:after,
.dropdown-container ul.cart_list li.loading:after,
.woocommerce a.button.loading:after,
.woocommerce button.button.loading:after,
.woocommerce input.button.loading:after,
div.blockUI.blockOverlay:after,
.cart-dropdown-form.loading .cart_list:after,
.woocommerce-wishlist .product-add-to-cart a.loading:after,
#cboxLoadingGraphic:after,
.ts-popup-modal.loading .overlay:after,
.ts-blogs .article-content,
.list-posts > article,
div.product .single-navigation a .product-info,
#comments .wcpr-filter-container ul.wcpr-filter-button-ul,
.archive.woocommerce .woocommerce .product-wrapper,
.shopping-cart-wrapper .dropdown-container:before,
.my-account-wrapper .dropdown-container:before,
.woocommerce .woocommerce-ordering .orderby ul:before,
.product-per-page-form ul.perpage ul:before,
.ts-testimonial-wrapper .testimonial-content,
ul.wishlist_table .product-remove a,
.shop-top-list-categories .products .product .product-wrapper,
.product-on-sale-form label:before,
.main-products:before,
.ts-shortcode.has-background-item .product .product-wrapper,
.woocommerce .quantity input.qty,
.quantity input.qty,
div.product .single-navigation > a > span,
.summary-2-columns .ts-product-attribute > div:not(.color) a{
background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
}

/* BODY COLOR */
body,
.woocommerce .woocommerce-ordering ul li a,
.product-per-page-form ul.perpage ul li a,
.wishlist_table tr td.product-stock-status span,
.woocommerce div.product .summary .woocommerce-product-details__short-description,
.cats-link,
.tags-link,
.brands-link,
.tags-link a,
.brands-link a,
.tagcloud a,
.account-dropdown-form ul li > a,
/* Widget */
.comment_list_widget .comment-body,
.woocommerce table.shop_attributes td,
.woocommerce table.shop_attributes th,
.woocommerce p.stars a,
.woocommerce-product-rating .woocommerce-review-link,
table tfoot th,
.woocommerce-checkout #payment div.payment_box,
.dashboard-widget.products ul li a,
.list-cats li a,
.product-categories .count,
.woocommerce-product-rating .woocommerce-review-link,
.dataTables_wrapper,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.woocommerce-checkout table.cart td.actions .coupon .input-text,
.ts-tiny-cart-wrapper .subtotal > span:first-child,
p.lost_password a,
.my-account-wrapper .forgot-pass a,
.login-remember label,
.woocommerce-form-login__rememberme,
.forgot-pass a,
body .my-account-wrapper .form-content a.sign-up,
.product .product-brands a,
.meta-wrapper .product-categories a,
.widget-container ul li .product-categories a,
.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
.woocommerce div.product div.images .woocommerce-product-gallery__trigger,
#page .summary .yith-wcwl-add-to-wishlist a,
#page .summary a.compare,
.ts-cart-checkout-process-bar a div > span:not(.status),
.ts-product-categories-widget ul ul > li a,
.widget_product_categories ul ul > li a,
.product-filter-by-brand ul ul > li label,
.woocommerce.item-layout-list .count,
.ts-list-of-product-categories-wrapper .list-categories li a,
.ts-product-size-chart-button,
body .comment-meta .button-text a,
.portfolio-info .cat-links a,
.ts-team-members .name a,
.summary .cat-links a,
.more-less-buttons a,
.ts-product-video-button,
.ts-product-360-button,
.woocommerce table.shop_table th,
.availability span:not(.availability-text),
/* Widget */
.widget-container ul li > a,
.dokan-widget-area .widget ul li > a,
.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li a,
.product-filter-by-brand ul li label,
.product-filter-by-availability ul li label,
.woocommerce .woocommerce-ordering .orderby li a,
body .select2-container--default .select2-selection--single .select2-selection__arrow b:before,
.tagcloud a,
.single-post article .tags-link a,
.popular-searches a,
#page .product-group-button-meta > div a,
#page .main-products.list .product-group-button-meta > .button-in .button-tooltip,
.woocommerce table.shop_table_responsive tr td:before,
.woocommerce-page table.shop_table_responsive tr td:before,
div.product:not(.show-tabs-content-default) #reviews #comments > h2{
color: <?php echo esc_html($ts_text_color); ?>;
}
.woocommerce p.stars a:hover~a:before,
.woocommerce p.stars.selected a.active~a:before{
color: <?php echo esc_html($ts_text_color); ?> !important;
}
.wp-caption p.wp-caption-text,
.entry-meta-top,
.comment_list_widget .meta,
.widget_recent_comments ul li,
.widget_categories > ul > li,
.widget_archive > ul > li,
.widget_rss .rss-date,
.widget_rss cite,
.entry-author .author-info .role,
.product-wrapper > .meta-wrapper .count,
.summary .yith-wfbt-submit-block .total_price_label,
.comment-text p.meta time,
.comment-text .woocommerce-review__dash{
color: <?php echo esc_html($ts_text_light_color); ?>;
}
@media
only screen and (max-width: 991px){
body .yith-wfbt-submit-block .total_price_label{
color: <?php echo esc_html($ts_text_light_color); ?>;
}
}
body .yith-woocompare-widget ul.products-list a.remove,
.cart_list li .cart-item-wrapper a.remove,
.woocommerce .widget_shopping_cart .cart_list li a.remove,
.woocommerce.widget_shopping_cart .cart_list li a.remove,
body table.compare-list tr.remove td > a,
.woocommerce table.shop_table .product-remove a,
ul.wishlist_table .product-remove a{
color: <?php echo esc_html($ts_text_color); ?> !important;
}

select,
textarea,
html input[type="search"],
html input[type="text"],
html input[type="email"],
html input[type="password"],
html input[type="date"],
html input[type="number"],
html input[type="tel"],
body .select2-container--default .select2-search--dropdown .select2-search__field,
body .select2-container--default .select2-selection--single,
body .select2-dropdown,
body .select2-container--default .select2-selection--single,
body .select2-container--default .select2-search--dropdown .select2-search__field,
.woocommerce form .form-row.woocommerce-validated .select2-container,
.woocommerce form .form-row.woocommerce-validated input.input-text,
.woocommerce form .form-row.woocommerce-validated select,
body .select2-container--default .select2-selection--multiple{
color: <?php echo esc_html($ts_input_text_color); ?>;
border-color: <?php echo esc_html($ts_input_border_color); ?>;
}
body .select2-container--default .select2-selection--single .select2-selection__rendered{
color: <?php echo esc_html($ts_input_text_color); ?>;
}
html input[type="search"]:focus,
html input[type="text"]:focus,
html input[type="email"]:focus,
html input[type="password"]:focus,
html input[type="date"]:focus,
html input[type="number"]:focus,
html input[type="tel"]:focus,
input:-webkit-autofill,
textarea:-webkit-autofill,
select:-webkit-autofill,
html textarea:focus,
.woocommerce form .form-row textarea:focus,
body .select2-container--default.select2-container--focus .select2-selection--multiple,
.woocommerce form .form-row.woocommerce-validated .select2-container,
.woocommerce form .form-row.woocommerce-validated input.input-text,
.woocommerce form .form-row.woocommerce-validated select,
body .select2-container--open .select2-selection--single,
body .select2-container--open .select2-dropdown--below{
color: <?php echo esc_html($ts_input_text_hover); ?>;
border-color: <?php echo esc_html($ts_input_border_hover); ?>;
}
body .select2-container--open .select2-selection--single .select2-selection__rendered{
color: <?php echo esc_html($ts_input_text_hover); ?>;
}


/* LINK COLOR */

a{
color: <?php echo esc_html($ts_link_color); ?>;
}
a:hover{
color: <?php echo esc_html($ts_link_color_hover); ?>;
}

/* TEXT BOLD COLOR */
h1,h2,h3,h4,h5,h6,
.h1,.h2,.h3,.h4,.h5,.h6,
.woocommerce > form > fieldset legend,
dt,
table thead th,
fieldset div > label,
blockquote,
.wpcf7 p,
.primary-text,
html input:focus:invalid:focus,
html select:focus:invalid:focus,
#yith-wcwl-popup-message,
html body > h1,
table#wp-calendar thead th,
.woocommerce table.shop_attributes th,
.avatar-name a,
h4.heading-title > a,
h1 > a,
h2 > a,
h3 > a,
h4 > a,
h5 > a,
h6 > a,
body a.button-text,
body .button-text a,
.single-navigation-1 a,
.single-navigation-2 a,
.ts-product-attribute > div a,
.heading-title,
.wp-block-archives li a,
.wp-block-latest-posts li a,
.wp-block-tag-cloud a,
.wp-block-rss li a,
.woocommerce .widget_layered_nav ul li a,
.widget-container.widget_rss ul li > a,
form.cart .reset_variations,
.widget-container .post_list_widget > li a.post-title,
.dashboard-widget.products ul li a,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a,
.widget-title-wrapper a.block-control,
.woocommerce-account .woocommerce-MyAccount-navigation li a,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a,
.woocommerce div.product .woocommerce-tabs ul.tabs li > a:hover,
.woocommerce div.product form.cart .quantity span,
.widget_shopping_cart_content p.total strong,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
.ts-search-result-container > p,
#page .woocommerce > .return-to-shop a,
.woocommerce .button.button-border,
.button.button-border,
.woocommerce .button.button-border-2,
.button.button-border-2,
#page .summary .ts-buy-now-button,
.woocommerce .button.button-border-2:hover,
.button.button-border-2:hover,
.threesixty .nav_bar a,
.woocommerce .summary .yith-wfbt-submit-block .yith-wfbt-submit-button,
.woocommerce .summary .yith-wfbt-submit-block .yith-wfbt-submit-button:hover,
#page .summary .ts-buy-now-button:hover,
#comments .wcpr-filter-button,
#comments .wcpr-filter-button:hover,
.meta-content .ic-like,
.meta-content .ic-like:hover,
.meta-content .ic-like.already-like,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce .yith-woocompare-widget a.compare.button,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .yith-woocompare-widget a.compare.button:hover,
.woocommerce .woocommerce-order-details p.order-again .button,
.woocommerce .woocommerce-order-details p.order-again .button:hover,
.woocommerce-MyAccount-content .woocommerce-pagination .button,
.woocommerce-MyAccount-content .woocommerce-pagination .button:hover,
.woocommerce-account .woocommerce-MyAccount-navigation li a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a,
.widget-title,
.ts-sidebar .wp-block-group__inner-container > h2,
.ts-countdown.text-light .counter-wrapper > div,
.cart_list .icon,
.woocommerce div.product .entry-title,
#ts-mobile-button-bottom a,
#ts-mobile-button-bottom span,
.ts-floating-sidebar .close,
#ts-quickshop-modal .close,
#ts-product-360-modal .close,
#ts-add-to-cart-popup-modal span.close,
.woocommerce table.cart td.actions .coupon .button,
body .cart-empty.woocommerce-info,
.woocommerce table.shop_table.order_details tfoot td,
.ts-tiny-cart-wrapper li div.blockUI.blockOverlay:before,
.widget_shopping_cart li div.blockUI.blockOverlay:before,
.dropdown-container ul.cart_list li.loading:before,
.thumbnail-wrapper .button-in.wishlist > a.loading:before,
.meta-wrapper .button-in.wishlist > a.loading:before,
.woocommerce a.button.loading:before,
.woocommerce button.button.loading:before,
.woocommerce input.button.loading:before,
.meta-wrapper .button-in a.compare div.blockUI.blockOverlay:before,
.thumbnail-wrapper .button-in a.compare div.blockUI.blockOverlay:before,
div.blockUI.blockOverlay:before,
.woocommerce div.blockUI.blockOverlay:before,
body div.product .summary .yith-wcwl-add-to-wishlist a.loading:before,
.meta-content .ic-like.loading:before,
.ts-shop-load-more .button:before,
.woocommerce .ts-shop-load-more .button:before,
.load-more-wrapper .button:before,
.archive.ajax-pagination .woocommerce > .products:before,
div.wpcf7 .ajax-loader:before,
.woocommerce p.stars a:hover,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
.shipping-calculator-button,
#order_review_heading,
.woocommerce form.login,
.woocommerce form.register,
.woocommerce .checkout-login-coupon-wrapper .checkout_coupon,
.mailchimp-subscription .widgettitle,
.woocommerce table.shop_table.order_details tfoot th,
.woocommerce table.shop_table.customer_details th,
.woocommerce #reviews #reply-title,
fieldset legend,
.woocommerce ul.order_details li strong,
.portfolio-info > span:first-child,
.single-portfolio .info-content .entry-title,
.quantity .number-button:hover:before,
.quantity .number-button:hover:after,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info:before,
.woocommerce .woocommerce-ordering ul.orderby .orderby-current,
.woocommerce .woocommerce-ordering .orderby-current,
.filter-widget-area-button a,
.product-per-page-form ul.perpage > li span,
.product-on-sale-form label,
.counter-wrapper > div,
.ts-countdown:not(.style-inline) .counter-wrapper > div .number-wrapper,
.account-content h2,
.woocommerce-MyAccount-content > h2,
.woocommerce-customer-details > h2,
.woocommerce-order-details > h2,
.woocommerce-additional-fields > h3,
header.woocommerce-Address-title > h3,
.woocommerce div.wishlist-title h2,
body table.compare-list tr.remove td > a .remove,
.woocommerce-product-details__short-description .ul-style.square li:before,
.chart-table tr:first-child td,
.sku-wrapper span:not(.sku),
.brands-link span:not(.brand-links),
.cats-link span:not(.cat-links),
.tags-link span:not(.tag-links),
.social-sharing > span,
.woocommerce div.product
blockquote:before,
.author-info span.author a,
.widget_recent_comments ul li .comment-author-link:before,
body.error404 article > p,
.vertical-button-icon .subscribe-email .button i,
.woocommerce.archive #primary > .woocommerce-info:before,
.ts-active-filters .widget_layered_nav_filters ul li a,
.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover,
.ts-product-video-button:hover,
.ts-product-360-button:hover,
.yith-wfbt-section .yith-wfbt-images .image_plus,
.yith-wfbt-submit-block .total_price_label,
#page .wishlist-title a.show-title-form,
.woocommerce .woocommerce-tabs table.shop_attributes a,
#comments .wcpr-overall-rating-right .wcpr-overall-rating-right-total,
#comments li.wcpr-filter-button-li a,
.woocommerce.item-layout-list .heading-title a,
.ts-product-categories-widget-wrapper .all-categories > span,
.ts-cart-checkout-process-bar .status,
.cart-dropdown-form .clear-cart-button,
div.product .single-navigation > a > span,
.ts-product-size-chart-button:hover,
.elementor-image figcaption,
.blocks-gallery-item__caption figcaption,
.wp-block-table strong,
table strong,
.yith-wfbt-items label,
.widget_recent_comments .comment-author-link a,
#page .entry-meta-top span.author a,
.widget-container ul li span.author a,
.widget_display_search > form > div:before,
.widget_search > form .search-button:before,
.widget_product_search > form:before,
.elementor-widget-wp-widget-woocommerce_product_search form:before,
.elementor-widget-wp-widget-search form .search-button:before,
.search-table .search-button:before,
.social-icons.style-vertical .ts-tooltip,
.popular-searches a:hover,
.single-post article .tags-link a:hover,
.tagcloud a:hover,
.meta-navigation  h6 a:hover,
.ts-team-members .member-social a,
.woocommerce ul#shipping_method li label,
form.checkout p.create-account > label,
.hidden-title-form .edit-title-buttons a,
.ts-product-categories-widget div > ul > li > a,
.ts-product-categories-widget ul.product-categories > li > span.icon-toggle,
.gridlist-toggle span,
.quantity input[type^="button"],
.woocommerce #reviews #comments > h2 span,
#page rs-layer .product-group-button-meta > div.loop-add-to-cart a,
/* Pagination */
.dokan-pagination-container .dokan-pagination li a,
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce nav.woocommerce-pagination ul li span.current,
.ts-pagination ul li a,
.ts-pagination ul li span,
.post-nav-links > a,
.post-nav-links > span,
.post-nav-links > a:hover,
/* Compare table */
body table.compare-list th,
body table.compare-list tr.title th,
body table.compare-list tr.image th,
body table.compare-list tr.price th{
color: <?php echo esc_html($ts_text_bold_color); ?>;
}
@media only screen and (min-width: 992px){
/* SHOPPING CART */
.woocommerce table.cart .actions > .button.empty-cart-button{
color: <?php echo esc_html($ts_text_bold_color); ?>;
}
}
#ts-search-popup .ts-button-close{
color: <?php echo esc_html($ts_text_bold_color); ?> !important;
}
#page .woocommerce > .return-to-shop a,
.woocommerce .button.button-border,
.button.button-border,
.woocommerce .button.button-border-2:hover,
.button.button-border-2:hover,
.threesixty .nav_bar a:hover,
.woocommerce .summary .yith-wfbt-submit-block .yith-wfbt-submit-button,
.woocommerce .summary .yith-wfbt-submit-block .yith-wfbt-submit-button:hover,
#comments .wcpr-filter-button:hover,
#page .summary .ts-buy-now-button:hover,
.meta-content .ic-like:hover,
.meta-content .ic-like.already-like,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce .yith-woocompare-widget a.compare.button,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .yith-woocompare-widget a.compare.button:hover,
.woocommerce .woocommerce-order-details p.order-again .button,
.woocommerce .woocommerce-order-details p.order-again .button:hover,
.woocommerce-MyAccount-content .woocommerce-pagination .button:hover,
.woocommerce-account .woocommerce-MyAccount-navigation li a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a,
.product-filter-by-color ul li.chosen a,
.product-filter-by-color ul li:hover a,
.ts-product-attribute > div.color:hover,
.ts-product-attribute > div.selected,
.popular-searches a:hover,
.single-post article .tags-link a:hover,
.tagcloud a:hover,
.meta-navigation h6 a:hover:before,
.ts-cart-checkout-process-bar .status,
/* Pagination */
.woocommerce nav.woocommerce-pagination ul li a.next:hover,
.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
.ts-pagination ul li a.prev:hover,
.ts-pagination ul li a.next:hover,
.woocommerce nav.woocommerce-pagination ul li a.next:focus,
.woocommerce nav.woocommerce-pagination ul li a.prev:focus,
.ts-pagination ul li a.prev:focus,
.ts-pagination ul li a.next:focus,
.dokan-pagination-container .dokan-pagination li:hover a,
.dokan-pagination-container .dokan-pagination li.active a,
.ts-pagination ul li a:hover,
.ts-pagination ul li a:focus,
.ts-pagination ul li span.current,
.post-nav-links > span,
.post-nav-links > a:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:focus,
#ts-mobile-button-bottom a:hover,
#ts-mobile-button-bottom span:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.active-image img,
.woocommerce.archive #primary > .woocommerce-info:before{
border-color: <?php echo esc_html($ts_text_bold_color); ?>;
}
.woocommerce .button.button-border-2,
.button.button-border-2,
.threesixty .nav_bar a,
.woocommerce .summary .yith-wfbt-submit-block .yith-wfbt-submit-button,
#comments .wcpr-filter-button,
#page .summary .ts-buy-now-button,
.meta-content .ic-like,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce .yith-woocompare-widget a.compare.button,
.woocommerce .woocommerce-order-details p.order-again .button,
.woocommerce-MyAccount-content .woocommerce-pagination .button,
.woocommerce-account .woocommerce-MyAccount-navigation li a,
.product-wrapper .color-swatch > div.active,
.product-wrapper .color-swatch > div:hover,
#customer_login h2:after,
.woocommerce .checkout #order_review,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a,
.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover a,
.woocommerce .product figure .color-image.active span:before,
.woocommerce .product figure .color.active span:before,
body.single article .entry-format:after,
.summary .quantity input.qty,
.widget_price_filter .price_slider_amount input[type="text"]:focus,
#add_payment_method table.cart td.actions .coupon .input-text,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.woocommerce-checkout table.cart td.actions .coupon .input-text,
.widget-title-wrapper a.block-control:hover,
.widget-title-wrapper a.block-control.active,
.yith-wfbt-section li .checkboxbutton,
.woocommerce div.product div.images .flex-control-thumbs li img:hover,
.woocommerce div.product div.images .flex-control-thumbs li img.flex-active,
.product-on-sale-form label:before,
body.ts_desktop .product.product-category .product-wrapper:hover,
body:not(.ts_desktop) .product.product-category .product-wrapper,
#ts-product-360-modal .close{
border-color: <?php echo esc_html($ts_border_color); ?>;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content:before{
background-color: <?php echo esc_html($ts_border_color); ?>;
}

#page div.product .summary a.compare.loading:before,
#yith-woocompare table.compare-list tr.remove td > a .blockOverlay:before,
#page div.product .summary .yith-wcwl-add-to-wishlist a.loading:before,
.images.loading:before,
.ts-product .content-wrapper.loading:before,
.ts-logo-slider-wrapper.loading .content-wrapper:before,
.related-posts.loading .content-wrapper:before,
.woocommerce .product figure.loading:before,
.ts-products-widget-wrapper.loading:before,
.ts-blogs-widget-wrapper.loading:before,
body:not(.elementor-editor-active) .elementor-section.loading:before,
.ts-recent-comments-widget-wrapper.loading:before,
.blogs article a.gallery.loading:before,
.ts-blogs-wrapper.loading .content-wrapper:before,
.ts-testimonial-wrapper .items.loading:before,
.ts-twitter-slider .items.loading:before,
article .thumbnail.loading:before,
.ts-portfolio-wrapper.loading:before,
.thumbnails.loading:before,
.ts-product-category-wrapper .content-wrapper.loading:before,
.thumbnails-container.loading:before,
.column-products.loading:before,
.ts-team-members .loading:before,
.ts-instagram-wrapper.loading:before,
.ts-products-widget-wrapper.loading:before,
.ts-tiny-cart-wrapper li div.blockUI.blockOverlay:before,
.widget_shopping_cart li div.blockUI.blockOverlay:before,
.dropdown-container ul.cart_list li.loading:before,
.woocommerce a.button.loading:before,
.woocommerce button.button.loading:before,
.woocommerce input.button.loading:before,
div.product .summary .yith-wcwl-add-to-wishlist a.loading:before,
div.blockUI.blockOverlay:before,
.woocommerce div.blockUI.blockOverlay:before,
div.wpcf7 .ajax-loader:before,
.woocommerce-wishlist .product-add-to-cart a.loading:before
.ts-search-by-category .search-content.loading ~ .search-button:before,
#page div.product .summary a.compare.loading:before,
#yith-woocompare table.compare-list tr.remove td > a .blockOverlay:before,
#page div.product .summary .yith-wcwl-add-to-wishlist a.loading:before,
.cart-dropdown-form.loading .cart_list:before{
border-top-color: <?php echo esc_html($ts_text_bold_color); ?>;
border-left-color: <?php echo esc_html($ts_text_bold_color); ?>;
}
.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range:before{
background-color: <?php echo esc_html($ts_text_bold_color); ?>;
}

/* Slider */
.owl-dots > div > span{
background-color: <?php echo esc_html($ts_border_color); ?>;
}
.owl-dots > div.active > span,
.owl-dots > div:hover > span{
background-color: <?php echo esc_html($ts_primary_color); ?>;
}

/* Button Nav Slider */
.owl-nav > div,
div.product .single-navigation > div > a{
color: <?php echo esc_html($ts_text_bold_color); ?>;
background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
border-color: <?php echo esc_html($ts_border_color); ?>;
}
div.product .single-navigation > div > a:hover,
.owl-nav > div:hover,
.single-portfolio .thumbnail .owl-nav > div:hover{
border-color: <?php echo esc_html($ts_text_bold_color); ?>;
}

/* PRIMARY COLOR */
html body > h1 a.close,
.ts-countdown.style-inline *,
.single-counter-wrapper *,
.single-counter-wrapper .availability-bar span.already-sold,
#page .show-counter-today .product .thumbnail-wrapper:before{
color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
}

.avatar-name a:hover,
h4.heading-title > a:hover,
h1 > a:hover,
h2 > a:hover,
h3 > a:hover,
h4 > a:hover,
h5 > a:hover,
h6 > a:hover,
body a.button-text:hover,
body .button-text a:hover,
.more-less-buttons a:hover,
form.cart .reset_variations:hover,
.widget-container .post_list_widget > li a.post-title:hover,
.dashboard-widget.products ul li a:hover,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a:hover,
.comments-area .reply a:hover,
.portfolio-meta .heading-title a:hover,
.portfolio-inner .item h3 a:hover,
.list-posts .heading-title a:hover,
.woocommerce table.cart td.actions .coupon .button:hover,
label a:hover,
.shipping-calculator-button:hover,
.single-portfolio .portfolio-info:not(.social-sharing) a:hover,
.dashboard-widget.products ul li a:hover,
.add-to-cart-popup-content .product-meta a:hover,
.widget-container ul.product_list_widget li > a:hover,
.widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
.woocommerce ul.product_list_widget .ts-wg-meta > a:hover,
.ts-team-members .name a:hover,
body .comment-meta .button-text a:hover,
.widget-container ul > li a:hover,
.dokan-widget-area .widget ul li > a:hover,
.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li.active a,
.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li:hover a,
.dokan-dashboard .dokan-dashboard-content li.active > a,
.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li a:hover,
.widget_categories > ul li.cat-parent.active > a,
.product-per-page-form ul.perpage ul li a.current,
.product-per-page-form ul.perpage ul li:hover a,
.woocommerce .woocommerce-ordering .orderby li a.current,
.woocommerce .woocommerce-ordering .orderby li a:hover,
.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li.active > a,
.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li > a:hover,
body .select2-container--default .select2-results__option[aria-selected=true],
body .select2-container--default .select2-results__option--highlighted[aria-selected],
.order-number a,
.ol-style.icon-primary li:before,
.ul-style.icon-primary > li:before,
.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a,
.widget_recent_entries .post-date,
.primary-color,
.ts-feature-box li:before,
.phone-number,
.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a,
.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover a,
.ts-product-attribute > div:not(.color) a:hover,
.ts-product-attribute > div:not(.color).selected a,
.summary .cat-links a:hover,
.portfolio-info .cat-links a:hover,
.ts-portfolio-wrapper .filter-bar li:hover,
.ts-portfolio-wrapper .filter-bar li.current,
div.product .single-navigation > a > span:hover,
p.lost_password a:hover,
.woocommerce .yith-wfbt-section > h3,
#page .summary .yith-wcwl-add-to-wishlist a:hover,
#page .summary a.compare:hover,
.my-account-wrapper .forgot-pass a:hover,
body .my-account-wrapper .form-content a.sign-up:hover,
.logged-in-as a:first-child,
.brands-link a:hover,
.tags-link a:hover,
.wp-block-archives li a:hover,
.wp-block-latest-posts li a:hover,
.wp-block-tag-cloud a:hover,
.wp-block-rss li a:hover,
header .header-language .wpml-ls-item li a:hover,
header .header-currency .wcml_currency_switcher li a:hover,
.account-dropdown-form ul li > a:hover,
.woocommerce-product-rating .woocommerce-review-link:hover,
.woocommerce-checkout #payment .payment_method_paypal .about_paypal:hover,
p.lost_password a:hover,
.availability-bar span span.already-sold,
.widget-container ul li span.author a:hover,
.author-info span.author a:hover,
.widget_recent_comments .comment-author-link a:hover,
#page .entry-meta-top span.author a:hover,
*:not(.ts-mailchimp-subscription-shortcode) > .mailchimp-subscription button,
body.error404 article > .heading-font-2,
div.wpcf7 label > span,
.woocommerce .woocommerce-ordering .orderby-current:hover,
.filter-widget-area-button a.active,
.filter-widget-area-button a:hover,
.product-on-sale-form:hover label,
.product-on-sale-form:hover label:before,
.product-on-sale-form.checked label,
.product-on-sale-form.checked label:before,
.woocommerce .woocommerce-ordering:hover ul.orderby .orderby-current,
.woocommerce .woocommerce-ordering:hover .orderby-current,
.product-per-page-form ul.perpage > li:hover span,
.ts-product-categories-widget div > ul > li.current > a:after,
.widget_product_categories > ul > li.current-cat > a:after,
.ts-product-categories-widget ul > li.current > a,
.ts-product-categories-widget ul > li a:hover,
.widget_product_categories ul > li.current-cat > a,
.widget_product_categories ul > li a:hover,
.product-filter-by-brand div > ul > li.selected > label:after,
.product-filter-by-brand ul > li.selected > label,
.product-filter-by-brand ul li > label:hover,
.product-filter-by-availability ul > li.selected label:after,
.product-filter-by-availability ul > li.selected *,
.product-filter-by-availability ul li:hover *,
.ts-active-filters .widget_layered_nav_filters ul li a:hover,
.yith-wfbt-section li .checkboxbutton.checked:after,
#page .wishlist-title a.show-title-form:hover,
.woocommerce .woocommerce-tabs table.shop_attributes a:hover,
.single-portfolio .portfolio-info a.portfolio-url,
.woocommerce.item-layout-list .heading-title a:hover,
.ts-list-of-product-categories-wrapper .list-categories li a:hover,
ul.info-content li:before,
.ts-product-in-category-tab-wrapper .column-tabs ul.tabs li:hover,
.ts-product-in-category-tab-wrapper .column-tabs ul.tabs li.current,
.cats-link a,
.ts-team-members .member-social a:hover,
.widget-container.widget_rss ul li > a:hover,
.ts-cart-checkout-process-bar > a.active span.status,
.cart-collaterals .cart_totals > h2,
.woocommerce-checkout #order_review_heading,
.woocommerce #payment ul.payment_methods li label,
.hidden-title-form .edit-title-buttons a:hover,
.ts-product-deals-wrapper .shortcode-heading-wrapper h2,
.product-hover-style-2 .product-group-button > div a:hover .button-tooltip,
.gridlist-toggle span.active,
.category-best-selling .shortcode-heading-wrapper h2,
#page .ts-mailchimp-subscription-shortcode.text-center .widget-title,
.vertical-button-icon .subscribe-email .button:hover i,
#page rs-layer .product-group-button-meta > div.loop-add-to-cart a:hover,
.quantity .plus:hover,
.quantity .minus:hover,
/* Social */
.style-color-multicolor li.custom a:hover i,
.social-icons:not(.style-vertical) li.custom .ts-tooltip:before,
.social-icons.style-vertical li.custom a:hover .ts-tooltip{
color: <?php echo esc_html($ts_primary_color); ?>;
}
@media only screen and (min-width: 992px){
/* SHOPPING CART */
.woocommerce table.cart .actions > .button.empty-cart-button:hover{
color: <?php echo esc_html($ts_primary_color); ?>;
}
}
header .header-template .my-account-wrapper .forgot-pass a:hover,
body .my-account-wrapper .form-content a.sign-up:hover{
color: <?php echo esc_html($ts_primary_color); ?> !important;
}
.ts-product-categories-widget div > ul > li.current > a:before,
.widget_product_categories ul > li.current-cat > a:before,
.ts-product-categories-widget div > ul > li > a:hover:before,
.widget_product_categories ul > li > a:hover:before,
.product-filter-by-brand div > ul > li.selected > label:before,
.product-filter-by-brand div > ul > li > label:hover:before,
.product-filter-by-availability ul > li.selected label:before,
.product-filter-by-availability ul > li label:hover:before,
.woocommerce form.checkout_coupon,
.menu-wrapper > .ic-close-menu-button:hover,
.woocommerce div.product div.thumbnails li:hover a img,
.mobile-menu-wrapper nav > ul > li > ul,
.shortcode-heading-wrapper .heading-title:after,
.column-tabs .heading-tab .heading-title:after,
.tagcloud a:hover:before,
.yith-wfbt-section li .checkboxbutton.checked,
.ts-cart-checkout-process-bar > a.active,
.ts-cart-checkout-process-bar > a.active span.status,
.product-on-sale-form.checked label:before,
.product-on-sale-form:hover label:before,
/* Social */
.style-color-multicolor li.custom a:hover i,
.style-color-multicolor li.custom a i{
border-color: <?php echo esc_html($ts_primary_color); ?>;
}
#page .show-counter-today .product .thumbnail-wrapper:before,
.style-inline .counter-wrapper,
.availability-bar .progress-bar span,
.ts-tiny-cart-wrapper .ic-cart:after,
.single-counter-wrapper .ts-countdown{
background-color: <?php echo esc_html($ts_primary_color); ?>;
}
.comments-title .heading-title > span,
*:not(.ts-mailchimp-subscription-shortcode) > .mailchimp-subscription button:hover,
.header-wishlist .count-number,
.woocommerce div.product form.cart .button:hover,
.woocommerce .yith-wfbt-submit-block .yith-wfbt-submit-button,
.category-best-selling .product-label.best-selling-label,
.post-password-form input[type^="submit"]:hover,
/* Social */
footer#colophon .style-color-multicolor li.custom a,
.style-color-multicolor li.custom a i,
body .social-icons:not(.style-vertical) li.custom .ts-tooltip{
background-color: <?php echo esc_html($ts_primary_color); ?>;
color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
border-color: <?php echo esc_html($ts_primary_color); ?>;
}
.woocommerce .yith-wfbt-submit-block .yith-wfbt-submit-button:hover{
border-color: <?php echo esc_html($ts_primary_color); ?>;
color: <?php echo esc_html($ts_primary_color); ?>;
background: transparent;
}

/* BORDER COLOR */
*,
*:before,
*:after,
.image-border .add-to-cart-popup-content .product-image img,
.image-border .thumbnail-wrapper img,
.quantity .number-button,
.quantity .minus,
.quantity .plus,
.woocommerce-account-fields,
.ts-shortcode .load-more-wrapper,
.ts-shop-load-more,
body #yith-woocompare table.compare-list tbody th,
body #yith-woocompare table.compare-list tbody td,
.woocommerce table.shop_table,
.woocommerce-page table.shop_table,
.woocommerce ul.order_details li,
.woocommerce div.product form.cart .group_table td,
.dokan-dashboard .dokan-dashboard-content .edit-account fieldset,
body > table.compare-list,
.woocommerce table.my_account_orders tbody tr:first-child td:first-child,
body .woocommerce table.my_account_orders td.order-actions,
.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td,
.woocommerce .widget_layered_nav ul,
.woocommerce table.shop_table,
.woocommerce table.shop_table td,
.woocommerce table.wishlist_table tbody td,
.woocommerce p.stars a.star-1,
.woocommerce p.stars a.star-2,
.woocommerce p.stars a.star-3,
.woocommerce p.stars a.star-4,
.woocommerce p.stars a.star-5,
.woocommerce #reviews #comments ol.commentlist li .comment-text,
.woocommerce table.shop_attributes,
.woocommerce #reviews #comments ol.commentlist li ,
.dataTables_wrapper,
.woocommerce div.product div.thumbnails li a img,
.woocommerce div.product div.images-thumbnails img,
.woocommerce ul.cart_list li img,
.woocommerce ul.product_list_widget li img,
.woocommerce-account .woocommerce-MyAccount-navigation li a,
.widget_price_filter .price_slider_amount input[type="text"],
.woocommerce div.product div.images .flex-control-thumbs li img,
#ts-quickshop-modal .close{
border-color: <?php echo esc_html($ts_border_color); ?>;
}
.ts-product-attribute > div:before{
background-color: <?php echo esc_html($ts_border_color); ?>;
border-color: <?php echo esc_html($ts_border_color); ?>;
}
.availability-bar .progress-bar{
background-color: <?php echo esc_html($ts_border_color); ?>;
}

/* BUTTON */
a.button,
button,
input[type^="submit"],
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce a.button.disabled,
.woocommerce a.button:disabled,
.woocommerce a.button:disabled[disabled],
.woocommerce button.button.disabled,
.woocommerce button.button:disabled,
.woocommerce button.button:disabled[disabled],
.woocommerce input.button.disabled,
.woocommerce input.button:disabled,
.woocommerce input.button:disabled[disabled],
.woocommerce #respond input#submit,
.shopping-cart p.buttons a,
#page .main-products.list .product-group-button-meta > div.loop-add-to-cart a,
body .woocommerce table.compare-list .add-to-cart td a,
.woocommerce a.button.alt.disabled,
.woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled,
.woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt:disabled[disabled],
.woocommerce a.button.alt:disabled[disabled]:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt:disabled[disabled],
.woocommerce button.button.alt:disabled[disabled]:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt:disabled[disabled],
.woocommerce input.button.alt:disabled[disabled]:hover,
.button.button-primary:hover,
.woocommerce div .button.button-primary:hover,
.woocommerce div.product form.cart table .button:hover,
.shopping-cart-wrapper.cart-primary a > .ic-cart,
.portfolio-inner .icon-group a:hover,
.woocommerce .woocommerce-form-register .button:hover,
.woocommerce .wishlist_table .product-add-to-cart a,
#ts-login-form .button.button-primary,
.woocommerce .button.button-border:hover,
.button.button-border:hover,
#page .woocommerce > .return-to-shop a:hover{
background-color: <?php echo esc_html($ts_button_background_color); ?>;
color: <?php echo esc_html($ts_button_text_color); ?>;
border-color: <?php echo esc_html($ts_button_border_color); ?>;
}
.ts-tiny-cart-wrapper .dropdown-footer .button.view-cart:hover,
#ts-add-to-cart-popup-modal .action .button.view-cart:hover,
.woocommerce.widget_shopping_cart .buttons .button,
.woocommerce .widget_shopping_cart .buttons .button{
background: transparent;
color: <?php echo esc_html($ts_button_background_color); ?>;
border-color: <?php echo esc_html($ts_button_background_color); ?>;
}
a.button:hover,
button:hover,
input[type^="submit"]:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce form.register .button,
body .mfp-close-btn-in .mfp-close:hover,
.woocommerce .woocommerce-form-register .button,
.woocommerce .wishlist_table .product-add-to-cart a:hover,
.cart_totals .wc-proceed-to-checkout a.button.view-cart:hover,
.woocommerce.widget_shopping_cart .buttons .button:hover,
.woocommerce .widget_shopping_cart .buttons .button:hover,
body .woocommerce table.compare-list .add-to-cart td a:hover,
.portfolio-inner .icon-group a,
#page .main-products.list .product-group-button-meta > div.loop-add-to-cart a:hover,
a.dokan-btn:hover,
.dokan-btn:hover,
input[type='submit'].dokan-btn:focus,
a.dokan-btn:focus,
.dokan-btn:focus,
input[type='submit'].dokan-btn.focus,
a.dokan-btn.focus,
.dokan-btn.focus,
.button.button-primary,
.woocommerce div .button.button-primary,
.woocommerce #payment #place_order,
#comments .wcpr-overall-rating-left-average,
.woocommerce .cart_totals .wc-proceed-to-checkout a.button,
.ts-tiny-cart-wrapper .dropdown-footer .button.checkout-button,
.woocommerce.widget_shopping_cart .buttons .button.checkout,
.woocommerce .widget_shopping_cart .buttons .button.checkout,
#ts-add-to-cart-popup-modal .action .button.checkout,
#ts-login-form .button.button-primary:hover{
background-color: <?php echo esc_html($ts_button_background_hover); ?>;
color: <?php echo esc_html($ts_button_text_hover); ?>;
border-color: <?php echo esc_html($ts_button_border_hover); ?>;
}
.woocommerce #payment #place_order:hover,
.woocommerce .cart_totals .wc-proceed-to-checkout a.button:hover,
.ts-tiny-cart-wrapper .dropdown-footer .button.checkout-button:hover,
.woocommerce.widget_shopping_cart .buttons .button.checkout:hover,
.woocommerce .widget_shopping_cart .buttons .button.checkout:hover,
#ts-add-to-cart-popup-modal .action .button.checkout:hover{
background: transparent;
color: <?php echo esc_html($ts_button_background_hover); ?>;
border-color: <?php echo esc_html($ts_button_background_hover); ?>;
}
.shop_table .order-total .amount,
.dropdown-footer .total .amount,
div.product .availability.out-of-stock span.availability-text,
.shopping-cart-wrapper .subtotal .amount,
.woocommerce table.order_details tfoot tr:last-child .amount,
#order_review .order-total .amount{
color: <?php echo esc_html($ts_text_highlight_color); ?> !important;
}

/* BREADCRUMB */
.breadcrumb-title-wrapper{
background-color: <?php echo esc_html($ts_breadcrumb_background_color); ?>;
border-color: <?php echo esc_html($ts_breadcrumb_border_color); ?>;
}
body.error404 #main{
border-color: <?php echo esc_html($ts_breadcrumb_border_color); ?>;
}
.breadcrumb-title-wrapper .breadcrumb-title *{
color: <?php echo esc_html($ts_breadcrumb_text_color); ?>;
}
.breadcrumb-title-wrapper .breadcrumb-title a,
.breadcrumb-title-wrapper .breadcrumb-title h1{
color: <?php echo esc_html($ts_breadcrumb_heading_color); ?>;
}
.breadcrumb-title-wrapper .breadcrumb-title a:hover{
color: <?php echo esc_html($ts_breadcrumb_link_color_hover); ?>;
}
.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title *{
color: <?php echo esc_html($ts_breadcrumb_img_text_color); ?>;
}
.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title a,
.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title h1{
color: <?php echo esc_html($ts_breadcrumb_img_heading_color); ?>;
}
.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title a:hover{
color: <?php echo esc_html($ts_breadcrumb_img_link_color_hover); ?>;
}
body.post-type-archive-product .breadcrumb-title-wrapper,
.shop-top-list-categories{
background-color: <?php echo esc_html($ts_shop_categories_background_color); ?>;
border-color: <?php echo esc_html($ts_shop_categories_background_color); ?>;
}

/* HEADER COLOR */
/* Header Middle */
.header-middle,
.header-v2 .header-bottom{
background-color: <?php echo esc_html($ts_middle_header_background_color); ?>;
}
.shopping-cart-wrapper .cart-control,
.my-wishlist-wrapper a,
.my-account-wrapper .account-control > a,
.ts-header .search-button > span{
color: <?php echo esc_html($ts_middle_header_icon_color); ?>;
border-color: <?php echo esc_html($ts_middle_header_icon_border_color); ?>;
}
.shopping-cart-wrapper:hover .cart-control,
.my-account-wrapper .account-control > a:hover,
.my-wishlist-wrapper:hover a,
.ts-header .search-button > span:hover{
color: <?php echo esc_html($ts_middle_header_icon_color_hover); ?>;
border-color: <?php echo esc_html($ts_middle_header_icon_border_hover); ?>;
}

/* Cart */
.header-wishlist .count-number,
.ic-cart .cart-number,
#ts-mobile-button-bottom .header-wishlist .count-number{
background-color: <?php echo esc_html($ts_header_cart_number_background_color); ?>;
color: <?php echo esc_html($ts_header_cart_number_color); ?>;
}

/* Search */
.ts-search-by-category .search-content input[type="text"]{
color: <?php echo esc_html($ts_header_search_text_color); ?>;
background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
border-color: <?php echo esc_html($ts_header_search_border_color); ?>;
}
.ts-search-by-category .search-content.loading:before{
border-top-color: <?php echo esc_html($ts_header_search_icon_color); ?>;
border-left-color: <?php echo esc_html($ts_header_search_icon_color); ?>;
}
.ts-search-by-category ::-webkit-input-placeholder{
color: <?php echo esc_html($ts_header_search_placeholder_text); ?>;
}
.ts-search-by-category :-moz-placeholder{ /* Firefox 18- */
color: <?php echo esc_html($ts_header_search_placeholder_text); ?>;
}
.ts-search-by-category ::-moz-placeholder{  /* Firefox 19+ */
color: <?php echo esc_html($ts_header_search_placeholder_text); ?>;
}
.ts-search-by-category :-ms-input-placeholder{
color: <?php echo esc_html($ts_header_search_placeholder_text); ?>;
}
.ts-search-by-category .search-button:before{
color: <?php echo esc_html($ts_header_search_icon_color); ?>;
}
.ts-search-by-category .search-button:hover:before{
color: <?php echo esc_html($ts_header_search_icon_hover_color); ?>;
}

/* Header Bottom */
.header-v3 .header-bottom{
background-color: <?php echo esc_html($ts_bottom_header_background_color); ?>;
border-color: <?php echo esc_html($ts_bottom_header_border_color); ?>;
}

/* MENU */
.vertical-menu-button{
color: <?php echo esc_html($ts_vertical_icon_color); ?>;
}
.ts-menu > nav.main-menu > ul.menu > li > .ts-menu-drop-icon,
header nav.main-menu > ul.menu > li > a,
header nav.main-menu > ul > li > a,
header nav.main-menu > ul.menu > li.menu-item:before{
color: <?php echo esc_html($ts_menu_text_color); ?>;
}

header nav.main-menu > ul.menu > li.menu-item:hover:before,
header nav.main-menu > ul.menu > li.current-menu-item:before,
header nav.main-menu > ul.menu > li.current_page_parent:before,
header nav.main-menu > ul.menu > li.current-menu-parent:before,
header nav.main-menu > ul.menu > li.current_page_item:before,
header nav.main-menu > ul.menu > li.current-menu-ancestor:before,
header nav.main-menu > ul.menu > li.current-page-ancestor:before,

.ts-menu > nav.main-menu > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu > li.current_page_parent > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu > li.current_page_item > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu > li.current-menu-ancestor > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu > li.current-page-ancestor > .ts-menu-drop-icon,
.ts-menu > nav.main-menu > ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
header nav.main-menu > ul.menu > li:hover > a,
header nav.main-menu > ul.menu > li.current-menu-item > a,
header nav.main-menu > ul.menu > li.current_page_parent > a,
header nav.main-menu > ul.menu > li.current-menu-parent > a,
header nav.main-menu > ul.menu > li.current_page_item > a,
header nav.main-menu > ul.menu > li.current-menu-ancestor > a,
header nav.main-menu > ul.menu > li.current-page-ancestor > a,
header nav.main-menu > ul.menu li.current-product_cat-ancestor > a{
color: <?php echo esc_html($ts_menu_text_hover); ?>;
}
header nav > ul.menu li ul.sub-menu:before{
background-color: <?php echo esc_html($ts_sub_menu_background_color); ?>;
}

/* Menu sub text */
header nav > ul.menu ul.sub-menu li.menu-item:before,
header nav > ul.menu ul.sub-menu > li > a,
header nav > ul.menu .elementor-widget-wp-widget-nav_menu li > a,
.ts-menu nav > ul.menu ul li > .ts-menu-drop-icon{
color: <?php echo esc_html($ts_sub_menu_text_color); ?>;
}

/* Menu sub hover */
.ts-menu > nav > ul.menu ul li:hover > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current_page_item > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current-menu-item > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current_page_parent > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current-menu-parent > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current-menu-ancestor > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current-page-ancestor > .ts-menu-drop-icon,
.ts-menu > nav > ul.menu ul li.current-product_cat-ancestor > .ts-menu-drop-icon,
header nav > ul.menu ul.sub-menu > li:hover > a,
header nav > ul.menu ul.sub-menu li.menu-item:hover:before,
header nav > ul.menu .elementor-widget-wp-widget-nav_menu li:hover > a,
header nav > ul.menu .elementor-widget-wp-widget-nav_menu li.current-menu-item > a,
header nav > ul.menu ul.sub-menu li.current-menu-item > a,
header nav > ul.menu ul.sub-menu li.current_page_parent > a,
header nav > ul.menu ul.sub-menu li.current-menu-parent > a,
header nav > ul.menu ul.sub-menu li.current_page_item > a,
header nav > ul.menu ul.sub-menu li.current-menu-ancestor > a,
header nav > ul.menu ul.sub-menu li.current-page-ancestor > a,
header nav > ul.menu ul.sub-menu li.current-product_cat-ancestor > a,

header nav > ul.menu ul.sub-menu li.current-menu-item:before,
header nav > ul.menu ul.sub-menu li.current_page_parent:before,
header nav > ul.menu ul.sub-menu li.current-menu-parent:before,
header nav > ul.menu ul.sub-menu li.current_page_item:before,
header nav > ul.menu ul.sub-menu li.current-menu-ancestor:before,
header nav > ul.menu ul.sub-menu li.current-page-ancestor:before,
header nav > ul.menu ul.sub-menu li.current-product_cat-ancestor:before{
color: <?php echo esc_html($ts_sub_menu_text_hover); ?>;
}

/* Heading menu */
.menu-wrapper nav > ul.menu ul.sub-menu h1,
.menu-wrapper nav > ul.menu ul.sub-menu h2,
.menu-wrapper nav > ul.menu ul.sub-menu h3,
.menu-wrapper nav > ul.menu ul.sub-menu h4,
.menu-wrapper nav > ul.menu ul.sub-menu h5,
.menu-wrapper nav > ul.menu ul.sub-menu h6,
.menu-wrapper nav > ul.menu ul.sub-menu .h1,
.menu-wrapper nav > ul.menu ul.sub-menu .h2,
.menu-wrapper nav > ul.menu ul.sub-menu .h3,
.menu-wrapper nav > ul.menu ul.sub-menu .h4,
.menu-wrapper nav > ul.menu ul.sub-menu .h5,
.menu-wrapper nav > ul.menu ul.sub-menu .h6{
color: <?php echo esc_html($ts_sub_menu_heading_color); ?>;
}

/* Vertical Menu Sidebar */
.wcml_currency_switcher > ul:before,
.wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu:before,
.wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu:before,
#vertical-menu-sidebar .vertical-menu-content,
.ts-header .vertical-menu-wrapper > .vertical-menu:before{
background-color: <?php echo esc_html($ts_vertical_menu_background_color); ?>;
}
#vertical-menu-sidebar,
#vertical-menu-sidebar h1,
#vertical-menu-sidebar h2,
#vertical-menu-sidebar h3,
#vertical-menu-sidebar h4,
#vertical-menu-sidebar h5,
#vertical-menu-sidebar h6,
#vertical-menu-sidebar .ts-menu-drop-icon,
#vertical-menu-sidebar .ts-menu ul li a,
#vertical-menu-sidebar .ts-menu ul li:before,
#vertical-menu-sidebar .close,
.ts-header nav.vertical-menu > ul.menu > li > a,
.ts-header nav.vertical-menu > ul.menu > li:before{
color: <?php echo esc_html($ts_vertical_menu_text_color); ?>;
}
#vertical-menu-sidebar *{
border-color: <?php echo esc_html($ts_vertical_menu_border_color); ?>;
}
.header-language:hover .wpml-ls > ul > li > a,
.header-currency:hover .wcml_currency_switcher > a,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li.small-menu:hover > a,
#vertical-menu-sidebar .content-top a:hover,

#vertical-menu-sidebar .close:hover,
#vertical-menu-sidebar ul.menu li.menu-item:hover:before,
#vertical-menu-sidebar ul.menu li.current-menu-item:before,
#vertical-menu-sidebar ul.menu li.current_page_parent:before,
#vertical-menu-sidebar ul.menu li.current-menu-parent:before,
#vertical-menu-sidebar ul.menu li.current_page_item:before,
#vertical-menu-sidebar ul.menu li.current-menu-ancestor:before,
#vertical-menu-sidebar ul.menu li.current-page-ancestor:before,

#vertical-menu-sidebar ul.menu li.current-menu-item > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current_page_parent > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current-menu-parent > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current_page_item > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current-menu-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current-page-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.menu li.current-menu-item > a,
#vertical-menu-sidebar ul.menu li.current_page_parent > a,
#vertical-menu-sidebar ul.menu li.current-menu-parent > a,
#vertical-menu-sidebar ul.menu li.current_page_item > a,
#vertical-menu-sidebar ul.menu li.current-menu-ancestor > a,
#vertical-menu-sidebar ul.menu li.current-page-ancestor > a,
#vertical-menu-sidebar ul.menu li.current-product_cat-ancestor > a,
#vertical-menu-sidebar ul.menu li:hover > a,
#vertical-menu-sidebar ul.menu li:hover:before,
#vertical-menu-sidebar li.active >.ts-menu-drop-icon,
#vertical-menu-sidebar .ts-menu-drop-icon:hover{
color: <?php echo esc_html($ts_vertical_menu_text_hover); ?>;
}
.header-language .wpml-ls-item li a,
.header-currency .wcml_currency_switcher li a,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li.small-menu > a,
#vertical-menu-sidebar .vertical-menu-wrapper nav > ul.menu > li.small-menu:before,
#group-icon-header nav > ul.menu > li.small-menu > a,
#group-icon-header nav > ul.menu > li.small-menu:before,
#vertical-menu-sidebar .ts-menu ul.sub-menu li a,
#vertical-menu-sidebar .ts-menu ul.sub-menu li:before{
color: <?php echo esc_html($ts_vertical_sub_menu_text_color); ?>;
}
#vertical-menu-sidebar ul.sub-menu li.current-menu-item > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current_page_parent > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current-menu-parent > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current_page_item > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current-menu-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current-page-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
#vertical-menu-sidebar ul.sub-menu li:hover > a,
#vertical-menu-sidebar ul.sub-menu li:hover:before,
#vertical-menu-sidebar ul.sub-menu li.current-menu-item > a,
#vertical-menu-sidebar ul.sub-menu li.current_page_parent > a,
#vertical-menu-sidebar ul.sub-menu li.current-menu-parent > a,
#vertical-menu-sidebar ul.sub-menu li.current_page_item > a,
#vertical-menu-sidebar ul.sub-menu li.current-menu-ancestor > a,
#vertical-menu-sidebar ul.sub-menu li.current-page-ancestor > a,
#vertical-menu-sidebar ul.sub-menu li.current-product_cat-ancestor > a,
#vertical-menu-sidebar ul.sub-menu .ts-menu-drop-icon.active,
#vertical-menu-sidebar ul.sub-menu .ts-menu-drop-icon:hover{
color: <?php echo esc_html($ts_vertical_sub_menu_text_hover); ?>;
}

/* MOBILE */
@media only screen and (max-width: 767px){
.ts-header .header-template,
.ts-header .header-middle{
background-color: <?php echo esc_html($ts_header_mobile_background_color); ?>;
}
.ts-header .ts-mobile-icon-toggle .icon,
.ts-header .shopping-cart-wrapper a.cart-control{
color: <?php echo esc_html($ts_header_mobile_icon_color); ?>;
border-color: <?php echo esc_html($ts_header_mobile_icon_border_color); ?>;
}
.ts-header .ic-cart .cart-number{
color: <?php echo esc_html($ts_header_mobile_cart_number_text_color); ?>;
background-color: <?php echo esc_html($ts_header_mobile_cart_number_background_color); ?>;
}
}
.ic-mobile-menu-close-button,
.mobile-menu-wrapper nav li > a,
.mobile-menu-wrapper nav li.menu-item:before,
.mobile-menu-wrapper nav li > .ts-menu-drop-icon,
.mobile-menu-wrapper nav > ul.menu ul li > .ts-menu-drop-icon{
color: <?php echo esc_html($ts_menu_mobile_text_color); ?>;
}
.mobile-menu-wrapper nav *{
border-color: <?php echo esc_html($ts_menu_mobile_border_color); ?>;
}
#group-icon-header .ts-sidebar-content,
.mobile-menu-wrapper li .ts-menu-drop-icon.active,
#group-icon-header .menu-title{
background-color: <?php echo esc_html($ts_menu_mobile_background_color); ?>;
}
.tab-mobile-menu li{
color: <?php echo esc_html($ts_tab_menu_mobile_text_color); ?>;
border-color: <?php echo esc_html($ts_tab_menu_mobile_border_color); ?>;
background: transparent;
}
.tab-mobile-menu li.active{
color: <?php echo esc_html($ts_tab_menu_mobile_text_hover); ?>;
background-color: <?php echo esc_html($ts_tab_menu_mobile_background_hover); ?>;
border-color: <?php echo esc_html($ts_tab_menu_mobile_background_hover); ?>;
}
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h1,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h2,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h3,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h4,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h5,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu h6,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h1,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h2,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h3,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h4,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h5,
.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h6{
color: <?php echo esc_html($ts_menu_mobile_heading_color); ?>;
}
.mobile-menu-wrapper .ts-menu-drop-icon.active,
.mobile-menu-wrapper .ts-menu-drop-icon:hover,
.mobile-menu-wrapper nav > ul li:hover > .ts-menu-drop-icon,
.mobile-menu-wrapper nav ul li:hover > a,
.mobile-menu-wrapper ul ul li:hover > a,
.mobile-menu-wrapper nav ul li.menu-item:hover:before,
.mobile-menu-wrapper nav ul li > .ts-menu-drop-icon:hover,
.mobile-menu-wrapper ul ul li:hover > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu ul.sub-menu > li > a:hover,
.mobile-menu-wrapper ul.menu .elementor-widget-wp-widget-nav_menu li > a:hover,
.mobile-menu-wrapper ul.menu ul .elementor-widget-wp-widget-nav_menu li.current-menu-item > a,
.mobile-menu-wrapper ul.menu li.current-menu-item > a,
.mobile-menu-wrapper ul.menu li.current_page_parent > a,
.mobile-menu-wrapper ul.menu li.current-menu-parent > a,
.mobile-menu-wrapper ul.menu li.current_page_item > a,
.mobile-menu-wrapper ul.menu li.current-menu-ancestor > a,
.mobile-menu-wrapper ul.menu li.current-page-ancestor > a,
.mobile-menu-wrapper ul.menu li.current-product_cat-ancestor > a,
.mobile-menu-wrapper ul.menu li.current-menu-item > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current_page_parent > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current-menu-parent > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current_page_item > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current-menu-ancestor > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current-page-ancestor > .ts-menu-drop-icon,
.mobile-menu-wrapper ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
.mobile-menu-wrapper nav ul.menu li.current-menu-item:before,
.mobile-menu-wrapper nav ul.menu li.current_page_parent:before,
.mobile-menu-wrapper nav ul.menu li.current-menu-parent:before,
.mobile-menu-wrapper nav ul.menu li.current_page_item:before,
.mobile-menu-wrapper nav ul.menu li.current-menu-ancestor:before,
.mobile-menu-wrapper nav ul.menu li.current-page-ancestor:before,
.mobile-menu-wrapper nav ul.menu li.current-product_cat-ancestor:before,
.group-button-header a:hover,
.group-button-header .wpml-ls-legacy-dropdown a:focus,
.group-button-header .wpml-ls-legacy-dropdown a:hover,
.group-button-header .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a{
color: <?php echo esc_html($ts_menu_mobile_text_hover); ?>;
}
.mobile-menu-wrapper ul.sub-menu{
background-color: <?php echo esc_html($ts_menu_mobile_background_color); ?>;
}
.mobile-menu-wrapper nav .sub-menu *{
border-color: <?php echo esc_html($ts_menu_mobile_border_color); ?>;
}
.group-button-header{
color: <?php echo esc_html($ts_bottom_menu_mobile_text_color); ?>;
background-color: <?php echo esc_html($ts_bottom_menu_mobile_background_color); ?>;
}
.group-button-header a{
color: <?php echo esc_html($ts_bottom_menu_mobile_text_color); ?>;
}

/* FOOTER COLOR */
footer#colophon{
background-color: <?php echo esc_html($ts_footer_background_color); ?>;
}
.footer-container *,
.footer-container input[type="text"],
.footer-container input[type="search"],
.footer-container input[type="text"],
.footer-container input[type="email"],
.footer-container input[type="password"],
.footer-container input[type="date"],
.footer-container input[type="number"],
.footer-container input[type="tel"]{
border-color: <?php echo esc_html($ts_footer_border_color); ?>;
}
.footer-container input[type="text"]:focus,
.footer-container input[type="search"]:focus,
.footer-container input[type="text"]:focus,
.footer-container input[type="email"]:focus,
.footer-container input[type="password"]:focus,
.footer-container input[type="date"]:focus,
.footer-container input[type="number"]:focus,
.footer-container input[type="tel"]:focus{
border-color: <?php echo esc_html($ts_footer_border_hover); ?>;
}
footer#colophon,
.footer-container a,
.footer-container dt,
.footer-container .mc4wp-form-fields label{
color: <?php echo esc_html($ts_footer_text_color); ?>;
}
.footer-container h1,
.footer-container h2,
.footer-container h3,
.footer-container h4,
.footer-container h5,
.footer-container h6,
.footer-container .widget-title,
.footer-container .mc4wp-form-fields h2.title{
color: <?php echo esc_html($ts_footer_heading_color); ?>;
}
.footer-container a:hover{
color: <?php echo esc_html($ts_footer_text_hover); ?>;
}
.footer-container .tagcloud a{
border-color: <?php echo esc_html($ts_footer_border_color); ?>;
color: <?php echo esc_html($ts_footer_text_color); ?>;
}
.footer-container .tagcloud a:hover{
border-color: <?php echo esc_html($ts_footer_border_hover); ?>;
color: <?php echo esc_html($ts_footer_border_hover); ?>;
}

/* PRODUCT COLOR */
/* Rating Product */
.ts-testimonial-wrapper .rating:before,
.star-rating:before,
.woocommerce .star-rating:before,
body .star-rating.no-rating:before{
color: <?php echo esc_html($ts_rating_color); ?> !important;
}
.woocommerce p.stars:hover a:before,
.star-rating span:before,
.ts-testimonial-wrapper .rating span:before,
.woocommerce p.stars.selected a.active:before,
.woocommerce p.stars.selected a:before,
#comments li.wcpr-filter-button-li a:hover{
color: <?php echo esc_html($ts_rating_color); ?> !important;
}
#comments .rate-percent-bg .rate-percent{
background-color: <?php echo esc_html($ts_rating_color); ?>;
}

/* Name Product */
.add-to-cart-popup-content .product-meta a,
.ts-search-result-container ul li a,
.widget-container ul.product_list_widget li > a,
.widget-container ul.product_list_widget li .ts-wg-meta > a,
.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
.woocommerce ul.product_list_widget .ts-wg-meta > a,
.elementor-widget-container ul.product_list_widget li > a,
.elementor-widget-container ul.product_list_widget li .ts-wg-meta > a,
h3.product-name > a,
.product-name a,
.single-navigation .product-info,
.group_table a,
body table.compare-list tr.title td,
.woocommerce .list-categories .product .product-categories a,
ul.wishlist_table .item-details .product-name h3,
.woocommerce #order_review td.product-name{
color: <?php echo esc_html($ts_product_name_text_color); ?>;
}
.product .product-brands a:hover,
.meta-wrapper .product-categories a:hover,
.widget-container ul li .product-categories a:hover,
.add-to-cart-popup-content .product-meta a:hover,
.ts-search-result-container ul li a:hover,
.elementor-widget-container ul.product_list_widget li > a:hover,
.elementor-widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
.widget-container ul.product_list_widget li > a:hover,
.widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
.woocommerce ul.product_list_widget .ts-wg-meta > a:hover,
h3.product-name > a:hover,
.product-name a:hover,
.single-navigation .product-info,
.group_table a:hover,
.woocommerce .list-categories .product .product-categories a:hover,
#page .product-group-button-meta > div a:hover,
#page .main-products.list .product-group-button-meta > div.button-in a:hover *{
color: <?php echo esc_html($ts_product_name_text_hover); ?>;
}

/* Button Product */
.thumbnail-wrapper .product-group-button .loop-add-to-cart a,
.product-group-button > div a{
background-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
}
.meta-wrapper .button-in a div.blockUI.blockOverlay:before,
.thumbnail-wrapper .button-in a div.blockUI.blockOverlay:before,
#page .product-group-button div.loop-add-to-cart a.loading:before,
#page .product-group-button-meta div.loop-add-to-cart a.loading:before{
border-top-color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
border-left-color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
}
.thumbnail-wrapper .product-group-button .loop-add-to-cart a:hover,
.product-group-button > div a:hover{
background-color: <?php echo esc_html($ts_product_button_thumbnail_background_hover); ?>;
color: <?php echo esc_html($ts_product_button_thumbnail_text_hover); ?>;
}
.product-wrapper .button-in a .button-tooltip,
.thumbnail-wrapper a .button-tooltip,
.ts-product-attribute .button-tooltip{
color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
}
.product-group-button .button-tooltip:before,
.product-group-button-meta .button-in .button-tooltip:before,
.ts-product-attribute .button-tooltip:before{
background-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
}
/* Label Product */
.woocommerce .product .product-label .onsale{
color: <?php echo esc_html($ts_product_sale_label_text_color); ?>;
background-color: <?php echo esc_html($ts_product_sale_label_background_color); ?>;
}
.woocommerce .product .product-label .onsale.amount{
color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
}
.woocommerce .product .product-label .new{
color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
background-color: <?php echo esc_html($ts_product_new_label_background_color); ?>;
}
.woocommerce .product .product-label .featured{
color: <?php echo esc_html($ts_product_feature_label_text_color); ?>;
background-color: <?php echo esc_html($ts_product_feature_label_background_color); ?>;
}
.woocommerce .product .product-label .out-of-stock{
color: <?php echo esc_html($ts_product_outstock_label_text_color); ?>;
background-color: <?php echo esc_html($ts_product_outstock_label_background_color); ?>;
}
/* Amount Product */
.price .amount,
.shop_table .amount,
.ts-tiny-cart-wrapper .subtotal > span.amount,
.woocommerce .products .product .price,
.product_list_widget .price,
.product_list_widget .amount,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.single-navigation .product-info .price,
/* Compare table */
body table.compare-list tr.price td{
color: <?php echo esc_html($ts_product_price_color); ?>;
}
del .amount,
.add-to-cart-popup-content del .amount,
.woocommerce .products .product del .amount,
.product_list_widget del .amount,
.shop_table del .amount,
div.product .summary .price del .amount,
.price del .amount,
.woocommerce div.product .summary p.price del .amount,
.yith-wfbt-section del .amount{
color: <?php echo esc_html($ts_product_del_price_color); ?>;
}
.yith-wfbt-submit-block .total_price .amount,
ins .amount,
.woocommerce .products .product ins .amount,
.product_list_widget ins .amount,
div.product .price ins .amount,
.price ins .amount,
.yith-wfbt-section ins .amount,
.wishlist_table ins .amount{
color: <?php echo esc_html($ts_product_sale_price_color); ?>;
}

<?php update_option('cb_load_dynamic_style', 1);  //uncomment after finished this file ?>
