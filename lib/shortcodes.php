<?php

// Use: [d4youtube]
	function shortcode_d4youtube( $atts ) {
		$attr=shortcode_atts(array(
			'id' => '',
			'offset' =>'',
			'playlist_archive' => false,
		), $atts);

		if ($attr['playlist_archive']) {

			global $ai_interests_array;

			$output = '<div id="video-library">';
			foreach ($ai_interests_array['interests']['options'] as $option) {
				$output .= '<div class="one_half"><div class="skivdiv-content">';
				$output .= '<h2>'.$option['name'].'</h2>';
				$output .= '<iframe width="900" height="500" src="https://www.youtube.com/embed/videoseries?list='.$option['youtube_playlist_id'].'"></iframe>';
				$output .= '</div></div>';
			}
			$output .= '</div>';

		} else {
	
			global $d4youtube_likes_playlist;
			global $d4youtube_api_key;		

			if ($atts['id'] != '') {
				$playlist_id = $atts['id'];
			} else {
				$playlist_id = $d4youtube_likes_playlist;
			}

			$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$playlist_id.'&key='.$d4youtube_api_key;

			$offset = $atts['offset'];

			/*print "<pre style='display:none'>";
			print_r(wp_remote_get($url));
			print "</pre>";*/
			$apiResult = wp_remote_get($url);
			$jsonResult = json_decode($apiResult['body']);

			if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items))
	        {
	        	if ($atts['offset'] != '') {
					$videocount = count($jsonResult->items);
					if ($videocount <= $atts['offset']) {
						//if the user has scrolled past the total number of videos in the playlist, get a random video from the "Likes" playlist
						$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$d4youtube_likes_playlist.'&key='.$d4youtube_api_key;
						$apiResult = wp_remote_get($url);
						$jsonResult = json_decode($apiResult['body']);
						$offset = array_rand($jsonResult->items, 1);

					} else {
						$offset = intval($atts['offset']);
						$videoarray = $jsonResult->items[$offset];
					}
				} else {
					$offset = 0;
				}

				$videoarray = $jsonResult->items[$offset];
				$vidID = $videoarray->snippet->resourceId->videoId;

	            $output .= '<div style="background-image:url('.$jsonResult->items[$offset]->snippet->thumbnails->high->url.')" class="youtube-frame" id="'.$vidID.'"><i class="icon-video"></i></div>';
	    	}
	    }

		return $output;
	} add_shortcode( 'd4youtube', 'shortcode_d4youtube' );

?>