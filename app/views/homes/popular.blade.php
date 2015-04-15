@extends('layouts.default')

@section('content')
<div class="container page">
	<h1>Popular Videos</h1>
	@foreach($popularVideos as $key => $popularVideo)
	<!-- 12 column / 3 column = 4 -->
	<a href="{{route('homes.watch-video', array($popularVideo->file_name))}}">
		<div class="col-md-3 col-xs-6 hidden-xs">
			<span class="v-time inline">{{$popularVideo->total_time}}</span>
			<div class="thumbnail"> 
				<img class="hvr-grow-rotate" src="{{$popularVideo->thumbnail}}">
			</div>
			<div class="v-Info">
				<a href="{{route('homes.watch-video', array($popularVideo->file_name))}}">{{$popularVideo->title}}</a>
			</div>
			<div class="count">
				by: <a href="{{route('view.users.channel', array($popularVideo->channel_name))}}">{{$popularVideo->channel_name}}</a>
				<br />
				<i class="fa fa-eye"></i> {{$popularVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$popularVideo->likes}} | {{date('F d, Y',strtotime($popularVideo->created_at))}}
			</div>
			<BR/>
		</div>
	</a>
	@endforeach
</div>
@stop