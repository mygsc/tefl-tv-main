@extends('layouts.default')
@section('title')
	Welcome to TEFL tv
@stop

@section('meta')
	<meta charset="UTF-8">
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{URL::full()}}">
	<meta property="og:title" content="Watch TEFL Tv">
	<meta property="og:site_name" content="TEFL Tv"/>
	<meta property="og:image" content="{{URL::full()}}/img/seo_image.png">
	<meta property="og:type" content="website">
	<meta name="og:description" content="Tefltv is a video-hosting website that concentrates on all facets of teaching English as a foreign language.

	Teachers, students and schools a like, can watch or actively participate by uploading videos in the following categories:

	For Teachers  
	For Students  
	For Schools 
	Video Blog 
	Music 
	Animated Video 
	Animated Music Video 
	Advice 
	Podcast 
	Interviews 
	Documentaries 
	Video CV 
	Job AD 
	Miscellaneous

	Tefltv welcomes all videos that might be interesting for the ESL community. This could range from instructionals for teachers and students, to video blogs about life as an ESL professional or student. 

	There are various ways to monetize your videos with Tefltv as a “partner” or “publisher.” For more information, please visit our website at Tefltv.com
	">
	<meta name="keywords" content="TEFL TV, TEFL, ESL TV, Teaching English, English language, Videos, TESOL VIDEO, TEFL Videos, For Teachers, For Students, Video Blog, Documentaries Interviews,Advice">
	<meta name="author" content="TEFL tv">
