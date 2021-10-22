/**
 * Fetch all the channel videos when you input channel ID while creating a new video
 */

jQuery(document).ready(function($){

   $( "input#channel_id" ).keyup(function(){
        var channel_id = $( this ).val();
        fetchVideos( channel_id );       
   });
   $( "button#fetch_videos" ).click(function(){
        var channel_id = $( "input#channel_id" ).val();
        fetchVideos( channel_id );       
   });

});

function fetchVideos( channel_id ) {
    $ = jQuery;
    $("#loader").text( 'Fetching...' );
    $.ajax({
        type : "POST",
        url : my_ajax_object.ajax_url,
        data : {
            action: "video_callback",
            channel_id: channel_id
        },
        success: function(response) {
            $("#loader").text( '' );
            $( "#import-form div" ).html( response );
            $( "#import-form button" ).removeAttr('disabled');
        }
   });   
}