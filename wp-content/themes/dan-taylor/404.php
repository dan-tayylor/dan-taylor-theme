<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

get_header();

$heading = get_field('heading_404', 'options');
$text = get_field('text_404', 'options');
?>


<div class="mk:relative mk:px-4 mk:md:px-8 mk:py-16 mk:md:py-28">
	<div class="mk:max-w-site mk:mx-auto mk:h-full mk:flex mk:items-center">
		<div class="mk:w-full mk:max-w-2xl hero-text mk:mx-auto mk:text-center">
           <div class="mk:mb-6 mk:text-center mk:flex mk:justify-center mk:items-center">
				<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 38 ); ?>
					<h1 class="mk:font-faustina mk:text-3xl mk:md:text-4xl mk:tracking-wide mk:text-center mk:mb-2"><?php echo esc_html( $heading ); ?></h1>
				<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 38 ); ?>
			</div>
			<div class="prose">
				<?php echo wp_kses_post( $text ); ?>
			</div>
			<div class="mk:mt-6">
				<a class="btn-outline" href="/">
					Return home
				</a>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
