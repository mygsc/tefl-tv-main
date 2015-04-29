<h1>Playlists</h1>
@foreach($playlists as $key=>$playlist)

<div class="col-md-4">
	<div class="p-relative">
		<div class="playlist-info" >		
			<br/>
			Videos
			<br/>
			<span class="glyphicon glyphicon-list fs-24"></span>
		</div>
		<a href="{{route('users.watchplaylist', array($playlist->video_id, $playlist->randID))}}">
		<img src="/img/thumbnails/v1.png" class="h-video">
		</a>
	</div>
	<div class="v-Info">
		<a href="{{route('users.watchplaylist', array($playlist->video_id, $playlist->randID))}}">{{$playlist->name}}</a>
	</div>
	<div class="count">
		<a href="/channels/{{$playlist->channel_name}}">{{$playlist->channel_name}}</a>
	</div>
</div>




@endforeach