@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container">
	<h1> TOP 50 Channels</h1>
	@foreach($topChannels as $topChannel)
	<div class="col-md-12">
		<div class="row">
			{{HTML::image($topChannel->image_src, 'alt')}}<br />
			Channel Name: <a href="#">{{$topChannel->channel_name}}</a><br />
			TOTAL VIEWS : {{$topChannel->total}}
		</div>
	</div>
	@endforeach

	<br>
	<br>
	<a href="{{route('homes.more-top-channels')}}">Click here to view all top channels</a>
</div>
@stop