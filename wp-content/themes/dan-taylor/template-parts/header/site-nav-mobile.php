<?php
/**
 * Displays mobile nav
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

?>

<div id="site-nav-mobile" class="mobile-nav mk:hidden mk:fixed mk:top-18 mk:left-0 mk:translate-x-full mk:w-full mk:h-dvh mk:z-100 mk:overflow-x-hidden mk:bg-white mk:transition-all mk:duration-300 mk:ease-bezier">
	<div class="mk:h-full mk:pt-16 mk:p-4 mk:overflow-y-auto">
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'mk:font-space mk:text-3xl mk:font-semibold mk:text-black mk:text-center',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'add_li_class'    => 'mk:leading-none mk:mb-4',
				'fallback_cb'     => false,
			)
		); ?>
		<div class="social-icons mk:flex mk:justify-center mk:gap-3 mk:mt-8">
			<a class="mk:w-6 mk:block" href="https://www.linkedin.com/in/daniel-taylor-30646260" target="_blank" aria-label="LinkedIn">
				<?php echo dan_theme_get_icon_svg( 'ui', 'linkedin', 24 ); ?>
			</a>
			<a class="mk:w-6 mk:block" href="https://github.com/dan-tayylor" target="_blank" aria-label="GitHub">
				<?php echo dan_theme_get_icon_svg( 'ui', 'github', 24 ); ?>
			</a>
		</div>
	</div>
</div>