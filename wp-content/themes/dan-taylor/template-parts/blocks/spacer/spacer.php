<?php
/**
 * Logos.
 *
 * Spacer block template.
 *
 * @package dan_theme
 * @since 1.0.0
 */

$spacing = get_field( 'spacing' );
$spacing_mobile = $spacing / 2;
?>

<div class="spacer-block mk:hidden mk:md:block" style="height: <?php echo esc_attr( $spacing ); ?>px;"></div>
</div>
<div class="spacer-block-mob mk:md:hidden" style="height: <?php echo esc_attr( $spacing_mobile ); ?>px;"></div>
</div>