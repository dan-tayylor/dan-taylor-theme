<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since Dan Theme 1.0.0
 * @package WordPress
 */

?>
</main>
</div>
</div>

<footer id="colophon" class="site-footer mk:px-4 mk:md:px-8 mk:py-8 ">
	<div class="mk:w-full mk:max-w-site mk:mx-auto mk:text-center mk:border-t-2 mk:border-orange/80 mk:pt-8">
		<div class="social-icons mk:flex mk:justify-center mk:gap-3 mk:mb-4">
			<a class="mk:w-6 mk:block" href="https://www.linkedin.com/in/daniel-taylor-30646260" target="_blank" aria-label="LinkedIn">
				<?php echo dan_theme_get_icon_svg( 'ui', 'linkedin', 24 ); ?>
			</a>
			<a class="mk:w-6 mk:block" href="https://github.com/dan-tayylor" target="_blank" aria-label="Github">
				<?php echo dan_theme_get_icon_svg( 'ui', 'github', 24 ); ?>
			</a>
		</div>
		<p class="">© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>
</div>

<?php wp_footer(); ?>

</body>

</html>