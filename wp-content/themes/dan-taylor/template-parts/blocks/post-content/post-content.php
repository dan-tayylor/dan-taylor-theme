<?php
/**
 * Post Content.
 *
 * Body content for posts.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$text    = get_field( 'text' );
$post_cta = get_field( 'post_cta', 'options' );
$cta_heading = $post_cta['heading'] ?? '';
$cta_text = $post_cta['text'] ?? '';
$cta_link = $post_cta['cta'] ?? '';

// Block ID.
$block_id = 'post-content-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'post-content-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> mk:px-4 mk:md:px-8 mk:pb-8 mk:md:pb-16 mk:pt-4 mk:md:pt-0">
	<div class="mk:w-full mk:max-w-site-xs mk:mx-auto mk:pb-8 mk:md:pb-16">
		<?php if($heading) { ?>
			<div class="mk:md:pr-8">
				<h2 class="mk:font-space mk:text-3xl mk:font-medium mk:text-smoke"><?php echo esc_html( $heading ); ?></h2> 
			</div>
		<?php } ?>
		<div>
			<?php if ( $text ) : ?>
				<div class="prose">
					<?php echo wp_kses_post( $text ); ?>
				</div>
			<?php endif; ?>
		</div>
		<aside class="mk:mt-16 mk:rounded-lg mk:bg-orange-50 mk:px-4 mk:md:px-8 mk:md:pr-28 mk:py-6 mk:md:py-10">
  			<p class="mk:font-space mk:text-2xl mk:font-semibold"><?php echo esc_html( $cta_heading ); ?></p>
			<p class="mk:mt-2">
				<?php echo esc_html( $cta_text ); ?>
			</p>
			<?php if($cta_link) { ?>
				<a href="<?php echo esc_url( $cta_link['url'] ); ?>" target="<?php echo esc_attr( $cta_link['target'] ); ?>" class="mk:mt-4 mk:inline-block mk:font-medium mk:text-orange mk:underline">
					<?php echo esc_html( $cta_link['title'] ); ?>
				</a>
			<?php } else {?>
				<a href="mailto:dan@thedantaylor.com?subject=WordPress%20maintenance%20enquiry&body=Hi%20Dan%2C%0A%0ASite%20URL%3A%20%0AWhat%20it%20is%20(brochure%20site%2C%20shop%2C%20membership...)%3A%20%0AAnything%20that%27s%20worrying%20you%3A%20%0AWho%20hosts%20it%3A%20%0A%0AThanks"
					class="mk:mt-4 mk:block mk:font-medium mk:text-orange mk:underline">
					Get in touch
				</a>
			<?php } ?>
		</aside>
	</div>
</div>
