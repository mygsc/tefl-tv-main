@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
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
					<div class="col-md-3">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<select class="form-control" style="width:auto!important;">
							<option value="" selected disabled>Sort By</option>
							<option>Likes</option>
							<option>Recent</option>
						</select>
						&nbsp;&nbsp;
						<button class="btn btn-unsub">Manage Playlists</button>
					</div>

					<div class="col-md-3">
						{{Form::open()}}
						<div class="input-group" style="">
							{{Form::hidden('text1',Crypt::encrypt(Auth::User()->id),array('id'=>'text1'))}}
							{{Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Create New Playlist','id'=>'create-playlist-text')) }}
							<span class="input-group-btn">
								{{Form::button('Save',array('class' => 'btn btn-primary	','id'=>'create-playlist-button'))}}
							</span>
						</div>
						{{Form::close()}}
					</div>
			
					<div class="col-md-1 text-right">
						<div class="buttons">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>

			

					<div id="videosContainer" class='container'>
						<br/><br/><br/>
						<div class="row">
						@if($playlists->isEmpty())
							No playlists yet
						@else
							@foreach($playlists as $playlist)
								<div id="playlists" class="col-xs-2 col-md-3">
										<a href="videoplaylist/{{Crypt::encrypt($playlist->id)}}"  class="thumbnail">
									@if(file_exists('/videos/'.$thumbnail_playlists[$validatorIdCounter++][0]->user_id.'/'.$thumbnail_playlists[$validatorChannelCounter++][0]->channel_name.$thumbnail_playlists[$validatorThumbnailCounter++][0]->file_name.'/'.$thumbnail_playlists[$validatorThumbnail2Counter++][0]->file_name.'.jpg'))

										<img src="/videos/{{$thumbnail_playlists[$idCounter++][0]->user_id}}-{{$thumbnail_playlists[$channel_nameCounter++][0]->channel_name}}/{{$thumbnail_playlists[$thumbnail_playlistCounter++][0]->file_name}}/{{$thumbnail_playlists[$thumbnail_playlistCounter2++][0]->file_name}}.jpg">
									@else
										<img src="/img/thumbnails/video.png">
									@endif
											<br/>
											
										</a>
										{{$playlist->name}}
										<br/>
								</div>
							@endforeach
						@endif
						</div>
					</div><!--videoContainer-->
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>

	
@stop


@section('script')
	{{HTML::script('js/user/playlist.js')}}
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.js')}}

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<script type="text/javascript">
		$('.grid').click(function() {
		    $('#videosContainer #list').removeClass('col-md-12').addClass('col-md-3');
		});
		$('.list').click(function() {
		    $('#videosContainer #list').removeClass('col-md-3').addClass('col-md-12');
		});
		$(document).ready( function( $ ) {
			$('#form-add-setting').on('submit', function() {
		        //.....
		        //show some spinner etc to indicate operation in progress
		        //.....
		        $.post(
		        	$(this).prop( 'action' ),{
		        		"_token": $( this ).find( 'input[name=_token]' ).val(),
		        		"setting_name": $( '#setting_name' ).val(),
		        		"setting_value": $( '#setting_value' ).val()
		        	},
		        	function( data ) {
		                //do something with data/response returned by server
		            },'json'
		        );
		        //.....
		        //do anything else you might want to do
		        //.....

		        //prevent the form from actually submitting in browser
		        return false;
		    } );
		} );
	</script>
@stop
