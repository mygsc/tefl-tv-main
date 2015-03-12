<h1>Playlists</h1>
@foreach($randomResults as $randomResult)

<div class="col-md-3">
	<div class="" style="position:relative;">
		<div class="playlist-info" >
			18
			<br/>
			Videos
			<br/>
			<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
		</div>
		<img src="/img/thumbnails/v1.png" class="h-video">
	</div>
	<div class="v-Info">
		<a href="#">{{$randomResult->name}}</a>
	</div>
	<div class="count">
		by:Playlist Owner Here
	</div>
</div>




@endforeach