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
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <h1><?php the_title(); ?></h1>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="student-thumbnail">
                        <?php the_post_thumbnail( 'student-thumbnail' ); ?>
                    </div>
                <?php endif; ?>

                <div class="student-content">
                    <?php the_content(); ?>
                </div>

                <div class="portfolio-button">
                    <a href="#" class="button">View Portfolio</a>
                </div>

                <?php
                $terms = get_the_terms( get_the_ID(), 'sch-student-category' );

                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        if ( $term->slug == 'designers' ) {
                            echo '<h2>Meet other Designer students:</h2>';
                        } elseif ( $term->slug == 'developer' ) {
                            echo '<h2>Meet other Developer students:</h2>';
                        }
                    }
                }
                ?>

                <div class="related-students">
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
                                echo '<ul>';
                                while ( $related_students_query->have_posts() ) {
                                    $related_students_query->the_post();
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
