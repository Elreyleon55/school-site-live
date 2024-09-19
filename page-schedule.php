<?php

/**
 * The template for displaying the home page
 * @package SCH_School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
  
    <h1><?php the_title(); ?></h1>

    <div class="page-content">
        <?php the_content(); ?>
    </div>

    <!-- Check if the repeater field has rows -->
    <?php if( have_rows('schedule_items') ): ?>
        <table class="schedule-table">
            <tbody>
                <?php 
                $index = 0;
                while( have_rows('schedule_items') ): the_row(); ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                        <!-- Format date using date_i18n -->
                        <td><?php echo date_i18n( 'F j, Y', strtotime(get_sub_field('date')) ); ?></td>
                        <td><?php echo esc_html( get_sub_field('course') ); ?></td>
                        <td><?php echo esc_html( get_sub_field('instructor') ); ?></td>
                    </tr>
                <?php 
                $index++;
                endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No schedule found.</p>
    <?php endif; ?>
</main>

<?php
get_footer();
?>
