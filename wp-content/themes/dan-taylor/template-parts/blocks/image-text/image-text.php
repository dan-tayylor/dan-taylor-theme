<?php
/**
 * Image / Text
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$text    = get_field( 'text' );
$cta     = get_field( 'cta' );
$image   = get_field( 'image' );
$image_position = get_field( 'image_position' );

if( 'right' === $image_position ) {
    $row = 'mk:md:flex-row-reverse';
} else {
    $row = '';
}

// Block ID.
$block_id = 'image-text-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'image-text-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_html( $block_id ); ?>" class="<?php echo esc_html( $class_name ); ?> mk:px-4 mk:md:px-8 mk:py-16">
	<div class="mk:w-full mk:max-w-site mk:mx-auto">
        <div class="mk:md:flex mk:gap-6 <?php echo esc_html( $row ); ?>">
            <div class="mk:md:w-1/2">
                <img class="mk:w-full mk:h-96 mk:object-cover" src="<?php echo esc_html( $image['url'] ); ?>" alt="<?php echo esc_html( $image['alt'] ); ?>" loading="lazy">
            </div>
            <div class="mk:md:w-1/2 mk:flex mk:items-center mk:mt-8 mk:md:mt-0 mk:md:py-6 mk:md:px-6">
                <div>
                    <h2 class="mk:text-2xl mk:mb-5"><?php echo esc_html( $heading ); ?></h2>
                    <div class="prose">
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
    </div>
</div>
