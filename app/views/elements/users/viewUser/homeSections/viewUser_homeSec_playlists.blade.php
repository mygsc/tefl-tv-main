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
				<img src="/img/thumbnails/video-sm.jpg" width="100%" class="h-video thumb">
			</div>

			<div class="v-Info">
				<span class="fa fa-globe"></span> | {{$playlists->name}}
			</div>

			<div class="count">
				{{date("F d Y", strtotime($playlists->updated_at))}}
			</div>
		</div>
		@endforeach
		@endif
	</div>
</div>