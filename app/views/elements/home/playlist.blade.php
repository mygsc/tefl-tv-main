<h1>Playlists</h1>
@foreach($playlists as $playlist)

<div class="col-md-4">
	<div class="p-relative">
		<div class="playlist-info" >
			
			<br/>
			Videos
			<br/>
			<span class="glyphicon glyphicon-list fs-24"></span>
		</div>
		<a href="#">
		<img src="/img/thumbnails/v1.png" class="h-video">
		</a>
	</div>
	<div class="v-Info">
		<a href="#">{{$playlist->name}}</a>
	</div>
	<div class="count">
		by:Kevin
		<!-- <a href="/channels/{{$playlist->channel_name}}">{{$playlist->channel_name}}</a> -->
	</div>
</div>




@endforeach