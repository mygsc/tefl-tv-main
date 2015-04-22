@extends('layouts.default')

@section('content')
<div class="container h-minH">
	<div class="col-lg-9 col-md-8 White">
		@include('elements.home.randoms.channel')
		<div class="text-center row" style="">
			<a href="{{route('homes.more-top-channels')}}"><b>Click here to view top 50 channels</b></a>
		</div>
	</div>
	<div class="col-lg-3 col-md-4">
		<div>
			@include('elements/home/carouselAds')
		</div>
		<div class="mg-t-10">
			@include('elements/home/adverstisementSmall')
			
		</div>
	</div>
</div>
@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop