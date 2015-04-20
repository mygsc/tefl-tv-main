@extends('layouts.default')
	@section('meta')
		<meta property="og:title" content="dynamic">
		<meta property="og:site_name" content="test.tefltv.com">
		<meta property="og:description" content="dynamic">
		<meta property="og:url" content="dynamic">
		<!-- <meta property="og:image" content="/videos/"> -->
		<meta property="og:type" content="video">
		<meta property="og:video:width" content="500"> 
		<meta property="og:video:height" content="300"> 
		<meta property="og:video" content="test.tefltv.com/watch=vWpcBEBlSre"> 
		
	@stop
	@section('css')
		{{HTML::style('css/vid.player.min.css')}}
	@stop
	@section('some_script')
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::script('js/video-player/fullscreen.min.js')}}
@stop
@section('content')
<div class="row">
	<div class="container page2">
		<BR/>
		<div class="row same-H">	
			<div class="col-md-6" style="">
				<div class="">
					<div class="row  vid-wrapper">
						<div id="vid-controls">
							<div class="embed-responsive embed-responsive-16by9 n-mg-b">
				              	<video preload="auto" id="media-video" poster="/img/thumbnails/v1.png">
									<source src='/videos/tefltv.mp4' type='video/mp4'>
									<source src='/videos/tefltv.webm' type='video/webm'>
									<source src='/videos/tefltv.ogg' type='video/ogg'>
								</video>	
							</div><!--/embed-responsive-->
							@include('elements/videoPlayer')
						</div>
		    		</div><!--/.row-->
    			</div>
			</div><!--/.col-md-8-->

			<div class="col-md-6 col-lg-height col-top">
                <div class="row">
                	<div class="col-md-7">
	                    <div class="ad1 col-md-12 col-sm-6 col-xs-6" style="margin-bottom:10px;">
	                        <a href="http://tefleducators.com/"><img src="/img/ads/large-rectangle.jpg" class="adDiv"></a>
	                    </div><!--/.ad1-->
                    
	                    <div class="ad2 col-md-12 col-sm-6 col-xs-6">
	                        <a href="http://www.auathailand.org/"><img src="/img/ads/half-large-rectangle.jpg" class="adDiv"></a>
	                   </div><!--/.ad2-->
                    </div>
					<div class="col-md-5 ctgryDiv hidden-sm">
						<h4>Categories</h4>
						<span class="">
							@if(!empty($categories))
							@foreach($categories as $category)
								{{$category}}
							@endforeach
							@endif
						</span>
					</div>
				</div><!--/.row of col4-->
			</div>
		</div><!--/.same-H-->
		<!--RECOMMENDED VIDEOS SECTION -->
		<br/>
		<div class="row same-H">
			<div class="categoryHead" style="width:99%!Important">
				<h3>Recommended Videos</h3>
			</div><!--/.recommended video-->

			<div class="col-md-12">
				<div class="row">
					@foreach($recommendeds as $recommended)
					<div class="col-lg-2 col-md-4 col-sm-6">
						<a href="{{route('homes.watch-video', array($recommended->file_name))}}">
							<span class="v-time inline">{{$recommended->total_time}}</span> 	
							<div class="thumbnail-2">
								<img class="hvr-grow-rotate"  src="{{$recommended->thumbnail}}">
							</div>
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($recommended->file_name))}}">{{$recommended->title}}</a>
							</div>
							<div class="count">
								by: <a href="{{route('view.users.channel', array($recommended->channel_name))}}">{{$recommended->channel_name}}</a>
								<br />
								<i class="fa fa-eye"></i> {{number_format($recommended->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$recommended->likes}} | {{date('F d, Y',strtotime($recommended->created_at))}}
							</div>
						</a>
					</div>
					@endforeach
				</div>
			</div><!--/.col-md-12-->
		
		</div><!--/.row for recommended videos-->
		<br/>
		<div class="row same-H">
			<div class="categoryHead" style="width:99%!Important">
				<h3>Popular</h3>
			</div>
			@foreach($populars as $popular)
			<div class="col-lg-2 col-md-4 col-sm-6">
				<a href="{{route('homes.watch-video', array($popular->file_name))}}">
					<span class="v-time inline">{{$popular->total_time}}</span>
					<div class="thumbnail-2">
						<img class="hvr-grow-rotate" src="{{$popular->thumbnail}}">
					</div>

					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($popular->file_name))}}">{{$popular->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($popular->channel_name))}}">{{$popular->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{number_format($popular->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$popular->likes}} | {{date('F d, Y',strtotime($popular->created_at))}}
					</div>
				</a>
			</div>
			@endforeach
		</div>
		<div class="row mg-b-10">
			<div class="text-center">
				{{ link_to_route('homes.popular', 'SEE MORE', null, array('class' => 'see-m-v see-m-v-a')) }}
			</div>
		</div>
	
		<div class="row same-H">
			<div class="categoryHead" style="width:99%!Important">
				<h3>Recent Uploads</h3>
			</div>
			@foreach($latests as $latest)
			<div class="col-lg-2 col-md-4 col-sm-6">
				<a href="{{route('homes.watch-video', array($latest->file_name))}}">

					<span class="v-time inline">{{$latest->total_time}}</span>
					<div class="thumbnail-2">
						<img class="hvr-grow-rotate"  src="{{$latest->thumbnail}}">
					</div>
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($latest->file_name))}}">{{$latest->title}}</a>
					</div>

					<div class="count">
						by: <a href="{{route('view.users.channel', array($latest->channel_name))}}">{{$latest->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{number_format($latest->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$latest->likes}} | {{date('F d, Y',strtotime($latest->created_at))}}
					</div>
				</a>
			</div>
			@endforeach
			
		</div>
		<div class="row mg-b-10">
			<div class="text-center">
				{{ link_to_route('homes.latest', 'SEE MORE', null, array('class' => 'see-m-v see-m-v-a')) }}
			</div>
		</div>
	
		<div class="row same-H">
			<div class="categoryHead" style="width:99%!Important">
				<h3>Random</h3>
			</div>
			@foreach($randoms as $random)
			<div class="col-lg-2 col-md-4 col-sm-6">
				<a href="{{route('homes.watch-video', array($popular->file_name))}}">
					<span class="v-time inline">{{$popular->total_time}}</span>
					<div class="thumbnail-2">
						<img class="hvr-grow-rotate" src="{{$random->thumbnail}}">
					</div>
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($random->file_name))}}">{{$random->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($random->channel_name))}}">{{$random->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{number_format($random->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$random->likes}} | {{date('F d, Y',strtotime($random->created_at))}}
					</div>
				</a>
			</div>
			@endforeach
			
		</div>
		<div class="row mg-b-10">
			<div class="text-center">
				{{ link_to_route('homes.random', 'SEE MORE', null, array('class' => 'see-m-v see-m-v-a')) }}
			</div>
		</div>


	</div><!--/.container page-->
</div><!--first row-->
@stop



