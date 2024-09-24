<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_site
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    $args = array(
        'post_type'      => 'sch-student',
        'posts_per_page' => -1, 
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    $student_query = new WP_Query( $args );

    if ( $student_query->have_posts() ) : ?>

        <div class="student-list">
            <?php while ( $student_query->have_posts() ) : $student_query->the_post(); ?>
                <article class="student-item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="student-thumbnail">
						<?php the_post_thumbnail( 'student-thumbnail' ); ?>

                        </div>
                    <?php endif; ?>

                
                    <div class="student-excerpt">
                        <?php the_excerpt(); ?>
                    </div>

              
                    <div class="student-taxonomy">
                        <?php
                        the_terms( get_the_ID(), 'sch-student-category', 'Category: ', ', ', '' );
                        ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

    <?php else : ?>
        <p>No students found.</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</main>

<?php
get_footer();
