<h1>Playlists</h1>
@foreach($datas as $randomResult)

<div class="col-md-3">
	<div class="p-relative">
		<div class="playlist-info" >
			18
			<br/>
			Videos
			<br/>
			<span class="glyphicon glyphicon-list fs-24"></span>
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