
# Luminate Theme #

*This theme is designed to be user-friendly, customizable, and visually appealing. This theme has everything you need to create a stunning online presence.*

## Installation ##

+ Download the theme files.
+ Upload them to your WordPress site in the "wp-content/themes" directory.
+ Activate the theme in the WordPress dashboard.

## Features ##

+ Customizable header and footer options
+ Services section with image repeater
+ Vertical logo option
+ Top notifications with date and user profile
+ Images slider with repeater
+ Special page links with hover content and image
+ Banner slider with repeater
+ Custom post types for events and sliders with custom meta fields
+ Custom widgets for images or logos

## Usage ##

+ Customize your header and footer options in the theme options.
+ Add your services section content with the image repeater.
+ Add your vertical logo in the theme options.
+ Add your top notifications message in the theme options.
+ Add your images to the slider with the image repeater.
+ Add your special page links in the theme options.
+ Add your banner slider content with the repeater.
+ Use the custom post types for events and sliders to create your content.
+ Use the custom widgets to display your images or logos.

## File System Workflow ##

### Index.php ###
+ Index.php calls the display data functions for the theme options on the home page.

### Theme-options.php ###
+ Theme-options.php registers all the theme options and saves the data.

### Display-theme-options.php ###
+ Display-theme-options.php displays all the saved data for the theme options.

### Theme-widgets.php ###
+ Theme-widgets.php registers custom widgets, including four images or logos that can be saved.

### Theme-shortcodes.php ###
+ Theme-shortcodes.php registers custom shortcodes, such as those for displaying contact information and phone numbers.

### Cpt-Events.php ###
+ Cpt-Events.php creates a custom post type for events and includes custom meta fields for date and time.

### Cpt-slider.php ###
+ Cpt-slider.php creates a custom post type for sliders and includes a custom meta field for a subtitle.

### Functions.php ###
+ Functions.php includes the custom file paths and all the necessary JS and CSS libraries.

## Theme Options ##

### Top Notifications ###
+ Allows users to input a text field for a notification message. This message will be displayed at the top of the page with the current date, a secondary menu, and a user profile.

### Header Options ###
+ Allows users to input two images and display them as a logo in the header.

### Images Slider ###
+ Allows users to input images with a repeater and display them in a slider after the header section.

### Special Page Links ###
+ Allows users to input four dropdown menus for special page links, which include hover content and an image.

### Banner Slider ###
+ Allows users to input two image fields and a text field for banner slider text with a repeater. This data will be displayed in a slider.

### Vertical Logo ###
+ Allows users to input an image and rotate it vertically with CSS. This logo will be displayed in the services options area.

### Services Options ###
+ Allows users to input a title and an image with a repeater. This data will be displayed in the widget area above the page content.

### Footer Options ###
+ Allows users to input an image and a textarea, which will be displayed in the area below the footer.

## Custom Post Types ##

| Register Name  | URL | Description |
| ------------- | ------------- | ------------- |
| Event  | /event/ | Custom Post Type event with custom meta fields of date and start/end time. |
| Slider | /slider/ | Custom Post Type slider with meta field subtitle. |

## Custom Widgets ##
+ Custom widgets for displaying images or logo with HTML structure.
+ Insert a path of image from media content `/wp-content/uploads/2023/04/image.png `

## Theme Shortcodes ##

| Name  | Shortcode |
| ------------- | ------------ |
| Contact Shortcode  | `[wpb-contact title="your title" tel="your phone number" email1="your email address" email2="your email address"]` |
| Group Shortcode | `[wpb-group title="Your Group title"]` |
| Location Shortcode  | `[wpb-location title="your location Name" url="your location url"]` |
| Phone Shortcode | `[wpb-phone tel="your phone number" title="your phone title"]` |
| Image Shortcode | `[wpb-image src="your image source" alt="your image alt text"]` |