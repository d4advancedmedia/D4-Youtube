 	// 3. This function creates an <iframe> (and YouTube player) after the API code downloads.
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player', {
			height: '390',
			width: '640',
			//videoId: 'M7lc1UVf-VE',
			/*events: {
				'onReady': onPlayerReady,
			    //'onStateChange': onPlayerStateChange
			}
			playerVars:
			{
				listType:'playlist',
				list: 'PLP1gqiHmrvvsrGBJkHcSPzGdaT3qsdZnJ'
			}*/			
		});
	}

jQuery(document).ready(function($) {	

});

jQuery(document).on('click', '.youtube-frame', function() {
		var vidID = jQuery(this).attr('id');
		jQuery(this).html('<iframe width="850" height="478" src="https://www.youtube.com/embed/' + vidID + '/?showinfo=0&autoplay=true" frameborder="0" allowfullscreen></iframe>');
	});	