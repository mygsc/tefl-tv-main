@extends('layouts.default')


@section('content')
<div class="container page">
	@include('elements.home.randoms.channel')
</div>
@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop