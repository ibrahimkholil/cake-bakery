<?php

class Theme_Options
{
   private $opt_name = '';
    /**
     * Instance
     *
     * @var $instance
     */
    private static $instance;
    private  $redux_url = '';

    /**
     * Initiator
     *
     * @since 1.0.0
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;


    }

	public function __construct()
	{
        $this->opt_name = 'cb_theme_options' ;
		$this->initThemeOptions();
		$this->registerSections();
        if( class_exists('ReduxFramework') ){
            $this->redux_url = ReduxFramework::$_url;
        }

		add_action('admin_enqueue_scripts',[$this,'enqueueAssets']);
	}
	public function initThemeOptions()
	{
		if ( ! class_exists( 'Redux' ) ) {
			return;
		}
        // This is your option name where all the Redux data is stored.

		$theme = wp_get_theme();
		$args = array(
			'opt_name'             =>  $this->opt_name,
			'display_name'         => $theme->get( 'Name' ),
			'display_version'      => $theme->get( 'Version' ),
			'menu_type'            => 'menu',
			'allow_sub_menu'       => true,
			'menu_title'           => __( 'Theme Settings', 'CAKE_BAKERY' ),
			'page_title'           => __( 'Cake Options', 'CAKE_BAKERY' ),
			'google_api_key'       => '',
			// Set it you want google fonts to update weekly. A google_api_key value is required.
			'google_update_weekly' => true,
			// Must be defined to add google fonts to the typography module
			'async_typography'     => true,
			// Use a asynchronous font on the front end or font string
			//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
			'admin_bar'            => true,
			// Show the panel pages on the admin bar
			'admin_bar_icon'       => 'dashicons-portfolio',
			// Choose an icon for the admin bar menu
			'admin_bar_priority'   => 50,
			// Choose an priority for the admin bar menu
			'global_variable'      => '',
			// Set a different name for your global variable other than the opt_name
			'dev_mode'             => false,
			// Show the time the page took to load, etc
			'update_notice'        => false,
			// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
			'customizer'           => true,
			// Enable basic customizer support
			//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
			//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

			// OPTIONAL -> Give you extra features
			'page_priority'        => null,
			// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
			'page_parent'          => 'themes.php',
			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
			'page_permissions'     => 'manage_options',
			// Permissions needed to access the options panel.
			'menu_icon'            => CAKE_BAKERY_THEME_URI.'/lib/theme-options/assets/images/cake-bakery-logo.png',
			// Specify a custom URL to an icon
			'last_tab'             => '',
			// Force your panel to always open to a specific tab (by id)
			'page_icon'            => 'icon-themes',
			// Icon displayed in the admin panel next to your menu_title
			'page_slug'            => '',
			// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
			'save_defaults'        => true,
			// On load save the defaults to DB before user clicks save or not
			'default_show'         => false,
			// If true, shows the default value next to each field that is not the default value.
			'default_mark'         => '',
			// What to print by the field's title if the value shown is default. Suggested: *
			'show_import_export'   => true,
			// Shows the Import/Export panel when not used as a field.

			// CAREFUL -> These options are for advanced use only
			'transient_time'       => 60 * MINUTE_IN_SECONDS,
			'output'               => true,
			// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
			'output_tag'           => true,
			// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
			// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

			// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
			'database'             => '',
			// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
			'use_cdn'              => true,
			// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

			// HINTS
			'hints'                => array(
				'icon'          => 'el el-question-sign',
				'icon_position' => 'right',
				'icon_color'    => 'lightgray',
				'icon_size'     => 'normal',
				'tip_style'     => array(
					'color'   => 'red',
					'shadow'  => true,
					'rounded' => false,
					'style'   => '',
				),
				'tip_position'  => array(
					'my' => 'top left',
					'at' => 'bottom right',
				),
				'tip_effect'    => array(
					'show' => array(
						'effect'   => 'slide',
						'duration' => '500',
						'event'    => 'mouseover',
					),
					'hide' => array(
						'effect'   => 'slide',
						'duration' => '500',
						'event'    => 'click mouseleave',
					),
				),
			)
		);

		// Panel Intro text -> before the form
		if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
			if ( ! empty( $args['global_variable'] ) ) {
				$v = $args['global_variable'];
			} else {
				$v = str_replace( '-', '_', $args['sorinThemeOptions'] );
			}
			$args['intro_text'] = '';
		} else {
			$args['intro_text'] = '';
		}

		// Add content after the form.
		$args['footer_text'] = '';
		\Redux::setArgs(   $this->opt_name, $args );
		$tabs = array(
			array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'CAKE_BAKERY'),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'CAKE_BAKERY'  )
			),
			array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'CAKE_BAKERY'  ),
				'content' => '<p>'.__( 'This is the tab content, HTML is allowed', 'CAKE_BAKERY' ).'</p>'
			)
		);
		\Redux::setHelpTab(   $this->opt_name, $tabs );
		$content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'CAKE_BAKERY' );
		\Redux::setHelpSidebar(   $this->opt_name, $content );
	}
	public function registerSections()
	{
		$this->removeDemo();
		$this->generalSection();
        $this->headerSection();
		$this->socialSection();
		$this->typographySection();
		$this->colorsScheme();
		$this->woocommerceTab();
		$this->singleProduct();
		$this->shopProductCategory();
		$this->footerSection();
        $this->customScripts();
	}
	public function generalSection()
	{
		\Redux::setSection(   $this->opt_name, array(
			'title'            => __( 'General Settings', 'CAKE_BAKERY' ),
			'id'               => 'generalOptions',
			'desc'             => __( 'Set General settings Fields.!', 'CAKE_BAKERY' ),
			'customizer_width' => '400px',
			'icon'             => 'el el-home',
			'fields'           => array(
				array(
					'id'       => 'cb_logo',
					'type'     => 'media',
					'url'      => true,
					'title'    => __('Site Logo', 'CAKE_BAKERY'),
					'compiler' => 'true',
					'subtitle' => __('Site Logo media uploader.', 'CAKE_BAKERY'),
					'default' => array(
                      'url' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/cake-bakery-logo.png'
                    ),
				),
              array(
                'id'       => 'cb_sticky_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Sticky Logo', 'CAKE_BAKERY'),
                'compiler' => 'true',
                'subtitle' => __('Sticky Logo media uploader.', 'CAKE_BAKERY'),
                'default' => array(
                  'url' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/cake-bakery-logo.png',
                ),
              ),
              array(
                'id'       => 'cb_mobile_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Mobile Logo', 'CAKE_BAKERY'),
                'compiler' => 'true',
                'subtitle' => __('Mobile Logo media uploader.', 'CAKE_BAKERY'),
                'default' => array(
                  'url' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/cake-bakery-logo.png',
                ),
              ),
            array(
                'id'        => 'cb_logo_width',
              'type'     => 'text',
              'url'      => true,
              'title'    => esc_html__( 'Logo Width', 'CAKE_BAKERY' ),
              'desc'     => '',
              'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'CAKE_BAKERY' ),
              'default'  => '160'
              )
            ,array(
                'id'        => 'cb_device_logo_width',
              'type'     => 'text',
              'url'      => true,
              'title'    => esc_html__( 'Logo Width on Device', 'CAKE_BAKERY' ),
              'desc'     => '',
              'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'CAKE_BAKERY' ),
              'default'  => '130'
              ),
              array(
                'id'       => 'cb_fav',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Fav Icon', 'CAKE_BAKERY'),
                'compiler' => 'true',
                'subtitle' => __('Fav Icon media uploader.', 'CAKE_BAKERY'),
                'default' => array(
                  'url' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/cake-bakery-logo.png',
                ),
              ),
              array(
                'id'       => 'cb_text_logo',
                'type'     => 'text',
                'url'      => true,
                'title'    => __('Text Logo', 'CAKE_BAKERY'),
                'compiler' => 'true',
                'subtitle' => __('Text logo.', 'CAKE_BAKERY'),
                'default' => 'Cake Bakery'
              ),

                array(
                    'id'       => 'cb_preloder',
                    'type'     => 'switch',
                    'title'    => __('Preloader Off', 'CAKE_BAKERY'),
                    'subtitle' => __('Set header button on/off', 'CAKE_BAKERY'),
                    'options' => array(
                        'on' => __('On',  'CAKE_BAKERY'),
                        'off' => __('Off',  'CAKE_BAKERY'),
                    ),
                    'default'  =>true,
                ),
                array(
                    'id'       => 'cb_preloderText',
                    'type'     => 'text',
                    'title'    => __('Preloader Text', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Preloader Text', 'CAKE_BAKERY'),
                    'desc'     => __( 'Word must be 5 to 8 character.', 'CAKE_BAKERY' ),
                    'default'  => 'Cake Bakery',
                ),
			)
		) );
	}
    public function headerSection()
    {
        $breadcrumb_layout_options = array();
        $breadcrumb_image_folder = get_template_directory_uri() . '/lib/theme-options/assets/images/breadcrumbs/';
        for( $i = 1; $i <= 2; $i++ ){
            $breadcrumb_layout_options['v' . $i] = array(
              'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'mydecor'), $i)
            ,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
            );
        }

        $header_layout_options = array();
        $header_image_folder = get_template_directory_uri() . '/lib/theme-options/assets/images/headers/';
        for( $i = 1; $i <= 3; $i++ ){
            $header_layout_options['v' . $i] = array(
              'alt'  => sprintf(esc_html__('Header Layout %s', 'CAKE_BAKERY'), $i)
            ,'img' => $header_image_folder . 'header_v'.$i.'.jpg'
            );
        }

        $loading_screen_options = array();
        $loading_image_folder = get_template_directory_uri() . '/images/loading/';
        for( $i = 1; $i <= 10; $i++ ){
            $loading_screen_options[$i] = array(
              'alt'  => sprintf(esc_html__('Loading Image %s', 'CAKE_BAKERY'), $i)
            ,'img' => $loading_image_folder . 'loading_'.$i.'.svg'
            );
        }
        \Redux::setSection(  $this->opt_name, array(
            'title'   => __('Header', 'CAKE_BAKERY'),
            'id'      => 'headerSection',
            'desc'    => __('Set your top style Header platforms.', 'CAKE_BAKERY'),
            'icon'    => 'el el-credit-card',
            'fields'  => array(
              array(
                'id'        => 'cb_header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header Layout', 'CAKE_BAKERY' ),
                'subtitle' => '','desc'     => '',
                'options'  => $header_layout_options,
                 'default'  => 'v1'
              ),
                array(
                    'id'       => 'headerSticky',
                    'type'     => 'switch',
                    'title'    => __('Sticky Header', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Sticky Header on/off', 'CAKE_BAKERY'),
                    'options' => array(
                        'on' => __('On',  'CAKE_BAKERY'),
                        'off' => __('Off',  'CAKE_BAKERY'),
                    ),
                    'default'  => true,
                ),
              array(
                'id'        => 'ts_enable_search'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Search Bar', 'mydecor' )
              ,'subtitle' => ''
              ,'default'  => true
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_search_popular_keywords'
              ,'type'     => 'textarea'
              ,'title'    => esc_html__( 'Popular Keywords For Search', 'mydecor' )
              ,'subtitle' => esc_html__( 'A comma separated list of keywords. Ex: Furniture, Outdoor, Sofa', 'mydecor' )
              ,'desc'     => ''
              ,'default'  => ''
              ,'validate' => 'no_html'
              ,'required'	=> array( 'ts_enable_search', 'equals', '1' )
              )
            ,array(
                'id'        => 'ts_enable_tiny_wishlist'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Wishlist', 'mydecor' )
              ,'subtitle' => ''
              ,'default'  => true
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_header_currency'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Header Currency', 'mydecor' )
              ,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WooCommerce Multilingual plugin, it may display demo html', 'mydecor' )
              ,'default'  => false
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_header_language'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Header Language', 'mydecor' )
              ,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WPML plugin, it may display demo html', 'mydecor' )
              ,'default'  => false
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_enable_tiny_account'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'My Account', 'mydecor' )
              ,'subtitle' => ''
              ,'default'  => true
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_enable_tiny_shopping_cart'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Shopping Cart', 'mydecor' )
              ,'subtitle' => ''
              ,'default'  => true
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              )
            ,array(
                'id'        => 'ts_shopping_cart_sidebar'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Shopping Cart Sidebar', 'mydecor' )
              ,'subtitle' => esc_html__( 'Show shopping cart in sidebar instead of dropdown. You need to update cart after changing', 'mydecor' )
              ,'default'  => false
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              ,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
              )
            ,array(
                'id'        => 'ts_show_shopping_cart_after_adding'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Show Shopping Cart After Adding Product To Cart', 'mydecor' )
              ,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products', 'mydecor' )
              ,'default'  => false
              ,'on'		=> esc_html__( 'Enable', 'mydecor' )
              ,'off'		=> esc_html__( 'Disable', 'mydecor' )
              ,'required'	=> array( 'ts_shopping_cart_sidebar', 'equals', '1' )
              )
            ,array(
                'id'        => 'ts_add_to_cart_effect'
              ,'type'     => 'select'
              ,'title'    => esc_html__( 'Add To Cart Effect', 'mydecor' )
              ,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products. If "Show Shopping Cart After Adding Product To Cart" is enabled, this option will be disabled', 'mydecor' )
              ,'options'  => array(
                  '0'				=> esc_html__( 'None', 'mydecor' )
                ,'fly_to_cart'	=> esc_html__( 'Fly To Cart', 'mydecor' )
                ,'show_popup'	=> esc_html__( 'Show Popup', 'mydecor' )
                )
              ,'default'  => '0'
              ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
              )

            ,array(
                'id'        => 'section-breadcrumb-options'
              ,'type'     => 'section'
              ,'title'    => esc_html__( 'Breadcrumb Options', 'mydecor' )
              ,'subtitle' => ''
              ,'indent'   => false
              )
            ,array(
                'id'        => 'ts_breadcrumb_layout'
              ,'type'     => 'image_select'
              ,'title'    => esc_html__( 'Breadcrumb Layout', 'mydecor' )
              ,'subtitle' => ''
              ,'desc'     => ''
              ,'options'  => $breadcrumb_layout_options
              ,'default'  => 'v1'
              )
            ,array(
                'id'        => 'ts_enable_breadcrumb_background_image'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Enable Breadcrumbs Background Image', 'mydecor' )
              ,'subtitle' => esc_html__( 'You can set background color by going to Color Scheme tab > Breadcrumb Colors section', 'mydecor' )
              ,'default'  => true
              )
            ,array(
                'id'        => 'ts_bg_breadcrumbs'
              ,'type'     => 'media'
              ,'url'      => true
              ,'title'    => esc_html__( 'Breadcrumbs Background Image', 'mydecor' )
              ,'desc'     => ''
              ,'subtitle' => esc_html__( 'Select a new image to override the default background image', 'mydecor' )
              ,'readonly' => false
              ,'default'  => array( 'url' => '' )
              )
            ,array(
                'id'        => 'ts_breadcrumb_bg_parallax'
              ,'type'     => 'switch'
              ,'title'    => esc_html__( 'Enable Breadcrumbs Background Parallax', 'mydecor' )
              ,'subtitle' => ''
              ,'default'  => false
              )

            ,array(
                'id'        => 'section-mobile-bottom-bar'
              ,'type'     => 'section'
              ,'title'    => esc_html__( 'Mobile Bottom Bar', 'mydecor' )
              ,'subtitle' => ''
              ,'indent'   => false
              )
            ,array(
                'id'        => 'ts_mobile_bottom_bar_custom_content'
              ,'type'     => 'editor'
              ,'title'    => esc_html__( 'Mobile Bottom Bar Custom Content', 'mydecor' )
              ,'subtitle' => esc_html__( 'You can add more buttons or custom content to bottom bar on mobile', 'mydecor' )
              ,'desc'     => ''
              ,'default'  => ''
              ,'args'     => array(
                  'wpautop'        => false
                ,'media_buttons' => true
                ,'textarea_rows' => 5
                ,'teeny'         => false
                ,'quicktags'     => true
                )
              )
            )
        ));
    }
	public function socialSection()
	{
		\Redux::setSection(  $this->opt_name, array(
			'title'   => __('Social Network', 'CAKE_BAKERY'),
			'id'      => 'socialShare',
			'desc'    => __('Set profile links for your Social Share platforms.', 'CAKE_BAKERY'),
			'icon'    => 'el el-random',
			'fields'  => array(
				array(
					'id'       => 'socialShareTwitter',
					'type'     => 'text',
					'title'    => __('Twitter', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Twitter.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareFacebook',
					'type'     => 'text',
					'title'    => __('Facebook', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Facebook.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareGoogle',
					'type'     => 'text',
					'title'    => __('Google Plus', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Google Plus.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareLinkedin',
					'type'     => 'text',
					'title'    => __('Linkedin', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for linkedin.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialSharePinterest',
					'type'     => 'text',
					'title'    => __('Pinterest', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Pinterest.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareTumblr',
					'type'     => 'text',
					'title'    => __('Tumblr', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Tumblr.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareDribbble',
					'type'     => 'text',
					'title'    => __('Dribbble', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Dribbble.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareInstagram',
					'type'     => 'text',
					'title'    => __('Instagram', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Instagram.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareYoutube',
					'type'     => 'text',
					'title'    => __('Youtube', 'CAKE_BAKERY'),
					'subtitle' => __('Set profile link for Youtube.', 'CAKE_BAKERY'),
					'desc'     => '',
					'default'  => '',
				),
				array(
					'id'       => 'socialShareHeight',
					'type'     => 'text',
					'title'    => __('Icon Height', 'CAKE_BAKERY'),
					'subtitle' => __('Set icon Height', 'CAKE_BAKERY'),
					'desc'     => __('Set Icon Height in (px)', 'CAKE_BAKERY'),
					'default'  => '',
				),
				array(
					'id'       => 'socialShareWidth',
					'type'     => 'text',
					'title'    => __('Icon Width', 'CAKE_BAKERY'),
					'subtitle' => __('Set icon Width', 'CAKE_BAKERY'),
					'desc'     => __('Set Icon Width in (px)', 'CAKE_BAKERY'),
					'default'  => '',
				),
				array(
					'id'       => 'socialShareBackgroundColor',
					'type'     => 'color_rgba',
					'title'    => __('Icon Background color', 'CAKE_BAKERY'),
					'transparent' => false,
					'subtitle' => __('Set icon Background color', 'CAKE_BAKERY'),
					'desc'     => __('Set Icon Background color', 'CAKE_BAKERY'),
					'default'  => '#188ff4',

				),
				array(
					'id'       => 'socialShareBackgroundHover',
					'type'     => 'color_rgba',
					'title'    => __('Icon Background Hover', 'CAKE_BAKERY'),
					'transparent' => false,
					'subtitle' => __('Set icon Background Hover', 'CAKE_BAKERY'),
					'desc'     => __('Set Icon Background Hover ', 'CAKE_BAKERY'),
					'default'  => '#94d015',
//					'validate' => 'color',
				),
				array(
					'id'       => 'socialShareLinkColor',
					'type'     => 'link_color',
					'title'    => __('Icon Color Option', 'CAKE_BAKERY'),
					'subtitle' => __('Set Icon colors', 'CAKE_BAKERY'),
					'default'  => array(
						'regular'  => '#1e73be', // blue
						'hover'    => '#dd3333', // red
						'active'   => '#8224e3',  // purple
						'visited'  => '#8224e3',  // purple
					)
				)
			)
		));
	}
	public function typographySection()
	{
        $family_fonts = array(
          "Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif"
        ,"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif"
        ,"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif"
        ,"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive"
        ,"Courier, monospace"                                   => "Courier, monospace"
        ,"Garamond, serif"                                      => "Garamond, serif"
        ,"Georgia, serif"                                       => "Georgia, serif"
        ,"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif"
        ,"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace"
        ,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"
        ,"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif"
        ,"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif"
        ,"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
        ,"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif"
        ,"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif"
        ,"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif"
        ,"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif"
        ,"CustomFont"                          					=> "CustomFont"
        );
        \Redux::setSection(  $this->opt_name, array(
            'title'  => __( 'Typography', 'CAKE_BAKERY' ),
            'id'     => 'typography',
            'icon'   => 'el el-font',
            'fields' => array(
              array(
                  'id'       			=> 'ts_body_font'
                ,'type'     		=> 'typography'
                ,'title'    		=> esc_html__( 'Body Font', 'mydecor' )
                ,'subtitle' 		=> ''
                ,'google'   		=> true
                ,'font-style'   	=> true
                ,'text-align'   	=> false
                ,'color'   			=> false
                ,'letter-spacing' 	=> true
                ,'preview'			=> array('always_display' => true)
                ,'default'  		=> array(
                    'font-family'  		=> 'Jost'
                  ,'font-weight' 		=> '400'
                  ,'font-size'   		=> '16px'
                  ,'line-height' 		=> '28px'
                  ,'letter-spacing' 	=> '0'
                  ,'font-style'   	=> ''
                  ,'google'	   		=> true
                  )
                ,'fonts'	=> $family_fonts
                ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
                )
              ,array(
                  'id'       			=> 'ts_heading_font'
                ,'type'     		=> 'typography'
                ,'title'    		=> esc_html__( 'Heading Font', 'mydecor' )
                ,'subtitle' 		=> ''
                ,'google'   		=> true
                ,'font-style'   	=> false
                ,'text-align'   	=> false
                ,'color'   			=> false
                ,'line-height'  	=> false
                ,'font-size'    	=> false
                ,'letter-spacing' 	=> true
                ,'preview'			=> array('always_display' => true)
                ,'default'  			=> array(
                    'font-family'  		=> 'Jost'
                  ,'font-weight' 		=> '600'
                  ,'letter-spacing' 	=> '0'
                  ,'google'	   		=> true
                  )
                ,'fonts'	=> $family_fonts
                ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
                )
              ,array(
                  'id'       			=> 'ts_menu_font'
                ,'type'     		=> 'typography'
                ,'title'    		=> esc_html__( 'Menu Font', 'mydecor' )
                ,'subtitle' 		=> ''
                ,'google'   		=> true
                ,'font-style'   	=> false
                ,'text-align'   	=> false
                ,'color'   			=> false
                ,'letter-spacing' 	=> true
                ,'preview'			=> array('always_display' => true)
                ,'default'  			=> array(
                    'font-family'  		=> 'Jost'
                  ,'font-weight' 		=> '500'
                  ,'font-size'   		=> '16px'
                  ,'line-height' 		=> '22px'
                  ,'letter-spacing' 	=> '0'
                  ,'google'	   		=> true
                  )
                ,'fonts'	=> $family_fonts
                ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
                )
              ,array(
                  'id'       			=> 'ts_sub_menu_font'
                ,'type'     		=> 'typography'
                ,'title'    		=> esc_html__( 'Sub Menu Font', 'mydecor' )
                ,'subtitle' 		=> ''
                ,'google'   		=> true
                ,'font-style'   	=> false
                ,'text-align'   	=> false
                ,'color'   			=> false
                ,'letter-spacing' 	=> true
                ,'preview'			=> array('always_display' => true)
                ,'default'  			=> array(
                    'font-family'  		=> 'Jost'
                  ,'font-weight' 		=> '400'
                  ,'font-size'   		=> '16px'
                  ,'line-height' 		=> '22px'
                  ,'letter-spacing' 	=> '0'
                  ,'google'	   		=> true
                  )
                ,'fonts'	=> $family_fonts
                ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
                )
              ,array(
                  'id'        => 'section-custom-font'
                ,'type'     => 'section'
                ,'title'    => esc_html__( 'Custom Font', 'mydecor' )
                ,'subtitle' => esc_html__( 'If you get the error message \'Sorry, this file type is not permitted for security reasons\', you can add this line define(\'ALLOW_UNFILTERED_UPLOADS\', true); to the wp-config.php file', 'mydecor' )
                ,'indent'   => false
                )
              ,array(
                  'id'        => 'ts_custom_font_ttf'
                ,'type'     => 'media'
                ,'url'      => true
                ,'preview'  => false
                ,'title'    => esc_html__( 'Custom Font ttf', 'mydecor' )
                ,'desc'     => ''
                ,'subtitle' => esc_html__( 'Upload the .ttf font file. To use it, you select CustomFont in the Standard Fonts group', 'mydecor' )
                ,'default'  => array( 'url' => '' )
                ,'mode'		=> 'application'
                )

              ,array(
                  'id'        => 'section-font-sizes'
                ,'type'     => 'section'
                ,'title'    => esc_html__( 'Font Sizes', 'mydecor' )
                ,'subtitle' => ''
                ,'indent'   => false
                )
              ,array(
                  'id'      => 'info-font-size-pc'
                ,'type'   => 'info'
                ,'notice' => false
                ,'title'  => esc_html__( 'Font size on PC', 'mydecor' )
                ,'desc'   => ''
                )
              ,array(
                  'id'       		=> 'ts_h1_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H1 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '72px'
                  ,'line-height' => '80px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h2_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H2 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '46px'
                  ,'line-height' => '54px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h3_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H3 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '32px'
                  ,'line-height' => '44px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h4_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H4 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '24px'
                  ,'line-height' => '34px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h5_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H5 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   		=> '20px'
                  ,'line-height' 		=> '28px'
                  ,'google'	   		=> false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h6_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H6 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   	=> '18px'
                  ,'line-height' 	=> '26px'
                  ,'google'	  	=> false
                  )
                )
              ,array(
                  'id'       		=> 'ts_small_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'Small Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'line-height'	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '13px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_button_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'Button Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'line-height'  => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-size'   => '13px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h1_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H1 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '52px'
                  ,'line-height' => '60px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h2_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H2 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '32px'
                  ,'line-height' => '40px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h3_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H3 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '24px'
                  ,'line-height' => '34px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h4_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H4 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '20px'
                  ,'line-height' => '28px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h5_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H5 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '18px'
                  ,'line-height' => '26px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h6_ipad_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H6 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '16px'
                  ,'line-height' => '22px'
                  ,'google'	   => false
                  )
                )

              ,array(
                  'id'      => 'info-font-size-mobile'
                ,'type'   => 'info'
                ,'notice' => false
                ,'title'  => esc_html__( 'Font size on Mobile', 'mydecor' )
                ,'desc'   => ''
                )
              ,array(
                  'id'       		=> 'ts_h1_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H1 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '42px'
                  ,'line-height' => '50px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h2_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H2 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '32px'
                  ,'line-height' => '40px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h3_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H3 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '24px'
                  ,'line-height' => '34px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h4_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H4 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '20px'
                  ,'line-height' => '28px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h5_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H5 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '18px'
                  ,'line-height' => '26px'
                  ,'google'	   => false
                  )
                )
              ,array(
                  'id'       		=> 'ts_h6_mobile_font'
                ,'type'     	=> 'typography'
                ,'title'    	=> esc_html__( 'H6 Font Size', 'mydecor' )
                ,'subtitle' 	=> ''
                ,'class' 		=> 'typography-no-preview'
                ,'google'   	=> false
                ,'font-family'  => false
                ,'font-weight'  => false
                ,'font-style'   => false
                ,'text-align'   => false
                ,'color'   		=> false
                ,'preview'		=> array('always_display' => false)
                ,'default'  	=> array(
                    'font-family'  => ''
                  ,'font-weight' => ''
                  ,'font-size'   => '16px'
                  ,'line-height' => '24px'
                  ,'google'	   => false
                  )
                )
            )
        ) );
	}
	public function footerSection()
	{
        \Redux::setSection(  $this->opt_name, array(
            'title'  => __( 'Footer', 'CAKE_BAKERY' ),
            'id'     => 'footerSection',
            'icon'   => 'el el-credit-card',
            'fields' => array(
                array(
                    'id'       => 'footerLayout',
                    'type'     => 'image_select',
                    'title'    => __('Footer Layout', 'CAKE_BAKERY'),
                    'subtitle' => __('Select Footer content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'CAKE_BAKERY'),
                    'options'  => array(
                        '1'      => array(
                            'alt'   => '1 Column',
                            'img'   => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/1col.png'
                        ),
                        '2'      => array(
                            'alt'   => '2 Column Left',
                            'img'   => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/2cl.png'
                        ),
                        '3'      => array(
                            'alt'   => '2 Column Right',
                            'img'  => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/2cr.png'
                        ),
                        '4'      => array(
                            'alt'   => '3 Column Middle',
                            'img'   => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/3cm.png'
                        ),
                        '5'      => array(
                            'alt'   => '3 Column Left',
                            'img'   => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/3cl.png'
                        ),
                        '6'      => array(
                            'alt'  => '3 Column Right',
                            'img'  => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/3cr.png'
                        )
                    ),
                    'default' => '2'
                ),
                array(
                    'id'       => 'copyRiteText',
                    'type'     => 'textarea',
                    'title'    => __( 'Copyrite Text', 'CAKE_BAKERY' ),
                    'default'  =>'© Copyright OrangeTheme 2018. All Rights Reserved',
                ),
         )
        ) );
	}
    public function woocommerceTab(){
        $product_loading_image = get_template_directory_uri() . '/images/prod_loading.gif';
        \Redux::setSection(  $this->opt_name, array(
          'title'  => __( 'WooCommerce', 'CAKE_BAKERY' ),
          'id'     => 'woocommerce_tab',
          'icon'   => 'el el-shopping-cart',
           'fields'=> array(

             array(
               'id'       	=> 'ts_product_hover_style'
             ,'type'     => 'select'
             ,'title'    => esc_html__( 'Hover Style', 'mydecor' )
             ,'subtitle' => esc_html__( 'Select the style of buttons/icons when hovering on product', 'mydecor' )
             ,'desc'     => ''
             ,'options'  => array(
                 'hover-style-1' 			=> esc_html__( 'Style 1', 'mydecor' )
               ,'hover-style-2' 			=> esc_html__( 'Style 2', 'mydecor' )
               )
             ,'default'  => 'hover-style-2'
             ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
             )
           ,array(
               'id'        => 'ts_effect_product'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Back Product Image', 'mydecor' )
             ,'subtitle' => esc_html__( 'Show another product image on hover. It will show an image from Product Gallery', 'mydecor' )
             ,'default'  => false
             )
           ,array(
               'id'        => 'ts_product_tooltip'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Product Tooltip', 'mydecor' )
             ,'subtitle' => esc_html__( 'Show tooltip when hovering on buttons/icons on product', 'mydecor' )
             ,'default'  => true
             )

           ,array(
               'id'        => 'section-lazy-load'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Lazy Load', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'        => 'ts_prod_lazy_load'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Activate Lazy Load', 'mydecor' )
             ,'subtitle' => ''
             ,'default'  => true
             )
           ,array(
               'id'        => 'ts_prod_placeholder_img'
             ,'type'     => 'media'
             ,'url'      => true
             ,'title'    => esc_html__( 'Placeholder Image', 'mydecor' )
             ,'desc'     => ''
             ,'subtitle' => ''
             ,'readonly' => false
             ,'default'  => array( 'url' => $product_loading_image )
             )

           ,array(
               'id'        => 'section-quickshop'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Quickshop', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'        => 'ts_enable_quickshop'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Activate Quickshop', 'mydecor' )
             ,'subtitle' => ''
             ,'default'  => true
             )

           ,array(
               'id'        => 'section-catalog-mode'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Catalog Mode', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'        => 'ts_enable_catalog_mode'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Enable Catalog Mode', 'mydecor' )
             ,'subtitle' => esc_html__( 'Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off', 'mydecor' )
             ,'default'  => false
             )

           ,array(
               'id'        => 'section-ajax-search'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Ajax Search', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'        => 'ts_ajax_search'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Enable Ajax Search', 'mydecor' )
             ,'subtitle' => ''
             ,'default'  => true
             )
           ,array(
               'id'        => 'ts_ajax_search_number_result'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Number Of Results', 'mydecor' )
             ,'subtitle' => esc_html__( 'Input -1 to show all results', 'mydecor' )
             ,'desc'     => ''
             ,'default'  => '4'
             )

           ,array(
               'id'        => 'section-cart-checkout'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Cart Checkout', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'        => 'ts_cart_checkout_process_bar'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Cart Checkout Process Bar', 'mydecor' )
             ,'subtitle' => ''
             ,'default'  => true
             )

          )
        ));
    }
    public function customScripts(){
        \Redux::setSection(  $this->opt_name, array(
          'title'  => __( 'Custom Code', 'CAKE_BAKERY' ),
          'id'     => 'custom_code',
          'icon'   => 'el el-edit',
         'fields'=> array(
               array(
                 'id'        => 'cb_custom_css_code'
               ,'type'     => 'ace_editor'
               ,'title'    => esc_html__( 'Custom CSS Code', 'CAKE_BAKERY' )
               ,'subtitle' => ''
               ,'mode'     => 'css'
               ,'theme'    => 'monokai'
               ,'desc'     => ''
               ,'default'  => ''
               ),
             array(
                'id'        => 'cb_custom_javascript_code'
              ,'type'     => 'ace_editor'
              ,'title'    => esc_html__( 'Custom Javascript Code', 'CAKE_BAKERY' )
              ,'subtitle' => ''
              ,'mode'     => 'javascript'
              ,'theme'    => 'monokai'
              ,'desc'     => ''
              ,'default'  => ''
              )
          )
        ));
    }
    public function singleProduct(){
        $breadcrumb_layout_options = array();
        $breadcrumb_image_folder = get_template_directory_uri() . '/lib/theme-options/assets/images/breadcrumbs/';
        for( $i = 1; $i <= 2; $i++ ){
            $breadcrumb_layout_options['v' . $i] = array(
              'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'mydecor'), $i)
            ,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
            );
        }

        $sidebar_options = array();
        $default_sidebars = mydecor_get_list_sidebars();
        if( is_array($default_sidebars) ){
            foreach( $default_sidebars as $key => $_sidebar ){
                $sidebar_options[$_sidebar['id']] = $_sidebar['name'];
            }
        }
        \Redux::setSection(  $this->opt_name, array(
          'title'  => __( 'Single Product', 'CAKE_BAKERY' ),
          'id'     => 'single_product_details',
          'icon'   => 'el el-edit',
         'fields'=> array(

           array(
             'id'        => 'ts_prod_layout'
           ,'type'     => 'image_select'
           ,'title'    => esc_html__( 'Product Layout', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
             '0-1-0' => array(
               'alt'  => esc_html__('Fullwidth', 'mydecor')
             ,'img' =>CAKE_BAKERY_THEME_URI.'/lib/theme-options/assets/images/1col.png'
             )
           ,'1-1-0' => array(
               'alt'  => esc_html__('Left Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI.'/lib/theme-options/assets/images/2cl.png'
             )
           ,'0-1-1' => array(
               'alt'  => esc_html__('Right Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI.'/lib/theme-options/assets/images/2cr.png'
             )
           ,'1-1-1' => array(
               'alt'  => esc_html__('Left & Right Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI.'/lib/theme-options/assets/images/3cm.png'
             )
           )
           ,'default'  => '0-1-0'
           )
         ,array(
             'id'       	=> 'ts_prod_left_sidebar'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Left Sidebar', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => $sidebar_options
           ,'default'  => 'product-detail-sidebar'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'       	=> 'ts_prod_right_sidebar'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Right Sidebar', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => $sidebar_options
           ,'default'  => 'product-detail-sidebar'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'        => 'ts_prod_breadcrumb'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Breadcrumb', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_cloudzoom'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Cloud Zoom', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_lightbox'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Lightbox', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_attr_dropdown'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Attribute Dropdown', 'mydecor' )
           ,'subtitle' => esc_html__( 'If you turn it off, the dropdown will be replaced by image or text label', 'mydecor' )
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_attr_color_text'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Attribute Color Text', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show text for the Color attribute instead of color/color image', 'mydecor' )
           ,'default'  => false
           ,'required'	=> array( 'ts_prod_attr_dropdown', 'equals', '0' )
           )
         ,array(
             'id'        => 'ts_prod_summary_2_columns'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Summary 2 Columns', 'mydecor' )
           ,'subtitle' => esc_html__( 'If product has sidebar, this option will be disabled', 'mydecor' )
           ,'default'  => false
           )
         ,array(
             'id'        => 'ts_prod_next_prev_navigation'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Next/Prev Product Navigation', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_thumbnail'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Thumbnail', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_label'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Label', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_title'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Title', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_title_in_content'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Title In Content', 'mydecor' )
           ,'subtitle' => esc_html__( 'Display the product title in the page content instead of above the breadcrumbs', 'mydecor' )
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_rating'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Rating', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_excerpt'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Excerpt', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_count_down'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Count Down', 'mydecor' )
           ,'subtitle' => esc_html__( 'You have to activate ThemeSky plugin', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_price'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Price', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_add_to_cart'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Add To Cart Button', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_ajax_add_to_cart'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Ajax Add To Cart', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'required'	=> array( 'ts_prod_add_to_cart', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_buy_now'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Buy Now Button', 'mydecor' )
           ,'subtitle' => esc_html__( 'Only support the simple and variable products', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_sku'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product SKU', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_availability'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Availability', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_sold_number'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Sold Number', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_brand'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Brands', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Categories', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_tag'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Tags', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_sharing'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Sharing', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_sharing_sharethis'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Sharing - Use ShareThis', 'mydecor' )
           ,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'mydecor' )
           ,'default'  => false
           ,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_sharing_sharethis_key'
           ,'type'     => 'text'
           ,'title'    => esc_html__( 'Product Sharing - ShareThis Key', 'mydecor' )
           ,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'mydecor' )
           ,'desc'     => ''
           ,'default'  => ''
           ,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_size_chart'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Size Chart', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'       	=> 'ts_prod_size_chart_style'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Product Size Chart Style', 'mydecor' )
           ,'subtitle' => esc_html__( 'Modal Popup is only available if the slug of the Size attribute is "size" and Attribute Dropdown is disabled', 'mydecor' )
           ,'desc'     => ''
           ,'options'  => array(
               'popup'		=> esc_html__( 'Modal Popup', 'mydecor' )
             ,'tab'		=> esc_html__( 'Additional Tab', 'mydecor' )
             )
           ,'default'  => 'popup'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           ,'required'	=> array( 'ts_prod_size_chart', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_more_less_content'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product More/Less Content', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show more/less content in the Description tab', 'mydecor' )
           ,'default'  => true
           )
         ,array(
             'id'        => 'ts_prod_wfbt_in_summary'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Frequently Bought Together In Summary', 'mydecor' )
           ,'subtitle' => esc_html__( 'Move Frequently Bought Together to product summary', 'mydecor' )
           ,'default'  => false
           )

         ,array(
             'id'        => 'section-product-tabs'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Product Tabs', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'        => 'ts_prod_tabs'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Tabs', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_tabs_show_content_default'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Show Product Tabs Content By Default', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show the content of all tabs by default and hide the tab headings', 'mydecor' )
           ,'default'  => false
           )
         ,array(
             'id'        => 'ts_prod_custom_tab'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Custom Tab', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_custom_tab_title'
           ,'type'     => 'text'
           ,'title'    => esc_html__( 'Product Custom Tab Title', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'default'  => 'Custom tab'
           )
         ,array(
             'id'        => 'ts_prod_custom_tab_content'
           ,'type'     => 'editor'
           ,'title'    => esc_html__( 'Product Custom Tab Content', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'default'  => esc_html__( 'Your custom content goes here. You can add the content for individual product', 'mydecor' )
           ,'args'     => array(
               'wpautop'        => false
             ,'media_buttons' => true
             ,'textarea_rows' => 5
             ,'teeny'         => false
             ,'quicktags'     => true
             )
           )

         ,array(
             'id'        => 'section-ads-banner'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Ads Banner', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'        => 'ts_prod_ads_banner'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Ads Banner', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_ads_banner_content'
           ,'type'     => 'editor'
           ,'title'    => esc_html__( 'Ads Banner Content', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'default'  => ''
           ,'args'     => array(
               'wpautop'        => false
             ,'media_buttons' => true
             ,'textarea_rows' => 5
             ,'teeny'         => false
             ,'quicktags'     => true
             )
           )

         ,array(
             'id'        => 'section-related-up-sell-products'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Related - Up-Sell Products', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'        => 'ts_prod_upsells'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Up-Sell Products', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_related'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Related Products', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         )

        ));
    }
    public function shopProductCategory(){


        \Redux::setSection(  $this->opt_name, array(
          'title'  => __( 'Shop/Product category', 'CAKE_BAKERY' ),
          'id'     => 'shop_product-cat',
          'icon'   => 'el el-edit',
         'fields'=> array(
           array(
             'id'        => 'ts_prod_cat_layout'
           ,'type'     => 'image_select'
           ,'title'    => esc_html__( 'Shop/Product Category Layout', 'mydecor' )
           ,'subtitle' => esc_html__( 'Sidebar is only available if Filter Widget Area is disabled', 'mydecor' )
           ,'desc'     => ''
           ,'options'  => array(
             '0-1-0' => array(
               'alt'  => esc_html__('Fullwidth', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/1col.png'
             )
           ,'1-1-0' => array(
               'alt'  => esc_html__('Left Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/2cl.png'
             )
           ,'0-1-1' => array(
               'alt'  => esc_html__('Right Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/2cr.png'
             )
           ,'1-1-1' => array(
               'alt'  => esc_html__('Left & Right Sidebar', 'mydecor')
             ,'img' => CAKE_BAKERY_THEME_URI . 'lib/theme-options/assets/images/3cm.png'
             )
           )
           ,'default'  => '0-1-0'
           )
         ,array(
             'id'       	=> 'ts_prod_cat_left_sidebar'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Left Sidebar', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => $sidebar_options
           ,'default'  => 'product-category-sidebar'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'       	=> 'ts_prod_cat_right_sidebar'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Right Sidebar', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => $sidebar_options
           ,'default'  => 'product-category-sidebar'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'       	=> 'ts_prod_cat_columns'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Product Columns', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
               3	=> 3
             ,4	=> 4
             ,5	=> 5
             ,6	=> 6
             )
           ,'default'  => '4'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'        => 'ts_prod_cat_per_page'
           ,'type'     => 'text'
           ,'title'    => esc_html__( 'Products Per Page', 'mydecor' )
           ,'subtitle' => esc_html__( 'Number of products per page', 'mydecor' )
           ,'desc'     => ''
           ,'default'  => '20'
           )
         ,array(
             'id'       	=> 'ts_prod_cat_loading_type'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Product Loading Type', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
               'default'			=> esc_html__( 'Default', 'mydecor' )
             ,'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'mydecor' )
             ,'load-more-button'	=> esc_html__( 'Load More Button', 'mydecor' )
             ,'ajax-pagination'	=> esc_html__( 'Ajax Pagination', 'mydecor' )
             )
           ,'default'  => 'load-more-button'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           )
         ,array(
             'id'        => 'ts_prod_cat_per_page_dropdown'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Products Per Page Dropdown', 'mydecor' )
           ,'subtitle' => esc_html__( 'Allow users to select number of products per page', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_onsale_checkbox'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Products On Sale Checkbox', 'mydecor' )
           ,'subtitle' => esc_html__( 'Allow users to view only the discounted products', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_glt'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Grid/List Toggle', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'       	=> 'ts_prod_cat_glt_default'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Grid/List Toggle Default', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
               'grid'	=> esc_html__( 'Grid', 'mydecor' )
             ,'list'	=> esc_html__( 'List', 'mydecor' )
             )
           ,'default'  => 'grid'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           ,'required'	=> array( 'ts_prod_cat_glt', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_cat_quantity_input'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Quantity Input', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show the quantity input on the List view', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           ,'required'	=> array( 'ts_prod_cat_glt', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_filter_widget_area'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Filter Widget Area', 'mydecor' )
           ,'subtitle' => esc_html__( 'Display Filter Widget Area on the Shop/Product Category page. If enabled, the shop sidebar will be removed', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'       	=> 'ts_filter_widget_area_style'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Filter Widget Area Style', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
               'sidebar'	=> esc_html__( 'Sidebar', 'mydecor' )
             ,'dropdown'	=> esc_html__( 'Dropdown', 'mydecor' )
             )
           ,'default'  => 'sidebar'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           ,'required'	=> array( 'ts_filter_widget_area', 'equals', '1' )
           )
         ,array(
             'id'        => 'ts_prod_cat_bestsellers'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Best Selling Products', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show best selling products at the top of product category page. It only shows if total products is more than double the maximum best selling products (default is 7)', 'mydecor' )
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_thumbnail'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Thumbnail', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_label'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Label', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_brand'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Brands', 'mydecor' )
           ,'subtitle' => esc_html__( 'Add brands to product list on all pages', 'mydecor' )
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_cat'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Categories', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_title'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Title', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_sku'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product SKU', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_rating'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Rating', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_price'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Price', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_add_to_cart'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Add To Cart Button', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => true
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_desc'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Short Description', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'        => 'ts_prod_cat_desc_words'
           ,'type'     => 'text'
           ,'title'    => esc_html__( 'Product Short Description - Limit Words', 'mydecor' )
           ,'subtitle' => esc_html__( 'It is also used for product shortcode', 'mydecor' )
           ,'desc'     => ''
           ,'default'  => '8'
           )
         ,array(
             'id'        => 'ts_prod_cat_color_swatch'
           ,'type'     => 'switch'
           ,'title'    => esc_html__( 'Product Color Swatches', 'mydecor' )
           ,'subtitle' => esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'mydecor' )
           ,'default'  => false
           ,'on'		=> esc_html__( 'Show', 'mydecor' )
           ,'off'		=> esc_html__( 'Hide', 'mydecor' )
           )
         ,array(
             'id'       	=> 'ts_prod_cat_number_color_swatch'
           ,'type'     => 'select'
           ,'title'    => esc_html__( 'Number Of Color Swatches', 'mydecor' )
           ,'subtitle' => ''
           ,'desc'     => ''
           ,'options'  => array(
               2	=> 2
             ,3	=> 3
             ,4	=> 4
             ,5	=> 5
             ,6	=> 6
             )
           ,'default'  => '3'
           ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
           ,'required'	=> array( 'ts_prod_cat_color_swatch', 'equals', '1' )
           )
         )

        ));
    }
    public function colorsScheme(){

        \Redux::setSection(  $this->opt_name, array(
          'title'  => __( 'Color Scheme ', 'CAKE_BAKERY' ),
          'id'     => 'color_schema',
          'icon'   => 'el el-brush',
         'fields'=> array(

         array(
             'id'        => 'section-general-colors'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'General Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'      => 'info-primary-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Primary Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_primary_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Primary Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_text_color_in_bg_primary'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Text Color In Background Primary Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'      => 'info-main-content-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Main Content Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_main_content_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Main Content Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_text_light_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Text Light Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#999999'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_text_bold_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Text Bold Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_text_highlight_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Text Highlight Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_link_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Link Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_link_color_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Link Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'      => 'info-input-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Input Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_input_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Input - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_input_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Input - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_input_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Input - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_input_border_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Input - Border Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#d1d1d1'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'      => 'info-button-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Button Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_button_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_button_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 0
             )
           )
         ,array(
             'id'       => 'ts_button_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_button_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_button_background_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Background Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_button_border_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Button - Border Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-breadcrumb-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Breadcrumb Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_breadcrumb_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_heading_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb - Heading Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_link_color_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb - Link Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_img_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb Has Background Image - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_img_heading_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb Has Background Image - Heading Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_img_link_color_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb Has Background Image - Link Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_breadcrumb_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Breadcrumb - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-shop-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Shop Page Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_shop_categories_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Shop Categories Background Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f6f5f6'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'        => 'section-header-colors'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Header Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'      => 'info-middle-header-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Middle Header Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_middle_header_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Middle Header - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_middle_header_icon_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Middle Header - Icon Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_middle_header_icon_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Middle Header - Icon Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_middle_header_icon_color_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Middle Header - Icon Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_middle_header_icon_border_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Middle Header - Icon Border Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-header-cart-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Header Cart Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_header_cart_number_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Number Of Cart Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_cart_number_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Number Of Cart Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-header-search-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Header Search Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_header_search_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_search_placeholder_text'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search Placeholder - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#999999'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_search_icon_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search - Icon Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_search_icon_hover_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search - Icon Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_search_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f6f5f6'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_search_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Search - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f6f5f6'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-bottom-header-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Bottom Header Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_bottom_header_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Bottom Header - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_bottom_header_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Bottom Header - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'        => 'section-menu-colors'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Menu Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'       => 'ts_menu_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'      => 'info-sub-menu-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Sub Menu Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_sub_menu_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sub Menu - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_sub_menu_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sub Menu - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_sub_menu_heading_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sub Menu - Heading Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_sub_menu_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sub Menu - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-vertical-menu-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Vertical Menu Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_vertical_icon_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Menu - Icon Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_menu_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Menu - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_menu_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Menu - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_menu_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Menu - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_menu_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Menu - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_sub_menu_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Sub Menu - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_vertical_sub_menu_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Vertical Sub Menu - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-header-mobile-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Menu Header Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_header_mobile_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Mobile - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_mobile_icon_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Mobile - Icon Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_mobile_cart_number_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Mobile - Cart Number Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_header_mobile_cart_number_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Header Mobile - Cart Number Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-menu-mobile-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Menu Mobile Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_tab_menu_mobile_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Tab Mobile - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_tab_menu_mobile_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Tab Mobile - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_tab_menu_mobile_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Tab Mobile - Text Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_tab_menu_mobile_background_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Tab Mobile - Background Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_mobile_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Mobile - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_mobile_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Mobile - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_mobile_heading_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Mobile - Heading Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_mobile_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Mobile - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_menu_mobile_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Menu Mobile - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_bottom_menu_mobile_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Bottom Menu Mobile - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f6f5f6'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_bottom_menu_mobile_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Bottom Menu Mobile - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'        => 'section-footer-colors'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Footer Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'       => 'ts_footer_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_footer_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#707070'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_footer_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_footer_heading_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Heading Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_footer_border_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Border Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#e5e5e5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_footer_border_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Footer - Border Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'        => 'section-product-colors'
           ,'type'     => 'section'
           ,'title'    => esc_html__( 'Product Colors', 'mydecor' )
           ,'subtitle' => ''
           ,'indent'   => false
           )
         ,array(
             'id'       => 'ts_product_name_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product Name - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_name_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product Name - Text Hover Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_price_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product - Price Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#000000'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_del_price_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product - Del Price Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#848484'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_sale_price_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product - Sale Price Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_rating_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product - Rating Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f9ac00'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_rating_fill_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Product - Rating Fill Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#f9ac00'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-product-button-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Thumbnail Product Button Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_product_button_thumbnail_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Thumbnail Button - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_button_thumbnail_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Thumbnail Button - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_button_thumbnail_text_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Thumbnail Button - Text Color Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_button_thumbnail_background_hover'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Thumbnail Button - Background Hover', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#161616'
             ,'alpha'	=> 1
             )
           )

         ,array(
             'id'      => 'info-product-label-colors'
           ,'type'   => 'info'
           ,'notice' => false
           ,'title'  => esc_html__( 'Product Label Colors', 'mydecor' )
           ,'desc'   => ''
           )
         ,array(
             'id'       => 'ts_product_sale_label_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sale Label - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_sale_label_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Sale Label - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#39b54a'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_new_label_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'New Label - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_new_label_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'New Label - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#0b5fb5'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_feature_label_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Feature Label - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_feature_label_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'Feature Label - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#a20401'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_outstock_label_text_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'OutStock Label - Text Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#ffffff'
             ,'alpha'	=> 1
             )
           )
         ,array(
             'id'       => 'ts_product_outstock_label_background_color'
           ,'type'     => 'color_rgba'
           ,'title'    => esc_html__( 'OutStock Label - Background Color', 'mydecor' )
           ,'subtitle' => ''
           ,'default'  => array(
               'color' 	=> '#989898'
             ,'alpha'	=> 1
             )
           )
         )

        ));
    }
	public function removeDemo()
	{

        /*
         *
         * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
         *
         */

