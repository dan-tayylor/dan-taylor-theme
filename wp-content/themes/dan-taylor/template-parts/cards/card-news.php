<?php
/**
 * News Card.
 *
 * @package dantaylor_starter_theme
 * @since 1.0.0
 */

$card_id = $args ?? null;
if ( $card_id ) {
	$card_id = $card_id;
} else {
	$card_id = '';
}

$image = get_the_post_thumbnail(
	$card_id,
	'small',
	array(
		'class' => 'mk:w-full mk:h-64 mk:object-cover',
	)
);

$post_title = get_the_title( $card_id );
$excerpt    = get_the_excerpt( $card_id );
$post_link = get_the_permalink( $card_id );
?>

<a class="mk:group mk:block mk:rounded mk:overflow-hidden mk:bg-misty mk:shadow-lg mk:hover:shadow-xl mk:transition-all mk:duration-500 " href="<?php echo esc_html( $post_link ); ?>">
    <?php if ( $image ) : ?>
        <?php echo wp_kses_post( $image ); ?>
    <?php endif; ?>
    <div class="mk:flex mk:flex-col mk:justify-between mk:px-5 mk:py-6">
        <div>
            <h3 class="mk:group-hover:text-orange mk:font-space mk:text-xl mk:font-semibold mk:leading-tight mk:mb-2 mk:transition-all mk:duration-300"><?php echo esc_html( $post_title ); ?></h3>
            <div class="prose mk:mb-3">
                <?php echo wp_kses_post( $excerpt ); ?>
            </div>
        </div>
    </div>
</a>
