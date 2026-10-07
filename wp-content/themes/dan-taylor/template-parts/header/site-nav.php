<?php
/**
 * Displays the site navigation.
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'dan_theme' ); ?>">
		<div class="mk:hidden mk:md:block">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu-wrapper mk:font-faustina mk:flex mk:items-center mk:gap-2 mk:text-xl',
					'container_class' => 'primary-menu-container',
					'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
					'fallback_cb'     => false,
				)
			);
			?>
		</div>
	</nav>
	<?php
endif;
