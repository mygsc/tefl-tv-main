@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container White">
		<div class="col-md-9">
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
		<div class="col-md-3">
			<br/>
			<div class="same-H">
				<div class="">
					@include('elements/home/adverstisementSmall')
					@include('elements/home/carouselAds')	
				</div>
			</div>
		</div>
	</div>
@stop