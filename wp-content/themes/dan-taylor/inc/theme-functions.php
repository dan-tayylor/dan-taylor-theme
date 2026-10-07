<?php
/**
 * Theme functions.
 *
 * @package dan_theme
 * @since 1.0.0
 */

/**
 * Load styles only for rendered blocks in a page.
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );


/** Allow SVG uploads.
 *
 * @param array $mimes The existing list of MIME types.
 * @return array Modified list of MIME types.
 */
function allow_svg_uploads( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_uploads' );

/** Fix SVG display in the media library.
 *
 * @param array $response The response for the attachment.
 * @return array Modified response for the attachment.
 */
function fix_svg_media_library( $response, $attachment = null ) {
	if ( 'image/svg+xml' === $response['mime'] ) {
		$response['sizes'] = array(
			'full' => array(
				'url'         => $response['url'],
				'width'       => 0,
				'height'      => 0,
				'orientation' => 'landscape',
			),
		);
	}
	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'fix_svg_media_library', 10, 2 );

/**
 * Gets the SVG code for a given icon.
 *
 * @since dan Theme 1.0.0
 * @package WordPress
 *
 * @param string $group The icon group.
 * @param string $icon  The icon.
 * @param int    $size  The icon size in pixels.
 * @return string
 */
function dan_theme_get_icon_svg( $group, $icon, $size = 24 ) {
	return Dan_theme_SVG_Icons::get_svg( $group, $icon, $size );
}

if ( ! function_exists( 'dan_theme_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function dan_theme_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
		</a>

			<?php
		endif; // End is_singular().
	}
}