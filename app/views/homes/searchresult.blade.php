@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container page">
		<div class="col-md-8">
			<div class="row">
				@if($searchResults->isEmpty())
					<br/><br/><br/>
					<div class="text-center">
					<p style="font-size:1.8em;font-style:italic;">Nothing Found</p>
					</div>
				@else
					@if($type == 'playlist')
						@include('elements.home.searchs.video')
					@elseif($type == 'channel')
						@include('elements.home.searchs.video')
					@else
						@include('elements.home.searchs.video')
					@endif
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="sideLinksDiv2">
				@include('elements/home/adverstisementSmall')
				@include('elements/home/carouselAds')	
			</div>
		</div>
	</div>
@stop