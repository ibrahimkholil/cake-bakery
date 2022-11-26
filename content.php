<?php
global $post;

$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
$post_class = array( 'post-item entry' );
if( is_sticky() && !is_paged() ){
    $post_class[] = 'sticky';
}
//
//
//if( $theme_options['ts_blog_excerpt_max_words'] == -1 && empty($post->post_excerpt) ){
//    $theme_options['ts_blog_read_more'] = 0;
//}
?>
<article <?php post_class( $post_class ) ?> >
    <?php if( $post_format != 'quote' ): ?>
        <?php
        if( has_post_thumbnail() ){
            ?>
        <div class="<?php echo ( 'gallery' == $post_format )?'nav-middle nav-center ':'' ?>entry-format">
            <?php

            if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
                if( $post_format != 'gallery' ){
                    ?>
                    <a class="thumbnail <?php echo esc_attr($post_format); ?>" href="<?php the_permalink() ?>">
                <?php }else{ ?>
                    <div class="thumbnail gallery loading">
                <?php } ?>
                <figure>
                    <?php
                    if( $post_format == 'gallery' ){
                        $gallery = get_post_meta($post->ID, 'ts_gallery', true);
                        if( $gallery != '' ){
                            $gallery_ids = explode(',', $gallery);
                        }
                        else{
                            $gallery_ids = array();
                        }

                        if( has_post_thumbnail() ){
                            array_unshift($gallery_ids, get_post_thumbnail_id());
                        }
                        foreach( $gallery_ids as $gallery_id ){
                            echo '<a class="thumbnail gallery" href="'.esc_url(get_the_permalink()).'">';
                            echo wp_get_attachment_image( $gallery_id, 'thumbnail', 0, array('class' => 'thumbnail-blog') );
                            echo '</a>';
                        }

                    }

                    if( $post_format === false || $post_format == 'standard' ){
                        if( has_post_thumbnail() ){
                            the_post_thumbnail('post-thumbnail', array('class' => 'thumbnail-blog'));
                        }

                    }
                    ?>
                </figure>
                <?php
                if( $post_format != 'gallery' ){
                    ?>
                    </a>
                <?php }else{ ?>
                    </div>
                <?php } ?>
                <?php
            }

            if( $post_format == 'video' ){
                $video_url = get_post_meta($post->ID, 'ts_video_url', true);
                if( $video_url ){
                    echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
                }

            }

            if( $post_format == 'audio' ){
                $audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
                if( strlen($audio_url) > 4 ){
                    $file_format = substr($audio_url, -3, 3);
                    if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
                        echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
                    }
                    else{
                        echo do_shortcode('[ts_soundcloud url="'.$audio_url.'" width="100%" height="166"]');
                    }
                }

            }


            ?>
            </div>
            <?php

        }
        ?>

        <div class="entry-content">

            <!-- Blog Title - Author -->
            <header>

                <!-- Blog Categories -->

                    <div class="cats-link">
                        <?php echo get_the_category_list(', '); ?>
                    </div>


                    <h2 class="heading-title entry-title">
                        <a class="post-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
                    </h2>

            </header>

            <!-- Blog Excerpt -->

                <div class="entry-summary">
                    <div class="short-content">
                        <?php

                        $max_words = 140;
                        if( $max_words != '-1' ){
                            cb_the_excerpt_max_words($max_words, $post,'', true);
                        }
                        else if( !empty($post->post_excerpt) ){
                            the_excerpt();
                        }
                        else{
                            the_content();
                        }
                        ?>
                    </div>
                    <?php
                    if( $post_format === false || $post_format == 'standard' ){
                        wp_link_pages();
                    }
                    ?>
                </div>


                <div class="entry-meta-top">

                    <!-- Blog Author -->

                        <span class="vcard author">
							<span><?php esc_html_e('By', 'cb'); ?></span>
							<?php the_author_posts_link(); ?>
						</span>


                    <!-- Blog Date Time -->

                        <span class="date-time">
							<?php echo get_the_time( get_option('date_format') ); ?>
						</span>


                    <!-- Blog Comment -->

                        <span class="comment-count">
							<?php
                            echo cb_get_post_comment_count();
                            ?>
						</span>


                </div>

            <!-- Blog Read More Button -->

                <div class="entry-meta-bottom">
                    <a class="button-readmore button button-primary" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read more...', 'cb'); ?></a>
                </div>

        </div>

    <?php endif; ?>
</article>
