<?php

/**
 * Shortcode for phone links.
 *
 * @param  mixed $atts
 * @return void
 */
function wpb_phone_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'tel' => '',
        'title' => '',
    ), $atts, 'wpb-phone' );

    $output = '';
    if ( ! empty( $atts['title'] ) ) {
        $output .= '<p class="phone-title">' . esc_html( $atts['title'] ) . '</p>';
    }
    if ( ! empty( $atts['tel'] ) ) {
        $output .= '<p><a href="tel:' . esc_attr( $atts['tel'] ) . '">' . esc_html( $atts['tel'] ) . '</a></p>';
    }

    return $output;
}

add_shortcode( 'wpb-phone', 'wpb_phone_shortcode' );

/**
 * Shortcode for location links.
 *
 * @param  mixed $atts
 * @return void
 */
function wpb_location_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => '',
        'url' => '',
    ), $atts );
    $output = '';
    if ( ! empty( $atts['title'] ) ) {
        $output .= '<p class="location-title">' . esc_html( $atts['title'] ) . '</p>';
    }
    if ( ! empty( $atts['url'] ) ) {
        $output .= '<p class="location-url">' . esc_html( $atts['url'] ) . '</p>';
    }

    return $output;
}

add_shortcode( 'wpb-location', 'wpb_location_shortcode' );

/**
 * Shortcode for group links.
 *
 * @param  mixed $atts
 * @return void
 */
function wpb_group_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => '',
    ), $atts );
    $output = '';
    $output .= '<p class="group-title">' . esc_html( $atts['title'] ) . '</p>';
    return $output;
}

add_shortcode( 'wpb-group', 'wpb_group_shortcode' );

function wpb_image_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'src' => '',
        'alt' => '',
    ), $atts );
    return '<img src="' . esc_url( $atts['src'] ) . '" alt="' . esc_attr( $atts['alt'] ) . '">';
}

add_shortcode( 'wpb-image', 'wpb_image_shortcode' );

/**
 * Shortcode for contact links.
 *
 * @param  mixed $atts
 * @return void
 */
function wpb_contact_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => '',
        'tel' => '',
        'email1' => '',
        'email2' => '',
    ), $atts );
    $html = '<p class="contact-title">' . esc_html( $atts['title'] ) . '</p>';
    if ( $atts['tel'] ) {
        $html .= '<p class="contact-tel"><a href="tel:' . esc_attr( $atts['tel'] ) . '">' . esc_html( $atts['tel'] ) . '</a></p>';
    }
    if ( $atts['email1'] ) {
        $html .= '<p class="email-icon"><a href="mailto:' . esc_attr( $atts['email1'] ) . '">' . esc_html( $atts['email1'] ) . '</a></p>';
    }
    if ( $atts['email2'] ) {
        $html .= '<p class="email-icon"><a href="mailto:' . esc_attr( $atts['email2'] ) . '">' . esc_html( $atts['email2'] ) . '</a></p>';
    }
    return $html;
}

add_shortcode( 'wpb-contact', 'wpb_contact_shortcode' );

/**
 * Shortcode function for display user tweets.
 *
 * @return void
 */
function display_positiva_user_tweets_shortcode() {
    // Start output buffering
    ob_start();

    display_user_tweets_post();

    // Get the buffered output and clean the buffer
    $output = ob_get_clean(); 

    // Return the function output
    return $output;
}
add_shortcode( 'display_positiva_user_tweets', 'display_positiva_user_tweets_shortcode' );

/**
 * Shortcode function for display calender.
 *
 * @return void
 */
function display_positiva_calendar_shortcode() {
    // Start output buffering
    ob_start();

    // Call custom calendar function
    custom_calendar();

    // Get the buffered output and clean the buffer
    $output = ob_get_clean();

    // Return the function output
    return $output;
}
add_shortcode( 'display_positiva_calendar', 'display_positiva_calendar_shortcode' );

/**
 * Shortcode function for displaying gravity forms.
 *
 * @return void
 */
function display_positiva_gravity_forms_shortcode() {
    // Start output buffering
    ob_start();

    // Call gravity forms function
    my_theme_display_gravity_forms();

    // Get the buffered output and clean the buffer
    $output = ob_get_clean();

    // Return the function output
    return $output;
}
add_shortcode( 'display_positiva_gravity_forms', 'display_positiva_gravity_forms_shortcode' );

?>
