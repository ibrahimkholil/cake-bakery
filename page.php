<?php
get_header();


$extra_class = '';

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
