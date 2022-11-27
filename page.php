<?php
get_header();
$page_options = cb_get_page_options();

$extra_class = '';

$page_column_class = cb_page_layout_columns_class($page_options['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && $page_options['ts_show_breadcrumb'] );
$show_page_title = ( !is_home() && !is_front_page() && $page_options['ts_show_page_title'] );
if( $show_breadcrumb || $show_page_title ){
    $extra_class = 'show_breadcrumb_'.cb_get_page_options('ts_breadcrumb_layout');
}

cb_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
?>


    <div class="container py-5 <?php echo esc_attr($extra_class) ?>">


        <!-- Main Content -->
        <div id="main-content" class="<?php //echo esc_attr($page_column_class['main_class']); ?>">
            <div id="primary" class="site-content">
                <?php
                if( class_exists('WooCommerce') ){
                    wc_print_notices();
                }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                    if( have_posts() ) the_post();
                    the_content();
                    wp_link_pages();
                    ?>
                </article>
                <?php
                /* If comments are open or we have at least one comment, load up the comment template. */
                if ( comments_open() || get_comments_number() ) :
                    comments_template( '', true );
                endif;
                ?>
            </div>
        </div>


    </div>

<?php get_footer(); ?>
