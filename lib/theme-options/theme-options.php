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
		$this->woocommerceTab();
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
    {     $header_layout_options = array();
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
                    'id'       => 'headerTopBg',
                    'type'     => 'color',
                    'title'    => __('Header Top Background', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Header Top Background.', 'CAKE_BAKERY'),
                    'output'    => array('background-color' => '.sr-header-top')
                ),
                array(
                    'id'       => 'headerNumber',
                    'type'     => 'text',
                    'title'    => __('Header Number', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Header Number.', 'CAKE_BAKERY'),
                    'desc'     => '',
                    'default'  => '',
                    'placeholder'  => 'e.g +015689222',
                ),
                array(
                    'id'       => 'headerEmail',
                    'type'     => 'text',
                    'title'    => __('Header Email', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Header Email.', 'CAKE_BAKERY'),
                    'desc'     => '',
                    'default'  => '',
                    'placeholder'  => 'example@yourdomain.com',
                ),
                array(
                    'id'       => 'headerBtnText',
                    'type'     => 'text',
                    'title'    => __('Header Button Text', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Header Button Text.', 'CAKE_BAKERY'),
                    'desc'     => '',
                    'default'  => '',
                ),
                array(
                    'id'       => 'headerBtnUrl',
                    'type'     => 'text',
                    'title'    => __('Header Button Link', 'CAKE_BAKERY'),
                    'subtitle' => __('Set Header Button Link.', 'CAKE_BAKERY'),
                    'desc'     => 'E.G: http://example.com',
                    'default'  => '',
                ),
                array(
                    'id'       => 'headerBtnOff',
                    'type'     => 'switch',
                    'title'    => __('Header Button  Hide', 'CAKE_BAKERY'),
                    'subtitle' => __('Set header button on/off', 'CAKE_BAKERY'),
                    'options' => array(
                        'on' => __('On',  'CAKE_BAKERY'),
                        'off' => __('Off',  'CAKE_BAKERY'),
                    ),
                    'default'  => true,
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
        \Redux::setSection(  $this->opt_name, array(
            'title'  => __( 'Typography', 'CAKE_BAKERY' ),
            'id'     => 'typography',
            'icon'   => 'el el-font',
            'fields' => array(
                array(
                    'id'       => 'sorinBodyFont',
                    'type'     => 'typography',
                    'title'    => __( 'Body Font', 'CAKE_BAKERY' ),
                    'subtitle' => __( 'Specify the body font properties.', 'CAKE_BAKERY' ),
                    'google'   => true,
                    'subsets'       => false,
                    'output' => array('body'),
                    'default'  => array(
                        'color'       => '#dd9933',
                        'font-size'   => '30px',
                        'font-family' => 'Arial,Helvetica,sans-serif',
                        'font-weight' => 'Normal',
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingOne',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H1', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title, h1' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingTwo',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H2', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingThree',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H3', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingFour',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H4', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingFive',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H5', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
                array(
                    'id'          => 'sorinHeadingSix',
                    'type'        => 'typography',
                    'title'       => __( 'Heading H6', 'CAKE_BAKERY' ),
                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                    //'google'      => false,
                    // Disable google fonts. Won't work if you haven't defined your google api key
                    'font-backup' => true,
                    // Select a backup non-google font in addition to a google font
                    //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                    //'font-size'     => false,
                    //'line-height'   => false,
                    //'word-spacing'  => true,  // Defaults to false
                    //'letter-spacing'=> true,  // Defaults to false
                    //'color'         => false,
                    //'preview'       => false, // Disable the previewer
                    'all_styles'  => true,
                    // Enable all Google Font style/weight variations to be added to the page
                    'output'      => array( '.site-title' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'compiler'    => array( 'site-title-compiler' ),
                    // An array of CSS selectors to apply this font style to dynamically
                    'units'       => 'px',
                    // Defaults to px
                    'subtitle'    => __( 'Typography option with each property can be called individually.', 'CAKE_BAKERY' ),
                    'default'     => array(
                        'color'       => '#333',
                        'font-style'  => '700',
                        'font-family' => 'Abel',
                        'google'      => true,
                        'font-size'   => '33px',
                        'line-height' => '40px'
                    ),
                ),
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
                            'img'   => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/1col.png'
                        ),
                        '2'      => array(
                            'alt'   => '2 Column Left',
                            'img'   => CAKE_BAKERY_THEME_URI . '/lib/theme-options/assets/images/2cl.png'
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
               'id'        => 'section-product-label'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Product Label', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'       	=> 'ts_product_label_style'
             ,'type'     => 'select'
             ,'title'    => esc_html__( 'Product Label Style', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'options'  => array(
                 'rectangle' 	=> esc_html__( 'Rectangle', 'mydecor' )
               ,'circle' 		=> esc_html__( 'Circle', 'mydecor' )
               )
             ,'default'  => 'rectangle'
             ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
             )
           ,array(
               'id'        => 'ts_product_show_new_label'
             ,'type'     => 'switch'
             ,'title'    => esc_html__( 'Product New Label', 'mydecor' )
             ,'subtitle' => ''
             ,'default'  => false
             ,'on'		=> esc_html__( 'Show', 'mydecor' )
             ,'off'		=> esc_html__( 'Hide', 'mydecor' )
             )
           ,array(
               'id'        => 'ts_product_new_label_text'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Product New Label Text', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'default'  => 'New'
             ,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
             )
           ,array(
               'id'        => 'ts_product_show_new_label_time'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Product New Label Time', 'mydecor' )
             ,'subtitle' => esc_html__( 'Number of days which you want to show New label since product is published', 'mydecor' )
             ,'desc'     => ''
             ,'default'  => '30'
             ,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
             )
           ,array(
               'id'        => 'ts_product_sale_label_text'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Product Sale Label Text', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'default'  => 'Sale'
             )
           ,array(
               'id'        => 'ts_product_feature_label_text'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Product Feature Label Text', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'default'  => 'Hot'
             )
           ,array(
               'id'        => 'ts_product_out_of_stock_label_text'
             ,'type'     => 'text'
             ,'title'    => esc_html__( 'Product Out Of Stock Label Text', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'default'  => 'Sold out'
             )
           ,array(
               'id'       	=> 'ts_show_sale_label_as'
             ,'type'     => 'select'
             ,'title'    => esc_html__( 'Show Sale Label As', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'options'  => array(
                 'text' 		=> esc_html__( 'Text', 'mydecor' )
               ,'number' 	=> esc_html__( 'Number', 'mydecor' )
               ,'percent' 	=> esc_html__( 'Percent', 'mydecor' )
               )
             ,'default'  => 'text'
             ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
             )

           ,array(
               'id'        => 'section-product-rating'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Product Rating', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
               'id'       	=> 'ts_product_rating_style'
             ,'type'     => 'select'
             ,'title'    => esc_html__( 'Product Rating Style', 'mydecor' )
             ,'subtitle' => ''
             ,'desc'     => ''
             ,'options'  => array(
                 'border' 		=> esc_html__( 'Border', 'mydecor' )
               ,'fill' 		=> esc_html__( 'Fill', 'mydecor' )
               )
             ,'default'  => 'fill'
             ,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
             )

           ,array(
               'id'        => 'section-product-hover'
             ,'type'     => 'section'
             ,'title'    => esc_html__( 'Product Hover', 'mydecor' )
             ,'subtitle' => ''
             ,'indent'   => false
             )
           ,array(
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
}


/**
 * Kicking this off by calling 'get_instance()' method
 */
Theme_Options::get_instance();
