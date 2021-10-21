<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Video
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Video
 * Plugin URI:        Easy Video
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Iftikhar
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       #
 * Text Domain:       
 * Domain Path:       /
 */

function enqueue_video_scripts() {
    wp_enqueue_style( 'easy-video-cs', plugin_dir_url( __FILE__ ) . 'assets/main.css' );
    wp_enqueue_script( 'easy-video-js', plugin_dir_url( __FILE__ ) . 'assets/main.js', array('jquery') );
}
add_action("wp_enqueue_scripts", "enqueue_video_scripts");


// Common class for fetching videso from the youtube channel
include_once( 'admin/class-easy-video.php' );
//include css and js file for the admin dashboard and ajax call for admin side
require_once( 'admin/admin-scripts.php' );

// activate and deactiavte 
require_once( 'inc/activate-deactivate.php' );

// post type
require_once( 'admin/post-type.php' );

// display shortcode
require_once( 'inc/display-shortcode.php' );


/**
 * Template Redirection for single page
 * 
 **/
add_filter( 'single_template', 'override_single_template' );
function override_single_template( $single_template ){
    global $post;

    if( $post->post_type == 'easyvideo' ){
        $file = dirname(__FILE__) .'/inc/single-'. $post->post_type .'.php';
        if( file_exists( $file ) ) $single_template = $file;
    }

    return $single_template;
}