<?php
/**
 * Functions and filters related to the menus.
 *
 * Makes the default WordPress navigation use an HTML structure similar
 * to the Navigation block.
 *
 * @link https://make.wordpress.org/themes/2020/07/06/printing-navigation-block-html-from-a-legacy-menu-in-themes/
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 *
 * @param string $uri  Social link.
 * @param int    $size The icon size in pixels.
 * @return string
 */
function dan_theme_get_social_link_svg( $uri, $size = 24 ) {
	return Dan_theme_SVG_Icons::get_social_link_svg( $uri, $size );
}

/**
 * Displays SVG icons in the footer navigation.
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string The menu item output with social icon.
 */
function dan_theme_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'footer' === $args->theme_location ) {
		$svg = dan_theme_get_social_link_svg( $item->url, 24 );
		if ( ! empty( $svg ) ) {
			$item_output = str_replace( $args->link_before, $svg, $item_output );
		}
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'dan_theme_nav_menu_social_icons', 10, 4 );


/**
 * Add class option to menu items.
 *
 * @param array $classes menu classes.
 * @param array $item menu items.
 * @param array $args menu arguments.
 */
function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );