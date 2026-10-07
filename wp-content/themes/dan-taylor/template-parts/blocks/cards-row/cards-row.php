<?php
/**
 * Cards row.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading     = get_field( 'heading' );
$cards     = get_field( 'cards' );

// Block ID.
$block_id = 'cards-row-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'cards-row-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} 
?>

<div class="<?php echo esc_html( $class_name ); ?> mk:px-4 mk:md:px-8 mk:py-16" id="<?php echo esc_html( $block_id ); ?>">
    <div class="mk:w-full mk:max-w-site mk:mx-auto">
        <?php if( $heading ) { ?>
            <h2 class="mk:text-3xl mk:mb-8"><?php echo esc_html( $heading ); ?></h2>
        <?php } ?>
        <div class="mk:grid mk:md:grid-cols-3 mk:gap-x-4 mk:gap-y-8">
            <?php foreach($cards as $card) { 
                $card_title = $card['title'];
                $text = $card['text'];
                $cta = $card['cta'];
                $image = $card['image']; ?>
                <div class="mk:flex mk:flex-col mk:justify-between">
                    <div>
                        <?php if( $image ) { ?>
                            <img class="mk:w-full mk:h-60 mk:object-cover mk:mb-4" src="<?php echo esc_html( $image['url'] ); ?>" alt="<?php echo esc_html( $image['alt'] ); ?>">
                        <?php } ?>
                        <h3 class="mk:text-lg mk:mb-2">
                            <?php echo esc_html( $card_title ); ?>
                        </h3>
                        <div class="prose">
                            <?php echo wp_kses_post( $text ); ?>
                        </div>
                    </div>
                    <?php if( $cta ) { ?>
                        <div class="mk:mt-6">
                            <a class="btn" href="<?php echo esc_html( $cta['url'] ); ?>" target="<?php echo esc_html( $cta['target'] ); ?>">
                                <?php echo esc_html( $cta['title'] ); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
	</div>
</div>
