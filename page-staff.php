<?php
/**
 * Template Name: Staff Page
 * The template for displaying Staff Page with specific conditions for post types
 *
 * @package FWD_Starter_Theme
 */
get_header();
?>

<main id="primary" class="site-main">

    <!-- شروع نمایش پست‌ها -->
    <?php
    $args = array(
        'post_type' => 'sch-staff',
        'posts_per_page' => -1,
    );

    $staff_query = new WP_Query( $args );

    if ( $staff_query->have_posts() ) :

        // متغیرها برای کنترل دسته‌بندی‌ها
        $has_administrative = false;
        $has_faculty = false;

        while ( $staff_query->have_posts() ) : $staff_query->the_post();
            // دریافت ترم‌های مرتبط با هر پست
            $terms = get_the_terms( get_the_ID(), 'sch-staff-type' );
            $term_name = ''; // مقدار پیش‌فرض

            if ( $terms && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $term_name = $term->name; // گرفتن نام اولین ترم
                }
            }

            // پست بدون ترم (بدون دسته‌بندی)
            if ( empty($terms) ) : ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><?php the_title(); ?></h2> <!-- نمایش عنوان پست -->
                    <p><?php the_field('biography'); ?></p> <!-- بیوگرافی -->
                </article>

            <?php
            // نمایش Administrative پست‌ها
            elseif ( $term_name === 'Administrative' ) :
                if (!$has_administrative) : ?>
                    <h2>Administrative Staff</h2> <!-- نمایش عنوان Administrative فقط یکبار -->
                    <?php $has_administrative = true; ?>
                <?php endif; ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h3><?php the_title(); ?></h3> <!-- عنوان پست -->
                    <p><?php the_field('biography'); ?></p> <!-- بیوگرافی -->
                </article>

            <?php
            // نمایش Faculty پست‌ها
            elseif ( $term_name === 'Faculty' ) :
                if (!$has_faculty) : ?>
                    <h2>Faculty Staff</h2> <!-- نمایش عنوان Faculty فقط یکبار -->
                    <?php $has_faculty = true; ?>
                <?php endif; ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h3><?php the_title(); ?></h3> <!-- عنوان پست -->
                    <p><?php the_field('biography'); ?></p> <!-- بیوگرافی -->

                    <!-- نمایش فیلد Courses به عنوان متن ساده -->
                    <?php $courses = get_field('courses'); ?>
                    <?php if ( $courses ) : ?>
                        <p><strong>Courses:</strong> <?php echo esc_html( $courses ); ?></p> <!-- دوره‌ها به صورت متن -->
                    <?php endif; ?>

                    <!-- نمایش فیلد وب‌سایت -->
                    <p><strong>Website:</strong> <a href="<?php the_field('instructor_website'); ?>" target="_blank">Visit Website</a></p> <!-- وب‌سایت -->
                </article>

            <?php endif;

        endwhile;
        wp_reset_postdata();
    else : ?>
        <p>No staff members found.</p>
    <?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
