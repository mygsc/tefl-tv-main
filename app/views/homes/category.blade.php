@extends('layouts.default')
@section('title')
Category: {{$category}} - TEFL-tv
@stop
@section('content')
<div class="container  ">
	<div class="row mg-t-10">
		<div class="row-same-height  ">
			<div class="col-md-3 hidden-xs hidden-sm col-md-height col-top">
				<div class="mg-r-10 mg-t--10 row">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div class="sidebar" data-sticky_column="" id="sidebar">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9 same-H White h-minH col-md-height col-top">
				<div id="floatboxanchor">
					<h1 class="mg-t-20 mg-b-20 capitalize">{{$category}}</h1>
					<div class="col-md-12">
						@foreach($videos as $video)
						<div class="col-lg-3 col-md-4 col-sm-6 hidden-xs ">
							<div class="p-relative">
								<a href="{{route('homes.watch-video', array('v=' .$video->file_name))}}" class="thumbnail-h">
									<div class="thumbnail-2"> 
										<img class="hvr-grow-rotate" src="{{asset($video->thumbnail . '?' . rand(0,99))}}" width="100%">
										<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
									</div>
									<div class="video-info">
										<div class="v-Info">
											<a href="{{route('homes.watch-video', array('v=' .$video->file_name))}}">
												<span class="visible-lg">{{ Str::limit($video['title'],50)}}</span>
												<span class="visible-md">{{ Str::limit($video['title'],40)}}</span>
												<span class="visible-xs visible-sm">{{ Str::limit($video['title'],30)}}</span>
											</a>
										</div>
										<div class="count">
											by: <a href="{{route('view.users.channel', array($video->channel_name))}}">{{$video->channel_name}}</a>
											<br />
											{{number_format($video->views)}} Views | <!--<i class="fa fa-thumbs-up"></i>  {{$video->likes}} | --> {{date('F d, Y',strtotime($video->created_at))}}
										</div>
									</div>

								</a>
							</div>	
						</div>

						<div class="col-md-12 visible-xs">
							<div class="row">
								<a href="{{route('homes.watch-video', array($video->file_name))}}">
									<div class="col-xs-4">
										<img class="thumbnail" src="{{$video->thumbnail}}">
									</div>
									<div class="col-xs-8">
										<div class="v-Info">
											<a href="{{route('homes.watch-video', array($video->file_name))}}">{{$video->title}}</a>
										</div>
										<div class="count">
											by: <a href="{{route('view.users.channel', array($video->channel_name))}}">{{$video->channel_name}}</a>
											<!--<br />
											<i class="fa fa-eye"></i> {{$video->views}} | <i class="fa fa-thumbs-up"></i> {{$video->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($video->created_at))}}
											-->
										</div>
									</div>
								</a>	
							</div>
						</div>
						@endforeach
					</div>

					<div class="text-center">
							{{ $videos->links()}}
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
@stop