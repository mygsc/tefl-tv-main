@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container page">
		<br/>
		<div class="row same-H White">
		{{-- */$playlistCounter = 1;/* --}}
			@include('elements/users/profileTop2')

			<div class=" Div-channel-border">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation" class="active">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->
				</div>

				<div class="">
					<br/>
					<div class="col-md-5">
						<!--<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>-->		
					</div>
					<div class="col-md-4">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<!--<button class="btn btn-unsub">Manage Playlist</button>
						<button class="btn btn-unsub">Add Video</button>-->
					</div>

				
			
					<div class="col-md-3 text-right">
						
						<div class="buttons">
						{{Form::model($playlist, array('route' => array('playlistdelete.post',Crypt::encrypt($playlist->id))))}}
							{{Form::submit('Delete Playlist',array('class'=>'btn btn-primary'))}}
						{{Form::close()}}
						</div>
					</div>

			

					<div id="videosContainer" class='container'>
						<br/><br/><br/>
						<div class="row">
						{{Form::hidden("encrypt",Crypt::encrypt($playlist->id),array('id'=>'encrypt'))}}
							<div class="col-md-3">
								@if(empty($videos))
								<div class="" style="position:relative;">
									<div class="playlist-info" >
										0
										<br/>
										Video(s)
										<br/>
										<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
									</div>
									<img src="/img/thumbnails/video.png">
								</div>
								@else
									@if(file_exists(public_path('/videos/'.$videos[0]->user_id.'-'.$videos[0]->channel_name.'/'.$videos[0]->file_name.'/'.$videos[0]->file_name.".jpg")))
									<div class="" style="position:relative;">
									<div class="playlist-info" >
										{{count($videos)}}
										<br/>
										Video(s)
										<br/>
										<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
									</div>
										<img src="/videos/{{$videos[0]->user_id}}-{{$videos[0]->channel_name}}/{{$videos[0]->file_name}}/{{$videos[0]->file_name}}.jpg">
									</div>
									@else
									<div class="" style="position:relative;">
									<div class="playlist-info" >
										{{count($videos)}}
										<br/>
										Video(s)
										<br/>
										<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
									</div>
										<img src="/img/thumbnails/video.png">
									</div>
									@endif
								@endif
							</div>

							<div class="col-md-9">
									<div class ="row" id="alert-edit-playlist">
									</div>
								<p><i class="fa fa-globe"></i> &nbsp;<span id="playlistName">{{$playlist->name}}</span></p>
								<p>{{$playlist->created_at->toFormattedDateString()}}</p>
								<p class="text-justify"><span id="playlistDesc">{{$playlist->description}}</span></p>
							</div>
						</div>
					<div class="content-padding">	
						<hr/>
						@if(empty($videos))
							No videos available in {{$playlist->name}} playlist.
						@else
					
							@foreach($videos as $video)
							<div class="row">	
									<div class="col-md-2">
										<a href="/watchplaylist={{$video->file_name}}/{{$playlist->randID}}" target="_blank">
										@if(file_exists(public_path('/videos/'.$video->user_id.'-'.$video->channel_name.'/'.$video->file_name.'/'.$video->file_name.'.jpg')))
											<img src="/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.jpg">
										@else
											<img src="/img/thumbnails/video.png">
										@endif
										</a>
									</div>
									<div class="col-md-10">
										<span class="pull-right" style="margin-right:20px;">
											<!--<button class="btn btn-default" title="set as playlist thumbnail"><i class="fa fa-file-image-o"></i></button> &nbsp;-->
											<button class="btn btn-default" title="remove from playlist" id="removeToplaylist{{$playlistCounter++}}" data-encrypt="{{Crypt::encrypt($video->playlist_id)}}" data-encrypt2 ="{{Crypt::encrypt($video->id)}}"><i class="fa fa-trash"></i></button>
										
										</span>
										<a href="/watchplaylist={{$video->file_name}}/{{Crypt::encrypt($playlist->id)}}" target="_blank"><p>{{$video->title}}</p></a>
										<small>{{$video->channel_name}}</small>
									</div>
							</div>
							<br/>
							@endforeach

						@endif
						
					</div><!--videoContainer-->
					</div> 
				</div>
			
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	<br/>
	</div><!--/.container page-->
</div>

	
@stop
@section('script')
	{{HTML::script('js/user/playlist.js')}}
@stop

