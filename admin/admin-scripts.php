<?php
/**
 * Enqueue css and js files for admin side
**/

function video_admin_enqueue_scripts() {
    wp_enqueue_style( 'video-admin-cs', plugin_dir_url( __FILE__ ) . 'assets/admin.css' );

    // for ajax
    wp_enqueue_script( 'ajax-script', plugin_dir_url( __FILE__ ) . 'assets/admin.js', array('jquery') );
    wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'video_admin_enqueue_scripts' );


// ajax callback
function video_callback() {
    
    /**
     * $_POST['channel_id]
     * The variable is from coming from ajax request
     */

     // create an object to access easy videos class
     $easy_videos = new Easy_Videos();
     // class the render_vides() function to fetch the videso from channel
     $html = $easy_videos->render_videos( $_POST['channel_id'] );
     // print the output
     echo $html;

    exit();
}

add_action( 'wp_ajax_nopriv_video_callback', 'video_callback' );
add_action( 'wp_ajax_video_callback', 'video_callback' );

require_once('import-videos.php');


