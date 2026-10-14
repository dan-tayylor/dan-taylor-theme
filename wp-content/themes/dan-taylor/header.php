<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

// Tailwind body classes.
$css_body_classes = array( 'mk:font-source-code', 'mk:text-charcoal', 'mk:overflow-x-hidden' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class($css_body_classes); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a href="#content" class="screen-reader-text">
		<?php
		/* translators: Hidden accessibility text. */
		esc_html_e( 'Skip to content', 'dan_theme' );
		?>
	</a>

	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
