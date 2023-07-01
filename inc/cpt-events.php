<?php

/**
 * Register custom post type events.
 *
 * @return void
 */
function create_event_post_type() {
    $args = array(
        'public'              => true,
        'label'               => 'Events',
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_rest'        => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite'             => array( 'slug' => 'event' ), // add this line to set the permalink structure.
    );
    register_post_type( 'event', $args );
}
add_action( 'init', 'create_event_post_type' );

/**
 * Add meta box for event date, start and end time.
 *
 * @return void
 */
function event_date_meta_box() {
    add_meta_box(
        'event_date',
        'Event Dates',
        'event_date_meta_box_callback',
        'event',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'event_date_meta_box' );

/**
 * Callback function to display custom fields in the meta box.
 *
 * @param  mixed $post
 * @return void
 */
function event_date_meta_box_callback( $post ) {
    wp_nonce_field( 'event_date_meta_box', 'event_date_meta_box_nonce' );

    // Retrieve current values for event date, start and end time
    $event_date       = get_post_meta( $post->ID, '_event_date', true );
    $event_start_time = get_post_meta( $post->ID, '_event_start_time', true );
    $event_end_time   = get_post_meta( $post->ID, '_event_end_time', true );

    // Display custom fields for event date, start and end time
    ?>
    <p>
        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr( $event_date ); ?>">
    </p>
    <p>
        <label for="event_start_time">Start Time:</label><br>
        <input type="time" id="event_start_time" name="event_start_time" value="<?php echo esc_attr( $event_start_time ); ?>">
    </p>
    <p>
        <label for="event_end_time">End Time:</label><br>
        <input type="time" id="event_end_time" name="event_end_time" value="<?php echo esc_attr( $event_end_time ); ?>">
    </p>
    <?php
}

/**
 * Save custom fields data when post is saved.
 *
 * @param  mixed $post_id
 * @return void
 */
function save_event_date_meta_box_data( $post_id ) {
    // Verify nonce.
    if ( ! isset( $_POST['event_date_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['event_date_meta_box_nonce'], 'event_date_meta_box' ) ) {
        return;
    }
    // Save start time data.
    if ( isset( $_POST['event_start_time'] ) ) {
        update_post_meta( $post_id, '_event_start_time', sanitize_text_field( $_POST['event_start_time'] ) );
    }
    // Save end time data.
    if ( isset( $_POST['event_end_time'] ) ) {
        update_post_meta( $post_id, '_event_end_time', sanitize_text_field( $_POST['event_end_time'] ) );
    }
    // Save date data.
    if ( isset( $_POST['event_date'] ) ) {
        update_post_meta( $post_id, '_event_date', sanitize_text_field( $_POST['event_date'] ) );
    }
}

add_action( 'save_post_event', 'save_event_date_meta_box_data' );

/**
 * Display custom post type events posts.
 *
 * @return void
 */
function display_cpt_events() {
    echo '<div class="cpt-event-header">';
    $post_type_object = get_post_type_object('event');
    if ($post_type_object) {
        $post_type_label = $post_type_object->labels->name;
        echo $post_type_label;
    }
    echo '</div>';
    // Query the event posts
    $args = array(
       'post_type'      => 'event',
       'posts_per_page' => 3, // Display 3 event posts
       'paged'          => 1, // Show the first page of results
       'orderby'        => '_event_date',
       'order'          => 'ASC',
       'meta_query'     => array(
            array(
                'key'     => '_event_date',
                'value'   => date('Y-m-d'), // Current date
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    );
    $query = new WP_Query($args);
    display_positiva_events( $query );
    wp_localize_script( 'cpt-event-scripts', 'cptEvents',
        array( 
            'url' => admin_url( 'admin-ajax.php' ),
            'security' => wp_create_nonce('load_more_events'),
            'maxPages' => $query->max_num_pages,
        )
    );
    
}


?>
 