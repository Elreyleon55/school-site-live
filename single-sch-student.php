<?php
/**
 * The template for displaying single student pages
 *
 * @package School_site_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-student-item'); ?>>
                
                <h1 class="student-title"><?php the_title(); ?></h1>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-student-thumbnail">
                        <?php the_post_thumbnail( 'student-thumbnail' ); ?>
                    </div>
                <?php endif; ?>

                <div class="single-student-content">
                    <?php the_content(); ?>
                </div>

                <?php
                $terms = get_the_terms( get_the_ID(), 'sch-student-category' );

                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        if ( $term->slug == 'designers' ) {
                            echo '<h2 class="related-title">Meet other Designer students:</h2>';
                        } elseif ( $term->slug == 'developer' ) {
                            echo '<h2 class="related-title">Meet other Developer students:</h2>';
                        }
                    }
                }
                ?>

                <div class="related-students-list">
                    <?php
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {

                            $related_students_args = array(
                                'post_type' => 'sch-student',
                                'posts_per_page' => 3,
                                'post__not_in' => array( get_the_ID() ), 
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'sch-student-category',
                                        'field'    => 'slug',
                                        'terms'    => $term->slug,
                                    ),
                                ),
                            );
                            $related_students_query = new WP_Query( $related_students_args );

                            if ( $related_students_query->have_posts() ) {
                                echo '<ul class="related-students">';
                                while ( $related_students_query->have_posts() ) {
                                    $related_students_query->the_post();
                                    ?>
                                    <li class="related-student-item">
                                        <a href="<?php the_permalink(); ?>" class="related-student-link"><?php the_title(); ?></a>
                                    </li>
                                    <?php
                                }
                                echo '</ul>';
                            }
                            wp_reset_postdata();
                        }
                    }
                    ?>
                </div>
                
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
?>
