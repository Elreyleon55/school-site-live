<?php
//making a change
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_site
 */

?>


	<footer id="colophon" class="site-footer">
		<div class="site-info">
				<?php
				?><h2>Credits</h2><?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Created by: %1$s %2$s.', 'school-theme' ), '', '<a href="http://ezequiel.space">Ezequiel Mahdi</a>' );
				?>
			<p>Photos courtesy of <a href="https://burst.shopify.com/" target="_blank" rel="noopener">Burst</a>.</p>
			<nav class="footer-nav">
				<h2>Links</h2>
				<div class="menu-footer-menu-container">
					<ul id="menu-footer-menu" class="menu">
						<li id="menu-item-334" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-334">
							<a href="https://ezequiel.space/school-site-live/schedule/">Schedule</a>
						</li>
						<li id="menu-item-327" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-327">
							<a href="https://ezequiel.space/school-site-live/news/">News</a>
						</li>
					</ul>
				</div>		
			</nav>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
