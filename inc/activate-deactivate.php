<?php
/**
 * Here you can all the code related with plugin activation and deactivation
 */


// Plugin activation
function yv_function_to_run(){
    // code here
}
register_activation_hook( __FILE__, 'yv_function_to_run' );

// plugin deactivaton
function yv_function_to_deactivate() {
    unregister_post_type( 'easyvideo' );
}
register_deactivation_hook( __FILE__, 'yv_function_to_deactivate' );