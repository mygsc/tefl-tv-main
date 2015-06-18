@extends('layouts.partnership')

@section('title')
	TEFLTV Publisher
@stop

@section('content')
	<div class="row">
		<img src="/img/partner-banner.png" class="center-block visible-lg visible-md visible-sm" width="100%">
		<img src="/img/v-bg_sm.png" class="center-block visible-xs" width="100%">
	</div>
	<div class="">
		<div class="container">
			<div class="text-center tagline">
				<a href="{{route('partners/partners_program')}}"><button class="btn btn-primary">Get Started <i class="fa fa-chevron-right"></i></button></a>
				<button class="btn btn-info">Watch Video <i class="fa fa-play"></i></button>
			</div>
		</div>
		<br/>
		<div class="visible-xs">
			<br/><br/>
		</div>
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


