@extends('layouts.default')

@section('content')

<div class="container h-minH ">
	<div class="row">
		<div class="col-lg-9 col-md-8 same-H White ">
			<h1 class="orangeC">Latest Videos</h1>
			@foreach($latestVideos as $latestVideo)
			<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs ">
				<span class="v-time inline">{{$latestVideo->total_time}}</span>
				<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}" class="thumbnail-h">
					<div class="thumbnail-2"> 
						<img class="hvr-grow-rotate" src="{{$latestVideo->thumbnail}}">
					</div>
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">{{$latestVideo->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{$latestVideo->views}} | <i class="fa fa-thumbs-up"></i>  {{$latestVideo->likes}} | {{date('F d, Y',strtotime($latestVideo->created_at))}}
					</div>
				</a>	
			</div>
			@endforeach
		</div>
		<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
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