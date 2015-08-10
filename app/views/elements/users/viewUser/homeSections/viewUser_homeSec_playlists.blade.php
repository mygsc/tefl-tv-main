<!--Playlists-->
<div class="whiteC text-center top-div_t mg-t-20 col-md-12 ">
	<div class="row">
		<h2>PLAYLISTS</h2>
	</div>
</div>
<div class="col-md-12 White same-H">
	<div class="">
		<div class="row">
		
			@if($usersPlaylists->isEmpty())
			<br/>
			<p class="text-center fs-12">No Playlists yet</p>
			@else
			@foreach($usersPlaylists as $playlists)
			<div class="col-md-3 col-sm-6 col-xs-6">
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
</div>