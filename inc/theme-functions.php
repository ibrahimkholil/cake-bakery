<?php
/*
Get Theme Version
*/
function cb_get_theme_version(){
    $theme = wp_get_theme();
    if( $theme->parent() ){
        return $theme->parent()->get('Version');
    }
    else{
        return $theme->get('Version');
    }
}

/**
 * @param $key
 * @param $default
 * @return theme options  function for global set
 */
function cb_get_theme_options( $key = '', $default = '' ){
    global $cb_theme_options;

    if( !$key ){
        return $cb_theme_options;
    }
    else if( isset($cb_theme_options[$key]) ){
        return $cb_theme_options[$key];
    }
    else{
        return $default;
    }
}
/*
* Render Header Template
*/
if( !function_exists('cb_get_header_template') ){
    function cb_get_header_template(){
        get_template_part('templates/headers/header', cb_get_theme_options('cb_header_layout'));
    }
}


/*
 * Logo
 */
if( !function_exists('cb_theme_logo') ){
    function cb_theme_logo(){
        $theme_options = cb_get_theme_options();
        $logo_image = is_array($theme_options['cb_logo'])?$theme_options['cb_logo']['url']:$theme_options['cb_logo'];
        $logo_image_mobile = is_array($theme_options['cb_mobile_logo'])?$theme_options['cb_mobile_logo']['url']:$theme_options['cb_mobile_logo'];
        $logo_image_sticky = is_array($theme_options['cb_sticky_logo'])?$theme_options['cb_sticky_logo']['url']:$theme_options['cb_sticky_logo'];
        $logo_text = stripslashes($theme_options['cb_text_logo']);

        if( !$logo_image_mobile ){
            $logo_image_mobile = $logo_image;
        }
        if( !$logo_image_sticky ){
            $logo_image_sticky = $logo_image;
        }
        if( !$logo_text ){
            $logo_text = get_bloginfo('name');
        }
        ?>
        <div class="logo">
            <a href="<?php echo esc_url( home_url('/') ); ?>">
                <?php if( $logo_image ): ?>
                    <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="normal-logo" />
                <?php endif; ?>

                <?php if( $logo_image_mobile ): ?>
                    <img src="<?php echo esc_url($logo_image_mobile); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="mobile-logo" />
                <?php endif; ?>

                <?php if( $logo_image_sticky ): ?>
                    <img src="<?php echo esc_url($logo_image_sticky); ?>" alt="<?php echo esc_attr($logo_text); ?>" title="<?php echo esc_attr($logo_text); ?>" class="sticky-logo" />
                <?php endif; ?>

                <?php
                if( !$logo_image ){
                    echo esc_html($logo_text);
                }
                ?>
            </a>
        </div>
        <?php
    }
}


/**
 *  Pagination
 */
if( !function_exists('cb_pagination') ){
    function cb_pagination( $query = null ){
        global $wp_query;
        $max_num_pages = $wp_query->max_num_pages;
        $paged = $wp_query->get( 'paged' );
        if( $query != null ){
            $max_num_pages = $query->max_num_pages;
            $paged = $query->get( 'paged' );
        }
        if( !$paged ){
            $paged = 1;
        }
        ?>
        <nav class="cb-pagination">
            <?php
            echo paginate_links( array(
              'base'         	=> esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) )
            ,'format'       => ''
            ,'add_args'     => ''
            ,'current'      => max( 1, $paged )
            ,'total'        => $max_num_pages
            ,'prev_text'    => esc_html__('Prev', 'cake-bakery')
            ,'next_text'    => esc_html__('Next', 'cake-bakery')
            ,'type'         => 'list'
            ,'end_size'     => 3
            ,'mid_size'     => 3
            ) );
            ?>
        </nav>
        <?php
    }
}
/*** Get excerpt ***/
if( !function_exists ('cb_string_limit_words') ){
    function cb_string_limit_words($string, $word_limit){
        $words = explode(' ', $string, ($word_limit + 1));
        if( count($words) > $word_limit ){
            array_pop($words);
        }
        return implode(' ', $words);
    }
}
if( !function_exists ('cb_the_excerpt_max_words') ){
    function cb_the_excerpt_max_words( $word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true ) {
        if( $post ){
            $excerpt = cb_get_the_excerpt_by_id($post->ID);
        }
        else{
            $excerpt = get_the_excerpt();
        }

        if( $strip_tags ){
            $excerpt = wp_strip_all_tags($excerpt);
            $excerpt = strip_shortcodes($excerpt);
        }

        if( $word_limit != -1 ){
            $result = cb_string_limit_words($excerpt, $word_limit);
            if( $result != $excerpt ){
                $result .= $extra_str;
            }
        }
        else{
            $result = $excerpt;
        }

        if( $echo ){
            echo do_shortcode($result);
        }
        return $result;
    }
}


