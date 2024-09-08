<?php
/* Template Name: Staff Page */
get_header(); ?>

<main id="primary" class="site-main">
    <h1>Our Staff</h1>

    <?php

    $args = array(
        'post_type' => 'sch-staff', 
        'posts_per_page' => -1 
    );

    $staff_query = new WP_Query($args);

    if ($staff_query->have_posts()) :
        while ($staff_query->have_posts()) : $staff_query->the_post(); ?>

        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                
                <?php
                $biography = get_field('biography');
                $courses = get_field('courses');
                $website = get_field('instructor_website');
                ?>

            
                <?php if ( $biography ): ?>
                    <p><strong>Biography:</strong> <?php echo $biography; ?></p>
                <?php endif; ?>

            
                <?php if ( $courses ): ?>
                    <p><strong>Courses Taught:</strong></p>
                    <ul>
                        <?php foreach ( $courses as $course ): ?>
                            <li><?php echo esc_html($course['course_name']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

        
                <?php if ( $website ): ?>
                    <p><strong>Website:</strong> <a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo esc_html($website); ?></a></p>
                <?php endif; ?>
            </article>

        <?php endwhile;
        wp_reset_postdata(); 
    else: ?>
        <p>No staff members found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
