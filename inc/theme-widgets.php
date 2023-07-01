<?php

/* ----------------------------------------------------------------
// Register Custom Widgets for Logo/Images and CPT Events
---------------------------------------------------------------- */

function custom_widget_init() {
    register_widget( 'Custom_Widget' );
    register_widget( 'CPT_Events_Widget' );
    register_widget( 'Positiva_Twitter_Widget' );
}
add_action( 'widgets_init', 'custom_widget_init' );

/**
 * Widget class for custom logos as HTML markup.
 */
class Custom_Widget extends WP_Widget {

    // Constructor
    function __construct() {
        parent::__construct(
            'custom_widget',
            __( 'Custom Widget', 'luminate' ),
            array( 'description' => __( 'A custom widget with logos.', 'luminate' ), )
        );
    }

    // Widget saved data output.
    public function widget( $args, $instance ) {
        ?>
        <div class='bg-white'>
            <div class="container">
                <div class="row widget-container">
                    <div class="col-md-3 col-sm-3">
                        <?php echo '<img src="' . $instance['logo_url1'] . '" class="logo1" alt="Logo 1">'; ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php echo '<img src="' . $instance['logo_url2'] . '" class="logo2" alt="Logo 2">'; ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php echo '<img src="' . $instance['logo_url3'] . '" class="logo3" alt="Logo 3">'; ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?php echo '<img src="' . $instance['logo_url4'] . '" class="logo4" alt="Logo 4">'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    // Widget HTML form for input four images.
    public function form( $instance ) {
        $logo_url1 = ! empty( $instance['logo_url1'] ) ? $instance['logo_url1'] : '';
        $logo_url2 = ! empty( $instance['logo_url2'] ) ? $instance['logo_url2'] : '';
        $logo_url3 = ! empty( $instance['logo_url3'] ) ? $instance['logo_url3'] : '';
        $logo_url4 = ! empty( $instance['logo_url4'] ) ? $instance['logo_url4'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'logo_url1' ); ?>">Logo 1 URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url1' ); ?>" name="<?php echo $this->get_field_name( 'logo_url1' ); ?>" type="text" value="<?php echo esc_attr( $logo_url1 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'logo_url2' ); ?>">Logo 2 URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url2' ); ?>" name="<?php echo $this->get_field_name( 'logo_url2' ); ?>" type="text" value="<?php echo esc_attr( $logo_url2 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'logo_url3' ); ?>">Logo 3 URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url3' ); ?>" name="<?php echo $this->get_field_name( 'logo_url3' ); ?>" type="text" value="<?php echo esc_attr( $logo_url3 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'logo_url4' ); ?>">Logo 4 URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url4' ); ?>" name="<?php echo $this->get_field_name( 'logo_url4' ); ?>" type="text" value="<?php echo esc_attr( $logo_url4 ); ?>">
        </p>
        <?php 
    }

    // Update the images data in the widget.
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['logo_url1'] = ( ! empty( $new_instance['logo_url1'] ) ) ? strip_tags( $new_instance['logo_url1'] ) : '';
        $instance['logo_url2'] = ( ! empty( $new_instance['logo_url2'] ) ) ? strip_tags( $new_instance['logo_url2'] ) : '';
        $instance['logo_url3'] = ( ! empty( $new_instance['logo_url3'] ) ) ? strip_tags( $new_instance['logo_url3'] ) : '';
        $instance['logo_url4'] = ( ! empty( $new_instance['logo_url4'] ) ) ? strip_tags( $new_instance['logo_url4'] ) : '';
        return $instance;
    }
}

/* ----------------------------------------------------------------
// Register CPT Events Widget
---------------------------------------------------------------- */
class CPT_Events_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'cpt_events_widget',
            __( 'CPT Events Widget', 'lumninate' ),
            array( 'description' => __( 'Displays events from a custom post type.', 'luminate' ) )
        );
    }

    // Widget output
    public function widget( $args, $instance ) {
        // Display the events using the display_cpt_events() function
        display_cpt_events();
    }
}

/* --------------------------------------------------------------------
// Positiva Twitter Widget class for display twitter posts with widget
-------------------------------------------------------------------- */
class Positiva_Twitter_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'positiva_twitter_posts',
            __( 'Twitter Widget', 'lumninate' ),
            array( 'description' => __( 'Displays specific user tweets', 'luminate' ) )
        );
    }

    // Widget output
    public function widget( $args, $instance ) {
        // Display the user tweets with display_user_tweets_post() function.
        display_user_tweets();
    }
}

?>
