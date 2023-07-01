<?php

/**
 * Create the theme options menu page.
 *
 * @return void
 */
function my_theme_options_page() {
	add_menu_page(
		'Theme Options',
		'Theme Options',
		'manage_options',
		'theme-options',
		'my_theme_options_callback'
	);
}
add_action('admin_menu', 'my_theme_options_page');

/**
 * Output HTML for Theme Options page with navigation tabs.
 *
 * @return void
 */
function my_theme_options_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header'; ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=theme-options&tab=top-notifications" class="nav-tab <?php echo $active_tab == 'top-notifications' ? 'nav-tab-active' : ''; ?>">Top Notifications</a>
            <a href="?page=theme-options&tab=header" class="nav-tab <?php echo $active_tab == 'header' ? 'nav-tab-active' : ''; ?>">Header Section</a>
            <a href="?page=theme-options&tab=images-slider" class="nav-tab <?php echo $active_tab == 'images-slider' ? 'nav-tab-active' : ''; ?>">Images Slider</a>
            <a href="?page=theme-options&tab=page-links" class="nav-tab <?php echo $active_tab == 'page-links' ? 'nav-tab-active' : ''; ?>">Special Page Links</a>
            <a href="?page=theme-options&tab=banner-slider" class="nav-tab <?php echo $active_tab == 'banner-slider' ? 'nav-tab-active' : ''; ?>">Banner Slider</a>
            <a href="?page=theme-options&tab=vertical-logo" class="nav-tab <?php echo $active_tab == 'vertical-logo' ? 'nav-tab-active' : ''; ?>">Vertical Logo</a>
            <a href="?page=theme-options&tab=services" class="nav-tab <?php echo $active_tab == 'services' ? 'nav-tab-active' : ''; ?>">The Services</a>
            <a href="?page=theme-options&tab=footer" class="nav-tab <?php echo $active_tab == 'footer' ? 'nav-tab-active' : ''; ?>">Footer Section</a>
            
        </h2>
        <form action="options.php" method="post">
            <?php
            // Display success message and close button
            if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
                ?>
                <div id="message" class="updated notice is-dismissible">
                    <p><?php _e( 'Settings saved successfully!', 'luminate' ); ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text"><?php _e( 'Dismiss this notice', 'luminate' ); ?></span>
                    </button>
                </div>
                <script>
                    // Close the success message on button click
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelector('.notice-dismiss').addEventListener('click', function() {
                            document.getElementById('message').remove();
                        });
                    });
                </script>
                <?php
            }
            // Conditions for navigation tabs.
            if ( $active_tab == 'top-notifications' ) {
                settings_fields( 'my_theme_options_top_notification' );
                do_settings_sections( 'my_theme_options_top_notification' );
                submit_button();
            } else if ( $active_tab == 'header' ) {
                settings_fields( 'my_theme_options' );
                do_settings_sections( 'my_theme_options' );
                submit_button();
            } else if ( $active_tab == 'images-slider' ) {
                settings_fields( 'my_theme_options_images_slider' );
                do_settings_sections( 'my_theme_options_images_slider' );
                submit_button();
            } else if ( $active_tab == 'page-links' ) {
                settings_fields( 'my_theme_options_page_links' );
                do_settings_sections( 'my_theme_options_page_links' );
                submit_button();
            } else if ( $active_tab == 'banner-slider' ) {
                settings_fields( 'my_theme_options_banner_slider' );
                do_settings_sections( 'my_theme_options_banner_slider' );
                submit_button();
            } else if ( $active_tab == 'vertical-logo' ) {
                settings_fields( 'my_theme_options_vertical_logo' );
                do_settings_sections( 'my_theme_options_vertical_logo' );
                submit_button();
            } else if ( $active_tab == 'services' ) {
                settings_fields( 'my_theme_options_services' );
                do_settings_sections( 'my_theme_options_services' );
                submit_button();
            } else if ( $active_tab == 'footer' ) {
                settings_fields( 'my_theme_options_footer' );
                do_settings_sections( 'my_theme_options_footer' );
                submit_button();
            }
            ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue media scripts.
 *
 * @return void
 */
