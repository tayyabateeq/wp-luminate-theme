<?php
 
/**
 * Register Custom Post Type Slider.
 *
 * @return void
 */
function create_slider_cpt() {
    $labels = array(
        'name'               => _x( 'Slider', 'Post Type General Name', 'luminate' ),
        'singular_name'      => _x( 'Slider', 'Post Type Singular Name', 'luminate' ),
        'menu_name'          => __( 'Slider', 'luminate' ),
        'all_items'          => __( 'All Slides', 'luminate' ),
        'view_item'          => __( 'View Slide', 'luminate' ),
        'add_new_item'       => __( 'Add New Slide', 'luminate' ),
        'add_new'            => __( 'Add New', 'luminate' ),
        'edit_item'          => __( 'Edit Slide', 'luminate' ),
        'update_item'        => __( 'Update Slide', 'luminate' ),
        'search_items'       => __( 'Search Slide', 'luminate' ),
        'not_found'          => __( 'Not Found', 'luminate' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'luminate' ),
    );
    $args = array(
        'label'               => __( 'Slider', 'luminate' ),
        'description'         => __( 'Custom post type for Slider', 'luminate' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'slider', $args );
}
add_action( 'init', 'create_slider_cpt', 0 );
 
/**
 * Add meta box for sub-title.
 *
 * @return void
 */
function add_sub_title_metabox() {
    add_meta_box(
        'sub_title_metabox',
        __( 'Sub Title', 'luminate' ),
        'sub_title_metabox_callback',
        'slider'
    );
}

add_action( 'add_meta_boxes', 'add_sub_title_metabox' );

/**
 * Callback function for sub-title meta box.
 *
 * @param  mixed $post
 * @return void
 */
function sub_title_metabox_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'sub_title_metabox_nonce' );
    $sub_title = get_post_meta( $post->ID, 'sub_title', true );
    ?>
    <p>
        <label for="sub_title"><?php esc_html_e( 'Sub Title:', 'luminate'); ?> </label>
    <br/>
    <input class="widefat" type="text" name="sub_title" id="sub_title" value="<?php echo esc_attr( $sub_title ); ?>" size="30" />
    </br/>
    <?php
}

/**
 * Save sub-title meta box data.
 *
 * @param  mixed $post_id gets post id from post.
 * @return void
 */
function save_sub_title_metabox_data( $post_id ) {
    if ( ! isset( $_POST['sub_title_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['sub_title_metabox_nonce'], basename( __FILE__ ) ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'slider' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['sub_title'] ) ) {
        return;
    }
    $sub_title = sanitize_text_field( $_POST['sub_title'] );
    update_post_meta( $post_id, 'sub_title', $sub_title );
}

add_action( 'save_post', 'save_sub_title_metabox_data' );

/**
 * Display custom post type slider posts.
 *
 * Display ten posts in a slider.
 * 
 * @return void
 */
function display_cpt_slider() {
    ?>
    <div class="slider-wrapper owl-carousel owl-theme">
        <?php
       // retrieve a single post with WP_Query
       $args = array(
           'post_type'      => 'slider',
           'posts_per_page' => 10,
       );
       $query = new WP_Query( $args );
       
       // check if the query has any posts
       if ( $query->have_posts() ) {
            // loop through the posts and display the slider
            while ( $query->have_posts() ) {
                // set up post data
                $query->the_post();
                // display the slider HTML code
               ?>	
                <div class="row item cpt-slider">
                    <div class="col-md-5 col-sm-6">
                        <div class="cpt-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6">
                        <div class="cpt-slider-caption">
                            <a href="<?php the_permalink(); ?>" class="cpt-title"><?php the_title(); ?></a>
                            <?php $sub_title = get_post_meta( get_the_ID(), 'sub_title', true );
                            if ( ! empty( $sub_title ) ) { ?>
                                    <h4 id="cpt-subtitle"><?php echo esc_html( $sub_title ); ?></h4>
                                <?php } ?>
                            <div class="slider-excerpt"><?php the_excerpt(); ?></div>
                            <button class="slider-cta btn">
                                <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'VER MÁS NOTICIAS', 'luminate' ); ?></a>
                            </button>
                        </div>
                    </div>
               </div>
               <?php
            }
           // reset the post data
           wp_reset_postdata();
        }
       ?>
    </div>
    <?php  
}

?>
