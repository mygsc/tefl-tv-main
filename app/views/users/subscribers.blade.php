@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container pageH">
		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop')

			<div class="Div-channel-border channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
						<li role="presentation">{{link_to_route('users.about', 'About')}}</li>
						<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
						<li role="presentation" class="active">{{link_to_route('users.subscribers', 'Subscribers/Subscriptionss')}}</li>

					</ul><!--tabNav-->
				</div>
				<br/>
				<div class="row">
					<div class="row-same-height">
						<div class="col-md-6 col-lg-height col-md-height">
							<div class="well2 Div-channelSubSection">
								<div class="s">
									<div class="subLabelThis">
										<span>Subscribers</span>&nbsp;
									</div>
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
									@if(empty($subscriberProfile))
										No Subscribers
									@else
										@foreach($subscriberProfile as $key => $profile)
										<div class="subscribers">
											<div class="col-md-6">
												@if(file_exists(public_path('img/user/'.$profile->subscriber_id.'.jpg')))
								                	{{HTML::image('img/user/'.$profile->subscriber_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
								                @else
								                	{{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
								                @endif
												&nbsp;

												<a href="{{route('view.users.channel')}}"><span><b>{{$profile->channel_name}}</b></span></a>&nbsp;
												<br/>&nbsp;
												<span>w/ <b>{{$profile->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
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
										</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
				
						<div class="col-md-6 col-lg-height col-md-height">
							<div class="well2 Div-channelSubSection">
								<div class="">
									<div class="subLabelThis">
										<span>Subscriptions</span>&nbsp;
									</div>
									<br/>
									<div class="searchPanel">
										<!--<div class="input-group">
										{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Subscription', 'class' => 'form-control c-input ')) }}
											<span class="input-group-btn">
												{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
											</span>
										</div>-->
									</div>
									<br/><br/>
									
									<table class="table">
										<tr>
											<td>{{ Form::checkbox(false)}}</td>
											<td>
												<select>
													<option>Actions</option>
												</select>
											</td>
											<td class="text-center">
												Send me updates
											</td>
											<td class="text-center">
												Actvity Feeds
											</td>
											<td class="text-right">
												Subscribe/Unsubscribe
											</td>
										</tr>
										@if(empty($subscriptionProfile))
											No Subscriptions
										@else
										@foreach($subscriptionProfile as $key => $profile1)
										<tr>
											<td>{{ Form::checkbox(false)}}</td>
											<td>
												@if(file_exists(public_path('img/user/'.$profile1->user_id.'.jpg')))
								                	{{HTML::image('img/user/'.$profile1->user_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
								                @else
								                	{{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
								                @endif
												&nbsp;
												<a href="{{route('view.users.channel')}}"><span><b>{{$profile1->channel_name}}</b></span></a>&nbsp;
											</td>
											<td class="text-center">{{ Form::checkbox(false)}}</td>
											<td class="text-center">
												<select>
													<option>All Activities</option>
												</select>
											</td>
											<td class="text-center">
												@if(isset($profile1->id))
													@if(isset(Auth::User()->id))
														<?php
															$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->id, 'subscriber_id' => Auth::User()->id))->first();
														?>
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
											</td>
										</tr>
										@endforeach
										@endif
									</table>
								</div>
							</div><!--subscriptions-->
						</div>
					</div><!--/.row-same-height-->
				</div><!--/.row-->
			</div>
		</div><!--/.shadow Div-channel-border-->
		<br/>
	</div><!--container-->
</div><!--/.row-->
@stop

@section('script')
	{{HTML::script('js/jquery.js')}}
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

