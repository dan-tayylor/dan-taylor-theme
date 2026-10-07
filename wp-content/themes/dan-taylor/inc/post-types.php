<?php
/**
 * Custom post type functions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dan_theme
 * @since 1.0.0
 */

/**
 * Register custom post types.
 */
function dan_theme_custom_post_type() {

	// Work.
	$portfolio_labels = array(
		'name'           => _x( 'Portfolio', 'Post Type General Name', 'dan_theme' ),
		'singular_name'  => _x( 'Portfolio', 'Post Type Singular Name', 'dan_theme' ),
		'menu_name'      => __( 'Portfolio', 'dan_theme' ),
		'name_admin_bar' => __( 'Portfolio', 'dan_theme' ),
		'add_new'        => __( 'Add Portfolio', 'dan_theme' ),
		'view_item'      => __( 'View Portfolio', 'dan_theme' ),
		'view_items'     => __( 'View Portfolio', 'dan_theme' ),
		'all_items'      => __( 'All Portfolio', 'dan_theme' ),
	);
	$portfolio_args   = array(
		'label'               => __( 'Portfolio', 'dan_theme' ),
		'description'         => __( 'Portfolio', 'dan_theme' ),
		'labels'              => $portfolio_labels,
		'supports'            => array( 'title', 'editor' ),
		'hierarchical'        => true,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => false,
	);
	register_post_type( 'portfolio', $portfolio_args );
}
add_action( 'init', 'dan_theme_custom_post_type', 0 );