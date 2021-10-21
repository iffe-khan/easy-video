<?php
/**
 * Display all the videos at the frontend
**/

function easy_videos_callback() {
    global $wpdb; $wpdb->show_errors();
    ob_start();
    ?>

        <div class="display_videos">
    <?php

            $args = array(  
                'post_type' => 'easyvideo',
                'post_status' => 'publish',
                'posts_per_page' => -1, 
                'orderby' => 'date', 
                'order' => 'ASC', 
            );

            $loop = new WP_Query( $args ); 
            while ( $loop->have_posts() ) : $loop->the_post();  
                
                echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';

                $channel_id = get_post_meta( get_the_ID(), 'channel_id', true );
                
                // create an object to access easy videos class
                $easy_videos = new Easy_Videos();
                // class the render_vides() function to fetch the videso from channel
                $html = $easy_videos->render_videos( $channel_id );
                // print the output
                echo $html;
            endwhile;

            wp_reset_postdata(); 

    ?>
           
        </div>
            

    <?php

    return ob_get_clean();
}
add_shortcode( 'easy_video', 'easy_videos_callback' );