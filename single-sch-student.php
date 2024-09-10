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
                
                <!-- نمایش نام دانش‌آموز -->
                <h1><?php the_title(); ?></h1>

                <!-- نمایش تصویر شاخص -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="student-thumbnail">
                        <?php the_post_thumbnail( 'student-thumbnail' ); ?>
                    </div>
                <?php endif; ?>

                <!-- نمایش محتوای کامل -->
                <div class="student-content">
                    <?php the_content(); ?>
                </div>

                <!-- دکمه View Portfolio -->
                <div class="portfolio-button">
                    <a href="#" class="button">View Portfolio</a>
                </div>

                <!-- عنوان Meet other Designer students -->
                <h2>Meet other Designer students:</h2>

                <!-- لینک به سایر دانش‌آموزان در همان ترم تاکسونومی -->
                <div class="related-students">
                    <?php
                    // دریافت ترم‌های مرتبط با پست فعلی
                    $terms = get_the_terms( get_the_ID(), 'sch-student-category' );

                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            // کوئری برای نمایش پست‌های دیگر در همان ترم تاکسونومی
                            $related_students_args = array(
                                'post_type' => 'sch-student',
                                'posts_per_page' => 3,
                                'post__not_in' => array( get_the_ID() ), // حذف پست فعلی از نتایج
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
