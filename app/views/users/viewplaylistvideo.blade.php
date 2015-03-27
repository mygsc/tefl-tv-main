@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
		{{-- */$playlistCounter = 1;/* --}}
			@include('elements/users/profileTop')
			<br/>
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
						<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<!--<button class="btn btn-unsub">Manage Playlist</button>-->
						<button class="btn btn-unsub">Add Video</button>
					</div>

				
			
					<div class="col-md-3 text-right">
						
						<div class="buttons">
							<button class="btn btn-primary">Delete Playlist</button>
							
						</div>
					</div>

			

					<div id="videosContainer" class='container'>
						<br/><br/><br/>
						<div class="row">
						{{Form::hidden("encrypt",Crypt::encrypt($playlist->id),array('id'=>'encrypt'))}}
							<div class="col-md-3">
								@if(empty($videos))
									<img src="/img/logos/default-playlist.png">
								@else
								<img src="/videos/{{$videos[0]->user_id}}-{{$videos[0]->channel_name}}/{{$videos[0]->file_name}}/{{$videos[0]->file_name}}.jpg">
								@endif
							</div>
							<div class="col-md-9">
								<h4><i class="fa fa-globe"></i> &nbsp;<span id="playlistName">{{$playlist->name}}</span></h4>
								<p>{{$playlist->created_at->toFormattedDateString()}}</p>
								<p class="text-justify"><span id="playlistDesc">{{$playlist->description}}</span></p>
							</div>
						</div>

						<hr/>
						@if(empty($videos))
							No videos available in {{$playlist->name}} playlist.
						@else

							@foreach($videos as $video)
							<div class="row">						
								<div class="col-md-2">
									<a href="/watchplaylist={{$video->file_name}}/{{Crypt::encrypt($playlist->id)}}" target="_blank"><img src="/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.jpg"></a>
								</div>
								<div class="col-md-10">
									<span class="pull-right" style="margin-right:20px;">
										<button class="btn btn-default" title="set as playlist thumbnail"><i class="fa fa-file-image-o"></i></button> &nbsp;
										<button class="btn btn-default" title="remove from playlist" id="removeToplaylist{{$playlistCounter++}}" data-encrypt="{{Crypt::encrypt($video->playlist_id)}}" data-encrypt2 ="{{Crypt::encrypt($video->id)}}"><i class="fa fa-trash"></i></button>
									
									</span>
									<a href="/watchplaylist={{$video->file_name}}/{{Crypt::encrypt($playlist->id)}}" target="_blank"><p>{{$video->title}}</p></a>
									<small>{{$video->channel_name}}</small>
								</div>
							</div>
							@endforeach
						@endif
						<hr/>
					</div><!--videoContainer-->
				</div>
				<br/>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->

	</div><!--/.container page-->
</div>

	
@stop
@section('script')
	{{HTML::script('js/user/playlist.js')}}
@stop

