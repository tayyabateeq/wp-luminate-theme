<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Luminate
 */

get_header();
?>
<div class="container">
    <div class="row">
        <div class="filter-events">
            <label for="event-filter">FILTER BY</label>
            <select id="event-filter">
            <?php
             $event_filter = isset($_GET['event-filter']) ? $_GET['event-filter'] : 'all';
                $options = array(
                    'all'      => 'All Events',
                    'upcoming' => 'Upcoming Events',
                    'past'     => 'Past Events',
                );
                foreach ($options as $value => $label) {
                    $selected = ($event_filter === $value) ? 'selected="selected"' : '';
                    echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
                }
            ?>
            </select>
        </div>
    </div>
</div>
<div id="event-container">
    <?php
    if ($event_filter === 'upcoming') {
        $upcoming_args = array(
            'post_type'      => 'event',
            'posts_per_page' => 4,
            'paged'          => 1,
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

        $upcoming_query = new WP_Query( $upcoming_args );
        ?>
        <div class="container">
            <div class="row archive-events-heading">
                <h2>Upcoming Events</h2>
            </div>
            <?php
                display_positiva_cpt_events($upcoming_query);
            ?>
            <div class="row archive-event-pagination-buttons">
                <div class="col-md-6 col-sm-6" id="cpt-archive-event-show-less">
                    <button type="button" class="btn btn-sm" id="cpt-upcoming-event-show-less-button">
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                </div>
                <div class="col-md-6 col-sm-6" id="cpt-archive-event-load-more">
                    <button type="button" class="btn btn-sm" id="cpt-upcoming-event-load-more-button">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php
        wp_localize_script( 'cpt-upcoming-event-scripts', 'cptEvents',
            array( 
                'url' => admin_url( 'admin-ajax.php' ),
                'security' => wp_create_nonce('load_more_upcoming_events'),
                'maxPages' => $upcoming_query->max_num_pages,
            )
        );
    } else if ($event_filter === 'past') {
        // Query the past event posts
        $past_args = array(
            'post_type'      => 'event',
            'posts_per_page' => 4,
            'paged'          => 1,
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

        $past_query = new WP_Query($past_args);
        ?>
        <div class="container">
            <div class="row archive-events-heading">
                <h2>Past Events</h2>
            </div>
            <?php
                display_positiva_cpt_events( $past_query );
            ?>
            <div class="row archive-event-pagination-buttons">
                <div class="col-md-6 col-sm-6" id="cpt-archive-event-show-less">
                    <button type="button" class="btn btn-sm" id="cpt-past-event-show-less-button">
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                </div>
                <div class="col-md-6 col-sm-6" id="cpt-archive-event-load-more">
                    <button type="button" class="btn btn-sm" id="cpt-past-event-load-more-button">
                            Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php
        wp_localize_script( 'cpt-past-event-scripts', 'cptEvents',
            array( 
                'url' => admin_url( 'admin-ajax.php' ),
                'security' => wp_create_nonce('load_more_past_events'),
                'maxPages' => $past_query->max_num_pages,
            )
        );
    } else {
        $event_args = array(
            'post_type'      => 'event',
            'posts_per_page' => 4,
            'paged'          => 1,
            'orderby'        => 'meta_value',
            'meta_key'       => '_event_date',
            'order'          => 'ASC',
        );

        $event_query = new WP_Query($event_args);
        ?>
        <div class="container">
            <div class="row archive-events-heading">
                <h2>All Events</h2>
            </div>
            <?php
            display_positiva_cpt_events( $event_query );
            ?>
            <div class="row archive-event-pagination-buttons">
                    <div class="col-md-6 col-sm-6" id="cpt-archive-event-show-less">
                        <button type="button" class="btn btn-sm" id="cpt-all-event-show-less-button">
                            <i class="fas fa-chevron-left"></i> Previous
                        </button>
                    </div>
                    <div class="col-md-6 col-sm-6" id="cpt-archive-event-load-more">
                        <button type="button" class="btn btn-sm" id="cpt-all-event-load-more-button">
                            Next <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
        </div>
        <?php
        wp_localize_script( 'cpt-all-event-scripts', 'cptEvents',
            array( 
                'url' => admin_url( 'admin-ajax.php' ),
                'security' => wp_create_nonce('load_more_all_events'),
                'maxPages' => $event_query->max_num_pages,
            )
        );
    }
    ?>
</div>

<?php


get_sidebar();
get_footer();

?>
<script>
    var eventFilterDropdown = document.getElementById('event-filter');
    eventFilterDropdown.addEventListener('change', function() {
        var selectedFilter = this.value;
        var currentUrl = window.location.href;
        var baseUrl = currentUrl.split('?')[0];
        var updatedUrl = baseUrl + '?event-filter=' + selectedFilter;
        window.location.href = updatedUrl;
    });
</script>