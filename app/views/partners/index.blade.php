@extends('layouts.partner')

@section('title')
TEFLTV Publisher
@stop

@section('content')



<main>
	<div id="cmn-video-demo3__container">
		<video id="cmn-video-demo3__video" autoplay muted loop="true">
        	<source src="/videos/tefltv.mp4" type="video/mp4">
	    	<source src="/videos/tefltv.webm" type="video/webm">
        	Your browser doesn't support HTML5 video. Here's a <a href="#">link</a> to download the video.
      	</video>
		<div id="cmn-video-demo3__content">
			<div class="text-center tagline" style="margin-top:70px;">
				<a href=""><button class="btn btn-primary">Get Started <i class="fa fa-chevron-right"></i></button></a>
				<a href=""><button class="btn btn-info">Watch Video <i class="fa fa-play"></i></button></a>
			</div>
		</div>
	</div>
</main><!-- /main -->

<div class="">
	<div class="container">
		<div class="row text-center div-Steps">
			<div class="col-sm-4 col-md-4">
				<img src="/img/icons/par-upload.png" class="wow rollIn"  data-wow-duration="1s" data-wow-delay="1s">
				<h2>Upload your own videos.</h2>
			</div>
			<div class="col-sm-4 col-md-4">
				<img src="/img/icons/par-share.png" class="wow rotateIn"  data-wow-duration="1s" data-wow-delay="2s">
				<h2>Embed video to your website or share to your social media accounts.</h2>
			</div>
			<div class="col-sm-4 col-md-4">
				<img src="/img/icons/par-earn.png" class="wow rotateInUpRight"  data-wow-duration="1s" data-wow-delay="3s">
				<h2>Earn Revenue from every advertisement.</h2>
			</div>
		</div>
	</div>
	<img src="/img/partners/lower-banner.jpg" width="100%">
	<div class="row White">
		<div class="container text-center div-partners">
			<h1 class="orangeC">-Featured Partners-</h1>


			<div class="col-md-4">
				<a href="http://www.auathailand.org" target="_blank">
					<img src="/img/logos/aua.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="1s">
				</a>
			</div>
			<div class="col-md-4">
				<a href="http://www.teflEducators.com" target="_blank" >
					<img src="/img/logos/te.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="2s">
				</a>
			</div>
			<div class="col-md-4">
				<a href="http://www.britishteachers.org.uk" target="_blank">
					<img src="/img/logos/bt.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="3s">
				</a>
			</div>
		</div>
	</div>
</div>

@stop


