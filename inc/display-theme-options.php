<?php

/**
 * Display top notifications at top of the page.
 * 
 * Display notification message, current date, secondary menu and user profile.
 *
 * @return void
 */

function my_theme_display_top_notification() {

    // your code to display the notification here
    $options = get_option('my_theme_options_top_notification');
    if ( isset( $options['notifications_enabled'] ) && $options['notifications_enabled'] ) {

        // Get current date in the format: Week Day, Day Month Year.
        $date = date('l, j F Y');

        // Get the notification text from the options.
        $notification_date = isset($options['notifications']) ? esc_html($options['notifications']) : '';
        
        // Append the date to the notification text.
        $notification_date = $date;
        ?>
        <div class="top-container">
        <div class="container">
            <div class="row top-notification">
                <div class="col-md-2 col-sm-2 notification-message">
                    <?php          
                    if ( isset($options['notification_message']) && !empty($options['notification_message']) ) {
                        $message = esc_html($options['notification_message']);
                        echo $message;
                    }
                    ?>
                </div>
                <div class="col-md-3 col-sm-3 notification-date">
                    <?php echo $notification_date; ?>
                </div>
                <div class="col-md-3 col-sm-3 secondary-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'secondary-menu',
                        'menu_class' => 'secondary-menu-list',
                        'container' => '',
                        'fallback_cb' => '',
                        'walker' => new Custom_Walker_Nav_Menu()
                    ) );
                    ?>
                </div>
                <div class="col-md-3 col-sm-3 login-profile">
                    <?php
                    if ( is_user_logged_in() ) {
                        $current_user = wp_get_current_user();
                        echo '<span class="username">' . esc_html( $current_user->display_name ) . '</span>';
                        echo wp_loginout( home_url(), false );
                    } else {
                        echo wp_loginout( home_url(), false );
                        ?><i class="fas fa-user-circle" style="margin-left: 5px;"></i><?php
                    }
                    ?>
                </div>
                <div class="col-md-1 col-sm-1 close-notification">
                    <button class="btn btn-sm cancel-notification">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
}
add_action( 'wp_body_open', 'my_theme_display_top_notification', 5 );

/**
 * Display header images option data in header section with logo.
 *
 * @return void
 */
function my_theme_display_header_images() {
    $options = get_option('my_theme_options');
    ?>
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <?php
            if ( isset( $options['header_image_1'] ) && !empty( $options['header_image_1'] ) ) {
                echo '<img id="custom-header-image-1" src="' . esc_attr( $options['header_image_1'] ) . '" alt="Header Image 1">';
            }
            ?>
        </div>
        <div class="col-md-5 col-sm-5">
            <?php
            if ( isset( $options['header_image_2'] ) && !empty( $options['header_image_2'] ) ) {
                echo '<img id="custom-header-image-2" src="' . esc_attr( $options['header_image_2'] ) . '" alt="Header Image 2">';
            }
            ?>
        </div>
    </div>
	<?php
	
}


/**
 * Display saved images from images slider theme option.
 *
 * @return void
 */
