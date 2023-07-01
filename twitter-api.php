<?php
$username = 'ImranKhanPTI';
$count = 2; // number of tweets to retrieve
$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$username&count=$count";

// Twitter API OAuth Authentication
$oauth_access_token = '1652217924118278145-6BpMHcoBjXSNROZLJS10ULcqZ6nHGn';
$oauth_access_token_secret = 'UC8TjwIO0KQ4fUVmABYiyWbnTCwMzJ3gh78xQi5IXp5yy';
$consumer_key = 'rJVrDJzImxGHEqorJcP1SXpLm';
$consumer_secret = 'nFoAh02F5ABBvHOyfUGpn7D4n9BzapcZaN6Gi3KqsVp3qVdIOf';

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_nonce' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_token' => $oauth_access_token,
    'oauth_timestamp' => time(),
    'oauth_version' => '1.0'
);

$base_params = empty($params) ? $oauth : array_merge($params, $oauth);
ksort($base_params);
$base_parts = array();
foreach ($base_params as $k => $v) {
    $base_parts[] = urlencode($k) . '=' . urlencode($v);
}
$base_string = implode('&', $base_parts);
$signature_key = urlencode($consumer_secret) . '&' . urlencode($oauth_access_token_secret);
$signature = base64_encode(hash_hmac('sha1', $base_string, $signature_key, true));
$oauth['oauth_signature'] = $signature;

// Build Authorization Header
$auth_parts = array();
foreach ($oauth as $k => $v) {
    $auth_parts[] = urlencode($k) . '="' . urlencode($v) . '"';
}
$auth_header = 'Authorization: OAuth ' . implode(', ', $auth_parts);

// Send API Request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array($auth_header, 'Expect:'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

// Display Tweets
$tweets = json_decode($response, true);
var_dump($tweets);
// foreach ($tweets as $tweet) {
// 	echo $tweet['text'] . '<br>';
// 	var_dump($tweet);
// }

	// Helper functions

	function build_base_string($method, $url, $params) {
		$r = array();
		ksort($params);
		foreach ($params as $key => $value) {
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method . '&' . rawurlencode($url) . '&' . rawurlencode(implode('&', $r));
	}

	function build_signature($base_string, $consumer_secret, $access_secret) {
		$key = rawurlencode($consumer_secret) . '&' . rawurlencode($access_secret);
		return base64_encode(hash_hmac('sha1', $base_string, $key, true));
	}

	function build_oauth_header($oauth, $signature) {
		$r = 'OAuth ';
		$values = array();
		foreach ($oauth as $key => $value) {
			$values[] = "$key=\"" . rawurlencode($value) . "\"";
		}
		$values[] = 'oauth_signature="' . rawurlencode($signature) . '"';
		$r .= implode(', ', $values);
		return $r;
	}

    /////////////////////////
    //Pagination Events
    function display_cpt_events() {
        // Initialize page number
        $paged = 1;
        if ( get_query_var( 'paged' ) ) {
            $paged = get_query_var( 'paged' );
        } elseif ( get_query_var( 'page' ) ) {
            $paged = get_query_var( 'page' );
        }
    
        // Set up query arguments
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 3,
            'paged' => $paged,
        );
        $query = new WP_Query( $args );    
    
        // Check if the query has any posts
        if ( $query->have_posts() ) {
            // Loop through the posts and display each post
            while ( $query->have_posts() ) {
                // Set up post data
                $query->the_post();
                // Display the start and end dates
                $event_start_date = get_post_meta( get_the_ID(), '_event_date', true );
                $event_start_time = get_post_meta( get_the_ID(), '_event_start_time', true );
                $event_end_time = get_post_meta( get_the_ID(), '_event_end_time', true );
                ?>
                <div class="row item cpt-event">
                    <div class="col-md-4 col-sm-4">
                        <div class="cpt-event-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="cpt-event-details">
                            <h2 class="cpt-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="cpt-event-date">
                                <?php echo date_i18n( 'F j, Y', strtotime( $event_start_date ) ); ?>
                            </div>
                            <div class="cpt-event-date">
                                <?php echo date_i18n( 'g:i A', strtotime( $event_start_time ) ); ?>
                                <?php echo "-"; ?>
                                <?php echo date_i18n( 'g:i A', strtotime( $event_end_time ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            // Display pagination links
            $big = 999999999; // need an unlikely integer
            $paginate_links = paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, $paged ),
                'total' => $query->max_num_pages,
                'prev_next' => true,
                'prev_text' => __('&laquo; Previous'),
                'next_text' => __('Next &raquo;'),
                'type' => 'array', // Change pagination type to array for AJAX pagination
            ) );
            if ( $paginate_links ) {
                ?>
                <div class="cpt-event-pagination">
                    <div class="ajax-pagination-container">
                        <?php foreach ( $paginate_links as $link ) {
                            echo $link;
                        } ?>
                    </div>
                </div>
                <script>
                // AJAX pagination
                jQuery('.ajax-pagination-container a').click(function(event) {
                    event.preventDefault();
                    var link = jQuery(this).attr('href');
                    jQuery('.ajax-pagination-container').html('<div class="ajax-loader"></div>');
                    jQuery.ajax({
                        type: 'GET',
                        url: link,
                        success: function(data) {
                            var result = jQuery(data).find('.cpt-event'); // find the event posts
                            var pagination = jQuery(data).find('.ajax-pagination-container'); // find the pagination links
                            jQuery('.cpt-events-wrapper').html(result); // replace the events
                            jQuery('.ajax-pagination-container').html(pagination); // replace the pagination links
                            // scroll to top of the page
                            jQuery('html, body').animate({
                                scrollTop: jQuery(".cpt-events-wrapper").offset().top
                            }, 500);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('AJAX Error: ' + errorThrown);
                        }
                    });
                });
                </script>
                <?php
            }
        }
        // Restore original post data
        wp_reset_postdata();
    }


    // 	// Replace with your own bearer token
