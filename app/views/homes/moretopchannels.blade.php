@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container h-minH  ">
	<div class="row">
		<div class="col-lg-9 col-md-8 White same-H">
			<h1 class="orangeC"> TOP 50 Channels</h1>
			@include('elements.home.randoms.channel')
		</div>
	
		<div class="col-lg-3 col-md-4">
			<div class="same-H grey pad-s-10">
				<div>
					@include('elements/home/carouselAds')
				</div>
				<div class="mg-t-10">
					@include('elements/home/adverstisementSmall')
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop