@extends('layouts.default')

@section('title')
	Top Playlist - TEFL TV
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 hidden-xs hidden-sm">

				<div class="same-H mg-r-10 row">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div class="mg-t-10">
						@include('elements/home/carouselAds')
					</div>
					<div class="mg-t-10">
						@include('elements/home/adverstisementSmall')

					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-8 same-H White h-minH">
				<h1 class="tblue mg-b-20 mg-t-20">Playlists</h1>
					@foreach($playlists as $key=>$playlist)
					<div class="col-md-4">
						<div class="p-relative">
							<div class="playlist-info" >		
								<br/>
								Videos
								<br/>
								<span class="glyphicon glyphicon-list fs-24"></span>
							</div>
							<a href="/channels/{{$playlist->channel_name}}/videoplaylist={{$playlist->randID}}">
								<div class="thumbnail-2">
									<img src="/img/thumbnails/video-sm.jpg" class="h-video" width="100%">
									<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
								</div>
							</a>
						</div>
						<div class="v-Info">
						<a href="/channels/{{$playlist->channel_name}}/videoplaylist={{$playlist->randID}}">{{$playlist->name}}</a>
						</div>
						<div class="count">
							<a href="/channels/{{$playlist->channel_name}}">{{$playlist->channel_name}}</a>
						</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
@stop

@section('script')

@stop