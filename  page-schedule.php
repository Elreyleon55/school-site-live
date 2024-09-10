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
    <h1><?php the_title(); ?></h1>

    <?php if( have_rows('schedule_items') ): ?>
        <table class="schedule-table">
            <tbody>
                <?php while( have_rows('schedule_items') ): the_row(); ?>
                    <tr>
                        <td><?php the_sub_field('date'); ?></td>
                        <td><?php the_sub_field('course'); ?></td>
                        <td><?php the_sub_field('instructor'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No schedule found.</p>
    <?php endif; ?>
</main>

<?php
get_footer();
get_sidebar();
