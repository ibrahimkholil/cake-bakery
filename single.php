<?php
get_header();

global $post;
setup_postdata($post);


$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */


$extra_classes = array();


?>
    <div id="content" class="container py-5 container-post <?php echo esc_attr(implode(' ', $extra_classes)) ?>">


        <!-- main-content -->
        <div id="main-content" class="<?php //echo esc_attr($page_column_class['main_class']); ?>">
            <article class="single single-post <?php echo esc_attr($post_format); ?> <?php ///echo !$show_blog_thumbnail?'no-featured-image':''; ?>">

                <div class="entry-format nav-middle nav-center">

                    <!-- Blog Thumbnail -->
                    <?php if( has_post_thumbnail() ): ?>
                        <?php if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){ ?>
                            <figure class="<?php echo ('gallery' == $post_format)?'gallery loading items thumbnail':'thumbnail' ?>">
                                <?php

                                if( $post_format == 'gallery' ){
                                    $gallery = get_post_meta($post->ID, 'ts_gallery', true);
                                    $gallery_ids = explode(',', $gallery);
                                    if( is_array($gallery_ids) ){
                                        array_unshift($gallery_ids, get_post_thumbnail_id());
                                    }
                                    foreach( $gallery_ids as $gallery_id ){
                                        echo wp_get_attachment_image( $gallery_id, 'full', 0, array('class' => 'thumbnail-blog') );
                                    }
                                }

                                if( ($post_format === false || $post_format == 'standard') && !is_singular('ts_feature') ){
                                    the_post_thumbnail('full', array('class' => 'thumbnail-blog'));
                                }

                                ?>
                            </figure>
                            <?php
                        }

                        if( $post_format == 'video' ){
                            $video_url = get_post_meta($post->ID, 'ts_video_url', true);
                            if( $video_url != '' ){
                                echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
                            }
                        }

                        if( $post_format == 'audio' ){
                            $audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
                            if( strlen($audio_url) > 4 ){
                                $file_format = substr($audio_url, -3, 3);
                                if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
                                    echo do_shortcode('[audio '.$file_format.'="'.esc_url($audio_url).'"]');
                                }
                                else{
                                    echo do_shortcode('[ts_soundcloud url="'.esc_url($audio_url).'" width="100%" height="166"]');
                                }
                            }
                        }
                        ?>
                    <?php endif; ?>
                </div>

                <div class="entry-header">
                    <header>
                        <?php
                        $categories_list = get_the_category_list(', ');
                        if( !$categories_list ){
                            $theme_options['ts_blog_details_categories'] = false;
                        }
                        ?>

                        <!-- Blog Categories -->

                            <div class="cats-link">
                                <?php echo trim($categories_list); ?>
                            </div>


                        <!-- Blog Title -->

                            <h2 class="entry-title"><?php the_title(); ?></h2>


                    </header>
                </div>



                    <div class="entry-meta-top">

                        <!-- Blog Author -->
                        <?php if( $theme_options['ts_blog_details_author'] ): ?>
                            <span class="vcard author">
						<span><?php esc_html_e('By', 'mydecor'); ?></span>
						<?php the_author_posts_link(); ?>
					</span>
                        <?php endif; ?>

                        <!-- Blog Date Time -->
                        <?php if( $theme_options['ts_blog_details_date'] ) : ?>
                            <span class="date-time">
						<?php echo get_the_time( get_option('date_format') ); ?>
					</span>
                        <?php endif; ?>

                        <!-- Blog Comment -->
                        <?php if( $theme_options['ts_blog_details_comment'] ): ?>
                            <span class="comment-count">
						<?php echo mydecor_get_post_comment_count(); ?>
					</span>
                        <?php endif; ?>

                    </div>



                <div class="entry-content">

                    <!-- Blog Content -->

                        <div class="content-wrapper">
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                        </div>

                </div>

                <!-- Blog Author -->
                <?php if( $theme_options['ts_blog_details_author_box'] && get_the_author_meta('description') ) : ?>
                    <div class="entry-author">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 100, 'mystery' ); ?>
                        </div>
                        <div class="author-info">
                            <span class="author"><?php the_author_posts_link();?></span>
                            <span class="role"><?php echo mydecor_get_user_role( get_the_author_meta('ID') ); ?></span>
                            <p><?php the_author_meta( 'description' ); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( $theme_options['ts_blog_details_navigation'] ): ?>
                    <div class="meta-navigation">

                        <!-- Next Prev Blog -->
                        <div class="single-navigation-1">
                            <h6 class="prev-blog"><?php previous_post_link('%link'); ?></h6>
                        </div>

                        <!-- Next Prev Blog -->
                        <div class="single-navigation-2">
                            <h6 class="next-blog"><?php next_post_link('%link'); ?></h6>
                        </div>

                    </div>
                <?php endif; ?>

                <!-- Related Posts-->
                <?php
//                if( !is_singular('ts_feature') && $theme_options['ts_blog_details_related_posts'] ){
//                    get_template_part('templates/related-posts');
//                }
                ?>

                <!-- Comment Form -->
                <?php

                    comments_template( '', true );

                ?>
            </article>
        </div><!-- end main-content -->

        <!-- end right sidebar -->
    </div>
<?php get_footer(); ?>
