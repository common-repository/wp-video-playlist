<?php
/**
 * @package jPlayer
 */
$videos = get_option('videoFields');
$type = '';
$list = array();
foreach($videos as $video):
	if(strpos($video['mediaUri'], 'youtube.com') > 0 || strpos($video['mediaUri'], 'youtu.be') > 0):
		$type = 'youtube';
	endif;

	$title = str_replace(['"', '\''], '\"', $video['post_type']);
	$url = str_replace(['"', '\''], '\"', $video['mediaUri']);

	array_push($list, ['type' => $type, 'title' => $title, 'm4v' => $url]);
endforeach;
?>

<div id="jp_video_container<?= empty($id) ? '' : '-' . $id ?>" class="jp_video_container jp-video" role="application" aria-label="media player" data-videos='<?php echo json_encode($list); ?>'>
	<div class="jp-type-playlist">
		<div id="jp_video<?= empty($id) ? '' : '-' . $id ?>" class="jp_video jp-jplayer"></div>
		<div class="jp-gui">
			<div class="jp-video-play">
				<button class="jp-video-play-icon" role="button" tabindex="0" style="display: none;"><i class="fa fa-play-circle-o" aria-hidden="true"></i></button>
			</div>
			<div class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-controls-holder">
					<div class="jp-controls">
						<button class="jp-previous" role="button" tabindex="0"><i class="fa fa-backward" aria-hidden="true"></i></button>
						<button class="jp-play" role="button" tabindex="0"><i class="fa fa-play" aria-hidden="true"></i></button>
						<button class="jp-next" role="button" tabindex="0"><i class="fa fa-forward" aria-hidden="true"></i></button>
						<button class="jp-stop" role="button" tabindex="0"><i class="fa fa-stop" aria-hidden="true"></i></button>
					</div>
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0"><i class="fa fa-volume-off" aria-hidden="true"></i></button>
						<button class="jp-volume-max" role="button" tabindex="0"><i class="fa fa-volume-up" aria-hidden="true"></i></button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-toggles">
						<!-- <button class="jp-repeat" role="button" tabindex="0"><i class="fa fa-repeat" aria-hidden="true"></i></button>
						<button class="jp-shuffle" role="button" tabindex="0"><i class="fa fa-random" aria-hidden="true"></i></button> -->
						<button class="jp-full-screen" role="button" tabindex="0"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="jp-playlist">
			<ul>
				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
				<li>&nbsp;</li>
			</ul>
		</div>
	</div>
</div>