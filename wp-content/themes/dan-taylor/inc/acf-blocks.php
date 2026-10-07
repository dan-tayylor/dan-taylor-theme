<?php
/**
 * ACF block functions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dan_theme
 * @since 1.0.0
 */

/** Register gutenberg blocks. */
if (function_exists('acf_register_block_type')) {
	function hippo_acf_block_types()
	{
		// Get the blocks directory path
		$blocks_dir = get_template_directory() . '/template-parts/blocks';

		// Get all directories in the blocks folder
		$block_dirs = array_filter(glob($blocks_dir . '/*'), 'is_dir');

		// Register each block
		foreach ($block_dirs as $block_dir) {
			// Get the block name from the directory path
			$block_name = basename($block_dir);

			// Skip .DS_Store and any other hidden directories
			if (strpos($block_name, '.') === 0) {
				continue;
			}

			// Register the block
			register_block_type($block_dir);
		}
	}
	add_action('acf/init', 'hippo_acf_block_types');
}


/** Set allowed block types. */
function dan_theme_allowed_block_types( $allowed_blocks ) {

    // Path to your block folders.
    $blocks_dir = get_template_directory() . '/template-parts/blocks';

    // Get all directories inside blocks.
    $block_dirs = array_filter( glob( $blocks_dir . '/*' ), 'is_dir' );

    $allowed = array();

    foreach ( $block_dirs as $block_dir ) {
        $block_name = basename( $block_dir );

        // Skip hidden/system directories.
        if ( strpos( $block_name, '.' ) === 0 ) {
            continue;
        }

        // Add ACF block slug.
        $allowed[] = 'acf/' . $block_name;
    }

    return $allowed;
}
add_filter( 'allowed_block_types_all', 'dan_theme_allowed_block_types', 25 );