@stop
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/video-player/fullscreen.min.js')}}
{{HTML::script('js/adsbygoogle.js')}}
<script>
if(window.isAdsDisplayed === undefined ) {
	$('.antiablock').removeClass('hidden');
}
</script>
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="mg-b-10">
			<div class="">	
				<div class="ad-bg same-H mg-t-10 White">
					<div class="row">
						<div class="row-same-height">
							<div class="col-md-7 col-md-height col-middle" style="">
								<div class="mg-b-10">
									<div class="vid-wrapperb p-relative">
										<div id="vid-controls">
											<div class="embed-responsive embed-responsive-16by9 n-mg-b">
												<video class="video-1" preload="none" id="media-video" poster="/img/thumbnails/v1-h.png">
													<source  src='/videos/tefltv.mp4' id="mp4" type='video/mp4'/>
													<source  src='/videos/tefltv.webm' id="webm" type='video/webm'/>
												</video>
											</div><!--/embed-responsive-->
											<div class="n-mg-b">
												@include('elements/videoPlayer')
											</div>
										</div>
									</div>
								</div><!--/.row-->
							</div>
							<div class="col-md-5 col-md-height col-middle">
								<div class="content-padding">
									<div class="visible-lg visible-md hidden-sm hidden-xs d-table">
										<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<!-- Left-Box -->
										<div class="ads-relative-wrapper-box ads-box ads-box-md" target="_blank">
											<ins class="adsbygoogle"
											style="display:block"
											data-ad-client="ca-pub-3138986188138771"
											data-ad-slot="8119606848"
											data-ad-format="auto"></ins>
											<script>
												(adsbygoogle = window.adsbygoogle || []).push({});
											</script>
										</div>
									</div>
								</div>
								<div class="visible-sm visible-xs hidden-md hidden-lg">
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<!-- Home page banner -->
									<div class="ads-relative-wrapper-top">
										<ins class="adsbygoogle"
										style="display:block"
										data-ad-client="ca-pub-3138986188138771"
										data-ad-slot="6642873645"
										data-ad-format="auto"></ins>
										<script>
											(adsbygoogle = window.adsbygoogle || []).push({});
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container  hidden ">
			<div class="row  White same-H mg-t-10">
				<div class=" ">
					<div class="col-md-6 col-md-offset-3">
						<div class="antiablock text-center">
							<BR/>

							<img src="/img/adblock_player.png" width="100%">
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
				
		<div class="row" data-sticky_parent="" style="position:relative;">
			<div class="row-same-height">
				<div class="col-lg-3 col-md-3 hidden-xs hidden-sm col-md-height col-top ">
					<div class="mg-r-10 mg-t--10">
						<div data-sticky_column="">
							@include('elements/home/categories')
							
							<div class="mg-t-10">
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
				</div>
				<div class="col-md-9 col-md-height col-top" >
					<!--RECOMMENDED VIDEOS SECTION -->
					<div class="top-div col-md-12">
						<div class=" row">
							<h2 class="inline mg-l-20">Recommended Videos</h2>
						</div>
					</div>

					<div class="col-md-12 White same-H">
						<br/>
						<div class="row ">
							@foreach($recommendeds as $recommended)
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<div class="p-relative">
									<a href='{{route('homes.watch-video', array('v='. $recommended->file_name))}}'>
										<span class="v-time inline">{{$recommended->total_time}}</span> 	
										<div class="thumbnail-2">
											<img class="hvr-grow-rotate main_image" id="" src="{{$recommended->thumbnail . '?' . rand(0,99)}}" width="100%" height="100%">
											<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
										</div>
										<div class="video-info">
											<div class="v-Info">
												<a href='{{route('homes.watch-video', array('v='. $recommended->file_name))}}'>
													<span class="visible-lg">{{ Str::limit($recommended['title'],50)}}</span>
													<span class="visible-md">{{ Str::limit($recommended['title'],40)}}</span>
													<span class="visible-xs visible-sm">{{ Str::limit($recommended['title'],30)}}</span>
												</a>
											</div>
											<div class="count">
												by: <a href="{{route('view.users.channel', array($recommended->channel_name))}}">{{$recommended->channel_name}}</a>
												<br />
												{{number_format($recommended->views,0,null,',')}} Views <!--| <i class="fa fa-thumbs-up"></i> {{$recommended->likes}}--> | {{date('F d, Y',strtotime($recommended->created_at))}}
											</div>
										</div>
									</a>
								</div>
							</div>
							@endforeach
					</div><!--/.col-md-12-->
				</div><!--/.row for recommended videos-->
				<br/>

				<div class="top-div col-md-12 mg-t-20">
					<div class=" row">
						<h2 class="inline mg-l-20">Popular Videos</h2>
					</div>
				</div>
				<div class="col-md-12 White same-H">
					<br/>
					<div class="row ">
						@foreach($populars as $popular)
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="p-relative">
								<span class="v-time inline">{{$popular->total_time}}</span>
								<a href='{{route('homes.watch-video', array('v=' . $popular->file_name))}}' class="thumbnail-h">
									<div class="thumbnail-2">
										<img class="hvr-grow-rotate" src="{{$popular->thumbnail. '?' . rand(0,99)}}" width="100%">
										<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
									</div>
									<div class="video-info">
										<div class="v-Info">
											<a href='{{route('homes.watch-video', array('v=' .$popular->file_name))}}'>
												<span class="visible-lg">{{ Str::limit($popular['title'],50)}}</span>
												<span class="visible-md">{{ Str::limit($popular['title'],40)}}</span>
												<span class="visible-xs visible-sm">{{ Str::limit($popular['title'],30)}}</span>
											</a>
										</div>
										<div class="count">
											by: <a href="{{route('view.users.channel', array($popular->channel_name))}}">{{$popular->channel_name}}</a>
											<br />
											{{number_format($popular->views,0,null,',')}} Views <!--| <i class="fa fa-thumbs-up"></i> {{$popular->likes}}--> | {{date('F d, Y',strtotime($popular->created_at))}}											
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<br/>
				<div class="top-div col-md-12 mg-t-20">
					<div class=" row">
						<h2 class="inline mg-l-20">Videos For Students</h2>
					</div>
				</div>
				<div class="col-md-12 White same-H">
					<br/>
					<div class="row">
						@foreach($forschools as $forschool)
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="p-relative">
								<a href='{{route('homes.watch-video', array('v=' . $forschool->file_name))}}' class="thumbnail-h">
									<span class="v-time inline">{{$forschool->total_time}}</span>
									<div class="thumbnail-2">
										<img class="hvr-grow-rotate"  src="{{$forschool->thumbnail. '?' . rand(0,99)}}" width="100%">
										<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
									</div>
									<div class="video-info">
										<div class="v-Info">
											<a href='{{route('homes.watch-video', array('v=' . $forschool->file_name))}}'>
												<span class="visible-lg">{{ Str::limit($forschool['title'],50)}}</span>
												<span class="visible-md">{{ Str::limit($forschool['title'],40)}}</span>
												<span class="visible-xs visible-sm">{{ Str::limit($forschool['title'],30)}}</span>
											</a>
										</div>
										<div class="count">
											by: <a href="{{route('view.users.channel', array($forschool->channel_name))}}">{{$forschool->channel_name}}</a>
											<br />
											{{number_format($forschool->views,0,null,',')}} Views | <!--<i class="fa fa-thumbs-up"></i> {{$forschool->likes}} |--> {{date('F d, Y',strtotime($forschool->created_at))}}
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<br/>
				<div class="top-div col-md-12 mg-t-20">
					<div class=" row">
						<h2 class="inline mg-l-20">Random Videos</h2>
					</div>
				</div>
				<div class="col-md-12 White same-H">
					<br/>
					<div class="row">
						@foreach($randoms as $random)
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="p-relative">
								<a href='{{route('homes.watch-video', array( 'v=' . $popular->file_name))}}' class="thumbnail-h">
									<span class="v-time inline">{{$random->total_time}}</span>
									<div class="thumbnail-2">
										<img class="hvr-grow-rotate" src="{{$random->thumbnail. '?' . rand(0,99)}}" width="100%">
										<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
									</div>
									<div class="video-info">
										<div class="v-Info">
											<a href='{{route('homes.watch-video', array('v=' . $random->file_name))}}'>
												<span class="visible-lg">{{ Str::limit($random['title'],50)}}</span>
												<span class="visible-md">{{ Str::limit($random['title'],40)}}</span>
												<span class="visible-xs visible-sm">{{ Str::limit($random['title'],30)}}</span>
											</a>
										</div>
										<div class="count">
											by: <a href="{{route('view.users.channel', array($random->channel_name))}}">{{$random->channel_name}}</a>
											<br />
											{{number_format($random->views,0,null,',')}} Views | <!--<i class="fa fa-thumbs-up"></i> {{$random->likes}} |--> {{date('F d, Y',strtotime($random->created_at))}}
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
						<!-- {{Form::hidden('autoplay',0,['id'=>'autoplay'])}}
						{{Form::hidden('duration',41,['id'=>'duration'])}} -->
					</div><!--first row-->
				</div>
			</div><!--/.container page-->
		</div>
	</div>
	@stop
<script>
	function addClassByClick(button){
  		$(button).addClass("active")
		}
</script>

<!--do not remove, it makes the left side nav sticks on it's position when page scrolls-->
@section('script')
	{{HTML::script('js/jquery.sticky-kit.min.js')}}
	{{HTML::script('js/sticky.js')}}
@stop
<!--cess-->

