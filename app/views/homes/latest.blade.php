@extends('layouts.default')

@section('content')

<div class="container">
	<div class="row mg-t-10">
		<div class="row-same-height">
			<div class="col-md-3 col-md-height hidden-xs hidden-sm col-top">
				<div class="mg-r-10 row mg-t--10">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div class="mg-t-10">
						@include('elements/home/carouselAds')
					</div>
					<div class="mg-t-10">
						@include('elements/home/adverstisementSmall')

					</div>
				</div>
			</div>
		<div class="col-md-8 same-H White h-minH col-md-height col-top">
			<h1 class="tblue mg-b-20 mg-t-20">Latest Videos</h1>
			@foreach($latestVideos as $latestVideo)
			<div class="col-lg-4 col-md-4">
				<div class="p-relative">
					<span class="v-time inline">{{$latestVideo->total_time}}</span>
					<a href="{{route('homes.watch-video', array('v=' .$latestVideo->file_name))}}" class="thumbnail-h">
						<div class="thumbnail-2">	
							<img class="hvr-grow-rotate" src="{{$latestVideo->thumbnail . '?' . rand(0,99)}}" width="100%">
							<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
						</div>
						<div class="video-info">
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($latestVideo->file_name))}}">{{$latestVideo->title}}</a>
							</div>
							<div class="count">
								by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
								<!--<br />
								<i class="fa fa-eye"></i> {{number_format($latestVideo->views)}} | <i class="fa fa-thumbs-up"></i>  {{$latestVideo->likes}} | {{date('F d, Y',strtotime($latestVideo->created_at))}}
								-->
							</div>
							
						</div>
						
					</a>
				</div>	
			</div>
			@endforeach
		</div>
		</div>
	</div>
</div>

@stop