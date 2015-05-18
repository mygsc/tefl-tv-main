<!--Playlists-->
<div class="col-md-12 White">
	<br/>
	<div class="row">
		<br/>
		<div class="orangeC text-center">
			<h2 class="">PLAYLISTS</h2>
		</div>
		<br/>
	</div>
	<br/>
	<div class="row">
		@if(empty($usersPlaylists))
		<p class="text-center fs-12">No Playlists yet</p>
		@else
		@foreach($usersPlaylists as $playlists)
		<div class="col-md-3">
			<div class="p-relative">
				<div class="playlist-info" >
					<br/>
					Videos
					<br/>
					<span class="glyphicon glyphicon-list fs-24"></span>
				</div>
				<img src="/img/thumbnails/v1.png" class="h-video thumb">
			</div>

			<div class="v-Info">
				<span class="fa fa-globe"></span> | {{$playlists->name}}
			</div>

			<div class="count">
				{{$playlists->updated_at}}
			</div>
		</div>
		@endforeach
		@endif
	</div>
</div>