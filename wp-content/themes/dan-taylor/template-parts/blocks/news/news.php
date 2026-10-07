<?php
/**
 * News
 *
 * @package dan_theme
 * @since 1.0.0
 */

$heading = get_field( 'heading' );
$categories = get_categories();

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$news_posts = get_posts( $args );

// Block ID.
$block_id = 'news-block';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Additional classes.
$class_name = 'news-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
} ?>

<div id="<?php echo esc_html( $block_id ); ?>" class="<?php echo esc_html( $class_name ); ?> mk:px-4 mk:md:px-8 mk:py-16">
	<div class="mk:w-full mk:max-w-site mk:mx-auto">
        <h2 class="mk:text-3xl mk:mb-5"><?php echo esc_html( $heading ); ?></h2>
        <?php if($categories) { ?>
            <div class="mk:py-8">
                <div class="mk:flex mk:gap-6 mk:mt-2">
                    <label class="filter-item">
                        <input type="radio" name="categories-filter" value="all" class="filter-checkbox mk:hidden">
                        <?php echo __( 'All' ); ?>
                    </label>
                    <?php foreach($categories as $category) { 
                        $category_name = $category->name;
                        $category_id = $category->term_id;
                        ?>
                        <label class="filter-item">
                            <input type="radio" name="categories-filter" value="<?php echo esc_html($category_id); ?>" class="filter-checkbox mk:hidden">
                            <?php echo esc_html( $category_name ); ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if($news_posts) { ?>
            <div id="news-listings-container" class="mk:grid mk:grid-cols-3 mk:gap-6">
                <?php foreach($news_posts as $news) { 
                    $post_id = $news->ID;
                    get_template_part( 'template-parts/cards/card', 'news', $post_id );
                } ?>
            </div>
            <div class="mk:pt-16 mk:text-center">
				<div id="load-more-button" class="btn" data-page="2">
					<?php echo __( 'Load More', 'make-theme' ); ?>
				</div>
			</div>
        <?php } ?>
    </div>
</div>
