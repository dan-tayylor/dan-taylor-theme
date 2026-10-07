<?php
/**
 * Enqueues scripts and styles.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dan_theme
 * @since 1.0.0
 */

/** Enqueue function frontend. */
function dan_theme_scripts() {

	// Styles.
	wp_enqueue_style( 'dan_theme-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	
	// Scripts.
    wp_enqueue_script( 'dan_theme-js', get_template_directory_uri() . '/assets/js/dist/main.min.js', array(), wp_get_theme()->get( 'Version' ), true );


}
add_action( 'wp_enqueue_scripts', 'dan_theme_scripts' );

function conditionally_load_jquery() {
    if ( ! is_page( 'contact' ) ) {
        wp_dequeue_script( 'jquery' );
        wp_deregister_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'conditionally_load_jquery', 100 );


/** Enqueue backend scripts and styles. */
function dan_theme_backend_scripts() {
	wp_enqueue_style( 'dan_theme-admin-style', get_template_directory_uri() . '/assets/admin.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'admin_enqueue_scripts', 'dan_theme_backend_scripts' );