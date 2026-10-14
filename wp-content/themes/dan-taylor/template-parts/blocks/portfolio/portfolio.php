<?php
/**
 * Portfolio
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading   = get_field( 'heading' );
$text   = get_field( 'text' );
$portfolio = get_field( 'portfolio' );
$cta = get_field( 'cta' );

// Block ID.
$block_id = 'portfolio-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'portfolio-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_html( $block_id ); ?>" class="<?php echo esc_html( $class_name ); ?> mk:px-4 mk:md:px-8 mk:py-16">
	<div class="mk:relative mk:w-full mk:max-w-site mk:mx-auto mk:border-t-2 mk:border-orange mk:pt-16 mk:md:pt-24">
        <div class="fade-in-group mk:max-w-2xl mk:mx-auto mk:mb-16 mk:text-center">
            <div class="mk:flex mk:justify-center mk:items-center">
                <?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 32 ); ?>
                <h2 class="mk:font-space mk:font-semibold mk:text-2xl mk:md:text-3xl"><?php echo esc_html( $heading ); ?></h2> 
                <?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 32 ); ?>
            </div>
            <?php if($text) { ?>
                <div class="prose mk:mt-6">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php } ?>
        </div>
        <?php if($portfolio) { ?>
            <div class="mk:grid mk:md:grid-cols-2 mk:gap-8">
                <?php foreach($portfolio as $post) {
                    setup_postdata( $post );
                    $work_title = get_the_title( $post->ID );
                    $images  = get_field( 'gallery', $post->ID );
                    $tech    = get_field( 'technologies', $post->ID );
                    $company = get_field( 'company', $post->ID );
                    $site_url = get_field( 'site_url', $post->ID );
                    ?>
                    <div class="mk:flex mk:flex-col mk:justify-between mk:mb-4">
                        <div>
                            <?php if($images) { ?>
                                <div class="portfolio-slideshow mk:aspect-video mk:overflow-hidden mk:rounded-t-2xl mk:relative mk:border-2 mk:border-charcoal">
                                    <?php foreach($images as $index => $image) {
                                        $image_element = $image['image']; ?>
                                            <img class="portfolio-slideshow__slide<?php echo 0 === $index ? ' is-active' : ''; ?>" src="<?php echo esc_url( $image_element['url'] ); ?>" alt="<?php echo esc_attr( $image_element['alt'] ); ?>" loading="lazy">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if($tech) { ?>
                                <div class="mk:mt-4 mk:mb-3">
                                    <div class="mk:flex mk:flex-wrap">
                                        <?php foreach($tech as $t) { ?>
                                            <div class="mk:font-space mk:font-semibold mk:mr-2 mk:text-xs mk:shadow-2xl mk:text-orange mk:border-2 mk:border-orange mk:px-3 mk:py-1 mk:rounded-4xl"><?php echo esc_html( $t['text'] ); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <h3 class="mk:font-space mk:font-semibold mk:text-2xl mk:mb-2"><?php echo esc_html( $work_title ); ?></h3>
                            <div class="prose">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="mk:md:flex mk:justify-between mk:items-center mk:md:flex-row-reverse mk:mt-4 mk:md:mt-8">
                            <?php if($company) { ?>
                                <p>Made for <a href="<?php echo esc_url($company['url']); ?>"  target="_blank" class="mk:underline mk:underline-offset-4"><?php echo esc_html( $company['title'] ); ?></a></p>
                            <?php } ?>
                            <div>
                                <?php if( $site_url) { ?>
                                    <a href="<?php echo esc_url( $site_url ); ?>" target="_blank" class="brace-btn mk:mt-8 mk:md:mt-0">
                                        <svg class="brace-svg brace-l" width="14" height="26" viewBox="0 0 14 26">
                                            <path d="M11,3 Q7.5,3 4,3 Q4,13 4,23 Q7.5,23 11,23"/>
                                        </svg>
                                        View Site
                                        <svg class="brace-svg brace-r" width="14" height="26" viewBox="0 0 14 26">
                                            <path d="M3,3 Q6.5,3 10,3 Q10,13 10,23 Q6.5,23 3,23"/>
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }
                wp_reset_postdata(); ?>
            </div>
        <?php } ?>
        <?php if($cta) { ?>
            <div class="mk:flex mk:justify-center mk:mt-8">
                <a class="btn-outline mk:mt-8" href="<?php echo esc_html( $cta['url'] ); ?>" target="<?php echo esc_html( $cta['target'] ); ?>">
                    <?php echo esc_html( $cta['title'] ); ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<style>
	.portfolio-slideshow {
		opacity: 0;
		transform: translateY(16px);
		transition: opacity 0.6s ease, transform 0.6s ease;
	}
	.portfolio-slideshow.is-in-view {
		opacity: 1;
		transform: translateY(0);
	}
	@media (prefers-reduced-motion: reduce) {
		.portfolio-slideshow {
			transition: none;
		}
	}
	.portfolio-slideshow__slide {
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		transform: translateX(100%);
		transition: transform 0.6s ease;
		z-index: 0;
	}
	.portfolio-slideshow__slide.is-active {
		transform: translateX(0);
		z-index: 2;
	}
</style>
