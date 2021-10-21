/**
 * Fetch all the channel videos when you input channel ID while creating a new video
 */

jQuery(document).ready(function($){

   $( "input#channel_id" ).keyup(function(){
       $("#loader").text( 'Fetching...' );
        var channel_id = $( this ).val();
        $.ajax({
            type : "POST",
            url : my_ajax_object.ajax_url,
            data : {
                action: "video_callback",
                channel_id: channel_id
            },
            success: function(response) {
                $("#loader").text( '' );
                $( "#render_vidoes" ).html( response );
            }
       });   
   });

});