function my_theme_enqueue_media() {
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'my_theme_enqueue_media');

/**
 * Register the settings for the theme options page.
 *
 * @return void
 */
function register_theme_options_settings() {

    // Register top notifications theme option settings.
	register_setting(
        'my_theme_options_top_notification',
        'my_theme_options_top_notification'
    );
   
    add_settings_section(
        'my_theme_manage_notifications',
        'Manage Top Notifications',
        'my_theme_manage_notifications_callback',
        'my_theme_options_top_notification'
    );

    add_settings_field(
        'my_theme_top_notifications',
        'Top Notifications',
        'my_theme_top_notifications_callback',
        'my_theme_options_top_notification',
        'my_theme_manage_notifications'
    );

    // Register header section theme option settings.
    register_setting(
        'my_theme_options',
        'my_theme_options'
    );
   
    add_settings_section(
        'my_theme_header_section',
        'Header Options',
        'my_theme_header_section_callback',
        'my_theme_options'
    );

    add_settings_field(
        'my_theme_header_image',
        'Header Image',
        'my_theme_header_image_callback',
        'my_theme_options',
        'my_theme_header_section'
    );

    // Register images slider theme option settings.
    register_setting(
        'my_theme_options_images_slider', // option group
        'my_theme_options_images_slider' // option name
      );

    add_settings_section(
      'my_theme_images_slider_section', // id
      'Images Slider Section', // title
      'my_theme_images_slider_section_callback', // callable
      'my_theme_options_images_slider' // page
    );
  
    add_settings_field(
      'my_theme_images_slider', //id
      'Images Slider', // title
      'my_theme_images_slider_callback', // callable
      'my_theme_options_images_slider', // page
      'my_theme_images_slider_section' // settings section
    );

    // Register special page links theme option settings.
    register_setting(
        'my_theme_options_page_links',
        'my_theme_options_page_links'
    );
   
    add_settings_section(
        'my_theme_page_links',
        'Special Page Links Section',
        'my_theme_page_links_callback',
        'my_theme_options_page_links'
    );

    add_settings_field(
        'my_theme_special_page_links',
        'Manage Special Page Links',
        'my_theme_special_page_links_callback',
        'my_theme_options_page_links',
        'my_theme_page_links'
    );

    // Register banner slider theme option settings.
    register_setting(
        'my_theme_options_banner_slider', // option group
        'my_theme_options_banner_slider' // option name
    );

    add_settings_section(
      'my_theme_banner_section', // id
      'Banner Section', // title
      'my_theme_banner_section_callback', // callable
      'my_theme_options_banner_slider' // page
    );
  
    add_settings_field(
      'my_theme_banner_slider', //id
      'Banner Slider', // title
      'my_theme_banner_slider_callback', // callable
      'my_theme_options_banner_slider', // page
      'my_theme_banner_section' // settings section
    );

    // Register vertical logo theme option settings.
    register_setting(
        'my_theme_options_vertical_logo',
        'my_theme_options_vertical_logo'
    );
   
    add_settings_section(
        'my_theme_vertical_section',
        'Vertical Logo Option',
        'my_theme_vertical_section_callback',
        'my_theme_options_vertical_logo'
    );

    add_settings_field(
        'my_theme_vertical_logo',
        'Vertical Logo',
        'my_theme_vertical_logo_callback',
        'my_theme_options_vertical_logo',
        'my_theme_vertical_section'
    );

    // Register the services theme option settings.
    register_setting(
        'my_theme_options_services', // option group
        'my_theme_options_services' // option name
      );

    add_settings_section(
      'my_theme_services_section', // id
      'Service Section', // title
      'my_theme_services_section_callback', // callable
      'my_theme_options_services' // page
    );
  
    add_settings_field(
      'my_theme_the_services', //id
      'The Services', // title
      'my_theme_the_services_callback', // callable
      'my_theme_options_services', // page
      'my_theme_services_section' // settings section
    );

    // Register footer section theme option settings.
    register_setting(
        'my_theme_options_footer',
        'my_theme_options_footer'
    );

    add_settings_section(
        'my_theme_footer_section',
        'Footer Options',
        'my_theme_footer_section_callback',
        'my_theme_options_footer'
    );

    add_settings_field(
        'my_theme_disclaimer_notification',
        'Disclaimer Notification',
        'my_theme_disclaimer_notification_callback',
        'my_theme_options_footer',
        'my_theme_footer_section'
    );

    add_settings_field(
        'my_theme_footer_image',
        'Footer Image',
        'my_theme_footer_image_callback',
        'my_theme_options_footer',
        'my_theme_footer_section'
    );
}
add_action('admin_init', 'register_theme_options_settings');

