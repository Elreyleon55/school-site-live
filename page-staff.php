<?php
/**
 * Template Name: Staff Page
 * The template for displaying Staff Page with specific conditions for post types
 *
 * @package School_site_Theme
 */
get_header();
?>

<main id="primary" class="site-main staff-page">

    <?php
    $args_no_term = array(
        'post_type' => 'sch-staff',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'sch-staff-type',
                'operator' => 'NOT EXISTS', 
            ),
        ),
    );

    $no_term_query = new WP_Query( $args_no_term );

    if ( $no_term_query->have_posts() ) : ?>
        <?php while ( $no_term_query->have_posts() ) : $no_term_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1> 
                <p><?php the_field('biography'); ?></p> 
            </article>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    ?>

    <!-- Administrative Staff -->
    <?php
    $args_admin = array(
        'post_type' => 'sch-staff',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'sch-staff-type',
                'field'    => 'slug',
                'terms'    => 'administrative', 
            ),
        ),
    );

    $admin_query = new WP_Query( $args_admin );

    if ( $admin_query->have_posts() ) : ?>
        <h2>Administrative Staff</h2>
        <div class="administrative-staff">
        <?php while ( $admin_query->have_posts() ) : $admin_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h3><?php the_title(); ?></h3>
                <p><?php the_field('biography'); ?></p>
            </article>
        <?php endwhile; ?>
        </div>
        <?php
        wp_reset_postdata();
    endif;
    ?>

    <!-- Faculty Staff -->
    <?php
    $args_faculty = array(
        'post_type' => 'sch-staff',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'sch-staff-type',
                'field'    => 'slug',
                'terms'    => 'faculty', 
            ),
        ),
    );

    $faculty_query = new WP_Query( $args_faculty );

    if ( $faculty_query->have_posts() ) : ?>
        <h2>Faculty Staff</h2>
        <div class="faculty-staff">
        <?php while ( $faculty_query->have_posts() ) : $faculty_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h3><?php the_title(); ?></h3>
                <p><?php the_field('biography'); ?></p>

                <?php $courses = get_field('courses'); ?>
                <?php if ( $courses ) : ?>
                    <p><strong>Courses:</strong> <?php echo esc_html( $courses ); ?></p>
                <?php endif; ?>
                <p><a href="<?php the_field('instructor_website'); ?>" target="_blank">Visit Website</a></p>
            </article>
        <?php endwhile; ?>
        </div>
        <?php
        wp_reset_postdata();
    endif;
    ?>

</main><!-- #primary -->

<?php
get_footer();
