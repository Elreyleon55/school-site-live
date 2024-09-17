<?php
/**
 * The template for displaying the Staff Page
 *
 * @package FWD_Starter_Theme
 */
get_header();
?>

	<main id="primary" class="site-main">

		<article class="header-section">
			<h1>
			<?php 
		the_title();
		?>
		</h1>
		<?php
		the_content();
		?>
		</article>
		<?php
		$args = array(
			'post_type' => 'sch-staff',
			'posts_per_page' => -1 
		);

		$staff_query = new WP_Query($args);

		if ($staff_query->have_posts()) :
			while ($staff_query->have_posts()) : $staff_query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="staff-thumbnail">
							<?php the_post_thumbnail('medium'); ?>
						</div>
					<?php endif; ?>
				</article>
			<?php endwhile;
			wp_reset_postdata();
		else : ?>
			<p>No staff members found.</p>
		<?php endif; ?>

	</main><!-- #primary -->

<?php
get_footer();