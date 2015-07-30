@extends('layouts.default')

@section('title')
	{{Auth::User()->channel_name}} - Subscriber | TEFL Tv
@stop

@section('content')
<div class="row">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop')

			<div class="Div-channel-border channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs visible-lg visible-md White same-H" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
						<li role="presentation">{{link_to_route('users.about', 'About Me')}}</li>
						<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
						<li role="presentation" class="active">{{link_to_route('users.subscribers', 'Subscribers/Subscriptionss')}}</li>
					</ul><!--tabNav-->
				</div>
				<nav class="navbar navbar-default visible-sm visible-xs">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<h4 class="inline mg-t-20">Subscribers/Subscriptions</h4>	
								<span class="fa fa-bars"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav">
								<li>{{link_to_route('users.channel', 'Home')}}</li>
								<li>{{link_to_route('users.about', 'About')}}</li>
								<li>{{link_to_route('users.myvideos', 'My Videos')}}</li>
								<li>{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
								<li>{{link_to_route('users.watchlater', 'Watch Later')}}</li>
								<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
								<li>{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="col-md-12 mg-t-20">
					<div class="row">
						<div class="row-same-height">
							<div class="col-md-6 col-md-height col-top  White same-H">
								<div class="row">
									<div class="top-div_t whiteC">
										<h3 class="text-center">SUBSCRIBERS</h3>
									</div>
							
									<div class="Div-channelSubSection" id="subscriberWrapper">
										<div class="content-padding">
								
											<br/><br/>
											@if($subscriberProfile->isEmpty())
												<p class="text-center">No Subscribers</p>
											@else
												@foreach($subscriberProfile as $key => $profile)
													<div class="subscribers">
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="row user-padding subs-wrap">
																{{HTML::image($profile['profile_picture'], 'alt', array('class' => 'userRep2'))}}
																&nbsp;

																<span><b><a href="{{route('view.users.channel', $profile->channel_name)}}">{{$profile->channel_name}}</a></b></span>&nbsp;
																<br/>&nbsp;
																<span>w/ <b>{{$profile->numberOfSubscribers}}</b>&nbsp;Subscribers</span>&nbsp;
																@if(isset(Auth::User()->id))
																	<?php
																		$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile->id, 'subscriber_id' => Auth::User()->id))->first();
																	?>
																	@if(isset($profile->id))
																		@if(Auth::User()->id != $profile->id)
																			{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
																    			{{Form::hidden('user_id', $profile->id)}}
																    			{{Form::hidden('subscriber_id', Auth::User()->id)}}
																    			@if(!$ifAlreadySubscribe)
																    				{{Form::hidden('status','subscribeOn')}}
																			    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right  subs-btn-size', 'id'=>'subscribebutton'))}}
																			    @else
																			    	{{Form::hidden('status','subscribeOff')}}
																			    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-info btn-xs pull-right', 'id'=>'subscribebutton'))}}
																			    @endif
																			{{Form::close()}}
																		@endif
																	@endif
																@endif
															</div>
														</div>
													</div>
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
				
						<div class="col-md-6 col-md-height col-top White same-H">
							<div class="row ">
								<div class="top-div_t whiteC">
									<h3 class="text-center">SUBSCRIPTIONS</h3>
								</div>
								<div class="Div-channelSubSection" id="subscriberWrapper">
									<div class="content-padding">
										<br/><br/>
										<div class="subscribers">
											@if($subscriptionProfile->isEmpty())
												<p class="text-center">No Subscriptions</p>
											@else
												@foreach($subscriptionProfile as $key => $profile1)
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="row user-padding subs-wrap">
										                	{{HTML::image($profile1['profile_picture'], 'alt', array('class' => 'userRep2'))}}
															&nbsp;
															<a href="{{route('view.users.channel', $profile1->channel_name)}}"><span><b>{{$profile1->channel_name}}</b></span></a>&nbsp;
															<br/>&nbsp;
															<span>w/ <b>{{$profile1->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
															@if(isset($profile1->id))
																@if(isset(Auth::User()->id))
																	<?php
																		$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->user_id, 'subscriber_id' => Auth::User()->id))->first();
																	?>
																	{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
														    			{{Form::hidden('user_id', $profile1->user_id)}}
														    			{{Form::hidden('subscriber_id', Auth::User()->id)}}
														    			@if(!$ifAlreadySubscribe)
														    				{{Form::hidden('status','subscribeOn')}}
																	    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs subs-btn-size pull-right', 'id'=>'subscribebutton'))}}
																	    @else
																	    	{{Form::hidden('status','subscribeOff')}}
																	    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-info btn-xs pull-right', 'id'=>'subscribebutton '))}}
																	    @endif
																	{{Form::close()}}
																@endif
															@endif
														</div>
													</div>
												@endforeach
											@endif
										</div>
									</div>

									</div>
								</div>
							</div><!--subscriptions-->
						</div>
					</div><!--/.row-same-height-->
					</div>
				</div><!--/.row-->
			</div>
		</div><!--/.shadow Div-channel-border-->
	</div>
</div>
		<br/>
	</div><!--container-->
</div><!--/.row-->
@stop

@section('script')
{{HTML::script('js/video-player/jquery.form.min.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/user/modalclearing.js')}}
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/media.player.js')}}
{{HTML::script('js/homes/convert_specialString.js')}}

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

