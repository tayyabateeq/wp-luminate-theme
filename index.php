<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Luminate
 */


get_header();

?>

    <main id="primary" class="site-main">
		
		<?php echo my_theme_display_images_slider(); ?>
		<?php echo my_theme_display_special_pages_links(); ?>
        <div class="container-fluid bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="show-last-posts">
                            <?Php
                            //the_post();
                            $args = array(
                                'posts_per_page' => 3, // set the number of posts to display
                                'orderby' => 'date', // order by post date
                                'order' => 'DESC', // display posts in descending order (newest first)
                                'post__not_in' => get_option( 'sticky_posts' ) // exclude sticky posts from this query
                            );
                            $latest_posts = new WP_Query( $args );
                            // If query have posts.
                            if ( $latest_posts->have_posts() ) :
                                // While query have posts.
                                while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
                                    echo '<div class="col-md-4 col-sm-12 last-posts">';
                                    echo '<div class="post-title">' . get_the_title() . '</div>';
                                    echo '<div class="post-img">' . get_the_post_thumbnail() . '</div>';
                                    echo '<div class="post-content">'. get_the_content() . '</div>';
                                    echo '<a href="' . get_permalink() . '" id="read-more-button">+ Ver otros servicios</a>';
                                    echo '</div>';
                                endwhile;

                            // reset the query
                            wp_reset_postdata();

                            else :

                                get_template_part( 'template-parts/content', 'none' );
                        
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); padding: 0;" >
                        <?php if ( is_active_sidebar( 'positiva-gravity-forms-sidebar' ) ) : ?>
                            <aside id="positiva-gravity-forms-sidebar" class="positiva-gravity-forms-sidebar">
                                <?php dynamic_sidebar( 'positiva-gravity-forms-sidebar' ); ?>
                            </aside>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div>
                        <?php echo display_cpt_slider(); ?>
                    </div>
                    <div>
                        <?php
                        // Display random sticky blog post.
                        $sticky = get_option( 'sticky_posts' );
                        if ( ! empty( $sticky ) ) {
                            $args = array(
                                'post__in' => $sticky,
                                'posts_per_page' => 1,
                                'ignore_sticky_posts' => 1,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );
                            $sticky_query = new WP_Query( $args );
                            if ( $sticky_query->have_posts() ) :
                                while ( $sticky_query->have_posts() ) : $sticky_query->the_post();
                                    $image_url = get_the_post_thumbnail_url();
                
                                    // Output the container with inline background image style.
                                    echo '<div class="container sticky-post-container" style="background-image: url(' . $image_url . ');">';
                                    ?>
                                        <div class="row" style="width: 80%;">
                                            <div class="sticky-post">
                                                <div class="sticky-post-content">
                                                    <div class="sticky-post-title"><?php the_title(); ?></div>
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                // Reset post data.
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                    </div>
                    <div>
                        <?php echo display_my_theme_banner_slider(); ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 bg-white" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); padding: 0;">
                    <?php if ( is_active_sidebar( 'positiva-sidebar' ) ) : ?>
                        <aside id="positiva-custom-sidebar" class="positiva-custom-sidebar">
                            <?php dynamic_sidebar( 'positiva-sidebar' ); ?>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </main><!-- #main -->

<?php
// Display vertical logo, services, and shortcodes options.
echo my_theme_display_custom_sidebar();

get_sidebar();
get_footer();