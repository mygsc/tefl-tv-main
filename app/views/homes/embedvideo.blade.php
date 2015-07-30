<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Embed Videos | TEFL Tv</title>
	{{HTML::style('css/vid.player.min.css')}}
	{{HTML::style('css/myStyle.css')}}
	{{HTML::style('css/bootstrap.css') }}
</head>
<body>
	<div class="row">
		<div class="content-padding">
			<div class="vid-wrapper p-relative">
				<div id="vid-controls">
					<div class="embed-responsive embed-responsive-16by9">
						<video preload='auto' id="media-video" poster="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.jpg">
							<source id="mp4" src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.mp4" type="video/mp4">
							<source id="webm" src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.webm" type="video/webm">
						</video> 
					</div>
					@include('elements/videoPlayer') 
				</div>
			</div>
		</div>
	</div>
</body>
	{{HTML::script('js/jquery.min.js')}}
	{{HTML::script('js/video-player/media.player.min.js')}}
</html>