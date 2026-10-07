/**
 * Header and navigation functionality.
 *
 * @package Dan Taylor 2026 Theme
 */

/* phpcs:disable */

// Open/close mobile main menu.
document.getElementById( 'main-menu-toggle' ).addEventListener('click', function () {
	const menu_panel = document.getElementById( 'site-nav-mobile' );

	if (menu_panel.classList.contains( 'open' )) {
		menu_panel.classList.remove( 'open' );
		menu_panel.classList.add( 'mk:translate-x-full' );
		this.classList.remove( 'active' );
		document.body.classList.remove( 'mk:overflow-hidden' );

		setTimeout(() => {
			menu_panel.classList.add( 'mk:hidden' );
		}, 300);
	} else {
		menu_panel.classList.remove( 'mk:hidden' );
		void menu_panel.offsetWidth;

		menu_panel.classList.add( 'open' );
		menu_panel.classList.remove( 'mk:translate-x-full' );
		this.classList.add( 'active' );
		document.body.classList.add( 'mk:overflow-hidden' );
	}
});

/* phpcs:enable */