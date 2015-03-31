<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="localhost:8000/css/vid.player.css">
	<script src="localhost:8000/js/media.player.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<video width="100%" height="100%" id="media-video" poster="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.jpg">
		<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.mp4" type="video/mp4">
		<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.webm" type="video/webm">
		<source src="/videos/{{$vidOwner->id.'-'.$vidOwner->channel_name}}/{{$vidFilename->file_name.'/'.$vidFilename->file_name}}.ogv" type="video/ogg">
	</video> 
</body>
</html>