/**
 * Top notifications settings section description.
 *
 * @return void
 */
function my_theme_manage_notifications_callback(){
    echo 'Manage your top notifications below:';
}

/**
 * Display input text field for top notification message.
 *
 * @return void
 */
function my_theme_top_notifications_callback(){
    $options = get_option('my_theme_options_top_notification');
    $notifications_enabled = isset($options['notifications_enabled']) ? $options['notifications_enabled'] : 0;

    // Add the checkbox to enable/disable the top notification
    echo '<input type="checkbox" id="my_theme_notifications_enabled" name="my_theme_options_top_notification[notifications_enabled]" value="1" ' . checked(1, $notifications_enabled, false) . ' />';
    echo '<label for="my_theme_notifications_enabled">Enable Top Notification</label><br><br>';
    if ($notifications_enabled) {
        // Show the message text field
        echo '<b>Notification Message: </b>';
        $message = isset($options['notification_message']) ? esc_attr($options['notification_message']) : '';
        echo '<input type="text" id="my_theme_notification_message" name="my_theme_options_top_notification[notification_message]" value="' . $message . '" placeholder="Notification Text Here!"/><br>';
    }
}

/**
 * Header settings section description.
 *
 * @return void
 */
function my_theme_header_section_callback() {
    echo 'Choose your header options below:';
}

/**
 * Header image settings field callback function.
 * 
 * Display two input fields and set images for header images.
 *
 * @return void
 */
function my_theme_header_image_callback() {
    $options = get_option('my_theme_options');
    $header_image_1 = isset($options['header_image_1']) ? esc_attr($options['header_image_1']) : '';
    $header_image_2 = isset($options['header_image_2']) ? esc_attr($options['header_image_2']) : '';
    ?>
    <label for="header-image-1">Header Image 1:</label>
    <input type="text" id="header-image-1" name="my_theme_options[header_image_1]" value="<?php echo esc_url($header_image_1); ?>">
    <button class="button" id="header-image-upload-1">Upload Image</button>
    <?php if (!empty($header_image_1)) : ?>
        <button class="button" id="header-image-remove-1">Remove Image</button>
        <div class="header-preview" style="background-image: url(<?php echo $header_image_1; ?>);"></div>
    <?php endif; ?>
    <br><br>
    <label for="header-image-2">Header Image 2:</label>
    <input type="text" id="header-image-2" name="my_theme_options[header_image_2]" value="<?php echo esc_url($header_image_2); ?>">
    <button class="button" id="header-image-upload-2">Upload Image</button>
    <?php if (!empty($header_image_2)) : ?>
        <button class="button" id="header-image-remove-2">Remove Image</button>
        <div class="header-preview" style="background-image: url(<?php echo $header_image_2; ?>);"></div>
    <?php endif; ?>
    <script>
    jQuery(document).ready(function($) {
        $('#header-image-upload-1').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options[header_image_1]"]').val(image_url);
                $('.header-preview').css('background-image', 'url(' + image_url + ')');
            });
        });

        $('#header-image-remove-1').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options[header_image_1]"]').val('');
            $('.header-preview').css('background-image', 'none');
        });

        $('#header-image-upload-2').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options[header_image_2]"]').val(image_url);
                $('.header-preview').css('background-image', 'url(' + image_url + ')');
            });
        });

        $('#header-image-remove-2').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options[header_image_2]"]').val('');
            $('.header-preview').css('background-image', 'none');
        });
    });
    </script>
    <?php
}

