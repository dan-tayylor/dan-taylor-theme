<?php
/**
 * Pillar Stack.
 *
 * A left-hand index of items beside a right-hand column of numbered panels.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$text = get_field('text'); 
$items = get_field( 'items' );

// Block ID.
$block_id = 'pillar-stack-block-' . ( $block['id'] ?? wp_unique_id() );
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'pillar-stack-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
?>

<?php if ( $items ) : ?>
	<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> mk:px-4 mk:md:px-8 mk:py-14">
		<div class="mk:max-w-site mk:mx-auto mk:border-t-2 mk:border-orange mk:pt-16 mk:md:pt-24">
			<div class="mk:max-w-2xl mk:mx-auto mk:mb-16 mk:text-center">
				<div class="mk:text-center mk:flex mk:justify-center mk:items-center">
					<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-left', 32 ); ?>
					<h2 class="mk:font-faustina mk:text-3xl mk:tracking-wide mk:mb-1.5"><?php echo esc_html( $heading ); ?></h2> 
					<?php echo dan_theme_get_icon_svg( 'ui', 'bracket-right', 32 ); ?>
				</div>
				<?php if($text) { ?>
					<div class="prose mk:mt-6">
						<?php echo wp_kses_post($text); ?>
					</div>
				<?php } ?>
			</div>
			<div class="pillar-stack mk:flex mk:flex-col mk:md:flex-row mk:gap-12 mk:md:gap-8 mk:items-start">
				<nav class="pillar-stack-nav mk:w-full mk:md:w-[443px] mk:shrink-0 mk:pt-4" aria-label="<?php esc_attr_e( 'Pillars', 'datatonic' ); ?>">
					<ul class="mk:flex mk:flex-col mk:gap-8">
						<?php foreach ( $items as $item_index => $item ) : ?>
							<?php
							$panel_id = $block_id . '-panel-' . $item_index;
							?>
							<?php if ( $item_index > 0 ) : ?>
								<li class="mk:border-t mk:border-text-secondary/32" role="presentation"></li>
							<?php endif; ?>
							<li class="pillar-stack-nav-item <?php echo 0 === $item_index ? 'is-active' : ''; ?>" data-index="<?php echo esc_attr( $item_index ); ?>">
								<a href="#<?php echo esc_attr( $panel_id ); ?>" class="pillar-stack-nav-link mk:flex mk:gap-4 mk:items-center mk:px-2 mk:no-underline">
									<span class="pillar-stack-nav-icon mk:shrink-0 mk:relative mk:size-10">
										<?php if ( ! empty( $item['icon']['url'] ) ) : ?>
											<img src="<?php echo esc_url( $item['icon']['url'] ); ?>" alt="" aria-hidden="true" width="40" height="40">
										<?php endif; ?>
									</span>
									<p class="pillar-stack-nav-label mk:font-faustina mk:text-xl">
										<?php echo esc_html( $item['title'] ); ?>
									</p>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="pillar-stack-nav-spacer" aria-hidden="true"></div>
				</nav>
				<div class="pillar-stack-panels mk:flex-1 mk:flex mk:flex-col mk:gap-4 mk:w-full">
					<?php foreach ( $items as $item_index => $item ) : 
						$date = $item['date'];
						?>
						<div id="<?php echo esc_attr( $block_id . '-panel-' . $item_index ); ?>" class="pillar-stack-panel mk:bg-orange mk:border mk:border-white/32 mk:rounded-lg mk:flex mk:flex-col mk:justify-center" data-index="<?php echo esc_attr( $item_index ); ?>" style="--i: <?php echo esc_attr( (int) $item_index ); ?>">
							<div class="pillar-stack-panel-inner mk:flex mk:flex-col mk:gap-6 mk:md:gap-8 mk:px-6 mk:md:px-10 mk:py-8 mk:md:py-12 mk:w-full">
								<?php if ( ! empty( $item['tag'] ) ) : ?>
									<span class="mk:inline-flex mk:self-start mk:bg-white/12 mk:backdrop-blur-sm mk:rounded-xs mk:p-1.5 mk:text-xs mk:text-white mk:border mk:border-white/40">
										<?php echo esc_html( $item['tag'] ); ?>
									</span>
									<hr class="mk:border-0 mk:border-t mk:border-white/32 mk:m-0">
								<?php endif; ?>
								<div class="pillar-stack-panel-content">
									<p class="pillar-stack-panel-number mk:text-white mk:shrink-0 mk:mb-2">
										<?php echo esc_html( $date ); ?>
									</p>
									<div class="mk:flex mk:flex-col mk:gap-2">
										<?php if ( ! empty( $item['title'] ) ) : ?>
											<p class="mk:font-faustina mk:text-2xl mk:tracking-wide mk:text-white mk:mb-3"><?php echo esc_html( $item['title'] ); ?></p>
										<?php endif; ?>
										<?php if ( ! empty( $item['text'] ) ) : ?>
											<div class="prose mk:text-white dark-list-items"><?php echo wp_kses_post( $item['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by wp_kses_post(). ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="pillar-stack-panel-dwell" aria-hidden="true"></div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
