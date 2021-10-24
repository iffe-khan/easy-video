<?php 
/**
 * Bulk videos from the channel
**/

add_action('admin_menu' , 'add_to_cpt_menu'); 

function add_to_cpt_menu() {
    add_submenu_page(
        'edit.php?post_type=easyvideo',
       	'Import Videos',
        'Import Videos',
        'manage_options',
        'import-video',
        'import_video_callback'
    );
}  

function import_video_callback() {
?>

	<h1>Import Videos</h1>

	<label>Channel ID</label><br>
	<input type="text" id="channel_id" placeholder="Enter channel ID" />
	<button class="button button-primary" id="fetch_videos">Fetch Videos</button>
	<br>
	<span id="loader"></span> <br>

	<div class="alert alert-success" style="display:none;">
		<b>Success!</b> All Videos have been imported.
	</div>
	<div class="alert alert-danger" style="display:none;">
		<b>Error!</b> Unable to import videos
	</div>

	<form method="post" id="import-form">
        <input type="hidden" id="next_page">
		<div></div>
        <div id="load-div"></div>
		<button type="submit" name="import_videos" disabled class="button button-primary">Import</button>
	</form>

<?php
}




if( isset($_POST['import_videos']) ) {
    require_once( ABSPATH . "wp-includes/pluggable.php" );
    
    $titles = $_POST['video_title'];
    $categories = $_POST['video_category'];
    $urls = $_POST['video_url'];

    $size = count($titles);
    for( $i = 0; $i < $size; $i++ ){

        $my_post = array(
            'post_type' => 'easyvideo',
            'post_title'    => $titles[$i],
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_ID()
        );
        $postID = wp_insert_post( $my_post );

        if($postID){
            update_post_meta( $postID, 'video_url', $urls[$i] );
            wp_set_post_categories( $postID, $categories[$i] );
            echo '<script>document.querySelector(".alert-success").css("display","block");</script>';
        } else {
            echo '<script>document.querySelector(".alert-danger").css("display","block");</script>';
        }

    }
}