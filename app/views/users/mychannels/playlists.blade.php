@extends('layouts.default')

@section('content')
<div class="row">
	<br/>
	<div class="container pageH White same-H">
		<div class="row ">
			@include('elements/users/profileTop')

			<div class=" Div-channel-border channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
						<li role="presentation">{{link_to_route('users.about', 'About')}}</li>
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
					<!--<div class="col-md-5">
						<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>
						
						
					</div>-->

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

					<!--<div class="col-md-1 text-right">
						<div class="buttons">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>-->



					<div id="videosContainer" class='container'>
						<br/><br/><br/>
						<div class="row">
						@if($playlists->isEmpty())
							<p class="text-center">You don't have playlist yet.</p>
						@else
							@foreach($playlists as $key=>$playlist)
							<div id="playlists" class="col-xs-2 col-md-3">
								<a href="videoplaylist={{$playlist->randID}}"  class="thumbnail-2">
								@if(isset($thumbnail_playlists[$key][0]))
									@if(file_exists(public_path('/videos/'.$thumbnail_playlists[$key][0]->user_id.'-'.$thumbnail_playlists[$key][0]->channel_name.'/'.$thumbnail_playlists[$key][0]->file_name.'/'.$thumbnail_playlists[$key][0]->file_name.'.jpg')))
									<div class="" style="position:relative;">
									<div class="playlist-info" >
										{{count($thumbnail_playlists[$key])}}
										<br/>
										Video(s)
										<br/>
										<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
									</div>
									<img src="/videos/{{$thumbnail_playlists[$key][0]->user_id}}-{{$thumbnail_playlists[$key][0]->channel_name}}/{{$thumbnail_playlists[$key][0]->file_name}}/{{$thumbnail_playlists[$key][0]->file_name}}.jpg">
									</div>
									@else
									<div class="" style="position:relative;">
									<div class="playlist-info" >
										{{count($thumbnail_playlists[$key])}}
										<br/>
										Video(s)
										<br/>
										<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
									</div>
										<img src="/img/thumbnails/video.png">
									</div>
									@endif
								@else
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
	<br/>
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