/**
 * Images slider settings section description.
 *
 * @return void
 */
function my_theme_images_slider_section_callback(){
    echo "Choose your images slider options below:";
}

/**
 * Display inout image fields for image slider settings with repeater.
 *
 * @return void
 */
function my_theme_images_slider_callback(){
    $options = get_option( 'my_theme_options_images_slider' );
    $sliders = isset( $options['images_slider'] ) ? $options['images_slider'] : array();
    ?>
    <div id="images-slider-repeater">
        <?php
        if ( ! empty( $sliders ) ) {
            foreach ( $sliders as $index => $slider ) {
                $slider_image = isset( $slider['slider_image'] ) ? esc_attr( $slider['slider_image'] ) : '';
                $slider_title = isset( $slider['slider_title'] ) ? $slider['slider_title'] : '';
                $slider_textarea = isset( $slider['slider_textarea'] ) ? $slider['slider_textarea'] : '';
                ?>
                <div class="slider-item">
                    <div class="image-upload">
                        <input id="image-upload-text" type="text" name="my_theme_options_images_slider[images_slider][<?php echo $index; ?>][slider_image]" value="<?php echo esc_html($slider_image); ?>" placeholder="Image URL">
                        <button class="button image-upload-button" id="slider-image-upload-<?php echo $index; ?>">Upload Image</button>
                    </div>
                    <input id="slider-item-title" type="text" name="my_theme_options_images_slider[images_slider][<?php echo $index; ?>][slider_title]" placeholder="Slider Title" value="<?php echo $slider_title; ?>"><br>
                    <textarea id="slider-item-textarea" name="my_theme_options_images_slider[images_slider][<?php echo $index; ?>][slider_textarea]" rows="5" cols="50" placeholder="Slider Textarea"><?php echo esc_html( $slider_textarea ); ?></textarea><br>
                    <button class="button delete">Delete</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button class="button" id="add">Add New</button>

    <script>
    jQuery(document).ready(function($) {
        var index = <?php echo ! empty( $sliders ) ? count( $sliders ) : 0; ?>;
        const repeater = document.querySelector('#images-slider-repeater');
        const addButton = document.querySelector('#add');
        function addNewItem() {
            event.preventDefault();
            const newItem = document.createElement('div');
            newItem.classList.add('slider-item');
            newItem.innerHTML = `
                <div class="slider-item">
                    <div class="image-upload">
                        <input id="image-upload-text" type="text" name="my_theme_options_images_slider[images_slider][${index}][slider_image]" value="" placeholder="Image URL">
                        <button class="button image-upload-button" id="slider-image-upload-${index}">Upload Image</button>
                    </div>
                    <input id="slider-item-title" type="text" name="my_theme_options_images_slider[images_slider][${index}][slider_title]" placeholder="Slider Title" value=""><br>
                    <textarea id="slider-item-textarea" name="my_theme_options_images_slider[images_slider][${index}][slider_textarea]" rows="5" cols="50" placeholder="Slider Textarea"></textarea><br>
                    <button class="remove">-</button>
                </div>
            `;

            const removeButton = newItem.querySelector('.remove');
            removeButton.addEventListener('click', removeItem);
            repeater.appendChild(newItem);

            index++;
        }
        // Remove the services item if not saved.
        function removeItem(event) {
            const item = event.target.parentNode;
            item.parentNode.removeChild(item);
        }

        // Handle the click event of the image upload button
        const imageUploadButtons = document.querySelectorAll('.image-upload-button');
        imageUploadButtons.forEach(button => {
            button.addEventListener('click', () => {
                event.preventDefault();
                const input = button.previousElementSibling;
                const mediaUploader = wp.media({
                    title: 'Choose Image',
                    button: { text: 'Use Image' },
                    multiple: false
                });
                mediaUploader.on('select', () => {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    input.value = attachment.url;
                });
                mediaUploader.open();
            });
        });

        addButton.addEventListener('click', () => {
            addNewItem();
        });
    });
    jQuery(document).ready(function($) {
        // Delete button click handler
        $(document).on('click', '.delete', function() {
            // Remove the parent div from the HTML
            $(this).parent('.slider-item').remove();
            
            // Remove the corresponding option from the saved options
            var index = $(this).parent('.slider-item').index();
            var sliders = <?php echo json_encode($sliders); ?>;
            sliders.splice(index, 1);
            $('input[name="my_theme_options_images_slider[images_slider]"]').val(JSON.stringify(sliders));
        });
    });
    </script>
    <?php
}

/**
 * Special page links settings section description.
 *
 * @return void
 */
function my_theme_page_links_callback(){
    echo 'Manage special page links below:';
}

/**
 * Display four dropdown list of pages for selecting special pages links.
 *
 * @return void
 */
function my_theme_special_page_links_callback(){
    $options = get_option('my_theme_options_page_links');
    $pages = get_pages(); // Get list of pages

    ?>
    <div class="special-page-links">
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class='page-links'>
                <label for="page-<?php echo $i; ?>"><?php echo sprintf(__('Select Page %s:', 'my-theme'), $i+1); ?></label><br>
                <?php
                // Generate dropdown menu of pages
                wp_dropdown_pages(array(
                    'id' => 'page-'.$i,
                    'name' => 'my_theme_options_page_links[pages]['.$i.'][id]',
                    'selected' => isset($options['pages'][$i]['id']) ? $options['pages'][$i]['id'] : '',
                    'echo' => 1,
                    'show_option_none' => __('Select a page', 'my-theme'),
                    'option_none_value' => ''
                ));
                ?>
                <br>
                <label for="text-<?php echo $i; ?>"><?php echo sprintf(__('Hover Text %s:', 'my-theme'), $i+1); ?></label><br/>
                <input type="text" id="text-<?php echo $i; ?>" name="my_theme_options_page_links[pages][<?php echo $i; ?>][text]" value="<?php echo isset($options['pages'][$i]['text']) ? $options['pages'][$i]['text'] : ''; ?>" />
                <br/>
                <label for="image-<?php echo $i; ?>"><?php echo sprintf(__('Icon %s:', 'my-theme'), $i+1); ?></label><br/>
                <div class="image-upload">
                    <input type="text" id="image-<?php echo $i; ?>" name="my_theme_options_page_links[pages][<?php echo $i; ?>][image]" value="<?php echo isset($options['pages'][$i]['image']) ? $options['pages'][$i]['image'] : ''; ?>" placeholder="Image URL">
                    <button class="button image-upload-button" id="image-upload-<?php echo $i; ?>">Upload Image</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        jQuery(document).ready(function($){
            $('.image-upload-button').click(function(e) {
                e.preventDefault();
                var button = $(this),
                custom_uploader = wp.media({
                    title: 'Insert image',
                    library : { type : 'image'},
                    button: { text: 'Insert image' },
                    multiple: false
                }).on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.prev().val(attachment.url);
                }).open();
            });
        });
    </script>
    <?php
}

