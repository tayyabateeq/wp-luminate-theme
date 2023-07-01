jQuery(document).ready(function($) {
    $('.secondary-menu .menu-item').click(function(e) {
        e.preventDefault();
        var submenu = $(this).find('.sub-menu');

        if (submenu.length > 0) {
            submenu.toggle();
        } else {
            var link = $(this).find('a').attr('href');
            window.location.href = link;
        }
    });
});
jQuery(document).ready(function($) {
    $('.cancel-notification').click(function() {
        $('.top-notification').hide();
    });
});
jQuery( document ).ready( function( $ ) {
    $( '.slider' ).slick( {
        autoplay: true,
        arrows: true,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnHover: false,
        appendArrows: $( '.slider' ),
        prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left"></i></div>',
        nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right"></i></div>',
        customPaging: function(slider, i) {
            return '<button type="button" class="slick-dot"></button>';
        },
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    dots: false,
                }
            }
        ]
    } );
} );

jQuery(document).ready(function($) {
    function activateSlider() {
        // Activate the slider
        $('#special-pages').slick({
            autoplay: true,
            arrows: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            speed: 1000,
            appendArrows: $('#special-pages'),
            prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-circle-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fa fa-chevron-circle-right"></i></div>',
            customPaging: function(slider, i) {
                return '<button type="button" class="slick-dot"></button>';
            }
        });
    }

    function deactivateSlider() {
        // Deactivate the slider
        $('#special-pages').slick('unslick');
    }

    function handleSlider() {
        if ($(window).width() < 768) {
            activateSlider();
        } else {
            deactivateSlider();
        }
    }

    // Call handleSlider on initial page load
    handleSlider();

    // Call handleSlider on window resize
    $(window).on('resize', function() {
        handleSlider();
    });
});

jQuery(document).ready(function($) {
    function activateSlider() {
        // Activate the slider
        $('.show-last-posts').slick({
            autoplay: true,
            arrows: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            speed: 1500,
            appendArrows: $('.show-last-posts'),
            prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-circle-left" style="color: #FD7605;"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fa fa-chevron-circle-right" style="color: #FD7605;"></i></div>',
            customPaging: function(slider, i) {
                return '<button type="button" class="slick-dot"></button>';
            }
        });
    }

    function deactivateSlider() {
        // Deactivate the slider
        $('.show-last-posts').slick('unslick');
    }

    function handleSlider() {
        if ($(window).width() < 768) {
            activateSlider();
        } else {
            deactivateSlider();
        }
    }

    // Call handleSlider on initial page load
    handleSlider();

    // Call handleSlider on window resize
    $(window).on('resize', function() {
        handleSlider();
    });
});

jQuery( document ).ready( function( $ ) {
    $( '.banner-slider-text' ).owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        items: 1,
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        smartSpeed: 450
    });
    jQuery( function( $ ) {
        $( "#date-picker" ).datepicker({
            dateFormat: "yy-mm-dd",  // format of the selected date
            showOtherMonths: true,  // show dates from other months
            selectOtherMonths: true,  // allow selecting dates from other months
            showButtonPanel: true  // show "Today" and "Done" buttons at the bottom
        });
    });
});
jQuery( document ).ready( function( $ ) {
    // Slider for cpt-slider posts.
    $( '.slider-wrapper' ).owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        loop: true,
        nav: false,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
} );