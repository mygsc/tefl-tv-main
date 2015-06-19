@extends('layouts.default')

@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row same-H White">
			@include('elements/users/profileTop2')
			<div class="White channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs visible-lg visible-md" role="tablist">
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
									<li>{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
									<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
								</ul>
							</div>
						</div>
					</nav>

				</div><!--./tab panel-->
				<br/>
				<div class="col-md-12 ">
					<div class="row">
						<div class="row-same-height">
							<div class="col-md-6 greyDark col-md-height col-top">
								<div class="row">
									<div class="h-title grey lightBlueC">
										<span><b>SUBSCRIBERS</b></span>&nbsp;
									</div>
									<div class="searchPanel">
										<!--<div class="input-group">
											{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Subscriber', 'class' => 'form-control c-input ')) }}
											<span class="input-group-btn">
												{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
											</span>
										</div>-->
									</div>
									<br/><br/>
									@if($subscriberProfile->isEmpty())
									<p class="text-center">No Subscribers</p>
									@else
									@foreach($subscriberProfile as $key => $profile)
									<div class="subscribers">
										<div class="col-md-6 col-sm-6 col-xs-12">
											{{HTML::image($profile['profile_picture'], 'alt', array('class' => 'userRep2'))}}
											&nbsp;

											<a href="{{route('view.users.channel', $profile->channel_name)}}"><span><b>{{$profile->channel_name}}</b></span></a>&nbsp;
											<br/>&nbsp;
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
											{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs', 'id'=>'subscribebutton'))}}
											@else
											{{Form::hidden('status','subscribeOff')}}
											{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs', 'id'=>'subscribebutton'))}}
											@endif
											{{Form::close()}}
											@endif
											@endif
											@endif
										</div>
									</div><!--subscibersDiv-->
									@endforeach
									@endif
								</div>
							</div>


							<div class="col-md-6 col-md-height col-top grey">
								<div class="row">
									<div class="h-title greyDark lightBlueC">
										<span><b>SUBSCRIPTIONS</b></span>&nbsp;
									</div>
									<div class="Div-channelSubSection" id="subscriberWrapper">
										<br/>
										<div class="searchPanel">
											<!--<div class="input-group">
												{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Subscriber', 'class' => 'form-control c-input ')) }}
												<span class="input-group-btn">
													{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
												</span>
											</div>-->
										</div>
										<br/><br/>
										@if($subscriptionProfile->isEmpty())
											<p class="text-center">No Subscription</p>
										@else
											@foreach($subscriptionProfile as $key => $profile1)
												<div class="subscribers">
													<div class="col-md-6 col-sm-6 col-xs-12">
														{{HTML::image($profile1['profile_picture'], 'alt', array('class' => 'userRep2'))}}
										
														&nbsp;

														<a href="{{route('view.users.channel', $profile1->channel_name)}}"><span><b>{{$profile1->channel_name}}</b></span></a>&nbsp;
														<br/>&nbsp;
														@if(isset(Auth::User()->id))
														<?php
														$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->id, 'subscriber_id' => Auth::User()->id))->first();
														?>
														@if(isset($profile1->id))
														@if(Auth::User()->id != $profile1->id)
														{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
														{{Form::hidden('user_id', $profile1->id)}}
														{{Form::hidden('subscriber_id', Auth::User()->id)}}
														@if(!$ifAlreadySubscribe)
														{{Form::hidden('status','subscribeOn')}}
														{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs', 'id'=>'subscribebutton'))}}
														@else
														{{Form::hidden('status','subscribeOff')}}
														{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs', 'id'=>'subscribebutton'))}}
														@endif
														{{Form::close()}}
														@endif
														@endif
														@endif
													</div>
												</div><!--subscibersDiv-->
											@endforeach
										@endif
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
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/media.player.js')}}
{{HTML::script('js/homes/convert_specialString.js')}}

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

