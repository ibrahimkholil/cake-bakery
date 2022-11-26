<?php  get_header();?>

<?php  get_footer();?>
<div class="page-template blog-template index-template container">
    <div id="main-content" class="<?php //echo esc_attr($page_column_class['main_class']); ?>">
        <div id="primary" class="site-content">

            <?php
            if( have_posts() ):
                echo '<div class="list-posts">';
                while( have_posts() ) : the_post();
                    get_template_part( 'content', get_post_format() );
                endwhile;
                echo '</div>';
            else:
                echo '<div class="alert alert-error">';
                echo '<h3>'.esc_html__('Sorry. There are no posts to display!', 'mydecor').'</h3>';
                echo '<p class="ts-aligncenter">'.esc_html__('Try researching for something else.', 'mydecor').'</p>';
                echo '</div>';
                echo '<div class="search-wrapper">';
                get_search_form();
                echo '</div>';
            endif;

            cb_pagination();
            ?>

        </div>
    </div>

</div>
