<?php

/**
 * Handle the load more events button ajax request. 
 *
 * @return void
 */
function load_more_events() {
    // Verify nonce for security.
    check_ajax_referer('load_more_events', 'security'); 
    $page = $_POST['page'];

    // Query the event posts
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => 3,
        'paged'          => $page,
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

    // check if the query has any posts
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            // set up post data
            $query->the_post();
            // Display the start and end dates
            $event_start_date = get_post_meta( get_the_ID(), '_event_date', true );
            $event_start_time = get_post_meta( get_the_ID(), '_event_start_time', true );
            $event_end_time   = get_post_meta( get_the_ID(), '_event_end_time', true );
            ?>
            <div class="row item cpt-event">
                <div class="col-md-4 col-sm-4">
                    <div class="cpt-event-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail( 'full' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="cpt-event-details">
                        <h2 class="cpt-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="cpt-event-date">
                            <?php echo date_i18n( 'F j, Y', strtotime( $event_start_date ) ); ?>
                        </div>
                        <div class="cpt-event-date">
                            <?php echo date_i18n( 'g:i A', strtotime( $event_start_time ) ); ?>
                            <?php echo "-"; ?>
                            <?php echo date_i18n( 'g:i A', strtotime( $event_end_time ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        // Reset the post data.
        wp_reset_postdata();
    } else {
        echo '<p>No events found.</p>';
    }
    wp_die();
}

add_action( 'wp_ajax_load_more_events', 'load_more_events' );
add_action( 'wp_ajax_nopriv_load_more_events', 'load_more_events' );

/**
 * Handle the load more all events button ajax request.
 *
 * @return void
 */
function load_more_all_events() {
    // Verify nonce for security.
    check_ajax_referer('load_more_all_events', 'security'); 
	$current_page = $_POST['page'];
	$all_args = array(
		'post_type'      => 'event',
		'posts_per_page' => 4,
		'paged'          => $current_page,
		'orderby'        => 'meta_value',
		'meta_key'       => '_event_date',
		'order'          => 'ASC',
	);
	
	$query = new WP_Query($all_args);

    // check if the query has any posts
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            // set up post data
            $query->the_post();
            // Display the start and end dates
            $event_start_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
            $event_end_time   = get_post_meta(get_the_ID(), '_event_end_time', true);
            ?>
            <div class="col-md-3 col-sm-12 cpt-event-item">
                <div class="row">
                    <div class="archive-event-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="archive-event-details">
                        <h2 class="archive-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="archive-event-date">
                            <?php echo date_i18n('F j, Y', strtotime($event_start_date)); ?>
                        </div>
                        <div class="archive-event-time">
                            <?php echo date_i18n('g:i A', strtotime($event_start_time)); ?>
                            <?php echo "-"; ?>
                            <?php echo date_i18n('g:i A', strtotime($event_end_time)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        // Reset the post data.
        wp_reset_postdata();
    } else {
        echo '<p>No events found.</p>';
    }
    wp_die(); // This is required to terminate the AJAX request properly.
    
}
add_action( 'wp_ajax_load_more_all_events', 'load_more_all_events' );
add_action( 'wp_ajax_nopriv_load_more_all_events', 'load_more_all_events' );

/**
 * Handle the load more upcoming events button ajax request.
 *
 * @return void
 */
function load_more_upcoming_events() {
    // Verify nonce for security.
    check_ajax_referer('load_more_upcoming_events', 'security'); 
	$current_page = $_POST['page'];
    $upcoming_args = array(
        'post_type'      => 'event',
        'posts_per_page' => 4,
        'paged'          => $current_page,
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
	$query = new WP_Query($upcoming_args);
    // check if the query has any posts
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            // set up post data
            $query->the_post();
            // Display the start and end dates
            $event_start_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
            $event_end_time   = get_post_meta(get_the_ID(), '_event_end_time', true);
            ?>
            <div class="col-md-3 col-sm-12 cpt-event-item">
                <div class="row">
                    <div class="archive-event-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="archive-event-details">
                        <h2 class="archive-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="archive-event-date">
                            <?php echo date_i18n('F j, Y', strtotime($event_start_date)); ?>
                        </div>
                        <div class="archive-event-time">
                            <?php echo date_i18n('g:i A', strtotime($event_start_time)); ?>
                            <?php echo "-"; ?>
                            <?php echo date_i18n('g:i A', strtotime($event_end_time)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        // Reset the post data.
        wp_reset_postdata();
    } else {
        echo '<p>No events found.</p>';
    }
    wp_die(); // This is required to terminate the AJAX request properly.
    
}
add_action( 'wp_ajax_load_more_upcoming_events', 'load_more_upcoming_events' );
add_action( 'wp_ajax_nopriv_load_more_upcoming_events', 'load_more_upcoming_events' );

/**
 * Handle the load more past events button ajax request.
 *
 * @return void
 */
function load_more_past_events() {
    // Verify nonce for security.
    check_ajax_referer('load_more_past_events', 'security'); 
	$current_page = $_POST['page'];
    // Query the past event posts
    $past_args = array(
        'post_type'      => 'event',
        'posts_per_page' => 4,
        'paged'          => $current_page,
        'meta_key'       => '_event_date',
        'orderby'        => 'meta_value',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_event_date',
                'value'   => date('Y-m-d'), // Current date
                'compare' => '<',
                'type'    => 'DATE',
            ),
        ),
    );
	
	$query = new WP_Query($past_args);

    // check if the query has any posts
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            // set up post data
            $query->the_post();
            // Display the start and end dates
            $event_start_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
            $event_end_time   = get_post_meta(get_the_ID(), '_event_end_time', true);
            ?>
            <div class="col-md-3 col-sm-12 cpt-event-item">
                <div class="row">
                    <div class="archive-event-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="archive-event-details">
                        <h2 class="archive-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="archive-event-date">
                            <?php echo date_i18n('F j, Y', strtotime($event_start_date)); ?>
                        </div>
                        <div class="archive-event-time">
                            <?php echo date_i18n('g:i A', strtotime($event_start_time)); ?>
                            <?php echo "-"; ?>
                            <?php echo date_i18n('g:i A', strtotime($event_end_time)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        // Reset the post data.
        wp_reset_postdata();
    } else {
        echo '<p>No events found.</p>';
    }
    wp_die(); // This is required to terminate the AJAX request properly.
    
}
add_action( 'wp_ajax_load_more_past_events', 'load_more_past_events' );
add_action( 'wp_ajax_nopriv_load_more_past_events', 'load_more_past_events' );