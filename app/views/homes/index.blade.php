@extends('layouts.default')
	@section('meta')
		{{-- <meta property="og:title" content="dynamic">
		<meta property="og:site_name" content="test.tefltv.com">
		<meta property="og:description" content="dynamic">
		<meta property="og:url" content="dynamic">
		<meta property="og:image" content="/img/thumbnails/video.png"> 
		<meta property="og:type" content="video">
		<meta property="og:video:width" content="500"> 
		<meta property="og:video:height" content="300"> 
		<meta property="og:video" content="test.tefltv.com">  --}}
		
	@stop
	@section('css')
		{{HTML::style('css/vid.player.min.css')}}
	@stop
	@section('some_script')
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::script('js/video-player/fullscreen.min.js')}}
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9 White same-H">
			<div class="row">	
				<div class="ad-bg">
					<div class="row">
						<div class="col-md-6" style="">
							<div class="mg-l-10  mg-b-10">
								<div class="vid-wrapperb p-relative">
									<div id="vid-controls">
										<div class="embed-responsive embed-responsive-16by9 n-mg-b">
							              	<video preload="auto" id="media-video" poster="/img/thumbnails/v1.png">
												<source id='mp4' src='/videos/tefltv.mp4' type='video/mp4'>
												<source id='webm' src='/videos/tefltv.webm' type='video/webm'>
												<source id='ogg' src='/videos/tefltv.ogvq' type='video/ogg'> 
											</video>	
										</div><!--/embed-responsive-->
										<div class="n-mg-b">
											@include('elements/videoPlayer')
										</div>
									</div>
					    		</div><!--/.row-->
			    			</div>
						</div><!--/.col-md-6-->
						<div class="col-md-6">
						</div>
					</div>
				</div>
			</div>

		<!--RECOMMENDED VIDEOS SECTION -->
		<div class="row grey mg-t--20">
		
			<h2 class="orangeC mg-l-10">Recommended Videos</h2>
			<div class="col-md-12">
				<div class="row ">
					@foreach($recommendeds as $recommended)
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="p-relative">
							<a href="{{route('homes.watch-video', array($recommended->file_name))}}">
								<span class="v-time inline">{{$recommended->total_time}}</span> 	
								<div class="thumbnail-2">
									<img class="hvr-grow-rotate"  src="{{$recommended->thumbnail}}">
									<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
								</div>
								<div class="video-info">
									<div class="v-Info">
										<a href="{{route('homes.watch-video', array($recommended->file_name))}}">{{$recommended->title}}</a>
									</div>
									<div class="count">
										by: <a href="{{route('view.users.channel', array($recommended->channel_name))}}">{{$recommended->channel_name}}</a>
										<br />
										<i class="fa fa-eye"></i> {{number_format($recommended->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$recommended->likes}} | {{date('F d, Y',strtotime($recommended->created_at))}}
									</div>
								</div>
							</a>
						</div>
					</div>
					@endforeach
				</div>
	
			</div><!--/.col-md-12-->
		
		</div><!--/.row for recommended videos-->
		<div class="row">
			<h2 class="orangeC mg-l-10">Popular Videos</h2>
			@foreach($populars as $popular)
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="p-relative">
					<a href="{{route('homes.watch-video', array($popular->file_name))}}">
						<span class="v-time inline">{{$popular->total_time}}</span>
						<div class="thumbnail-2">
							<img class="hvr-grow-rotate" src="{{$popular->thumbnail}}">
							<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
						</div>
						<div class="video-info">
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($popular->file_name))}}">{{$popular->title}}</a>
							</div>
							<div class="count">
								by: <a href="{{route('view.users.channel', array($popular->channel_name))}}">{{$popular->channel_name}}</a>
								<br />
								<i class="fa fa-eye"></i> {{number_format($popular->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$popular->likes}} | {{date('F d, Y',strtotime($popular->created_at))}}
							</div>
						</div>
					</a>
				</div>
			</div>
			@endforeach
			
		</div>

			
		<div class="row grey">
			<h2 class="orangeC mg-l-10">Latest Videos</h2>

			@foreach($latests as $latest)
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="p-relative">
					<a href="{{route('homes.watch-video', array($latest->file_name))}}">

						<span class="v-time inline">{{$latest->total_time}}</span>
						<div class="thumbnail-2">
							<img class="hvr-grow-rotate"  src="{{$latest->thumbnail}}">
							<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
						</div>
						<div class="video-info">
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($latest->file_name))}}">{{$latest->title}}</a>
							</div>

							<div class="count">
								by: <a href="{{route('view.users.channel', array($latest->channel_name))}}">{{$latest->channel_name}}</a>
								<br />
								<i class="fa fa-eye"></i> {{number_format($latest->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$latest->likes}} | {{date('F d, Y',strtotime($latest->created_at))}}
							</div>
						</div>
					</a>
				</div>
			</div>
			@endforeach
			
		</div>

		<div class="row">
			<h2 class="orangeC mg-l-10">Random Videos</h2>
			@foreach($randoms as $random)
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="p-relative">
					<a href="{{route('homes.watch-video', array($popular->file_name))}}">
						<span class="v-time inline">{{$popular->total_time}}</span>
						<div class="thumbnail-2">
							<img class="hvr-grow-rotate" src="{{$random->thumbnail}}">
							<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
						</div>
						<div class="video-info">
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($random->file_name))}}">{{$random->title}}</a>
							</div>
							<div class="count">
								by: <a href="{{route('view.users.channel', array($random->channel_name))}}">{{$random->channel_name}}</a>
								<br />
								<i class="fa fa-eye"></i> {{number_format($random->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$random->likes}} | {{date('F d, Y',strtotime($random->created_at))}}
							</div>
						</div>
					</a>
				</div>
			</div>
			@endforeach
			
		</div>
		<br/>
	</div><!--/.container page-->
	<div class="col-lg-3 col-md-3 hidden-xs hidden-sm">
			<div class="same-H grey pad-s-10">
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
</div><!--first row-->
</div>
</div>
@stop



