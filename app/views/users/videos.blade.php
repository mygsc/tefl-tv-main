@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop')
			<br/>
			<div class="Div-channel-border">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->
				</div>

				<div class="">
					<br/>
					<div class="col-md-6">
						<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>
					<div class="col-md-5">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<select class="form-control" style="width:auto!important;">
							<option value="" selected disabled>Sort By</option>
							<option>Likes</option>
							<option>Recent</option>
						</select>
						&nbsp;&nbsp;
						<button class="btn btn-unsub">Manage Videos</button>
					</div>
			
					<div class="col-md-1 text-right">
						<div class="buttons">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>

					<br/><br/><hr class="" />

				<div id="videosContainer" class='container'>
					@foreach($usersVideos as $usersVideo)
					<div id='list' class="col-md-3">
						&nbsp;

						<div class="inlineVid ">
							{{Form::open()}}
								<span title="Add to Playist" style="position:absolute;right:15px;z-index:99;">{{Form::button('<i class="icon icon-playlist-add" ></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}</span>
							
							{{Form::close()}}
							<a href="{{route('homes.watch-video',$usersVideo->id.'%'.$usersVideo->title)}}" target="_blank">
								<video poster="/videos/img-vid-poster/{{Crypt::encrypt($usersVideo->id).'.jpg'}}" height="200" width="100%" class="h-video" >
									<source src="/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}" type="video/mp4" />
								</video>
							</a>
						</div>

						<div class="inlineInfo ">
							<div class="v-Info">
								{{$usersVideo->title}}
							</div>
							<div class="text-justify desc hide">
								<p>{{$usersVideo->description}}</p>
								<br/>
							</div>
							<div class="count">
								<i class="fa fa-eye"></i> {{$usersVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$usersVideo->likes}} | <i class="fa fa-calendar"></i> {{$usersVideo->created_at}}
							</div>
								

						</div>
					</div>
					@endforeach	
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('script')
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/homes/convert_specialString.js')}}

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<script type="text/javascript">
		$('.grid').click(function() {
		    $('#videosContainer #list').removeClass('col-md-12').addClass('col-md-3');
		    $('.inlineVid').removeClass('col-md-4');
		    $('.inlineInfo').removeClass('col-md-8');
		    $('.desc').addClass('hide');
		});
		$('.list').click(function() {
		    $('#videosContainer #list').removeClass('col-md-3').addClass('col-md-12');
		    $('.inlineVid').addClass('col-md-4');
		    $('.inlineInfo').addClass('col-md-8');
		    $('.desc').removeClass('hide');
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


