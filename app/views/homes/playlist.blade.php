@extends('layouts.default')

@section('title')
	Top Playlist - TEFL TV
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-8 same-H White h-minH">
						@include('elements.home.playlist')
			</div>

			<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
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

@section('script')

@stop