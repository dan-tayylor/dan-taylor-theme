<?php
/**
 * Hero Homepage.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading         = get_field( 'heading' );
$text    = get_field( 'text' );
$cta     = get_field( 'cta' );
$image         = get_field( 'image' );
$video         = get_field( 'video' );
$display_video = get_field( 'display_video' );

// Block ID.
$block_id = 'hero-heading';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'hero-heading';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_html( $block_id ); ?>" class="<?php echo esc_html( $class_name ); ?> mk:relative mk:px-4 mk:md:px-8 mk:pt-16 mk:pb-8">
	<div class="mk:max-w-site mk:mx-auto mk:h-full mk:flex mk:items-center">
			<div class="mk:w-full mk:max-w-2xl hero-text mk:mx-auto mk:text-center">
           <div class="mk:mb-6 mk:text-center mk:flex mk:justify-center mk:items-center">
            <?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 38 ); ?>
					    <h1 class="mk:font-space mk:text-3xl mk:md:text-4xl mk:font-semibold mk:text-center"><?php echo esc_html( $heading ); ?></h1>
            <?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 38 ); ?>
        </div>
				<div class="prose mk:text-lg">
					<?php echo wp_kses_post( $text ); ?>
				</div>
				<?php if( $cta ) { ?>
					<div class="mk:mt-6">
						<a class="btn" href="<?php echo esc_html( $cta['url'] ); ?>" target="<?php echo esc_html( $cta['target'] ); ?>">
							<?php echo esc_html( $cta['title'] ); ?>
						</a>
					</div>
				<?php } ?>
			</div>
	</div>
</div>


