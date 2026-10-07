<?php
/**
 * ACF functions
 *
 * @package WordPress
 */

/**
 * Save ACF json.
 *
 * @param array $path Path to save ACF json.
 */
function acf_json_save_point( $path ) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path; }

add_filter( 'acf/settings/save_json', 'acf_json_save_point' );

/**
 * Load ACF json.
 *
 * @param array $paths Path to load ACF json.
 */
function acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'acf_json_load_point' );

// Options Page.
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Theme Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);
}

/**
 * Add new Block categories to the Gutenberg Editor
 *
 * @param       array $categories     The existing array of Gutenberg Block categories.
 * @return      array $categories     The modified array of Gutenberg Block categories.
 * @since       1.0.0
 * @author      Make Agency
 */
function make_add_block_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'carousels',
				'title' => __( 'Carousels', 'dan_theme' ),
			),
			array(
				'slug'  => 'content',
				'title' => __( 'Content', 'dan_theme' ),
			),
			array(
				'slug'  => 'hero',
				'title' => __( 'Hero', 'dan_theme' ),
			),
			array(
				'slug'  => 'post-types',
				'title' => __( 'Post Types', 'dan_theme' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'make_add_block_category', 10, 1 );