
<div class="">
	<div class="col-md-12">
		<div class="row">
			{{--<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
				<button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
				<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
				<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
				<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
				<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
				<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>
				<button id='btn-fullscreen' class='fullscreen' title='fullscreen' onclick='fullscreen();'>Fullscreen</button> --}}
				@foreach($video_path as $video)
					<div class="embed-responsive embed-responsive-16by9">
						<video id="media-video" width="100%" poster="/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.jpg" class="embed-responsive-item">
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.ogv' type='video/ogg'>
						</video>
					</div>
					@include('elements/videoPlayer')
				@endforeach
				
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