if( !function_exists('cb_get_the_excerpt_by_id') ){
    function cb_get_the_excerpt_by_id( $post_id = 0 )
    {
        global $wpdb;
        $query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
        $result = $wpdb->get_results( $wpdb->prepare($query, $post_id), ARRAY_A );
        if( $result[0]['post_excerpt'] ){
            return $result[0]['post_excerpt'];
        }
        else{
            $content = $result[0]['post_content'];
            if( false !== strpos( $content, '<!--nextpage-->' ) ){
                $pages = explode( '<!--nextpage-->', $content );
                return $pages[0];
            }
            return $content;
        }
    }
}
/* Get post comment count */
if( !function_exists('cb_get_post_comment_count') ){
    function cb_get_post_comment_count( $post_id = 0 ){
        global $post;
        if( !$post_id ){
            $post_id = $post->ID;
        }

        $comments_count = wp_count_comments($post_id);
        return $comments_count->approved;
    }
}



/*** Breadcrumbs ***/
if( !function_exists('cb_breadcrumbs') ){
    function cb_breadcrumbs(){
        $delimiter_char = '&#8250;';
        if( class_exists('WooCommerce') ){
            if( function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce() ){
                woocommerce_breadcrumb(array('wrap_before'=>'<div class="breadcrumbs"><div class="breadcrumbs-container">','delimiter'=>'<span>'.$delimiter_char.'</span>','wrap_after'=>'</div></div>'));
                return;
            }
        }

        $allowed_html = array(
          'a'		=> array('href' => array(), 'title' => array())
        ,'span'	=> array('class' => array())
        ,'div'	=> array('class' => array())
        );
        $output = '';

        $delimiter = '<span class="brn_arrow">'.$delimiter_char.'</span>';

        $ar_title = array(
          'home'			=> __('Home', 'mydecor')
        ,'search' 		=> __('Search results for ', 'mydecor')
        ,'404' 			=> __('Error 404', 'mydecor')
        ,'tagged' 		=> __('Tagged ', 'mydecor')
        ,'author' 		=> __('Articles posted by ', 'mydecor')
        ,'page' 		=> __('Page', 'mydecor')
        );

        $before = '<span class="current">'; /* tag before the current crumb */
        $after = '</span>'; /* tag after the current crumb */
        global $wp_rewrite, $post;
        $rewriteUrl = $wp_rewrite->using_permalinks();
        if( !is_home() && !is_front_page() || is_paged() ){
            $output .= '<div class="breadcrumbs"><div class="breadcrumbs-container">';

            $homeLink = esc_url( home_url('/') );
            $output .= '<a href="' . $homeLink . '">' . $ar_title['home'] . '</a> ' . $delimiter . ' ';

            if( is_category() ){
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if( $thisCat->parent != 0 ){
                    $output .= get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
                }
                $output .= $before . single_cat_title('', false) . $after;
            }
            elseif( is_search() ){
                $output .= $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
            }elseif( is_day() ){
                $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                $output .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                $output .= $before . get_the_time('d') . $after;
            }elseif( is_month() ){
                $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                $output .= $before . get_the_time('F') . $after;
            }elseif( is_year() ){
                $output .= $before . get_the_time('Y') . $after;
            }elseif( is_single() && !is_attachment() ){
                if( get_post_type() != 'post' ){
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $post_type_name = $post_type->labels->singular_name;
                    if( is_singular('ts_portfolio') ){
                        $portfolio_page_info = mydecor_get_portfolio_page_info();
                        if( $portfolio_page_info ){
                            $post_type_name = $portfolio_page_info['title'];
                            $portfolio_url = $portfolio_page_info['url'];
                        }
                    }
                    if( $rewriteUrl ){
                        $output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . $slug['slug'] . '/') . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }else{
                        $output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . '?post_type=' . get_post_type()) . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }
                    $output .= $before . get_the_title() . $after;
                }else{
                    $cat = get_the_category(); $cat = $cat[0];
                    $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    $output .= $before . get_the_title() . $after;
                }
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                $post_type_name = $post_type->labels->singular_name;
                if( isset($slug['slug']) && $slug['slug'] == 'portfolio' ){
                    $portfolio_page_info = mydecor_get_portfolio_page_info();
                    if( $portfolio_page_info ){
                        $post_type_name = $portfolio_page_info['title'];
                        $portfolio_url = $portfolio_page_info['url'];
                    }
                }
                if( is_tag() ){
                    $output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
                }
                elseif( is_taxonomy_hierarchical(get_query_var('taxonomy')) ){
                    if( $rewriteUrl ){
                        $output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . $slug['slug'] . '/') . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }else{
                        $output .= '<a href="' . (isset($portfolio_url)?$portfolio_url:$homeLink . '?post_type=' . get_post_type()) . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }

                    $curTaxanomy = get_query_var('taxonomy');
                    $curTerm = get_query_var( 'term' );
                    $termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
                    $pushPrintArr = array();
                    if( $termNow !== false ){
                        while( (int)$termNow->parent != 0 ){
                            $parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
                            array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
                            $curTerm = $parentTerm->name;
                            $termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
                        }
                    }
                    $pushPrintArr = array_reverse($pushPrintArr);
                    array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
                    $output .= implode($pushPrintArr);
                }else{
                    $output .= $before . $post_type_name . $after;
                }
            }elseif( is_attachment() ){
                if( (int)$post->post_parent > 0 ){
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    if( count($cat) > 0 ){
                        $cat = $cat[0];
                        $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    }
                    $output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
                }
                $output .= $before . get_the_title() . $after;
            }elseif( is_page() && !$post->post_parent ){
                $output .= $before . get_the_title() . $after;
            }elseif( is_page() && $post->post_parent ){
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while( $parent_id ){
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach( $breadcrumbs as $crumb ){
                    $output .= $crumb . ' ' . $delimiter . ' ';
                }
                $output .= $before . get_the_title() . $after;
            }elseif( is_tag() ){
                $output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
            }elseif( is_author() ){
                global $author;
                $userdata = get_userdata($author);
                $output .= $before . $ar_title['author'] . $userdata->display_name . $after;
            }elseif( is_404() ){
                $output .= $before . $ar_title['404'] . $after;
            }
            if( get_query_var('paged') || get_query_var('page') ){
                if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){
                    $output .= $before .' (';
                }
                $output .= $ar_title['page'] . ' ' . ( get_query_var('paged')?get_query_var('paged'):get_query_var('page') );
                if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){
                    $output .= ')'. $after;
                }
            }
            $output .= '</div></div>';
        }

        echo wp_kses($output, $allowed_html);

        wp_reset_postdata();
    }
}

