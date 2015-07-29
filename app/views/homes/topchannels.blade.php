@extends('layouts.default')

@section('title')
    Top Channels | TEFL Tv
@stop

@section('content')
<div class="container">
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 col-md-height hidden-xs hidden-sm col-top">
				<div class="mg-r-10 row mg-t--10" data-sticky_column="">
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
			<div class="col-md-8 White same-H col-md-height col-top">
				@include('elements.home.channel')
				<div class="text-center row mg-b-10" style="">
					<a href="{{route('homes.more-top-channels')}}"><b>Click here to view top 50 channels</b></a>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop