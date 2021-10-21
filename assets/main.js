/**
 * Make video playable by clicking on it on the frontend 
 */

jQuery( document ).ready(function($){
    $('.display_videos .all_videos a').on('click',function(e){
        // stop the default behavior of the anchor tag
		e.preventDefault();

        // hide all the preview vides if any
        $('.display_videos .preview').hide();
        $('.display_videos .preview iframe').remove();

        // get the unique increment id assigned in loop
        var inc = $(this).attr('data-id');
        // get vide url
		var video_url = $(this).attr('href');
        // grab video id from the url
		var video_id = video_url.substring(video_url.search('=')+1,video_url.length);
		
        // output the single video to make it play
        var selector = '.preview_video-'+video_id+'-'+inc;
		$(selector).html('<iframe width="560" height="315" src="https://www.youtube.com/embed/' + video_id + '" frameborder="0" allowfullscreen></iframe>');
        $(selector).fadeIn();

    });

    // hide the single video
    $(".preview").click(function(){
        $('.display_videos .preview').fadeOut();
        $('.display_videos .preview iframe').remove();
    });
});