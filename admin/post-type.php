<?php
/**
 * Code for creating custom post type for the videos
 */

// Register a custom post type for videos
function video_post_type_init() {
    $labels = array(
        'name'                  => _x( 'Easy video', 'Youtube Videos', 'easy-video' ),
        'singular_name'         => _x( 'Easy video', 'Youtube Video', 'easy-video' ),
        'menu_name'             => _x( 'Easy video', 'Youtube Videos', 'easy-video' ),
        'name_admin_bar'        => _x( 'Easy video', 'Add New on Toolbar', 'easy-video' ),
        'add_new'               => __( 'Add New', 'videasy-videoeo' ),
        'add_new_item'          => __( 'Add New easy-video', 'easy-video' ),
        'new_item'              => __( 'New video', 'easy-video' ),
        'edit_item'             => __( 'Edit video', 'easy-video' ),
        'view_item'             => __( 'View video', 'easy-video' ),
        'all_items'             => __( 'All videos', 'easy-video' ),
        'search_items'          => __( 'Search video', 'easy-video' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Easy video custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'easyvideo' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'           => 'dashicons-video-alt3',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'category' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'easyvideo', $args );
}
add_action( 'init', 'video_post_type_init' );

// add meta box for videos url
function add_video_metaboxes() {
    add_meta_box(
		'channel_id',
		'Channel ID',
		'channel_id_function',
		'easyvideo',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_video_metaboxes' );

// channel id output
function channel_id_function() {
    global $post;
    $channelID = get_post_meta( $post->ID, 'channel_id', true );
?>
    <input type="text" name="channel_id" id="channel_id" placeholder="Enter Channel ID" value="<?php echo $channelID; ?>" style="max-width:100%; min-width:300px;"/>
    <div id="loader"></div>
    <div id="render_vidoes">
        <?php   
            if( $channelID ){
                $easy_videos = new Easy_Videos();
                $html = $easy_videos->render_videos( $channelID );
                echo $html;
            }
        ?>
    </div>
<?php
}

// save channel ID 
function video_save_custom_meta( $post_id, $post ) {
    if( $post->post_type == 'easyvideo' ) {
        update_post_meta( $post_id, 'channel_id', @$_POST['channel_id'] );
    }
}
add_action( 'save_post', 'video_save_custom_meta', 1, 2 );