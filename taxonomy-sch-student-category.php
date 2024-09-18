<?php
/**
 * The template for displaying archive pages for students taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php single_term_title(); ?></h1> 
	</header><!-- .page-header -->

	<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
	?>

	<article class="student-box">
        <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
            <?php the_post_thumbnail( 'student-thumbnail' ); ?>
        </a>

        <div class="student-taxonomy-description">
            <?php the_content(); ?>
        </div>
    </article>

	<?php
		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>#primary

<?php
get_footer();
?>
