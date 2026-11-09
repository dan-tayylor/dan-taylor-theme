<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

get_header();

if ( is_home() && get_option( 'page_for_posts' ) ) {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	$posts_page    = $posts_page_id ? get_post( $posts_page_id ) : null;

	if ( $posts_page instanceof WP_Post ) {
		global $post;

		$post = $posts_page;
		setup_postdata( $post );
		get_template_part( 'template-parts/content/content' );
		wp_reset_postdata();
	}
} elseif ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$post_type = get_post_type();

		if( $post_type != 'page' ) {
			get_template_part( 'template-parts/content/content', $post_type);
		} else {
			get_template_part( 'template-parts/content/content');
		}
	}
} else {
	get_template_part( 'template-parts/content/content-none' );
}

get_footer();
