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

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> mk:px-4 mk:md:px-8 mk:pb-8 mk:md:pb-16 mk:pt-4 mk:md:pt-0">
	<div class="fade-in-group mk:w-full mk:max-w-site mk:mx-auto mk:border-b mk:border-mist mk:pb-8 mk:md:pb-16">
		<div class="mk:flex mk:flex-col mk:md:flex-row mk:items-start">
			<div class="mk:md:w-1/2 mk:mb-6 mk:md:mb-0">
				<div class="mk:md:pr-8">
					<h2 class="mk:font-space mk:text-3xl mk:font-medium mk:text-smoke"><?php echo esc_html( $heading ); ?></h2> 
					<?php if ( $skills ) : ?>
						<div class="mk:max-w-[400px] mk:flex mk:flex-wrap mk:mt-4 mk:md:mt-8">
							<?php foreach ( $skills as $skill ) : ?>
								<div class="mk:mr-2 mk:mb-2 mk:font-space mk:text-sm mk:font-semibold mk:shadow-2xl mk:text-orange mk:border-2 mk:border-orange mk:px-3 mk:py-1 mk:rounded-4xl"><?php echo esc_html( $skill['text'] ); ?></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="mk:md:w-1/2">
				<?php if ( $text ) : ?>
					<div class="prose">
						<?php echo wp_kses_post( $text ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
