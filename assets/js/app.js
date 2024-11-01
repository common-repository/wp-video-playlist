jQuery(function($) {
	/* Load jPlayer */
	jQuery('.jp_video_container').each(function(i, thisPlayer) {
		const videos = JSON.parse(thisPlayer.dataset.videos)

		new jPlayerPlaylist({
			jPlayer: "#" + thisPlayer.querySelector('.jp_video').id,
			cssSelectorAncestor: "#" + thisPlayer.id
		},
		videos,
		{
			playlistOptions: {
				autoPlay: false
			},
			supplied: "m4v",
			smoothPlayBar: true,
			keyEnabled: false,
			autoBlur: false,
			stop: function(e) {
				jQuery(thisPlayer).find(".jp-play").removeClass("active")
				jQuery(thisPlayer).find(".waves").fadeOut()
			},
			pause: function(e) {
				jQuery(thisPlayer).find(".jp-play").removeClass("active")
				jQuery(thisPlayer).find(".waves").fadeOut()
			},
			play: function(e) {
				jQuery(thisPlayer).find(".jp-play").addClass("active")
				jQuery(thisPlayer).find(".waves").fadeIn()
			},
		})
	})

	/* Youtube Integration Setup */
	const setupYoutube = function(whereDivTo, width, height) {
		jQuery("<div>").attr("id", "ytplayer").appendTo(whereDivTo)

		onYouTubeIframeAPIReady = function() {
			youtubeApi = new YT.Player("ytplayer", {
				width: width,
				height: height,
				videoId: "cfLob5IYMp8",
				playerVars: {
					"autoplay": 1,
					"color": "white",
					"modestbranding": 1,
					"rel": 0,
					"showinfo": 0,
					"theme": "light"
				}, events: {
					"onReady": function() {
						jQuery(document).trigger("ready.Youtube")
					},
					"onStateChange": "youtubeStateChange"
				}
			})
		}
		$.getScript("//www.youtube.com/player_api")
	},
	loadYoutubeListeners = function(player, jplayer, id) {
		const container = jQuery(player.options.cssSelector.gui, player.options.cssSelectorAncestor)

		youtubeStateChange = function(ytEvent) {
			switch(ytEvent.data) {
				case -1:
					jQuery(ytEvent.target.getIframe()).show()
					jQuery(jplayer).find('video').hide()
					container.css({ 'opacity' : 0, 'z-index': -1, 'position' : 'relative' })
					container.find('.jp-interface').slideUp("slow")
					break;

				case YT.PlayerState.ENDED:
					jQuery(jplayer).trigger($.jPlayer.event.ended)
					break;

				case YT.PlayerState.CUED:
					jQuery(jplayer).find('video').show()
					jQuery(ytEvent.target.getIframe()).hide()
					container.css({ 'opacity' : 1, 'z-index': 0 })
					container.find('.jp-interface').slideDown("slow")
			}
		};
		youtubeApi.loadVideoById(id)
	}

	jQuery(document).on($.jPlayer.event.setmedia, function(jpEvent) {
		const player = jpEvent.jPlayer,
		url = player.status.src;

		if(!player.html.video.available){
			return;
		}
		if(typeof player.status.media.type === "undefined" || player.status.media.type != 'youtube') {
			if(window['youtubeApi'])
			if(youtubeApi.getPlayerState() != YT.PlayerState.CUED && youtubeApi.getPlayerState() != YT.PlayerState.ENDED)
				return youtubeApi.stopVideo()
			return;
		}

		const youtubeId = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/)[1]

		if(window['youtubeApi']) {
			loadYoutubeListeners(player, jpEvent.target, youtubeId)
		} else {
			setupYoutube(jpEvent.target, player.status.width, player.status.height)
			jQuery(document).on("ready.Youtube", function() {
				loadYoutubeListeners(player, jpEvent.target, youtubeId)
			})
		}
	})

	jQuery(".toggle-list").bind("click", function() {
		if (!jQuery("body").hasClass("active")) {
			jQuery("body").addClass("active")
		} else {
			jQuery("body").removeClass("active")
		}
	})
	jQuery(document).on('click', '.jp-play.active', function() {
		jQuery(this).removeClass("active")
		jQuery(this).parents('.jp-jplayer').find(".waves").fadeOut()
		jQuery(this).parents('.jp-jplayer').jPlayer('pause')
	})
})