if( !function_exists('cb_breadcrumbs_title') ){
    function cb_breadcrumbs_title( $show_breadcrumb = false, $show_page_title = false, $page_title = '', $extra_class_title = '' ){
        $theme_options = cb_get_theme_options();
        if( $show_breadcrumb || $show_page_title ){
            $breadcrumb_bg_option = is_array($theme_options['ts_bg_breadcrumbs'])?$theme_options['ts_bg_breadcrumbs']['url']:$theme_options['ts_bg_breadcrumbs'];
            $breadcrumb_bg = '';
            $classes = array();
            $classes[] = 'breadcrumb-title-wrapper breadcrumb-' . $theme_options['ts_breadcrumb_layout'];
            $classes[] = $show_breadcrumb?'':'no-breadcrumb';
            $classes[] = $show_page_title?'':'no-title';
            if( $theme_options['.'] && ( $theme_options['ts_breadcrumb_layout'] == 'v2' ) ){
                if( $breadcrumb_bg_option == '' ){ /* No Override */
                    $breadcrumb_bg = get_template_directory_uri() . '/images/bg_breadcrumb_'.$theme_options['ts_breadcrumb_layout'].'.jpg';
                }
                else{
                    $breadcrumb_bg = $breadcrumb_bg_option;
                }
            }

            $style = '';
            if( $breadcrumb_bg != '' ){
                $style = 'style="background-image: url('. esc_url($breadcrumb_bg) .')"';
                if( $theme_options['ts_breadcrumb_bg_parallax'] ){
                    $classes[] = 'ts-breadcrumb-parallax';
                }
            }
            echo '<div class="'.esc_attr(implode(' ', array_filter($classes))).'" '.$style.'><div class="breadcrumb-content container"><div class="breadcrumb-title">';

            if( $show_breadcrumb ){
                cb_breadcrumbs();
            }

            if( $show_page_title ){
                echo '<h1 class="heading-title page-title entry-title '.$extra_class_title.'">'.$page_title.'</h1>';
            }

            echo '</div></div></div>';
        }
    }
}

/*** Page Layout Columns Class ***/
if( !function_exists('cb_page_layout_columns_class') ){
    function cb_page_layout_columns_class($page_column, $left_sidebar_name = '', $right_sidebar_name = ''){
        $data = array();

        if( empty($page_column) ){
            $page_column = '0-1-0';
        }

        $layout_config = explode('-', $page_column);
        $left_sidebar = (int)$layout_config[0];
        $right_sidebar = (int)$layout_config[2];

        if( $left_sidebar_name && !is_active_sidebar( $left_sidebar_name ) ){
            $left_sidebar = 0;
        }

        if( $right_sidebar_name && !is_active_sidebar( $right_sidebar_name ) ){
            $right_sidebar = 0;
        }

        $main_class = ($left_sidebar + $right_sidebar) == 2 ?'ts-col-12':( ($left_sidebar + $right_sidebar) == 1 ?'ts-col-18':'ts-col-24' );

        $data['left_sidebar'] = $left_sidebar;
        $data['right_sidebar'] = $right_sidebar;
        $data['main_class'] = $main_class;
        $data['left_sidebar_class'] = 'ts-col-6';
        $data['right_sidebar_class'] = 'ts-col-6';

        return $data;
    }
}


add_action('init', 'mydecor_support_wc_product_gallery_lightbox', 20);
/*
 * Image light box enable for woocommerce
 */
function mydecor_support_wc_product_gallery_lightbox(){
    if( cb_get_theme_options('ts_prod_cloudzoom') ){
        add_theme_support( 'wc-product-gallery-zoom' );
    }
    if( cb_get_theme_options('ts_prod_lightbox') ){
        add_theme_support( 'wc-product-gallery-lightbox' );
    }
}
