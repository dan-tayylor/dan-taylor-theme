<?php
/**
 * Displays header site branding
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

$logo = get_field( 'logo', 'option' );
$hide_until_scroll  = ! empty( $args['hide_until_scroll'] );
$group_class        = 'mk:flex mk:items-center mk:gap-3';
if ( $hide_until_scroll ) {
	$group_class .= ' site-branding__group';
}

?>

<div class="site-branding">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="header-branding" class="">
		<?php if ( $logo ) : ?>
			<div class="site-logo mk:w-14"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"></div>
		<?php endif; ?>
	</a>
</div>
