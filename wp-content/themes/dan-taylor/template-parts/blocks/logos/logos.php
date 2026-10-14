<?php
/**
 * Logos.
 *
 * A grid of logos, three per row on desktop, narrowing down on smaller screens.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$mobile_heading = get_field( 'mobile_heading' );
$logos   = get_field( 'logos' );

// Block ID.
$block_id = 'logos-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'logos-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> mk:px-4 mk:md:px-8 mk:pt-0 mk:pb-16 mk:md:py-16">
	<div class="mk:w-full mk:max-w-site mk:mx-auto mk:border-t-2 mk:border-orange mk:pt-16">
		<div class="mk:mb-16 mk:text-center mk:flex mk:justify-center mk:items-center">
			<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 32 ); ?>
			<h2 class="mk:font-space mk:text-2xl mk:md:text-3xl mk:font-semibold">
				<span class="mk:hidden mk:md:block"><?php echo esc_html( $heading ); ?></span>
				<span class="mk:md:hidden"><?php echo esc_html( $mobile_heading ); ?></span>
			</h2>
			<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 32 ); ?>
		</div>

		<?php if ( $logos ) : ?>
			<div class="mk:max-w-site-sm mk:mx-auto mk:grid mk:grid-cols-2 mk:md:grid-cols-4 mk:gap-8 mk:items-center">
				<?php foreach ( $logos as $logo ) :
					$logo_element = $logo['logo'];
					if ( empty( $logo_element ) ) {
						continue;
					}
					?>
					<div class="mk:flex mk:justify-center mk:items-center">
						<img class="mk:max-w-32 mk:max-h-16 mk:w-auto mk:object-contain" src="<?php echo esc_url( $logo_element['url'] ); ?>" alt="<?php echo esc_attr( $logo_element['alt'] ); ?>" loading="lazy">
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
