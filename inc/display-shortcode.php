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
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(  
		'post_type' => 'easyvideo',
		'post_status' => 'publish',
		'orderby' => 'date', 
		'order' => 'ASC', 
		'posts_per_page' => 12,
		'paged' => $paged
	);

	$loop = new WP_Query( $args ); 
	while ( $loop->have_posts() ) : $loop->the_post();  

    	$video_url = get_post_meta( get_the_ID(), 'video_url', true );
    	$video_id = substr( $video_url, -11 );
    	$feature_image = 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';

	?>
    	<a href="<?php echo get_the_permalink(); ?>" class="video">
    		<img class="card-img-top" src="<?php echo $feature_image; ?>" alt="Card image" style="width: 100%;">
    		<br>
    		<span><?php the_title(); ?></span>
    	</a>

	<?php

	endwhile;

	?>

	<div class="pagination">
		<?php echo paginate_links( array( 'total' => $loop->max_num_pages ) ); ?>
	</div>

	<?php
	   wp_reset_postdata(); 
	?>         

</div>

<?php

	return ob_get_clean();
}
add_shortcode( 'easy_video', 'easy_videos_callback' );