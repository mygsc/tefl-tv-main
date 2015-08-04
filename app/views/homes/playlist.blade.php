@extends('layouts.default')

@section('title')
	Top Playlist | TEFL Tv
@stop

@section('content')
<div class="container">
	<div class="row mg-t-10">
		<div class="row-same-height">
			<div class="col-md-3 col-md-height hidden-xs hidden-sm col-top">
				<div class="mg-r-10 row mg-t--10">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>

					<div id="ad_sidebar">
						<div class="mg-t-10">
							@include('elements/home/carouselAds')
						</div>
						<div class="mg-t-10">
							@include('elements/home/adverstisementSmall')

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-md-height col-top same-H White h-minH mg-t-10">
				<div id="floatboxanchor">
					<h1 class="tblue mg-b-20 mg-t-20">Playlists</h1>
						@foreach($playlists as $key=>$playlist)
						<div class="col-md-3">
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
	</div>
</div>
@stop

@section('script')

@stop