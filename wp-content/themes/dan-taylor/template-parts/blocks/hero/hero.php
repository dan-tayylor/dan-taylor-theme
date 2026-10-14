<?php
/**
 * Hero Homepage.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading         = get_field( 'heading' );
$job_title    = get_field( 'job_title' );
$text    = get_field( 'text' );
$image         = get_field( 'image' );
$logo = get_field('logo', 'options');

// Block ID.
$block_id = 'hero-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'hero-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_html( $block_id ); ?>" class="<?php echo esc_html( $class_name ); ?> mk:relative mk:px-4 mk:md:px-8 mk:py-8 mk:md:py-16">
	<div class="mk:max-w-site mk:mx-auto mk:h-full mk:flex mk:items-center">
		<div class="mk:md:flex mk:items-center">
			<div class="mk:md:w-1/2 hero-text">
				<div id="hero-branding" class="mk:flex mk:items-center mk:gap-3 mk:mb-2">
					<?php if ( $logo ) : ?>
						<div class="site-logo mk:w-10"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"></div>
					<?php endif; ?>
					<h1 class="mk:font-space mk:text-4xl mk:font-semibold"><?php echo esc_html( $heading ); ?></h1>
				</div>
				<h2 class="mk:font-space mk:text-2xl mk:font-semibold mk:mb-4"><?php echo esc_html($job_title); ?></h2>
				<div class="prose mk:text-lg">
					<?php echo wp_kses_post( $text ); ?>
				</div>
			</div>
			<?php if ( $image ) { ?>
				<div class="mk:md:w-1/2 mk:mt-16 mk:md:mt-0">
					<div class="hero-photo mk:w-80 mk:h-80 mk:mx-auto mk:rounded-full">
						<div class="hero-photo__blob"></div>
						<img class="mk:w-full mk:h-full mk:object-cover" src="<?php echo esc_html( $image['url'] ); ?>" alt="<?php echo esc_html( $image['alt'] ); ?>">
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<style>
  .hero-photo {
    position: relative;
    width: 280px;
    height: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
 
  .hero-photo__blob {
    position: absolute;
    width: 118%;
    height: 118%;
    background: #D85A30;
    border-radius: 42% 58% 65% 35% / 45% 40% 60% 55%;
    animation: blobMorph 9s ease-in-out infinite;
    z-index: 1;
  }
 
  .hero-photo img {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    display: block;
  }
 
  @keyframes blobMorph {
    0%, 100% {
      border-radius: 42% 58% 65% 35% / 45% 40% 60% 55%;
      transform: rotate(0deg) scale(1);
    }
    50% {
      border-radius: 60% 40% 45% 55% / 55% 60% 40% 45%;
      transform: rotate(8deg) scale(1.04);
    }
  }
 
  @media (prefers-reduced-motion: reduce) {
    .hero-photo__blob {
      animation: none;
    }
  }
</style>