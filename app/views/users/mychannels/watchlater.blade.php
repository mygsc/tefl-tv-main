@extends('layouts.default')

@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row">

			@include('elements/users/profileTop')
			<div class="channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs visible-lg visible-md White same-H" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
						<li role="presentation">{{link_to_route('users.about', 'About Me')}}</li>
						<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation" class="active">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
						<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
					</ul><!--tabNav-->
					<nav class="navbar navbar-default visible-sm visible-xs">
						<div class="container-fluid">
							<div class="navbar-header">

								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
									<h4 class="inline mg-t-20">Watch Later</h4>	
									<span class="fa fa-bars"></span>
								</button>
								
							</div>
							<div class="collapse navbar-collapse" id="myNavbar">
								<ul class="nav navbar-nav">
									<li>{{link_to_route('users.channel', 'Home')}}</li>
									<li>{{link_to_route('users.about', 'About')}}</li>
									<li>{{link_to_route('users.myvideos', 'My Videos')}}</li>
									<li>{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
									<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
									<li>{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
									<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>


				<div class="top-div_t col-md-12 mg-t-20 pad20t">
					<div class="content-padding">
						<div class="col-md-6 col-sm-8 col-xs-8">
							{{Form::open(array('route' => 'searchWatchLater', 'method' => 'GET'))}}	
							<div class="input-group">
								{{ Form::text('search', null, array('id' => 'category', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
								<span class="input-group-btn">
									{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
								</span>
								{{Form::close()}}
							</div>
						</div>

						<!--<div class="col-md-5">
					
							<select class="form-control" style="width:auto!important;">
								<option value="" selected disabled>Sort By</option>
								<option>Likes</option>
								<option>Recent</option>
							</select>
							&nbsp;&nbsp;
							<button class="btn btn-unsub">Manage Your Watch Later Videos</button>
						</div>-->

						<div class="col-md-6 col-sm-4 col-xs-4 text-right">
							<div class="buttons pull-right">
								<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
								<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 White same-H channel-content">
					<div id="videosContainer" class='container'>
						<br/>
						@if($usersWatchLater->isEmpty())
						<p class="text-center">There's no video to watch later.</p>
						@else
						@foreach($usersWatchLater as $key => $watchLater)
						<div id='list' class="col-md-3">
							<div class="inlineVid ">
								<div class="watch">
									<input type="hidden" id="user_id" value="{{Auth::User()->id}}"/>
									@if($watchLater->status==1)
									<span title="Remove from watch later?" class="btn-sq inline">
										<p class="inline" style="font-family:Teko;color:#393939!Important;font-size:1.6em;">WATCHED</p> &nbsp; | &nbsp;
										<span class="inline">
											{{Form::open(array('route' => ['post.delete.watch-later', $watchLater->id], 'class' => 'inline' ,'onsubmit'=> 'return confirm("Are you sure you want to delete this?")'))}}
											{{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}
											{{Form::close()}}
										</span>

									</span>
									@else
									<span title="Remove from watch later?" class="btn-sq inline">		
										{{Form::open()}}
										{{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}
										{{Form::close()}}
									</span>
									@endif
									<input type="hidden" class="status" id="video_id" value="{{$watchLater->video_id}}"/>
									<div class="thumbnail-2">
										<a href="{{route('homes.watch-video', array($watchLater->file_name))}}" target="_blank">
											@if(file_exists(public_path('/videos/'.$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name.'.jpg')) )
											
												<img src="/videos/{{$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.jpg'}}" width="100%" class="hvr-grow-rotate">
													
												<!--<video poster="/videos/{{$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.jpg'}}" width="100%" />
														<source src="/videos/{{$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.mp4'}}" type="video/mp4" />
														<source src="/videos/{{$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.webm'}}" type="video/webm" />
														<source src="/videos/{{$watchLater->uploader.'-'.$watchLater->uploaders_channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.ogg'}}" type="video/ogg" />
												</video>-->
												@else
												<img src="/img/thumbnails/video-sm.jpg" width="100%"/>
															
											@endif
											<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
										</a>
									</div>
								</div>
											
							</div>
							<div class="inlineInfo ">
								<div class="v-Info">
									<a href='{{route('homes.watch-video', array('v=' . $watchLater->file_name))}}' target="_blank">
									<span class="visible-lg">{{ Str::limit($watchLater['title'],65)}}</span>
									<span class="visible-md">{{ Str::limit($watchLater['title'],45)}}</span>
									<span class="visible-xs visible-sm">{{ Str::limit($watchLater['title'],30)}}</span>
									</a>
								</div>
								<div class="text-justify desc hide">
											<p>{{$watchLater->description}}</p>
											<br/>
										</div>
										<div class="count">
									by: <a href="{{route('view.users.channel', array($watchLater->uploaders_channel_name))}}">{{$watchLater->uploaders_channel_name}}</a><br/>
									<i class="fa fa-eye"></i> {{$watchLater->views}} | <i class="fa fa-thumbs-up"></i> {{$watchLater->numberOfLikes}} | <i class="fa fa-calendar"></i> {{$watchLater->created_at}}<br/>
									<br/>
								</div>
							</div>
						</div><!--/#list-->
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
		{{HTML::script('js/video-player/jquery.form.min.js')}}
		{{HTML::script('js/video-player/media.player.min.js')}}
		{{HTML::script('js/user/upload_image.js')}}
		{{HTML::script('js/user/upload_cover_photo.js')}}
		{{HTML::script('js/user/modalclearing.js')}}
		{{HTML::script('js/subscribe.js')}}
		{{HTML::script('js/media.player.js')}}
		{{HTML::script('js/homes/watch.js')}}
		{{HTML::script('js/overlaytext.js')}}
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

