
<div class="">
	<div class="col-md-12">
		<div class="row" id="vid-wrapper">
					<div id="vid-controls">
						<div class="embed-responsive embed-responsive-16by9">
							@if(file_exists(public_path('/videos/'.$videos->user_id.'-'.$owner->channel_name.'/'.$videos->file_name.'/'.$videos->file_name.'.jpg')))
							<video preload="auto" id="media-video" width="100%" poster="/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}_600x338.jpg" class="embed-responsive-item">
							<source id='mp4' src='/videos/{{$videso->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4' type='video/mp4'>
							<source id='webm' src='/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
							<source id='ogg' src='/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.ogg' type='video/ogg'>
							</video>
							@else
							<video preload="auto" id="media-video" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
							<source id='mp4' src='/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4' type='video/mp4'>
							<source id='webm' src='/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.webm' type='video/webm'>
							<source id='ogg' src='/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.ogg' type='video/ogg'>	
							</video>
							@endif
						</div>
						@include('elements/videoPlayer')
					</div>
				
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