/**
 * Banner slider settings section description.
 *
 * @return void
 */
function my_theme_banner_section_callback() {
    echo "Manage your banner slider options below:";
}

/**
 * Display input image fields and text fields with repeater for banner slider.
 *
 * @return void
 */
function my_theme_banner_slider_callback() {
    $options = get_option( 'my_theme_options_banner_slider' ); // Updated option name
    $banner_sliders = isset( $options['banner_slider'] ) ? $options['banner_slider'] : array();
    $banner_slider_image_1 = isset($options['banner_slider_image_1']) ? esc_attr($options['banner_slider_image_1']) : '';
    $banner_slider_image_2 = isset($options['banner_slider_image_2']) ? esc_attr($options['banner_slider_image_2']) : '';
    ?>
    <label for="banner-slider-image-1">Banner Slider Image 1:</label>
    <input type="text" id="banner-slider-image-1" name="my_theme_options_banner_slider[banner_slider_image_1]" value="<?php echo $banner_slider_image_1; ?>">
    <button class="button" id="banner-slider-image-upload-1">Upload Image</button>
    <?php if (!empty($banner_slider_image_1)) : ?>
        <button class="button" id="banner-slider-image-remove-1">Remove Image</button>
        <div class="banner-preview" style="background-image: url(<?php echo $banner_slider_image_1; ?>);"></div>
    <?php endif; ?>
    <br><br>
    <label for="banner-slider-image-2">Banner Slider Image 2:</label>
    <input type="text" id="banner-slider-image-2" name="my_theme_options_banner_slider[banner_slider_image_2]" value="<?php echo $banner_slider_image_2; ?>">
    <button class="button" id="banner-slider-image-upload-2">Upload Image</button>
    <?php if (!empty($banner_slider_image_2)) : ?>
        <button class="button" id="banner-slider-image-remove-2">Remove Image</button>
        <div class="banner-preview" style="background-image: url(<?php echo $banner_slider_image_2; ?>);"></div>
    <?php endif; ?>
    <div id="banner-slider-repeater">
        <?php
        if (!empty($banner_sliders)) {
            foreach ($banner_sliders as $index => $banner_slider) {
                $banner_slider_textarea = isset($banner_slider['banner_slider_textarea']) ? $banner_slider['banner_slider_textarea'] : '';
                ?>
                <div class="banner-slider-item">
                    <textarea id="banner-slider-textarea" name="my_theme_options_banner_slider[banner_slider][<?php echo esc_attr($index); ?>][banner_slider_textarea]" rows="5" cols="50" placeholder="Slider Textarea"><?php echo esc_textarea($banner_slider_textarea); ?></textarea><br>
                    <button class="button delete">Delete</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button class="button" id="add">Add New</button>
    <script>
    jQuery(document).ready(function($) {
        var index = <?php echo ! empty( $banner_sliders ) ? count( $banner_sliders ) : 0; ?>;
        const repeater = document.querySelector('#banner-slider-repeater');
        const addButton = document.querySelector('#add');
        // Add a new div item on click add new.
        function addNewItem() {
            event.preventDefault();
            const newItem = document.createElement('div');
            newItem.classList.add('banner-slider-item');
            newItem.innerHTML = `
                <textarea id="banner-slider-textarea" name="my_theme_options_banner_slider[banner_slider][${index}][banner_slider_textarea]" rows="5" cols="50" placeholder="Banner Slider Textarea"></textarea><br>
                <button class="remove">-</button>
            `;

            const removeButton = newItem.querySelector('.remove');
            removeButton.addEventListener('click', removeItem);
            repeater.appendChild(newItem);

            index++;
        }
        // Remove the banner text field item if not saved in options.
        function removeItem(event) {
            const item = event.target.parentNode;
            item.parentNode.removeChild(item);
        }
        addButton.addEventListener('click', () => {
            addNewItem();
        });
    });
    jQuery(document).ready(function($) {
        // Delete button click handler.
        $(document).on('click', '.delete', function() {
            // Remove the parent div from the HTML.
            $(this).parent('.banner-slider-item').remove();
            
            // Remove the corresponding option from the saved options.
            var index = $(this).parent('.slider-item').index();
            var sliders = <?php echo json_encode($banner_sliders); ?>;
            sliders.splice(index, 1);
            $('input[name="my_theme_options_banner_slider[banner_slider]"]').val(JSON.stringify(sliders));
        });
    });
    jQuery(document).ready(function($) {
        // Handle to upload image button for banner slider.
        $('#banner-slider-image-upload-1').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options_banner_slider[banner_slider_image_1]"]').val(image_url);
                $('.banner-preview').css('background-image', 'url(' + image_url + ')');
            });
        });

        // Remove first image in banner slider options.
        $('#banner-slider-image-remove-1').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options_banner_slider[banner_slider_image_1]"]').val('');
            $('.banner-preview').css('background-image', 'none');
        });

        // Handle upload image button for banner slider.
        $('#banner-slider-image-upload-2').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options_banner_slider[banner_slider_image_2]"]').val(image_url);
                $('.header-preview').css('background-image', 'url(' + image_url + ')');
            });
        });

        // Remove second image in banner slider options.
        $('#banner-slider-image-remove-2').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options_banner_slider[banner_slider_image_2]"]').val('');
            $('.banner-preview').css('background-image', 'none');
        });
    });
    </script>
    <?php
}

