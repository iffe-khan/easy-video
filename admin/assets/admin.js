/**
 * Fetch all the channel videos when you input channel ID while creating a new video
 */

jQuery(document).ready(function($){

   $( "input#channel_id" ).keyup(function(){
        var channel_id = $( this ).val();
        if( channel_id == '' ) {
            $( "#import-form .all_videos, #import-form #load-div" ).html('');

        }       
   });
   $( "button#fetch_videos" ).click(function(){
        var channel_id = $( "input#channel_id" ).val();
        fetchVideos( channel_id );       
   });
    $( document ).on('click', "button#load-more", function(){
        $( this ).text( 'Fetching...' );
        var channel_id = $( "input#channel_id" ).val();
        fetchVideos( channel_id );      
   });

});

function fetchVideos( channel_id ) {
    $ = jQuery;
    $("#loader").text( 'Fetching...' );
    var next_page = $("#import-form #next_page").val();
    console.log( next_page );
    $.ajax({
        type : "POST",
        url : my_ajax_object.ajax_url,
        data : {
            action: "video_callback",
            channel_id: channel_id,
            next_page: next_page
        },
        success: function(response) {
            response = JSON.parse(response);

            console.log( response.nextPage );

            $("#loader").text( '' );
            $("#import-form #next_page").val( response.nextPage );

            if(next_page == ''){
                $( "#import-form div" ).html( response.html );
            } else {
                $( "#import-form div .all_videos" ).append( response.html );
            }

            if( response.nextPage ) {
                var btn = '<button type="button" id="load-more" data-id="'+response.nextPage+'" class="button"> load more </button>';
                $( "#import-form #load-div" ).html( btn );
            } else {
                $( "#import-form #load-div" ).html( '' );
            }
            
            $( "#import-form button" ).removeAttr('disabled');
        }
   });   
}