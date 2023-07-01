jQuery(function ($) {
    $('.nav-tab').on('click', function (e) {
        e.preventDefault();
        var tab = $(this).data('tab');

        // Update active tab
        $('.nav-tab').removeClass('active');
        $(this).addClass('active');

        // Show corresponding tab content
        $('.tab-pane').removeClass('active');
        $('#' + tab).addClass('active');
    });
});
