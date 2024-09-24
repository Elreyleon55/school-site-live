<?php

/**
 * The template for displaying the home page
 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme

 * The template for displaying the Home Page.
 *
 * @Kaleb https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SCH_School_Theme

 */

get_header();
?>


	<main id="primary" class="site-main">

		<section class="container">
			<h1><?php the_title(); ?></h1>
			<?php 
				the_content();
			?>

		</section>

		<?php
		?>
				<section class="home-blog">
					<article class="articles">
							<?php
							$args = array(
								'post_type'     => 'post',
								'posts_per_page' => 3,
							);
							$blog_query  = new WP_Query( $args );
							if( $blog_query -> have_posts() ){
								while( $blog_query -> have_posts() ){
									$blog_query -> the_post();
									?>
										<article>
											<a href=" <?php the_permalink(); ?> ">
												<?php the_post_thumbnail( 'lastest-blog-post' )  ?>
												<h3 class="article-title"><?php the_title(); ?></h3>
											</a>
										</article>
									<?php
		
								}
								wp_reset_postdata();
							}
							?>
					</article>

				</section>

				<section>

			<?php
		
		?>

	</main><!-- #primary -->

<?php
get_footer();

?>


