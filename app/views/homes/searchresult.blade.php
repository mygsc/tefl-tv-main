@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container ">
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<div class="mg-r-10 row">
					@include('elements/home/categories')
					<div id="ad_sidebar">
						<div>
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9 White same-H h-minH mg-t-10">
				<div class="" id="floatboxanchor">
					
					@if($searchResults->isEmpty())
						<br/><br/><br/>
						<div class="text-center">
						<p style="font-size:1.8em;font-style:italic;">Nothing Found</p>
						</div>
					@else
						<br/>
						<h3>Search containing "{{$search}}"</h3>
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
		</div>
	</div>
@stop