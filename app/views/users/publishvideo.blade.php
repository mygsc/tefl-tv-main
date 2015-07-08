<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="{{$get->title}}">
	<meta property="og:site_name" content="{{asset('/')}}">
	<meta property="og:description" content="{{$get->description}}">
	<meta property="og:url" content="{{asset('/')}}watch?v={{$get->file_name}}"> 
	<meta property="og:image" content="/videos/{{$vidOwner->id}}-{{$vidOwner->channel_name}}/{{$get->file_name}}/{{$get->file_name}}.jpg">
	<meta property="og:type" content="video">
	<meta property="og:video:width" content="500"> 
	<meta property="og:video:height" content="315"> 
	<meta property="og:video" content="/videos/{{$vidOwner->id}}-{{$vidOwner->channel_name}}/{{$get->file_name}}/{{$get->file_name}}.mp4">  
	<title>Publish Video</title>
	{{HTML::style('css/vid.player.min.css')}}
	{{HTML::style('css/publisher.css')}}
	{{HTML::style('css/myStyle.css')}}
	{{HTML::style('css/bootstrap.css') }}
</head>
<body>
	<div class="row">
		<div class="content-padding">
			<div class="vid-wrapper p-relative">
				<div id="vid-controls">
					<div class="embed-responsive embed-responsive-16by9">
						<video preload='auto' id="media-video" poster="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$get->file_name.'/'.$get->file_name}}.jpg">
							<source id="mp4" src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$get->file_name.'/'.$get->file_name}}.mp4" type="video/mp4">
							<source id="webm" src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$get->file_name.'/'.$get->file_name}}.webm" type="video/webm">
						</video> 
					</div>
					@include('ads.publisher');
					@include('elements/videoPlayer') 
				</div>
			</div>
		</div>
	</div>
</body>
	{{HTML::script('js/jquery.min.js')}}
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::script('js/video-player/fullscreen.min.js')}}
</html>