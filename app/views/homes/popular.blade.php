@extends('layouts.default')

@section('content')
<div class="container page">
	<h1>Popular Videos</h1>
	@foreach($latestVideos as $key => $latestVideo)
	<!-- 12 column / 3 column = 4 -->
		<div class="col-md-3">
			<img src="/img/thumbnails/v4.png">

			<div class="v-Info">
				<a href="{{route('homes.watch-video')}}">{{$latestVideo->title}}</a>
			</div>
			<div class="count">
				Channel: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
				<br />
				Views: {{$latestVideo->views}}, Likes: {{$latestVideo->likes}}
				<br />
				Date Uploaded: {{$latestVideo->created_at}}
			</div>
		</div>

	@endforeach

</div>
@stop