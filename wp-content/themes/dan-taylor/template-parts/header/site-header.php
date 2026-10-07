<?php
/**
 * Displays the site header.
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

// The header branding starts hidden and reveals on scroll when a hero block is present on the page.
$has_hero_branding = has_block( 'acf/hero' );
$header_class      = 'site-header mk:sticky mk:top-0 mk:z-100 mk:px-4 mk:md:px-8 mk:py-4';
if ( $has_hero_branding ) {
	$header_class .= ' site-header--has-hero';
}
?>

<header id="masthead" class="<?php echo esc_attr( $header_class ); ?>">
	<div class="mk:w-full mk:max-w-site mk:mx-auto mk:flex mk:justify-between mk:items-center">
		<?php get_template_part( 'template-parts/header/site-branding', null, array( 'hide_until_scroll' => $has_hero_branding ) ); ?>
		<?php get_template_part( 'template-parts/header/site-nav' ); ?>
		<div class="menu-button-container mk:md:hidden">
			<button id="main-menu-toggle" class="mk:flex mk:items-center mk:gap-2 mk:ml-auto mk:md:ml-0 mk:group mk:outline-none mk:cursor-pointer mk:touch-manipulation" aria-label="Navicon">
				<div class="mk:w-8 mk:h-5 mk:flex mk:flex-col mk:justify-between">
					<span class="menu-line mk:block mk:w-full mk:h-0.5 mk:bg-orange mk:transition-transform mk:duration-200"></span>
					<span class="menu-line mk:block mk:w-full mk:h-0.5 mk:bg-orange mk:transition-opacity mk:duration-200"></span>
					<span class="menu-line mk:block mk:w-full mk:h-0.5 mk:bg-orange mk:transition-transform mk:duration-200"></span>
				</div>
			</button>
		</div>
	</div>
	<?php get_template_part( 'template-parts/header/site-nav-mobile' ); ?>
</header>

<?php if ( $has_hero_branding ) : ?>
<style>
	.site-header--has-hero {
		background-color: transparent;
		transition: background-color 0.3s ease, box-shadow 0.3s ease;
		background-color: rgba(250, 250, 250, 0.1);
		backdrop-filter: blur(10px);
	}
	
	.site-branding__group {
		opacity: 0;
		transform: translateY(-8px);
		pointer-events: none;
		transition: opacity 0.3s ease, transform 0.3s ease;
	}
	.site-branding__group.is-visible {
		opacity: 1;
		transform: translateY(0);
		pointer-events: auto;
	}
</style>
<?php endif; ?>
