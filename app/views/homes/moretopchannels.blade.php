@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container">
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 col-md-height hidden-xs hidden-sm col-top">
				<div class="mg-r-10 row mg-t--10">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>

					<div class="sidebar" data-sticky_column="">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')

						</div>
					</div>
				</div>
			</div>
		<div class="col-md-8 col-md-height col-top White same-H">
			<div id="floatboxanchor">
				<h1 class="tblue mg-b-20 mg-t-20"> TOP 50 Channels</h1>
				@include('elements.home.channel')
			</div>
		</div>
	
	</div>
	</div>
</div>
@stop