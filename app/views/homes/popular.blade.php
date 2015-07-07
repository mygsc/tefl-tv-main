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
					<div id="ad_sidebar">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-md-height same-H White col-top h-minH ">
				<div id="floatboxanchor">
					<h1 class="tblue mg-b-20 mg-t-20">Popular Videos</h1>
					@foreach($popularVideos as $key => $popularVideo)
					<!-- 12 column / 3 column = 4 -->
					<a href="{{route('homes.watch-video', array('v=' .$popularVideo->file_name))}}">
						<div class="col-md-3">
							<div class="p-relative">
								<span class="v-time inline">{{$popularVideo->total_time}}</span>
								<div class="thumbnail-2"> 
									<img class="hvr-grow-rotate" src="{{$popularVideo->thumbnail . '?' . rand(0,99)}}" width="100%">
									<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
								</div>

							<div class="video-info">
								<div class="v-Info">
									<a href="{{route('homes.watch-video', array($popularVideo->file_name))}}">{{$popularVideo->title}}</a>
								</div>
								<div class="count">
									by: <a href="{{route('view.users.channel', array($popularVideo->channel_name))}}">{{$popularVideo->channel_name}}</a>
									<br />
									{{number_format($popularVideo->views)}} Views | <!--<i class="fa fa-thumbs-up"></i> {{$popularVideo->likes}} |--> {{date('F d, Y',strtotime($popularVideo->created_at))}}
									
								</div>
							</div>
							</div>
						</div>
					</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@stop