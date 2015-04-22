
<div class="">
	<div class="col-md-12">
		<div class="row" id="vid-wrapper">
				@foreach($video_path as $video)
					<div id="vid-controls">
						<div class="embed-responsive embed-responsive-16by9">
							@if(file_exists(public_path('/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'.jpg')))
							<video preload="auto" id="media-video" width="100%" poster="/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_600x338.jpg" class="embed-responsive-item">
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_hd.mp4' type='video/mp4'>
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_low.mp4' type='video/mp4'>
								{{-- 
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.ogg' type='video/ogg'> 
								--}}
							</video>
							@else
							<video preload="auto" id="media-video" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
								<source id="vid-src" src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
								<source id="vid-src" src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_hd.mp4' type='video/mp4'>
								<source id="vid-src" src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_low.mp4' type='video/mp4'>
								{{-- <source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_hd.mp4' type='video/mp4'> --}}
								{{-- <source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
								<source src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.ogg' type='video/ogg'> --}}
							</video>
							@endif
						</div>
						@include('elements/videoPlayer')
					</div>
				@endforeach
				
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
