@extends('layouts.default')

@section('content')
<div class="container page">
	<h1>Popular Videos</h1>
	@foreach($popularVideos as $key => $popularVideo)
	<!-- 12 column / 3 column = 4 -->
	<div class="col-md-3">
		<img src="/img/thumbnails/v4.png">

		<div class="v-Info">
			<a href="{{route('homes.watch-video')}}">{{$popularVideo->title}}</a>
		</div>
		<div class="count">
			by: <a href="{{route('view.users.channel', array($popularVideo->channel_name))}}">{{$popularVideo->channel_name}}</a>
			<br />
			<i class="fa fa-eye"></i> {{$popularVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$popularVideo->likes}} | <i class="fa fa-calendar"></i> {{$popularVideo->created_at}}
		</div>
		<BR/>
	</div>
	@endforeach
</div>
@stop