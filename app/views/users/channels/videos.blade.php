@extends('layouts.default')

@section('some_script')
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/sort.js')}}

	<script type="text/javascript">
		$(document).ready( function( $ ) {
			var success = $('#uploaded').val();
			if(success == 1){
				$('<div id="success" style="width:400px;height:40px;display:block;background:#087bd3;color:#fff">New video has been uploaded successfully.</div>').appendTo('body');
					$('#success').fadeOut(20000);
			}
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

@section('content')
<div class="row">
	<div class="container page">
		<br/>
		<div class="row same-H White">
			@include('elements/users/profileTop2')
			
			<div class="channel-content">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs visible-lg visible-md" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation" class="active">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->
				  	<nav class="navbar navbar-default visible-sm visible-xs">
						<div class="container-fluid">
							<div class="navbar-header">
								
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
									<h4 class="inline mg-t-20">Videos</h4>	
									<span class="fa fa-bars"></span>
								</button>
								
							</div>
							<div class="collapse navbar-collapse" id="myNavbar">
								<ul class="nav navbar-nav">
									<li>{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
									<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>

				<div class="">
					<br/>
					<div class="col-md-6 col-sm-6">
						{{Form::open(array('route' => ['channels.search', $userChannel->channel_name], 'method' => 'GET'))}}
						<div class="input-group" style="margin-bottom:10px;">
							{{ Form::text('searchTitle', null, array('id' => 'category', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
							{{Form::close()}}
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<select class="form-control" style="width:auto!important;" id="dropdown" onchange="dynamic_select(this.value)">
							<option value="" selected disabled>Sort By</option>
							<option>Recent</option>
							<option>Likes</option>
							<option>Views</option>
							<option>Unpublished</option>
						</select>
						&nbsp;&nbsp;
					

						<div class="buttons pull-right inline">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
						<input type="hidden" id="uploaded" value="{{Session::pull('success')}}"/>
					</div>
						<input type="hidden" id="uploaded" value="{{Session::pull('success')}}"/>
					</div>
					
					<br/><br/><hr class="" />

				<div id="videosContainer" class='container'>
					<div class="col-md-12" style="margin-left:-10px;">
						@if(empty($usersVideos))
							<p class="text-center">No Videos yet.</p>
						@else
						@foreach($usersVideos as $usersVideo)
						<div id='list' class="col-md-3 mg-b-10">
							<div class="inlineVid">
								<a href="{{route('homes.watch-video', array($usersVideo->file_name))}}" target="_blank">
									<div class="thumbnail-2">
										@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name.'.jpg')) )
										<img src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}" width="100%" class="hvr-grow-rotate">
							
										@else
<<<<<<< HEAD
											{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('width' => '100%','class' => 'hvr-grow-rotate'))}}
=======
											{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('class' => 'hvr-grow-rotate', 'width' => '100%'))}}
>>>>>>> d17e1a700122dfffc867ba05f95ad017a684552b
										@endif
										<div class="play-hover mg-t--20"><img src="/img/icons/play-btn.png" /> </div>						
									</div>
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
									<i class="fa fa-eye"></i> {{$usersVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$usersVideo->likes}} | <i class="fa fa-calendar"></i> {{date('M d Y',strtotime($usersVideo->created_at))}}
									{{$usersVideo->uploaded}}
								</div>
							</div>
						</div>
					@endforeach	

				</div>
					@endif
				</div>
					</div>

				</div>
			</div>
			<br/>
		</div>
	</div>
@stop