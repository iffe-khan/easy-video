
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
        </header>

        <div class="entry-content">
            <div class="display_videos">
                <?php
                    $channel_id = get_post_meta( get_the_ID(), 'channel_id', true );
                    $easy_videos = new Easy_Videos();
                    $html = $easy_videos->render_videos( $channel_id );
                    echo $html;
                ?>
            </div>
        </div>

       
    </article>
</div>

<?php
endwhile;

// get_sidebar();
get_footer();
