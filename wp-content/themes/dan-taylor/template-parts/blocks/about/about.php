<?php
/**
 * About.
 *
 * Two-column about section.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$text    = get_field( 'text' );
$skills  = get_field( 'skills' );

// Block ID.
$block_id = 'about-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'about-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> mk:px-4 mk:md:px-8 mk:pt-16 mk:pb-8 mk:md:py-16">
	<div class="fade-in-group mk:w-full mk:max-w-site mk:mx-auto mk:border-t-2 mk:border-orange mk:pt-16 mk:md:pt-24">
		<div class="mk:mb-10 mk:md:mb-12 mk:text-center mk:flex mk:flex-col mk:items-center">
			<div class="mk:text-center mk:flex mk:justify-center mk:items-center">
				<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 32 ); ?>
				<h2 class="mk:font-space mk:text-3xl mk:font-semibold"><?php echo esc_html( $heading ); ?></h2> 
				<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 32 ); ?>
			</div>
		</div>

		<div class="mk:flex mk:flex-col mk:md:flex-row mk:gap-12 mk:items-start">
			<?php if ( $text ) : ?>
				<div class="mk:md:w-2/3 prose">
					<?php echo wp_kses_post( $text ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by wp_kses_post(). ?>
				</div>
			<?php endif; ?>

			<?php if ( $skills ) : ?>
				<div class="mk:md:w-1/3 mk:flex mk:flex-wrap">
					<?php foreach ( $skills as $skill ) : ?>
						<div class="mk:mr-2 mk:mb-2 mk:font-space mk:text-sm mk:font-semibold mk:shadow-2xl mk:text-orange mk:border-2 mk:border-orange mk:px-3 mk:py-1 mk:rounded-4xl"><?php echo esc_html( $skill['text'] ); ?></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
