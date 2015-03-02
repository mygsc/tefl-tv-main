<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	{{HTML::style('css/mediaPlayer.css')}}
	{{HTML::style('css/bootstrap.css')}}
	{{HTML::script('js/mediaPlayer.js')}}
</head>
<body>
	<h3>Custom Video Player</h3>
	<hr>
	
		<div id='media-player'>
			<video id='media-video' controls>
				<source src='/videos/sample.mp4' type='video/mp4'>
				<source src='/videos/sample.ogg' type='video/ogg'>
				
			</video>
			<div id='media-controls'>
				<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
				<button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
				<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
				<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
				<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
				<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
				<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>	
			</div>
			<div id='media-play-list'>
				<h2>Play list</h2>
				<ul id='play-list'>
					<li><span class='play-item' onclick='loadVideo("parrots.webm", "parrots.mp4");'>Parrots</span></li>
					<li><span class='play-item' onclick='loadVideo("paddle-wheel.webm", "paddle-wheel.mp4");'>Paddle Steamer Wheel</span></li>
					<li><span class='play-item' onclick='loadVideo("grass.webm", "grass.mp4");'>Grass</span></li>
				</ul>
			</div>
		</div>	

</body>
</html>


