
<?php
/**
 * The template for displaying all single Easy Video Posts
 *
 */

get_header();

while ( have_posts() ) :
    the_post();
?>

<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class('af-single-article'); ?>>
        <header class="entry-header alignwide">
            <h1 class="post-title">
                <?php the_title(); ?>
            </h1>
            <p>
                <?php 
                    $categories = get_the_category(get_the_ID());
                    foreach( $categories as $cat ){
                        echo '<label class="cat">'.$cat->name.'</label>';
                    }
                ?>
            </p>
        </header>

        <div class="entry-content">
            <div class="display_videos">
                <?php
                    $video_url = get_post_meta( get_the_ID(), 'video_url', true );
                    $video_id = substr( $video_url, -11 );
                ?>
                <iframe src="https://www.youtube.com/embed/<?php echo $video_id; ?>" style="width:100%; height:500px; border:0;"></iframe>
            </div>
        </div>

       
    </article>
</div>

<?php
endwhile;

// get_sidebar();
get_footer();
