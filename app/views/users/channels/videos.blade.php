@extends('layouts.default')

@section('title')
{{$userChannel->channel_name}} | TEFL Tv
@stop

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
		<div class="row">
			@include('elements.users.profileTop2')
			<div class="channel-content">

				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs visible-lg visible-md White same-H" role="tablist">
						<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
						<li role="presentation" class="active">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.playlists2', 'Playlists', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>

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
									<li>{{link_to_route('view.users.playlists2', 'Playlists', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>

				<div class="top-div col-md-12 mg-t-20" style="padding:20px 0;">
					<div class="row">
						<div class="content-padding">
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
							<div class="col-md-6 col-sm-6 hidden-xs">
								<select class="form-control" style="width:auto!important;" id="dropdown" onchange="dynamic_select(this.value)">
									<option value="" selected disabled>Sort By</option>
									<option>Recent</option>
									<option>Likes</option>
									<option>Views</option>
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
					</div>
				</div>
				<div class="col-md-12 White same-H mg-t--20">
					<div class="row">
						<br/>
						<div id="videosContainer" class='content-padding'>
							<div class="col-md-12" style="margin-left:-10px;">
								@if($usersVideos->isEmpty())
								<p class="text-center">No Videos yet.</p>
								@else
								@foreach($usersVideos as $usersVideo)
								<div id='list' class="col-md-3 col-sm-6 col-xs-6 mg-b-10">
									<div class="inlineVid">
										<a href="{{route('homes.watch-video', array('v='.$usersVideo->file_name))}}" target="_blank">
											<div class="thumbnail-2">
												<img src="{{$usersVideo->thumbnail}}" width="100%" class="hvr-grow-rotate">
												<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>						
											</div>
										</a>
									</div>

									<div class="inlineInfo ">
										<div class="video-info-2">
											<div class="v-Info">
												
												<a href='{{route('homes.watch-video', array('v=' . $usersVideo->file_name))}}' target="_blank">
													<span class="visible-lg">{{ Str::limit($usersVideo['title'],65)}}</span>
													<span class="visible-md">{{ Str::limit($usersVideo['title'],45)}}</span>
													<span class="visible-xs visible-sm">{{ Str::limit($usersVideo['title'],30)}}</span>
												</a>
											</div>
											<div class="text-justify desc hide">
												<p>{{$usersVideo->description}}</p>
												<br/>
											</div>
											<div class="count">
												{{$usersVideo->views}} Views | {{$usersVideo->likes}} Likes | {{date('M d Y',strtotime($usersVideo->created_at))}}
												{{--{{$usersVideo->uploaded}}--}}
											</div>
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
		</div>
		<br/>
	</div>
</div>
@stop