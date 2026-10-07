<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_singular() ) : ?>
			<?php the_title( '<h1>', '</h1>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>

		<?php dan_theme_post_thumbnail(); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
