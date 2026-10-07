<?php
/**
 * Admin functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @since Dan Theme 1.0.0
 * @package dan_theme
 */

/** Remove items from admin bar. */
function dan_theme_remove_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'new-content' );
	$wp_admin_bar->remove_node( 'customize' );
	$wp_admin_bar->remove_node( 'updates' );
	$wp_admin_bar->remove_node( 'comments' );
	$wp_admin_bar->remove_node( 'wpseo-menu' );
}
add_action( 'wp_before_admin_bar_render', 'dan_theme_remove_admin_bar' );