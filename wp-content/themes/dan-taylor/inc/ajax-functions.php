<?php
/**
 * Ajax filter functions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dan_theme
 * @since 1.0.0
 */

/**
 * News Filters.
 */
function fetch_news_posts() {
	check_ajax_referer( 'fetch_news_nonce', 'security' );
    $filters = $_POST['filters'] ?? [];
    $page  = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1; // Default to page 1 if missing.
    $categories = $filters['categories-filter'];

    /* phpcs:disable */
    $tax_query = [
        'relation' => 'AND',
    ];

    // Categories.
    if ( ! in_array( 'all', (array) $categories, true ) && !empty($categories) ) {
        $tax_query[] = [
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => array_map('intval', $categories),
        ];
    }
    /* phpcs:enable */

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => $tax_query,
        'paged' => $page    
    );
    $news_posts = new WP_Query( $args );

    // Display News posts.
	if ( $news_posts->have_posts() ) {
        $cards = '';
		while ( $news_posts->have_posts() ) {
			$news_posts->the_post();
			ob_start();

			// News cards.
			get_template_part( 'template-parts/cards/card', 'news' );
			$cards .= ob_get_clean();
		}
		wp_reset_postdata();
	} else {
		ob_start();
		echo '<div><p>No news articles found.</p></div>';
		$cards .= ob_get_clean();
	}

	$response = array(
		'cards'    => $cards,
		'has_more' => $news_posts->max_num_pages > $page, // Check if there are more resources to load.
	);

    wp_send_json( $response );
}
add_action( 'wp_ajax_fetch_news_posts', 'fetch_news_posts' );
add_action( 'wp_ajax_nopriv_fetch_news_posts', 'fetch_news_posts' );