<?php
/**
 * Common Easy_Videos class for fetching videos from the channel using youtube API
**/

class Easy_Videos {

    public function render_videos( $channelId, $nextPage ) {

        $API_Url = 'https://www.googleapis.com/youtube/v3/';
        $API_Key = 'AIzaSyAJh8xDQyX4Kc5lHc14iCAgwQpWdwgcyj4';

        // echo $channelId;
        
        // If you don't know the channel ID see below
        //UCdEZOEd6VvlGD88JVNLQErA : channelID
        
        $parameter = [
            'id'=> $channelId,
            'part'=> 'contentDetails',
            'key'=> $API_Key
        ];
        $channel_URL = $API_Url . 'channels?' . http_build_query($parameter);
        $json_details = json_decode(file_get_contents($channel_URL), true);

        // var_dump($json_details);
    
        $playlist = $json_details['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
       
        $parameter = [
            'part'=> 'snippet',
            'playlistId' => $playlist,
            'maxResults' => '20',
            'key'=> $API_Key
        ];
        $channel_URL = $API_Url . 'playlistItems?' . http_build_query($parameter);

        if( $nextPage != '' ){
            $channel_URL = $channel_URL . '&pageToken=' . $nextPage;
        } 

        $json_details = json_decode(file_get_contents($channel_URL), true);
    
        $nextPagToken = $json_details['nextPageToken'];
        
        $my_videos = [];
        foreach($json_details['items'] as $video){
            $my_videos[] = array( 'v_id'=>$video['snippet']['resourceId']['videoId'], 'v_name'=>$video['snippet']['title'] );
        }
        
        // while(isset($json_details['nextPageToken'])){
        //     $nxt_page_URL = $channel_URL . '&pageToken=' . $json_details['nextPageToken'];
        //     $json_details = json_decode(file_get_contents($nxt_page_URL), true);
        //     foreach($json_details['items'] as $video)
        //         $my_videos[] = $video['snippet']['resourceId']['videoId'];
        // }
    
        ($nextPage == '') ? $html = '<div class="all_videos">' : '';
        
        $args = array(
            'hide_empty' => false,
            'taxonomy' => 'category'
        );
        $categories = get_categories($args);

        foreach($my_videos as $video){
            if(isset($video)){
                $html .= '
                <div class="video" '.$json_details['nextPageToken'].'>
                <a class="video" href="https://www.youtube.com/watch?v='. $video['v_id'] .'" data-id="'.$i.'" target="_blank">
                    <img src="https://img.youtube.com/vi/'.$video['v_id'].'/hqdefault.jpg" /><br>
                    <span>'. $video['v_name'] .'</span>
                </a>
                <input type="text" name="video_title[]" value="'.$video['v_name'].'" />
                <input type="hidden" name="video_url[]" value="https://www.youtube.com/watch?v='. $video['v_id'] .'" />
                <select name="video_category[]">';
                foreach( $categories as $category){
                    $selected = '';
                    if($category->term_id == 1){$selected='selected';}
                    $html .= '<option '.$selected.' value="'.$category->term_id.'">'.$category->name.'</option>';
                }
                $html .= '
                </select>
                </div>
                ';
            }
        }

        ( $nextPage == '' ) ? $html .= '</div>' : '';

        // if( $nextPagToken ){
        //     $html .= '<button type="button" id="load-more" data-id="'.$nextPagToken.'" class="button"> load more </button>';
        // }

        $arr = array(
            'html' => $html,
            'nextPage' => $json_details['nextPageToken']
        );
    
        return json_encode($arr);
    }
}