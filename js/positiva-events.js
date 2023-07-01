jQuery(function ($) {
    var currentPage = 1;
    var maxPages = cptEvents.maxPages;

    function updateArrows() {
        if (currentPage === 1) {
            $('#cpt-event-show-less-button').addClass('disabled');
        } else {
            $('#cpt-event-show-less-button').removeClass('disabled');
        }

        if (currentPage == maxPages) {
            $('#cpt-event-load-more-button').addClass('disabled');
        } else {
            $('#cpt-event-load-more-button').removeClass('disabled');
        }
    }

    $('#cpt-event-show-less-button').on('click', function (e) {
        e.preventDefault();

        if (currentPage > 1) {
            currentPage--;
            updateArrows();
            loadData();
        }
    });

    $('#cpt-event-load-more-button').on('click', function (e) {
        e.preventDefault();

        if (currentPage < maxPages) {
            currentPage++;
            updateArrows();
            loadData();
        }
    });

    function loadData() {
        $('#cpt-event-container').html('<i class="fa fa-spinner fa-spin"></i> Loading...'); // Display loading spinner

        $.ajax({
            url: cptEvents.url,
            type: 'POST',
            data: {
                action: 'load_more_events',
                page: currentPage,
                security: cptEvents.security, // Add nonce for security
            },
            success: function (response) {
                $('#cpt-event-container').html(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    updateArrows();
    loadData();
});
