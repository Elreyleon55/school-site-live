<?php

/**
 * The template for displaying the Home Page.
 *
 * @Kaleb https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SCH_School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

       
    ?>

        <section class="home-intro">
            <h1><?php the_title(); ?></h1>

            <?php the_post_thumbnail('large') ?>

            <?php

            if ( function_exists( 'get_field') ){
                if ( get_field( 'top_section') ) {
                    the_field( 'top_section');
                }
            }

            ?>


        </section>
        <section class="home-work">
        <h2><?php esc_html_e( 'Featured Works', 'work-category' ); ?></h2>
        <?php
		$args = array(
			'post_type'    => 'fwd-work',
			'posts_per_page' => 4,
            'tax_query'  => array(
                array(
                    'taxonomy' => 'fwd-featured',
                    'field'    => 'slug',
                    'terms'    => 'front-page'
                )
            )
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<article>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
						<?php the_post_thumbnail( 'medium' ); ?>
					</a>
				</article>
				<?php
			}
			wp_reset_postdata();
		}
		?>
        </section>

        <section class="home-work">
        <h2>Featured Works (Relationship Field)</h2>
            <?php
            $featured_works = get_field('featured_works');
            if ($featured_works): ?>
                <?php foreach ($featured_works as $featured_works):
                    $permalink = get_permalink($featured_works->ID);
                    $title = get_the_title($featured_works->ID);
                    $custom_field = get_field('field_name', $featured_works->ID);
                ?>
                    <article>
                        <?php echo get_the_post_thumbnail($featured_works->ID, 'medium'); ?>
                        <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>


        </section>

        <section class="home-left">
        <?php 

           if (function_exists ( 'get_field' ) ) {

            if (get_field( 'left_section_heading')) {
                
                            echo '<h2>';
                            the_field( 'left_section_heading' );
                            echo '</h2>';


            }

            if (get_field( 'left_section_content')) {
                
                echo '<p>';
                the_field( 'left_section_content' );
                echo '</p>';
            }
           }
            ?>
        </section>

        <section class="home-right">
            <?php
               if (function_exists ( 'get_field' ) ) {

                if (get_field( 'right_section_heading')) {
                    
                                echo '<h2>';
                                the_field( 'right_section_heading' );
                                echo '</h2>';
    
    
                }
    
                if (get_field( 'right_section_content')) {
                    
                    echo '<p>';
                    the_field( 'right_section_content' );
                    echo '</p>';
                }
               }
            ?>
        </section>

        <section class="home-slider"></section>
        <?php
        	$args = array (
				'post_type'   => 'fwd-testimonial',
				'post_per_page' => -1,

			);

			$query = new WP_Query( $args );

                if ( $query -> have_posts() ): ?>
                 <div class="swiper">
                 <div class="swiper-wrapper">

                 <?php
    while ( $query -> have_posts() ) :
        $query -> the_post();
        ?>
        <div class="swiper-slide">
            <?php  the_content(); ?>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    </div>
    <div class="swiper-pagination"></div>
<div class="swiper-button-prev"></div>
<!-- <div class="swiper-button-next"></div> -->
</div>
<?php endif; ?>
</section>

        <section class="home-blog">
            <h2><?php esc_html_e('Latest Blog Post', 'fwd'); ?></h2>
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
            );

            $blog_query = new WP_QUERY($args);

            if ($blog_query->have_posts()) {
                while ($blog_query->have_posts()) {
                    $blog_query->the_post();
            ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                               <?php the_post_thumbnail('new-size');  ?>
                   <h3><?php the_title(); ?></h3>
                         <p><?php echo get_the_date(); ?> 
                </a>
                    </article>
            <?php
                }
                wp_reset_postdata();
            }
            ?>
        </section>


    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #primary -->

<?php
get_footer();