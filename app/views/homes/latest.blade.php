@extends('layouts.default')

@section('title')
    Latest Videos | TEFL Tv
@stop

@section('content')

<div class="container">
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 col-md-height hidden-xs hidden-sm col-top">
				<div class="mg-r-10 row mg-t--10">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div id="ad_sidebar" data-sticky_column="">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')

						</div>
					</div>
				</div>
			</div>
		<div class="col-md-8 same-H White h-minH col-md-height col-top">
			<div class="row">
				<h1 class="tblue mg-b-20 mg-t-20 mg-l-20">Latest Videos</h1>
				@foreach($latestVideos as $latestVideo)

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<div class="p-relative">
						<span class="v-time inline">{{$latestVideo->total_time}}</span>
						<a href="{{route('homes.watch-video', array('v=' .$latestVideo->file_name))}}" class="thumbnail-h">
							<div class="thumbnail-2">	
								<img class="hvr-grow-rotate" src="{{$latestVideo->thumbnail . '?' . rand(0,99)}}" width="100%">
								<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
							</div>
							<div class="video-info">
								<div class="v-Info">
									<a href="{{route('homes.watch-video', array('v=' .$latestVideo->file_name))}}">
										<span class="visible-lg">{{ Str::limit($latestVideo['title'],50)}}</span>
										<span class="visible-md">{{ Str::limit($latestVideo['title'],40)}}</span>
										<span class="visible-xs visible-sm">{{ Str::limit($latestVideo['title'],30)}}</span>
									</a>
								</div>
								<div class="count">
									by: <a href="{{route('view.users.channel', array($latestVideo->channel_name))}}">{{$latestVideo->channel_name}}</a>
									<br />
									{{number_format($latestVideo->views)}} Views | <!--<i class="fa fa-thumbs-up"></i>  {{$latestVideo->likes}} |--> {{date('F d, Y',strtotime($latestVideo->created_at))}}
							
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
</div>

@stop

<!--do not remove, it makes the left side nav sticks on it's position when page scrolls-->
@section('script')
	{{HTML::script('js/jquery.sticky-kit.min.js')}}
	{{HTML::script('js/sticky.js')}}
@stop
<!--cess-->