function my_theme_display_images_slider() {
    $options = get_option( 'my_theme_options_images_slider' );
    $sliders = isset( $options['images_slider'] ) ? $options['images_slider'] : array();

    if ( ! empty( $sliders ) ) {
        ?>
        <div class="container-fluid">
            <div class='row' id="my-images-slider">
                <div class="col-md-12 col-sm-12 slider">
                    <?php
                    foreach ( $sliders as $slider ) {
                        $slider_image = isset( $slider['slider_image'] ) ? esc_attr( $slider['slider_image'] ) : '';
                        $slider_title = isset( $slider['slider_title'] ) ? $slider['slider_title'] : '';
                        $slider_textarea = isset( $slider['slider_textarea'] ) ? $slider['slider_textarea'] : '';
                        ?>
                        <div class="slider-item">
                            <div class="slider-image">
                                <img src="<?php echo $slider_image; ?>">
                            </div>
                            <div class="container images-slider-content">
                                <p class="slider-text"><?php echo $slider_textarea; ?></p>
                                <h4 class="slider-title"><?php echo $slider_title; ?></h4>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Display selected special page links from theme options. 
 *
 * @return void
 */
function my_theme_display_special_pages_links() {
    $options = get_option('my_theme_options_page_links');
    if ($options && isset($options['pages'])) {
        echo "<div class='container'>";
        echo "<div class='row' id='special-pages' style='justify-content: center;'>";
        foreach ($options['pages'] as $page) {
            // check if id field is set and not empty.
            if (isset($page['id']) && !empty($page['id'])) {
                $page_data = get_post($page['id']);
                if ($page_data) {
                    echo '<div class="col-md-3 col-sm-12 special-page-link">';
                    echo '<a href="' . get_permalink($page_data->ID) . '">';
                    if (isset($page['image']) && !empty($page['image'])) {
                        echo '<img src="' . esc_attr($page['image']) . '" alt="' . esc_attr($page_data->post_title) . '" />';
                    } else {
                        echo $page_data->post_title;
                    }
                    // display the page title below the icon.
                    echo '<br />' . $page_data->post_title; 
                    echo '<div class="hover-content">';
                    if (isset($page['text']) && !empty($page['text'])) {
                        // Add new <div> for hover content.
                        echo '<div class="hover-text">' . $page['text'] . '</div>';
                    }
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            }
        }
        echo '</div>';
        echo '</div>';
        ?>
        <?php
    }
}
function my_theme_display_gravity_forms() {
    ?>
    <div class="nav-tab-wrapper">
		<span class="nav-tab active" data-tab="red-asistencial">Red Asistencial</span>
		<span class="nav-tab" data-tab="punto-de-atencion">Punto de Atención</span>
	</div>
	<div class="tab-content">
		<div class="tab-pane active" id="red-asistencial">
			<form action="" method="post">
				<?php echo do_shortcode('[gravityform id="2" title="true"]'); ?>
			</form>
		</div>
        <div class="tab-pane" id="punto-de-atencion">
            <form action="" method="post">
                <?php echo do_shortcode('[gravityform id="4" title="true"]'); ?>
            </form>
        </div>
	</div>
    <?php
}

/**
 * Display positiva cpt events.
 *
 * @param  mixed $query from wp query with arguments.
 * @return void
 */
function display_positiva_events( $query ) {
    if ($query->have_posts()) {
        ?>
        <div id="cpt-event-container">
            <?php
            // loop through the posts and display each post.
            while ($query->have_posts()) {
                // set up post data.
                $query->the_post();
                // Display the start and end time with date.
                $event_start_date = get_post_meta(get_the_ID(), '_event_date', true);
                $event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
                $event_end_time   = get_post_meta(get_the_ID(), '_event_end_time', true);
                ?>
                <div class="row item cpt-event">
                    <div class="col-md-4 col-sm-4">
                        <div class="cpt-event-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="cpt-event-details">
                            <h2 class="cpt-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="cpt-event-date">
                                <?php echo date_i18n('F j, Y', strtotime($event_start_date)); ?>
                            </div>
                            <div class="cpt-event-date">
                                <?php echo date_i18n('g:i A', strtotime($event_start_time)); ?>
                                <?php echo "-"; ?>
                                <?php echo date_i18n('g:i A', strtotime($event_end_time)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            // Reset post data.
            wp_reset_postdata();
            ?>
        </div>
        <div class="events-ajax-paginations">
            <div id="cpt-event-show-less">
                <button type="button" class="btn btn-sm" id="cpt-event-show-less-button">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
            </div>
            <div id="cpt-event-load-more">
                <button type="button" class="btn btn-sm" id="cpt-event-load-more-button">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div id="cpt-event-more-events">
                <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">More Events</a>
            </div>
        </div>
        <?php
    } else {
        echo 'No events found.';
    }
}
/**
 * Display banner slider option saved data.
 * 
 * Data will be displayed in slider form using jquery slider.
 *
 * @return void
 */
function display_my_theme_banner_slider(){
    // Updated option name.
    $options = get_option( 'my_theme_options_banner_slider' );
    $banner_sliders = isset( $options['banner_slider'] ) ? $options['banner_slider'] : array();
    ?>
    <div class="banner-slider-container">
    <?php
        if ( ! empty( $banner_sliders ) ) {
            ?>
            <div class="banner-slider-text owl-carousel owl-loaded owl-drag">
                <?php
                foreach ( $banner_sliders as $banner_slider ) {
                    $banner_slider_textarea = isset( $banner_slider['banner_slider_textarea'] ) ? $banner_slider['banner_slider_textarea'] : '';
                    ?>
                    <div class="slider-text-banner">
                        <p><?php echo $banner_slider_textarea; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-6 col-md-6" id="banner-image-1">
            <?php
            if ( isset( $options['banner_slider_image_1'] ) && !empty( $options['banner_slider_image_1'] ) ) {
                echo '<img id="banner-slider-image-1" src="' . esc_attr( $options['banner_slider_image_1'] ) . '" alt="Banner Slider Image 1">';
            }
            ?>
        </div>
        <div class="col-md-6 col-md-6" id="banner-image-2">
            <?php
            if ( isset( $options['banner_slider_image_2'] ) && !empty( $options['banner_slider_image_2'] ) ) {
                echo '<img id="banner-slider-image-2" src="' . esc_attr( $options['banner_slider_image_2'] ) . '" alt="Banner Slider Image 2">';
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Display current date in calender text field.
 * 
 * Display the calender using JQuery.
 *
 * @return void
 */
function custom_calendar() {
    ?>
    <div class="row calender" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-md-12 col-sm-12 bg-orange calender-title">
            <h2> Calender </h2>
        </div>
        <div class="col-md-12 col-sm-12 calender-date-field">
            <input type="text" id="date-picker" placeholder="<?php echo date('F j, Y'); ?>">
            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
        </div>
    </div>
    <?php
}

/**
 * Display tweets of specific users.
 *
 * @return void
 */
function display_user_tweets(){
    ?>
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-md-12 col-sm-12 tweet-container" style="height: 300px; overflow: auto; margin-top: 15px;">
            <?php
            if ( isset( $_GET['username'] ) && !empty( $_GET['username'] ) ) {
                $username = $_GET['username'];

                // Generate oEmbed URL for the user's timeline
                $oembed_url = 'https://publish.twitter.com/oembed?url=https://twitter.com/' . $username;

                // Make request to oEmbed API
                $response = file_get_contents($oembed_url);

                // Decode response JSON
                $json = json_decode($response, true);

                // Check for errors
                if (isset($json['html'])) {
                    echo $json['html'];
                } else {
                    echo 'Error retrieving tweets';
                }
            }
            ?>
        </div>
    </div>
    <div class="row" style="margin-top: 5px; padding-right: 15px; padding-left: 15px;">
        <div class="col-md-12 col-sm-12 input-group mb-3 bg-light" style="margin-top: 15px;">
            <input type="text" class="form-control" id="username" placeholder="Twitter Username" aria-label="Twitter username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-info" type="button" id="submit-button" onclick="window.location.href='?username=' + document.getElementById('username').value">@</button>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display vertical logo, services and shortcodes options data.
 *
 * @return void
 */
function my_theme_display_custom_sidebar(){
    ?>
    <div class='container-fluid'>
        <div class='row custom-sidebar'>
            <?php
            $options = get_option('my_theme_options_vertical_logo');
            if ( isset( $options['vertical_logo'] ) && !empty ( $options['vertical_logo'] ) ) {
                echo '<div class="col-md-2 col-sm-12 vertical-logo">';
                echo '<img id="custom-vertical-image" src="' . esc_attr($options['vertical_logo']) . '" alt="Vertical Image">';
                echo '</div>';
            }
            $options = get_option( 'my_theme_options_services' );
            $services = isset( $options['services'] ) ? $options['services'] : array();
            echo '<div class="col-md-5 col-sm-12 services">';
            if ( ! empty( $services ) ) {
                foreach ( $services as $index => $service ) {
                    $services_title = isset( $service['services_title'] ) ? $service['services_title'] : '';
                    $services_image = isset( $service['services_image'] ) ? esc_attr( $service['services_image'] ) : '';
                    ?>
                    <div class="col-md-4 col-sm-12 service-item">
                        <div class="service-image">
                            <img src="<?php echo $services_image; ?>">
                        </div>
                        <h6 class="service-title"><?php echo $services_title; ?></h6>
                    </div>
                    <?php
                }
            }
            echo '</div>';
            ?>
            <div class="col-md-5 col-sm-12 sidebar-shortcodes">
                <div class="phone-shortcode">
                    <div class="phone-img">
                        <?php echo do_shortcode('[wpb-image src="/wp-content/uploads/2023/04/Color-Overlay-4.png" alt="group"]'); ?>
                    </div>
                    <div class="phone-det">
                        <?php echo do_shortcode('[wpb-phone tel="01-8000-111-170" title="Líneas de atención Comunicate a nivel nacional"]'); ?>
                    </div>
                </div>
                <div class="location-shortcode">
                    <div class="location-img">
                        <?php echo do_shortcode('[wpb-image src="/wp-content/uploads/2023/04/Color-Overlay-5.png" alt="group"]'); ?>
                    </div>
                    <div class="location-det">
                        <?php echo do_shortcode('[wpb-location title="Puntos de Atención" url="Ubica el punto de atención más cercano"]'); ?>
                    </div>
                </div>
                <div class="group-shortcode">
                    <div class="group-img">
                        <?php echo do_shortcode('[wpb-image src="/wp-content/uploads/2023/04/Frame-1-1.png" alt="group"]'); ?>
                    </div>
                    <div class="group-det">
                        <?php echo do_shortcode('[wpb-group title="Directorio de Funcionarios"]'); ?>
                    </div>
                </div>
                <div class="contact-shortcode">
                    <div class="contact-img">
                        <?php echo do_shortcode('[wpb-image src="/wp-content/uploads/2023/04/Vector-1.png" alt="group"]'); ?>
                    </div>
                    <div class="contact-det">
                        <?php echo do_shortcode('[wpb-contact title="Línea Ética Presenta aquí tu caso de fraude o corrupción" tel="01-8000-112-870" email1="servicioalcliente@positiva.gov.co" email2="notijicacionesjudiciales@popositiva.gov.co"]'); ?>
                    </div>	
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display footer disclaimer message and image above footer area.
 *
 * @return void
 */
function my_theme_disclaimer_notification() {
    $options = get_option( 'my_theme_options_footer' );
    $disclaimer = isset( $options['disclaimer_notification'] ) ? $options['disclaimer_notification'] : '';
    $image = isset( $options['footer_image'] ) ? $options['footer_image'] : '';
    ?>
    <div class="container-fluid disclaimer">
        <div class="container">
            <div class="row disclaimer-notification">
                <?php
                if ( $disclaimer || $image ) {
                    echo '<div class="col-md-8 col-sm-12">';
                    if ( $disclaimer ) {
                        echo '<p>' . wp_kses_post( $disclaimer ) . '</p>';
                    }
                    echo '</div>';
                    echo '<div class="col-md-4 col-sm-12">';
                    if ( $image ) {
                        echo '<img src="' . esc_attr( $image ) . '" alt="' . esc_attr__( 'Disclaimer Notification Image', 'my_theme' ) . '">';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'my_theme_disclaimer_notification' );

?>
