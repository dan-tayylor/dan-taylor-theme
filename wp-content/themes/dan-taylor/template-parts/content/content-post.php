<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

$categories_list = get_the_category();
$modified  = get_the_modified_date( 'j F Y' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header mk:px-4 mk:md:px-8">
        <div class="mk:max-w-site-xs mk:mx-auto mk:py-8 mk:md:py-16">
            <?php if($categories_list) { ?>
                <div class="mk:flex mk:mb-6">
                    <?php foreach($categories_list as $cat ) { ?>
                        <div class="mk:mr-2 mk:mb-2 mk:font-space mk:text-sm mk:font-semibold mk:shadow-2xl mk:text-orange mk:border-2 mk:border-orange mk:px-3 mk:py-1 mk:rounded-4xl"><?php echo esc_html( $cat->name ); ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if ( is_singular() ) : ?>
                <?php the_title( '<h1 class="mk:font-space mk:text-4xl mk:md:text-6xl">', '</h1>' ); ?>
            <?php else : ?>
                <?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php endif; ?>
            <?php if($modified) { ?>
                <div class="mk:mt-4">
                    <p class="mk:font-space mk:text-sm">Last updated: <span class="mk:font-semibold"><?php echo esc_html( $modified ); ?></span></p>
                </div>
            <?php } ?>
        </div>
        <div class="mk:max-w-site-xs mk:mx-auto mk:mb-8 mk:rounded-lg mk:overflow-hidden">
            <?php dan_theme_post_thumbnail(); ?>
        </div>
    </div>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
