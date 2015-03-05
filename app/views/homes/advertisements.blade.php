@extends('layouts.default')


@section('content')
<style type="text/css">
	/* Moving on to the styling, we'll start with the main progress bar first and then the value part of it. After that, we'll do some experiments :D */
	.wrapper {
		background: #2a2a2a;
		padding:0 10px 8px 10px;
		width: 100%!Important;
		margin-top: 0;
		border-top: 1px solid #000;
		/*border-top:1px solid #111111;*/
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
		cursor:pointer;
		position: relative;
	}

	.fullscreen{
		padding:0 5px;
		cursor:pointer;
	}
	
	.time{
		color: #fff;
		font-size: 0.9em;
		padding: 2px;
	}

	.title{
		color: #b5daf9;
		font-size: 0.9em;
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



div#progressbar{
	width:100%;height:10px;background:#111111;padding:1px;overflow: hidden;border:2px solid #131313;margin-top: 5px;
	border-radius: 3px;	margin-bottom: 5px;
}
div#progressbar #current-progress{
	width:0px;height:100%;background:#D0D0D0;border-radius: 2px;			
}
.volume{
	border-radius:5px;height:150px;min-width:5px;position:absolute;bottom:20px;right:0;
	background:rgba(42,42,42,0.9);padding: 8px 8px 8px 8px;cursor: default;
}
#volume-vertical{
	width:100%;
	height:100%;
	background: #337AB7;
	border-radius:2px;
	position: absolute;
	bottom: 0;
}
#volume-button{
	width:100%;
	height:15px;
	background: #fff;
	border-radius:10px;
	cursor: pointer;
}
/*#volume-button:hover{
	background: red;
	cursor: pointer;
}*/
div.volume div.volume-static-holder{
	border:1px solid #fff;
	background: transparent;
	width:9px;
	height: 100%;
	border-radius:10px;
	position: relative;

}
/* setting area*/
.hd-setting{
	border-radius:5px;min-height:5px;min-width:5px;position:absolute;bottom:50px;right:10px;
	background:rgba(42,42,42,0.9);padding: 5px;cursor: default;
}
.hd-setting ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
.hd-setting ul li{
	padding:2px;
}
.hd-setting ul li a{
	color:#fff;
	text-decoration: none;
}

.share-video{
	border-radius:5px;min-height:5px;min-width:5px;position:absolute;bottom:50px;right:10px;
	background:rgba(42,42,42,0.9);padding: 5px;cursor: default;
}
.share-video ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
.share-video ul li{
	padding:2px;
}
.share-video ul li a{
	color:#fff;
	text-decoration: none;
}
#hd-setting{
	cursor:pointer;
}
#share-video{
	cursor:pointer;
}
.advertisement{
	position: absolute;
	bottom: 60px;
	background:rgba(42,42,42,0.9);
	width: 100%;
	min-height:10px;
}
 .play-icon{
 	margin: auto;  
  	position: absolute;
 	left:0;
  	right: 0;
  	top: 0;
  	bottom: 0;
  	width: 50px;
  	height: 26px;
  	background:rgba(42,42,42,0.9);
  	border-radius: 5px;
  	padding: 5px;
  	cursor: pointer;
}.play-icon span{
	color:#fff;
	margin: auto;  
  	position: absolute;
 	left:0;
  	right: 0;
  	top: 0;
  	bottom: 0;
  	cursor: pointer;
  	text-align:center;
}.play-icon:hover{
	-moz-box-shadow:inset 0px 2px 13px #ffffff;
-webkit-box-shadow:inset 0px 2px 13px #ffffff;
box-shadow:inset 0px 2px 13px #ffffff;
}
</style>
<div class="container page">
<br/>
	<div class="col-md-7">
		<div class="">

		{{--<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
			<button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
			<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
			<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
			<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
			<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
			<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>
			<button id='btn-fullscreen' class='fullscreen' title='fullscreen' onclick='fullscreen();'>Fullscreen</button> --}}
			

			<div class="row">
				<video id="media-video" width="100%" poster="/img/thumbnails/v1.png">
					<source src='/videos/movie.mp4' type='video/mp4'>
					<source src='/videos/movie.webm' type='video/webm'>
					<source src='/videos/movie.ogg' type='video/ogg'>
					<source src='/videos/movie.mov' type='video/mov'>
					<source src='/videos/movie.m4v' type='video/x-m4v'>
					<source src='/videos/movie.3gp' type='video/3gpp'>
				</video>
				<div class="advertisement" style="display:none">
						<h2 style="text-align:center;color:#fff;">GSC are hiring for web developer <a href="#">APPLY NOW!</a></h2>
				</div>
				<div class="play-icon">
					<span>&#9658;</span>
				</div>

			</div>
			<div class="row" style="margin-top:-7px;">
			<div class="wrapper">
			
				<div id="progressbar">
					<div id="current-progress">
						
					</div>
				</div>
			
			<span class="play"><img id="play-pause" onclick='togglePlayPause();' src="/img/icons/play.png"/></span>
			<span class="title">Vocabulary and Memory Test</span>
			<span class="pull-right">
				<span class="ctime time">00:00 / </span> 
				<span class="ttime time">00:00</span>
				
				<span class="sound" title="Volume"><img id='mute-icon' src="/img/icons/sound.png"  onclick='toggleMute("true");' />
					<div class="volume" style="display:none">
						<div class="volume-static-holder">
							<div id="volume-vertical">
								<div id="volume-button"> 
								</div>
							</div>
						</div>							
					</div>
				</span>
				<span ><img onclick='fullscreen();' title="fullscreen" class="fullscreen" src="/img/icons/fullscreen.png"></span>
					<div class="hd-setting" style="display:none">
					<small style="text-align:center;color:#fff">HD Quality</small>
						<ul>
							<li> <a href="#">1080p</a></li>
							<li> <a href="#">720p</a></li>
							<li> <a href="#">480p</a></li>
							<li> <a href="#">360p</a></li>
							<li> <a href="#">240p</a></li>
						</ul>						
					</div>
					<div class="share-video" style="display:none">
					<small style="text-align:center;color:#fff">Share to:</small>
						<ul>
							<li> <a href="#">Facebook</a></li>
							<li> <a href="#">Twitter</a></li>
							<li> <a href="#">Instagram</a></li>
							<li> <a href="#">Youtube</a></li>
							<li> <a href="#">Gmail</a></li>
						</ul>						
					</div>

				<span><img id="hd-setting" title="HD setting" src="/img/icons/setting.png"></span>
				<span><img id="share-video" title="Share video" src="/img/icons/share.png"></span>
				<img src="/img/logos/teflTv.png" class="playerLogo">
			</span>
		</div>
		</div>
		</div>
	</div>
</div>


@stop
@section('script')
	{{HTML::script('js/media.player.js')}}
@stop