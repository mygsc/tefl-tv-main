@extends('layouts.default')

@section('content')

<div class="row White">
<div class="container h-minH">
	<div class="row">
		<div class="col-lg-9 col-md-8 same-H White ">
			<h1 class="tblue mg-b-20 mg-t-20">Popular Videos</h1>
			@foreach($popularVideos as $key => $popularVideo)
			<!-- 12 column / 3 column = 4 -->
			<a href="{{route('homes.watch-video', array($popularVideo->file_name))}}">
				<div class="col-md-4">
					<div class="p-relative">
						<span class="v-time inline">{{$popularVideo->total_time}}</span>
						<div class="thumbnail-2"> 
							<img class="hvr-grow-rotate" src="{{$popularVideo->thumbnail}}">
							<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
						</div>

					<div class="video-info">
						<div class="v-Info">
							<a href="{{route('homes.watch-video', array($popularVideo->file_name))}}">{{$popularVideo->title}}</a>
						</div>
						<div class="count">
							by: <a href="{{route('view.users.channel', array($popularVideo->channel_name))}}">{{$popularVideo->channel_name}}</a>
							<br />
							<i class="fa fa-eye"></i> {{number_format($popularVideo->views)}} | <i class="fa fa-thumbs-up"></i> {{$popularVideo->likes}} | {{date('F d, Y',strtotime($popularVideo->created_at))}}
						</div>
					</div>
					</div>
					<BR/>
				</div>
			</a>
			@endforeach
		</div>
		<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
			<div class="same-H grey pad-s-10">
				@include('elements/home/categories')
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
</div>
@stop