/**
 * Vertical logo settings section description.
 *
 * @return void
 */
function my_theme_vertical_section_callback() {
    echo 'Choose your vertical logo options below:';
}

/**
 * Display input image field for vertical logo setting.
 *
 * @return void
 */
function my_theme_vertical_logo_callback() {

    $options = get_option('my_theme_options_vertical_logo');
    $vertical_logo = isset($options['vertical_logo']) ? esc_attr($options['vertical_logo']) : '';
    ?>
    <input type="text" name="my_theme_options_vertical_logo[vertical_logo]" value="<?php echo $vertical_logo; ?>">
    <button class="button" id="vertical-image-upload">Upload Image</button>
    <?php if (!empty($vertical_logo)) : ?>
        <button class="button" id="vertical-image-remove">Remove Image</button>
        <div class="vertical-preview" style="background-image: url(<?php echo $vertical_logo; ?>);"></div>
    <?php endif; ?>
    <script>
    jQuery(document).ready(function($) {
        $('#vertical-image-upload').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options_vertical_logo[vertical_logo]"]').val(image_url);
                $('.vertical-preview').css('background-image', 'url(' + image_url + ')');
            });
        });

        $('#vertical-image-remove').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options_vertical_logo[vertical_logo]"]').val('');
            $('.vertical-preview').css('background-image', 'none');
        });
    });
    </script>
    <?php
}

