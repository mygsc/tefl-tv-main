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
				<p class="text-center mg-t-20 mg-b-20 ">No Playlists yet</p>
			@else
				@foreach($usersPlaylists as $key=>$playlist)
					<div class="col-lg-3 col-md-3 col-sm-2">
						<div class="p-relative">
							<div class="thumbnail-2"> 
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
										<img src="/img/thumbnails/video-sm.jpg" width="100%">
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
								<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
							</div>
						</div>

						<div class="v-Info">
							<span class="fa fa-globe"></span> | {{$playlist->name}}
						</div>
						<div class="count">
							{{date('F d, Y',strtotime($playlist->updated_at))}}
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
</div><!--/.2nd 6 column Playlists-->