        /*
        *
        * --> Action hook examples
        *
        */

        // If Redux is running as a plugin, this will remove the demo notice and links
        //add_action( 'redux/loaded', 'remove_demo' );

        // Function to test the compiler hook and demo CSS output.
        // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
        //add_filter('redux/options/' .  $this->opt_name . '/compiler', 'compiler_action', 10, 3);

        // Change the arguments after they've been declared, but before the panel is created
        //add_filter('redux/options/' .  $this->opt_name . '/args', 'change_arguments' );

        // Change the default value of a field after it's been set, but before it's been useds
        //add_filter('redux/options/' .  $this->opt_name . '/defaults', 'change_defaults' );

        // Dynamically add a section. Can be also used to modify sections/fields
        //add_filter('redux/options/' .  $this->opt_name . '/sections', 'dynamic_section');

        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         * */
        if ( ! function_exists( 'compiler_action' ) ) {
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
            }
        }

        /**
         * Custom function for the callback validation referenced above
         * */
        if ( ! function_exists( 'redux_validate_callback_function' ) ) {
            function redux_validate_callback_function( $field, $value, $existing_value ) {
                $error   = false;
                $warning = false;

                //do your validation
                if ( $value == 1 ) {
                    $error = true;
                    $value = $existing_value;
                } elseif ( $value == 2 ) {
                    $warning = true;
                    $value   = $existing_value;
                }

                $return['value'] = $value;

                if ( $error == true ) {
                    $field['msg']    = 'your custom error message';
                    $return['error'] = $field;
                }

                if ( $warning == true ) {
                    $field['msg']      = 'your custom warning message';
                    $return['warning'] = $field;
                }

                return $return;
            }
        }
        /**
         * Custom function for the callback referenced above
         */
        if ( ! function_exists( 'redux_my_custom_field' ) ) {
            function redux_my_custom_field( $field, $value ) {
                print_r( $field );
                echo '<br/>';
                print_r( $value );
            }
        }
        /**
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        if ( ! function_exists( 'dynamic_section' ) ) {
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'CAKE_BAKERY' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'CAKE_BAKERY' ),
                    'icon'   => 'el el-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        if ( ! function_exists( 'change_arguments' ) ) {
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        if ( ! function_exists( 'change_defaults' ) ) {
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }
        }
        /**
         * Removes the demo link and the notice of integrated demo from the redux-framework plugin
         */
        if ( ! function_exists( 'remove_demo' ) ) {
            function remove_demo() {
                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }
        }
	}
	public function enqueueAssets()
	{
		//$screen = get_current_screen();
//		if(strpos(strtolower($screen->id),$this->config->name)){
//		}
        wp_enqueue_style('adminOption', CAKE_BAKERY_THEME_URI .'lib/theme-options/assets/css/themeOptions.css',array(),true);
//        wp_enqueue_style('adminOption', CAKE_BAKERY_THEME_URI .'/assets/css/admin.css',array(),true);

    }
    public function bradcrumbs_layout(){
        $breadcrumb_layout_options = array();
        $breadcrumb_image_folder = get_template_directory_uri() . '/lib/theme-options/assets/images/breadcrumbs/';
        for( $i = 1; $i <= 2; $i++ ){
            $breadcrumb_layout_options['v' . $i] = array(
              'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'mydecor'), $i)
            ,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
            );
        }
    }
}


/**
 * Kicking this off by calling 'get_instance()' method
 */
Theme_Options::get_instance();
