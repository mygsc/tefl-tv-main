@extends('layouts.default')


@section('content')
<style type="text/css">
	/* Moving on to the styling, we'll start with the main progress bar first and then the value part of it. After that, we'll do some experiments :D */
	.wrapper {
		background: #1e1e1e;
		padding:0 10px 8px 10px;
		width: 100%;
		margin-top: 0;
		border-top:1px solid #111111;
	}
	img#play-pause{
		cursor:pointer;
	}
	.play{
		padding:0 5px;
		margin-right: 10px;
	}
	.sound{
		padding:0 5px;

	}

	.fullscreen{
		padding:0 5px;
		cursor:pointer;
	}
	
	.time{
		color: #fff;
		font-size: 1.0em;
		padding: 2px;
	}

	.title{
		color: #b5daf9;
		font-size: 1.0em;
		font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
		font-weight: normal!Important;

	}
	.playerLogo{
		height:20px;
		width:15px;
	}
	progress {
		width: 100%;
		height: 12px;
		display: inline-block;
		/* Important Thing */
		-webkit-appearance: none;
		border: none;
		margin-bottom: 0;
	}

	/* All good till now. Now we'll style the background */
	progress::-webkit-progress-bar{
		background: black;
		border-radius: 3px;
		padding: 3px;
		height: 10px;
	}

	/* Now the value part */
	progress::-webkit-progress-value {
		border-radius: 3px;
		background: rgba(242,246,248,1);
		background: -moz-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
		background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(242,246,248,1)), color-stop(50%, rgba(216,225,231,1)), color-stop(51%, rgba(181,198,208,1)), color-stop(100%, rgba(224,239,249,1)));
		background: -webkit-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
		background: -o-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
		background: -ms-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
		background: linear-gradient(to bottom, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9', GradientType=0 );

	}

	/* That's it! Now let's try creating a new stripe pattern and animate it using animation and keyframes properties  */

div.progressbar{
	width:100%;height:12px;background:green;padding:1px;			
}
div.progressbar #current-progress{
	width:10px;height:10px;background:#D0D0D0;			
}

</style>
<div class="container page">
<br/>
	<div class="col-md-7">
		<video  id="media-video" width="650" height="350" controls poster="/img/thumbnails/v1.png" preload="none">
			<source src='/videos/movie.mp4' type='video/mp4'>
			<source src='/videos/movie.webm' type='video/webm'>
			<source src='/videos/movie.ogg' type='video/ogg'>
			<source src='/videos/movie.mov' type='video/mov'>
			<source src='/videos/movie.m4v' type='video/x-m4v'>
			<source src='/videos/movie.3gp' type='video/3gpp'>
		</video>

		{{--<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
			 <button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
			<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
			<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
			<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
			<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
			<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>
			<button id='btn-fullscreen' class='fullscreen' title='fullscreen' onclick='fullscreen();'>Fullscreen</button> --}}
			<div class="progressbar">
				<div id="current-progress">
					
				</div>
			</div>

		<div class="wrapper">
			<progress id='progress-bar'  min="0" max="100" value="0"></progress>
			
			<span class="play">
			<img id="play-pause" onclick='togglePlayPause();' src="/img/icons/play.png"></span>
			<span class="title">Vocabulary and Memory Test</span>
			<span class="pull-right">
				{{-- <span class="time">00:00 /  00:00</span> --}}
				<span class="ctime time">00:00 / </span> 
				<span class="ttime time">00:00</span>
				<span class="sound"><img src="/img/icons/sound.png"></span>
				<span ><img id='btn-fullscreen' title="Fullscreen" class="fullscreen" onclick='fullscreen();' src="/img/icons/fullscreen.png"></span>
				<img src="/img/logos/teflTv.png" class="playerLogo">
			</span>
		</div>
	</div>
</div>


@stop
@section('script')
	{{HTML::script('js/media-player.js')}}
@stop