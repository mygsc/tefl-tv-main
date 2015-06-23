@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container h-minH ">
	<div class="row">
		<div class="col-lg-3 col-md-3 hidden-xs hidden-sm">

				<div class=" mg-r-10 row">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div class="mg-t-10">
						@include('elements/home/carouselAds')
					</div>
					<div class="mg-t-10">
						@include('elements/home/adverstisementSmall')

					</div>
				</div>
			</div>
		<div class="col-lg-9 col-md-8 White same-H  mg-t-10">
			<h1 class="tblue mg-b-20 mg-t-20"> TOP 50 Channels</h1>
			@include('elements.home.channel')
		</div>
	
		
	</div>
</div>
@stop