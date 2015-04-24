@extends('layouts.default')
@section('title')
Category: {{$category}} - TEFL-tv
@stop
@section('content')
<div class="container h-minH ">
	<div class="row">
		<div class="col-lg-9 col-md-8 same-H White ">
			<h1 class="orangeC">{{$category}}</h1>
				<div class="col-md-12">
					@foreach($videos as $video)
					<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs ">
						<div class="p-relative">
							<a href="{{route('homes.watch-video', array($video->file_name))}}" class="thumbnail-h">
								<div class="thumbnail-2"> 
									<img class="hvr-grow-rotate" src="{{asset($video->thumbnail)}}">
								</div>
								<div class="video-info">
									<div class="v-Info">
										<a href="{{route('homes.watch-video', array($video->file_name))}}">{{$video->title}}</a>
									</div>
									<div class="count">
										by: <a href="{{route('view.users.channel', array($video->channel_name))}}">{{$video->channel_name}}</a>
										<br />
										<i class="fa fa-eye"></i> {{$video->views}} | <i class="fa fa-thumbs-up"></i>  {{$video->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($video->created_at))}}
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
										<br />
										<i class="fa fa-eye"></i> {{$video->views}} | <i class="fa fa-thumbs-up"></i> {{$video->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($video->created_at))}}
									</div>
								</div>
							</a>	
						</div>
					</div>
					@endforeach
				</div>
				{{ $videos->links()}}
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