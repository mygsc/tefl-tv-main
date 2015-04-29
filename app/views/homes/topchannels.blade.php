@extends('layouts.default')

@section('content')
<div class="container h-minH  ">
	<div class="row">
		<div class="col-lg-9 col-md-8 White same-H">

			@include('elements.home.channel')
			<div class="text-center row mg-b-10" style="">
				<a href="{{route('homes.more-top-channels')}}"><b>Click here to view top 50 channels</b></a>
			</div>
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

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop