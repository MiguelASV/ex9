<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.


		endwhile; // End of the loop.
        //term_description( $category );

        echo '<div class="section-conference">';

        echo '<h2>Nos dernières conférences</h2>';
        /* The 2nd Query (without global var) */
        $args2 = array (
            "category_name" => "conference"
        );

        $query2 = new WP_Query( $args2 );
        $catID = get_the_category($query2->post->ID);

        echo "<h1>".category_description($catID[0])."</h1>";
        // The 2nd Loop
        while ( $query2->have_posts() ) {
            $query2->the_post();
            echo '<div class="contenu-conference">';
                echo '<div class="texte-conference">';
                    echo '<li>' . get_the_title( $query2->post->ID ) . ' - '. get_the_date() . '</li>';
                    echo '<p>' . get_the_excerpt() .'<p>';
                echo '</div>';
                echo '<div>';
                    echo get_the_post_thumbnail(null, "thumbnail");
                echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        // Restore original Post Data
        wp_reset_postdata();

            // The Query
            echo '<h2>Voici les dernières nouvelles</h2>';
            echo '<div class="section-nouvelles">';
            $args = array(
                        "category_name" => "nouvelle",
                        "posts_per_page" => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
            );
            $query1 = new WP_Query( $args );
            
            // The Loop
            while ( $query1->have_posts() ) {
                $query1->the_post();
                echo '<div class="contenu-nouvelles">';
                    echo '<h4>' . get_the_title() . '</h4>';
                    echo get_the_post_thumbnail(null, "thumbnail");
                echo '</div>';
            }
            echo '</div>';
            
            /* Restore original Post Data 
            * NB: Because we are using new WP_Query we aren't stomping on the 
            * original $wp_query and it does not need to be reset with 
            * wp_reset_query(). We just need to set the post data back up with
            * wp_reset_postdata().
            */
            wp_reset_postdata();
            
            
            
            ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
