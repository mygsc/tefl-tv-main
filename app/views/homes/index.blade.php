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
		{{HTML::style('css/vid.player.css')}}
	@stop
@section('content')
<div class="row White">
	<div class="container page">
		<div class="row">	
			<br/>
			<div class="col-md-8" style="margin-bottom:20px;">
				<div class="col-md-12">
					<div class="row  vid-wrapper">
						<div id="vid-controls">
							<div class="embed-responsive embed-responsive-16by9">
				              	<video preload="auto" id="media-video" poster="/img/thumbnails/v1.png">
									<source src='/videos/tefltv.mp4' type='video/mp4'>
									<source src='/videos/tefltv.webm' type='video/webm'>
									<source src='/videos/tefltv.ogv' type='video/ogg'>
								</video>
								@include('elements/videoPlayer')
							</div><!--/embed-responsive-->
							
						</div>
		    		</div><!--/.row-->
    			</div>
			</div><!--/.col-md-8-->

			<div class="col-md-4">
                <div class="row">
                    <div class="ad1 col-md-12 col-sm-6 col-xs-6" style="margin-bottom:20px;">
                        <img src="/img/thumbnails/ad1.jpg" class="adDiv">
                    </div><!--/.ad1-->
                    
                    <div class="ad2 col-md-12 col-sm-6 col-xs-6">
                        <img src="/img/thumbnails/ad2.jpg" class="adDiv">
                   </div><!--/.ad2-->
                </div><!--/.row of col4-->
			</div><!--/.col-md-4-->


		</div><!--/.row 1st-->

		<br/>
		<!--RECOMMENDED VIDEOS SECTION -->
		<div class="row">
			<div class="categoryHead" style="width:99%!Important">

	            <h3>Recommended Videos</h3>
	      	</div><!--/.recommended video-->

			<div class="col-md-12">
				<div class="row">

				@foreach($recommendeds as $recommended)
				<a href="{{route('homes.watch-video', array($recommended->file_name))}}">
		            <div class="col-lg-2 col-md-4 col-sm-6">
		            	<div class="thumbnail-2">
			            	@if(file_exists($recommended->video_poster))
								<img class="hvr-grow-rotate"  src="{{$recommended->poster_path}}">
							@else
								<img class="hvr-grow-rotate"  src="/img/thumbnails/video.png">
							@endif
						</div>
		            	<div class="v-Info">
		            		<a href="{{route('homes.watch-video', array($recommended->file_name))}}">{{$recommended->title}}</a>
		            	</div>

		            	<div class="count">
							by: <a href="{{route('view.users.channel', array($recommended->channel_name))}}">{{$recommended->channel_name}}</a>
							<br />
							<i class="fa fa-eye"></i> {{number_format($recommended->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$recommended->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($recommended->created_at))}}
						</div>
		            </div>
		            </a>
		        @endforeach
		        </div>
	        </div><!--/.col-md-12-->
		</div><!--/.row for recommended videos-->

		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Popular</h3>
					</div>

					@foreach($populars as $popular)
					<a href="{{route('homes.watch-video', array($popular->file_name))}}">
					<div class="col-md-6 col-sm-6">
						<div class="thumbnail-2">
							@if(file_exists($popular->video_poster))
								<img class="hvr-grow-rotate" src="{{$recommended->poster_path}}">
							@else
								<img class="hvr-grow-rotate" src="/img/thumbnails/video.png">
							@endif
						</div>
						
						<div class="v-Info">
							<a href="{{route('homes.watch-video', array($popular->file_name))}}">{{$popular->title}}</a>
						</div>
						<div class="count">
							by: <a href="{{route('view.users.channel', array($popular->channel_name))}}">{{$popular->channel_name}}</a>
							<br />
							<i class="fa fa-eye"></i> {{number_format($popular->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$popular->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($popular->created_at))}}
						</div>
					
					</div>
					</a>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.popular', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for Popular-->
			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Recent Uploads</h3>
					</div>
					@foreach($latests as $latest)
					<a href="{{route('homes.watch-video', array($latest->file_name))}}">
						<div class="col-md-6 col-sm-6">
							<div class="thumbnail-2">
								@if(file_exists($latest->video_poster))
									<img class="hvr-grow-rotate"  src="{{$latest->poster_path}}">
								@else
									<img class="hvr-grow-rotate"  src="/img/thumbnails/video.png">
								@endif
							</div>
							<div class="v-Info">
								<a href="{{route('homes.watch-video', array($latest->file_name))}}">{{$latest->title}}</a>
							</div>
							
			            	<div class="count">
								by: <a href="{{route('view.users.channel', array($latest->channel_name))}}">{{$latest->channel_name}}</a>
								<br />
								<i class="fa fa-eye"></i> {{number_format($latest->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$latest->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($latest->created_at))}}
							</div>
						</div>
					</a>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.latest', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for Recent Uploads-->

			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Random</h3>
					</div>
					@foreach($randoms as $random)
					<a href="{{route('homes.watch-video', array($popular->file_name))}}">
					<div class="col-md-6 col-sm-6">
						<div class="thumbnail-2">
							@if(file_exists($random->video_poster))
								<img class="hvr-grow-rotate" src="{{$random->poster_path}}">
							@else
								<img class="hvr-grow-rotate" src="/img/thumbnails/video.png">
							@endif
						</div>
						<div class="v-Info">
							<a href="{{route('homes.watch-video', array($random->file_name))}}">{{$random->title}}</a>
						</div>
						<div class="count">
							by: <a href="{{route('view.users.channel', array($random->channel_name))}}">{{$random->channel_name}}</a>
							<br />
							<i class="fa fa-eye"></i> {{number_format($random->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$random->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($random->created_at))}}
						</div>

					</div>
					</a>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.random', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for random-->

		</div><!--/.row for threee categories-->

	</div><!--/.container page-->
</div>
@stop
@section('script')
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/fullscreen.js')}}
@stop


