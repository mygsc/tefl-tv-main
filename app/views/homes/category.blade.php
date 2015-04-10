@extends('layouts.default')
@section('title')
Category: {{$category}} - TEFL-tv
@stop
@section('content')
<div class="container">
	<h1>{{$category}}</h1>
		<div class="col-md-12">
			@foreach($videos as $video)
			<div class="col-lg-3 col-md-3 col-sm-6 hidden-xs ">
				<a href="{{route('homes.watch-video', array($video->file_name))}}" class="thumbnail-h">
					<div class="thumbnail"> 
						<img class="hvr-grow-rotate" src="{{asset($video->thumbnail)}}">
					</div>
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($video->file_name))}}">{{$video->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($video->channel_name))}}">{{$video->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{$video->views}} | <i class="fa fa-thumbs-up"></i>  {{$video->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($video->created_at))}}
					</div>
				</a>	
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
	@stop