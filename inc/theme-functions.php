<?php

/**
 * create dynamic css
 */
add_action('add_option_cake_bakery_theme_options', 'cake_baker_create_dynamic_css', 10, 2);
function cake_baker_create_dynamic_css( $option, $value ){
    cake_bakery_update_dynamic_css($value, $value, $option);
}

/**
 * Update dynamic css
 */

add_action('update_option_cake_bakery_theme_options', 'cake_bakery_update_dynamic_css', 10, 3);
function cake_bakery_update_dynamic_css( $old_value,$value,$option){
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

