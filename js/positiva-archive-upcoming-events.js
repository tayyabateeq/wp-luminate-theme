jQuery(function ($) {
    var currentPage = 1;
    var maxPages = cptEvents.maxPages;

    function updateArrows() {
        if (currentPage === 1) {
            $('#cpt-upcoming-event-show-less-button').addClass('disabled');
        } else {
            $('#cpt-upcoming-event-show-less-button').removeClass('disabled');
        }

        if (currentPage >= maxPages) {
            $('#cpt-upcoming-event-load-more-button').addClass('disabled');
        } else {
            $('#cpt-upcoming-event-load-more-button').removeClass('disabled');
        }
    }

    $('#cpt-upcoming-event-show-less-button').on('click', function (e) {
        e.preventDefault();

        if (currentPage > 1) {
            currentPage--;
            updateArrows();
            loadData();
        }
    });

    $('#cpt-upcoming-event-load-more-button').on('click', function (e) {
        e.preventDefault();

        if (currentPage < maxPages) {
            currentPage++;
            updateArrows();
            loadData();
        }
    });

    function loadData() {
        $('#archive-event-container').html('<i class="fa fa-spinner fa-spin"></i> Loading...'); // Display loading spinner

        $.ajax({
            url: cptEvents.url,
            type: 'POST',
            data: {
                action: 'load_more_upcoming_events',
                page: currentPage,
                security: cptEvents.security // Add nonce for security
            },
            success: function (response) {
                $('#archive-event-container').html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    updateArrows();
    loadData();
});