// $BEARER_TOKEN = 'AAAAAAAAAAAAAAAAAAAAAG1snQEAAAAAgChBo8uYiu49lqS4P%2BC0DGFO52c%3DEyqSmo4xbdIwNibb80xp0my111cjccMQ2rFsX8OwywoNScSPXr';

// // Endpoint URL
// $url = 'https://api.twitter.com/2/tweets?ids=1653226832068739072';

// // Initialize cURL session
// $ch = curl_init();

// // Set cURL options
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Authorization: Bearer'.$BEARER_TOKEN
// ));

// // Execute the cURL request and get the response
// $response = curl_exec($ch);

// // Check for errors
// if(curl_error($ch)) {
//     echo 'cURL error: '.curl_error($ch);
// }

// // Close cURL session
// curl_close($ch);

// // Display the API response
// echo $response;

// $BEARER_TOKEN = 'AAAAAAAAAAAAAAAAAAAAAG1snQEAAAAAgChBo8uYiu49lqS4P%2BC0DGFO52c%3DEyqSmo4xbdIwNibb80xp0my111cjccMQ2rFsX8OwywoNScSPXr';
// $tweet_ids = '1653226832068739072'; // comma-separated list of Tweet IDs
// $url = 'https://api.twitter.com/2/tweets?ids=' . $tweet_ids;
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// // Receive server response ...
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Authorization: Bearer ' . $BEARER_TOKEN
// ));
// $server_output = curl_exec($ch);
// curl_close($ch);

// // Decode the JSON response
// $response = json_decode($server_output, true);
// var_dump($response);
// Print out the results
// foreach ($response['data'] as $tweet) {
//     echo "Tweet ID: " . $tweet['id'] . "\n";
//     echo "Tweet text: " . $tweet['text'] . "\n";
//     echo "Author: " . $tweet['author_id'] . "\n";
//     echo "Created at: " . $tweet['created_at'] . "\n\n";
// }

// // Set your Bearer Token here
// $BEARER_TOKEN = "AAAAAAAAAAAAAAAAAAAAAG1snQEAAAAAgChBo8uYiu49lqS4P%2BC0DGFO52c%3DEyqSmo4xbdIwNibb80xp0my111cjccMQ2rFsX8OwywoNScSPXr";

// // Set the API endpoint URL
// $url = "https://api.twitter.com/2/users/me";

// // Initialize a cURL session
// $ch = curl_init();

// // Set the cURL options
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     "Authorization: Bearer " . $BEARER_TOKEN,
//     "User-Agent: My Twitter App v1.0.0",
// ));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // Execute the cURL request
// $response = curl_exec($ch);
// var_dump($response);
// // Check for errors
// if (curl_errno($ch)) {
//     echo "cURL error: " . curl_error($ch);
// } else {
//     // Decode the JSON response
//     $data = json_decode($response);

//     // Print the user data
//     echo "User ID: " . $data->data->id . "<br>";
//     echo "Username: " . $data->data->username . "<br>";
//     echo "Name: " . $data->data->name . "<br>";
//     // and so on ...
// }

// // Close the cURL session
// curl_close($ch);

