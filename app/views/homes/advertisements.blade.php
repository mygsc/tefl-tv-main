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
	.play{
		padding:0 5px;
		margin-right: 10px;
	}
	.sound{
		padding:0 5px;

	}

	.fullscreen{
		padding:0 5px;

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
	progress::-webkit-progress-bar {
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



</style>
<div class="container page">
<br/>
	<div class="col-md-7">
		<!--replace image with video-->
		<img src="/img/thumbnails/v1.png">
		<!--/replace-->

		<div class="wrapper">
			<progress value="60" max="100"></progress>
			<span class="play">
			<img src="/img/icons/play.png"></span>
			<span class="title">Vocabulary and Memory Test</span>
			<span class="pull-right">
				<span class="time">6:05 /  10:00</span>
				<span class="sound"><img src="/img/icons/sound.png"></span>
				<span class="fullscreen"><img src="/img/icons/fullscreen.png"></span>
				<img src="/img/logos/teflTv.png" class="playerLogo">
			</span>
		</div>
	</div>
</div>


@stop