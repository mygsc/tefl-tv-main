@extends('layouts.default')

@section('content')

<div class="container page">
	<h1>Latest Videos</h1>
	@foreach($latestVideos as $latestVideo)
	
	<div class="col-lg-3 col-md-3 col-sm-6 hidden-xs ">
		<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}" class="thumbnail-h">
			<div class="thumbnail"> 
				@if(file_exists($latestVideo->video_poster))
				<img class="hvr-grow-rotate" src="{{$latestVideo->poster_path}}">
				@else
				<img class="hvr-grow-rotate"src="/img/thumbnails/video.png">
				@endif
			</div>
			<div class="v-Info">
				<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">{{$latestVideo->title}}</a>
			</div>
			<div class="count">
				by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
				<br />
				<i class="fa fa-eye"></i> {{$latestVideo->views}} | <i class="fa fa-thumbs-up"></i>  | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($latestVideo->created_at))}}
			</div>
		</a>	
	</div>

	<div class="col-md-12 visible-xs">
		<div class="row">
			<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">
				<div class="col-xs-4">
					@if(file_exists($latestVideo->video_poster))
					<img class="thumbnail" src="{{$latestVideo->poster_path}}">
					@else
					<img class="thumbnail" src="/img/thumbnails/video.png">
					@endif
				</div>
				<div class="col-xs-8">
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">{{$latestVideo->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{$latestVideo->views}} | <i class="fa fa-thumbs-up"></i> | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($latestVideo->created_at))}}
					</div>
				</div>
			</a>	
		</div>
	</div>

	@endforeach
</div>


@stop