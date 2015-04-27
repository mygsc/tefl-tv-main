
<!--Playlists-->
	<div class="col-md-12 White">
		<div class="">
			<div class="orangeC text-center">
				<br/>
				<h2>PLAYLISTS 
					<small class="">({{link_to_route('users.playlists', 'Show All')}})</small>
				</h2>
				<br/>
			</div>
			
			<div class="row">
			
			@if($usersPlaylists->isEmpty())
				<p class="text-center">No Playlists yet</p>
			@else
			@foreach($usersPlaylists as $key=>$playlist)
			<div class="col-lg-3 col-md-3 col-sm-2">
			<div class="p-relative">
				@if(isset($thumbnail_playlists[$key][0]))	
					@if(file_exists(public_path('/videos/'.$thumbnail_playlists[$key][0]->user_id.'-'.$thumbnail_playlists[$key][0]->channel_name.'/'.$thumbnail_playlists[$key][0]->file_name.'/'.$thumbnail_playlists[$key][0]->file_name.'.jpg')))
					<div class="playlist-info" >
						{{count($thumbnail_playlists[$key])}}
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
						<img src="/videos/{{$thumbnail_playlists[$key][0]->user_id}}-{{$thumbnail_playlists[$key][0]->channel_name}}/{{$thumbnail_playlists[$key][0]->file_name}}/{{$thumbnail_playlists[$key][0]->file_name}}.jpg">
					@else	
					<div class="playlist-info" >
						{{count($thumbnail_playlists[$key])}}
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list fs-24"></span>
					</div>
						<img src="/img/thumbnails/video.png">
					@endif
				@else
					<div class="playlist-info" >
						0
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list fs-24"></span>
					</div>
					<img src="/img/thumbnails/video.png">
				@endif
					</div>
				<div class="v-Info">
					<span class="fa fa-globe"></span> | {{$playlist->name}}
				</div>
					
				<div class="count">
					{{$playlist->updated_at}}
				</div>
			</div>
			@endforeach
			@endif
			
			</div>
		</div>

	</div><!--/.2nd 6 column Playlists-->