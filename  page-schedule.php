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

  
    <div class="page-content">
        <?php the_content(); ?>
    </div>


    <?php 
    $schedule_items = get_field('schedule_items');

    if( $schedule_items ): ?>
        <table class="schedule-table">
            <tbody>
                <?php foreach( $schedule_items as $item ): ?>
                    <tr>
                        <td><?php echo esc_html($item['date']); ?></td>
                        <td><?php echo esc_html($item['course']); ?></td>
                        <td><?php echo esc_html($item['instructor']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No schedule found.</p>
    <?php endif; ?>
</main>

<?php
get_footer();
get_sidebar();