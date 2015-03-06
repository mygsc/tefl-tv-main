@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container page">
		<div class="col-md-8">
			<div class="row">
				@if(empty($videoResults))
					<br/>
					<p style="font-size:1.8em;font-style:italic">No Rusult</p>
				@else
				@foreach($videoResults as $video)
					<div class="col-md-12">
						Title: <a href="#">{{$video->title}}</a><br />
						Description: {{$video->description}}<br />
						Author: <a href="#">{{$video->channel_name}}</a><br />
						<br /><br />
					</div>
				@endforeach
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="sideLinksDiv2">
		
			@include('elements/home/adverstisementSmall')
			@include('elements/home/carouselAds')	
			@include('elements/home/recommendedChannelList')
		</div>
		</div>
	</div>
@stop