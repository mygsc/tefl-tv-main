@extends('layouts.default')

@section('title')
    {{$userChannel->channel_name}} | TEFL Tv
@stop

@section('content')
<div class="row">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop2')
			<div class="">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs visible-lg visible-md White same-H" role="tablist">
						<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
						<li role="presentation" class="active">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
					</ul><!--tabNav-->
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
									<li>{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.videos2','Videos', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.playlists2', 'Playlists', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
								</ul>
							</div>
						</div>
					</nav>

				</div><!--./tab panel-->

				<div class="col-md-12 mg-t-20">
					<div class="row">
						<div class="row-same-height">
							<div class="col-md-6 col-md-height col-top White same-H">
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
																<a href="{{route('view.users.channel', $profile->channel_name)}}"><span><b>{{$profile->channel_name}}</b></span></a>&nbsp;
																<br/>&nbsp;
																@if($profile->ifShowSubscriberCount == 'show')
																	<span>w/ <b>{{$profile->numberOfSubscribers}}</b>&nbsp;Subscribers</span>&nbsp;
																@endif
																@if(isset(Auth::User()->id))
																	<?php
																		$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile->subscriber_id, 'subscriber_id' => Auth::User()->id))->first();
																	?>
																	@if(isset($profile->id))
																		@if(Auth::User()->id != $profile->subscriber_id)
																			{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
																			{{Form::hidden('user_id', $profile->subscriber_id)}}
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
													</div><!--subscibersDiv-->
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>


							<div class="col-md-6 col-md-height col-top  White same-H">
								<div class="row " >
									<div class="top-div_t whiteC">
										<h3 class="text-center">SUBSCRIPTIONS</h3>
									</div>
									<div class="Div-channelSubSection" id="subscriberWrapper">
										<div class="content-padding">
											<br/><br/>
												@if($subscriptionProfile->isEmpty())
													<p class="text-center">No Subscription</p>
												@else
													@foreach($subscriptionProfile as $key => $profile1)
														<div class="subscribers">
															<div class="col-md-12 col-sm-12 col-xs-12">
																<div class="row user-padding subs-wrap">
																	{{HTML::image($profile1['profile_picture'], 'alt', array('class' => 'userRep2'))}}
																	&nbsp;
																	<a href="{{route('view.users.channel', $profile1->channel_name)}}"><span><b>{{$profile1->channel_name}}</b></span></a>&nbsp;
																	<br/>&nbsp;
																	@if($profile1->ifShowSubscriberCount == 'show')
																		<span>w/ <b>{{$profile1->numberOfSubscribers}}</b>&nbsp;Subscribers</span>&nbsp;
																	@endif
																	@if(isset(Auth::User()->id))
																		<?php
																			$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->user_id, 'subscriber_id' => Auth::User()->id))->first();
																		?>
																		@if(isset($profile1->id))
																			@if(Auth::User()->id != $profile1->user_id)
																				{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
																				{{Form::hidden('user_id', $profile1->user_id)}}
																				{{Form::hidden('subscriber_id', Auth::User()->id)}}
																				@if(!$ifAlreadySubscribe)
																					{{Form::hidden('status','subscribeOn')}}
																					{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right subs-btn-size', 'id'=>'subscribebutton'))}}
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
														</div><!--subscibersDiv-->
													@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
							</div><!--/.row-->
						</div>
					</div><!--/.shadow-->
				</div><!--container-->
			</div><!--/.row-->
			<br/>
		</div>
	</div>
@stop

@section('script')
{{HTML::script('js/jquery.min.js')}}
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

