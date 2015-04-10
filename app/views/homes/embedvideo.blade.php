<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="{{$vidFilename->title}}">
	<meta property="og:site_name" content="test.tefltv.com">
	<meta property="og:description" content="{{$vidFilename->description}}">
	<meta property="og:url" content="http://www.test.tefltv.com/watch!v={{$vidFilename->file_name}}"> 
	<meta property="og:image" content="/videos/{{$vidOwner->id}}-{{$vidOwner->channel_name}}/{{$vidFilename->file_name}}/{{$vidFilename->file_name}}.jpg">
	<meta property="og:type" content="video">
	<meta property="og:video:width" content="500"> 
	<meta property="og:video:height" content="315"> 
	<meta property="og:video" content="/videos/{{$vidOwner->id}}-{{$vidOwner->channel_name}}/{{$vidFilename->file_name}}/{{$vidFilename->file_name}}.mp4">  
	<title>Embed Video</title>
	{{HTML::style('css/vid.player.css')}}
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/media.player.js')}}
</head>
<body>
<div class="col-md-12">
	<div class="row  vid-wrapper">
		<div id="vid-controls">
			<div class="embed-responsive embed-responsive-16by9">
              	<video id="media-video" poster="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.jpg">
					<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.mp4" type="video/mp4">
					<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.webm" type="video/webm">
					<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.ogg" type="video/ogg">
				</video> 
				 @include('elements/videoPlayer') 
			</div>
			
		</div>
	</div>
</div>

</body>
</html>