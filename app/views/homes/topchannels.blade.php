@extends('layouts.default')


@section('content')
<div class="container page">
	@include('elements.home.randoms.channel')
	<div class="text-center row" style="">
		<a href="{{route('homes.more-top-channels')}}"><b>Click here to view top 50 channels</b></a>

	</div>
</div>
@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop