@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop2')
			<br/>
			<div class="Div-channel-border channel-content">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<!-- <li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li> -->
				    	<!-- <li role="presentation" class="active">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li> -->
				  		<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->
				</div>

				<div class="row">
					<br/>
					<!--<div class="col-md-6">
						<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>-->

					<div class="col-md-5">
				
						<!--<select class="form-control" style="width:auto!important;">
							<option value="" selected disabled>Sort By</option>
							<option>Likes</option>
							<option>Recent</option>
						</select>
						&nbsp;&nbsp;
						<button class="btn btn-unsub">Manage Your Watch Later Videos</button>-->
					</div>

					<div class="col-md-12 text-right">
						<div class="buttons pull-right">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>
					<br/><hr class="" />
					<div id="videosContainer" class='container'>
						<br/>
						@if(empty($usersWatchLater))
							<p class="text-center">No watch later yet.</p>
						@else
						@foreach($usersWatchLater as $key => $watchLater)
						<div id='list' class="col-md-3">
							<div class="inlineVid ">
								<div class="watch">
									<input type="hidden" id="user_id" value="{{$userChannel->id}}"/>
									@if($watchLater->status==1)
									<span title="Remove from watch later?" class="btn-sq">
											<p class="inline" style="font-family:Teko;color:#393939!Important;font-size:1.6em;">WATCHED</p> &nbsp; | &nbsp;
											<span class="inline">
												{{Form::open(array('route' => ['post.delete.watch-later', $watchLater->id], ,'onsubmit'=> 'return confirm("Are you sure you want to delete this?")'))}}
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
									<div>
									<a href="{{route('homes.watch-video', array($watchLater->file_name))}}" target="_blank">
									
											@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name.'.jpg')) )
														<video poster="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.jpg'}}"  width="100%" >
															<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.mp4'}}" type="video/mp4" />
															<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.webm'}}" type="video/webm" />
															<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$watchLater->file_name.'/'.$watchLater->file_name. '.ogg'}}" type="video/ogg" />
														</video>
														@else
															{{HTML::image('img/thumbnails/video-sm.jpg')}}
														@endif
										</a>
										</div>
										<br/>		
								</div>
							</div>

							<div class="inlineInfo ">
								<div class="count">
									<div class="v-Info">
										<!-- <a href="{{route('homes.watch-video', array($watchLater->file_name))}}" target="_blank"> -->
										{{$watchLater->title}}
										<!-- </a> -->
									</div>
									by: <a href="{{route('view.users.channel', array($watchLater->channel_name))}}">{{$watchLater->channel_name}}</a><br/>
										{{$watchLater->views}} Views | {{$watchLater->numberOfLikes}} Likes | {{$watchLater->created_at}}<br/>
									<br/>
								</div>
							</div>
						</div><!--/#list-->
						@endforeach
						@endif
					</div><!--videoContainer-->
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
@stop

@section('script')
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

