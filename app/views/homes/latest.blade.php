@extends('layouts.default')

@section('content')

<div class="container page">
	<h1>Latest Videos</h1>
	@foreach($latestVideos as $latestVideo)
	<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">
		<div class="col-md-3">
			@if(file_exists($latestVideo->video_poster))
			<img width="100%" src="{{$latestVideo->poster_path}}">
			@else
			<img width="100%" src="/img/thumbnails/video.png">
			@endif
			<div class="v-Info">
				<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">{{$latestVideo->title}}</a>
			</div>
			<div class="count">
				by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
				<br />
				<i class="fa fa-eye"></i> {{$latestVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$latestVideo->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($latestVideo->created_at))}}
			</div>
		</div>
	</a>
	@endforeach
</div>


@stop