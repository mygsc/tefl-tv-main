@extends('layouts.default')

@section('content')

<div class="container page">
	<h1>Latest Videos</h1>
	@foreach($latestVideos as $latestVideo)
	<div class="col-md-3">
		<img src="/img/thumbnails/v10.png">
		<div class="v-Info">
			<a href="{{route('homes.watch-video')}}">{{$latestVideo->title}}</a>
		</div>
		<div class="count">
			by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
			<br />
			<i class="fa fa-eye"></i> {{$latestVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$latestVideo->likes}} | <i class="fa fa-calendar"></i> {{$latestVideo->created_at}}
		</div>
	</div>
	@endforeach
</div>


@stop