/**
 * The services settings section description.
 *
 * @return void
 */
function my_theme_services_section_callback(){
    echo "Choose your services options below:";
}

/**
 * Display and input text field and image for services settings with repeater.
 *
 * @return void
 */
function my_theme_the_services_callback(){
    $options = get_option( 'my_theme_options_services' );
    $services = isset( $options['services'] ) ? $options['services'] : array();
    ?>
    <div id="repeater">
        <?php
        if ( ! empty( $services ) ) {
            foreach ( $services as $index => $service ) {
                $services_title = isset( $service['services_title'] ) ? $service['services_title'] : '';
                $services_image = isset( $service['services_image'] ) ? esc_attr( $service['services_image'] ) : '';
                ?>
                <div class="item">
                    <input id="services-title" type="text" name="my_theme_options_services[services][<?php echo $index; ?>][services_title]" placeholder="Title" value="<?php echo $services_title; ?>">
                    <div class="image-upload">
                        <input id="services-text" type="text" name="my_theme_options_services[services][<?php echo $index; ?>][services_image]" value="<?php echo $services_image; ?>" placeholder="Image URL">
                        <button class="button image-upload-button" id="services-image-upload-<?php echo $index; ?>">Upload Image</button>
                    </div>
                    <button class="button delete">Delete</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button class="button" id="add">Add New</button>
    <script>
    jQuery(document).ready(function($) {
        var index = <?php echo ! empty( $services ) ? count( $services ) : 0; ?>;
        const repeater = document.querySelector('#repeater');
        const addButton = document.querySelector('#add');
        function addNewItem() {
            event.preventDefault();
            const newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.innerHTML = `
                <div class="item">
                    <input id="services-title" type="text" name="my_theme_options_services[services][${index}][services_title]" placeholder="Title" value="">
                    <div class="image-upload">
                        <input id="services-text" type="text" name="my_theme_options_services[services][${index}][services_image]" value="" placeholder="Image URL">
                        <button class="button image-upload-button" id="services-image-upload-${index}">Upload Image</button>
                    </div>
                    <button class="remove">-</button>
                </div>
            `;
            const removeButton = newItem.querySelector('.remove');
            removeButton.addEventListener('click', removeItem);
            repeater.appendChild(newItem);
            index++;
        }
        // Remove the service item.
        function removeItem(event) {
            const item = event.target.parentNode;
            item.parentNode.removeChild(item);
        }

        // Handle the click event of the image upload button
        const imageUploadButtons = document.querySelectorAll('.image-upload-button');
        imageUploadButtons.forEach(button => {
            button.addEventListener('click', () => {
                event.preventDefault();
                const input = button.previousElementSibling;
                const mediaUploader = wp.media({
                    title: 'Choose Image',
                    button: { text: 'Use Image' },
                    multiple: false
                });
                mediaUploader.on('select', () => {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    input.value = attachment.url;
                });
                mediaUploader.open();
            });
        });

        addButton.addEventListener('click', () => {
            addNewItem();
        });
    });
    jQuery(document).ready(function($) {
        // Delete button click handler
        $(document).on('click', '.delete', function() {
            // Remove the parent div from the HTML
            $(this).parent('.item').remove();
            
            // Remove the corresponding option from the saved options
            var index = $(this).parent('.item').index();
            var services = <?php echo json_encode($services); ?>;
            services.splice(index, 1);
            $('input[name="my_theme_options_services[services]"]').val(JSON.stringify(services));
        });
    });
    </script>
    <?php
}

/**
 * Footer section settings descriptions. 
 *
 * @return void
 */
function my_theme_footer_section_callback() {
    ?>
    <p><?php _e( 'Choose your footer options below:', 'luminate' ); ?></p>
    <?php
}

/**
 * Display textfield for footer disclaimer notification.
 *
 * @return void
 */
function my_theme_disclaimer_notification_callback() {
    $options = get_option( 'my_theme_options_footer' );
    $disclaimer = isset( $options['disclaimer_notification'] ) ? $options['disclaimer_notification'] : '';
    ?>
    <textarea name="my_theme_options_footer[disclaimer_notification]" rows="5" cols="50"><?php echo esc_html( $disclaimer ); ?></textarea>
    <?php
}

/**
 * Display input image field for footer disclaimer image.
 *
 * @return void
 */
function my_theme_footer_image_callback() {
    $options = get_option( 'my_theme_options_footer' );
    ?>
    <input type="text" name="my_theme_options_footer[footer_image]" value="<?php echo isset($options['footer_image']) ? esc_attr($options['footer_image']) : ''; ?>">
    <button class="button" id="footer-image-upload">Upload Image</button>
    <?php if (!empty($options['footer_image'])) : ?>
        <button class="button" id="footer-image-remove">Remove Image</button>
        <div class="footer-preview" style="background-image: url(<?php echo esc_attr($options['footer_image']); ?>);"></div>
    <?php endif; ?>
    <script>
    jQuery(document).ready(function($) {
        $('#footer-image-upload').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="my_theme_options_footer[footer_image]"]').val(image_url); // Updated option name
                $('.footer-preview').css('background-image', 'url(' + image_url + ')');
            });
        });
        $('#footer-image-remove').click(function(e) {
            e.preventDefault();
            $('input[name="my_theme_options_footer[footer_image]"]').val('');
            $('.footer-preview').css('background-image', 'none');
        });
    });
    </script>
    <?php
}

function display_user_tweets_post(){
    ?>
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-md-12 col-sm-12 tweet-container" style="height: 300px; overflow: auto; margin-top: 15px;">
            <?php
            $username = isset($_POST['username']) ? $_POST['username'] : 'tayyab__ateeq';

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
            ?>
        </div>
    </div>
    <div class="row" style="margin-top: 5px; padding-right: 15px; padding-left: 15px;">
        <div class="col-md-12 col-sm-12 bg-light">
            <form method="post">
                <div class="input-group mb-3 bg-light" style="margin-top: 15px;">
                    <input type="text" class="form-control" name="username" placeholder="Twitter Username" aria-label="Twitter username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="submit-button">@</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
}

?>
