@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop2')

			<div class="Div-channel-border">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<!-- <li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li> -->
				    	<!-- <li role="presentation">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li> -->
				  		<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation" class="active">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>

					</ul><!--tabNav-->
				</div>
				<br/>
				<div class="row">
					<div class="col-md-6">
						<div class="well2 Div-channelSubSection">
							<div class="subscibersDiv">
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
			             		{{HTML::image('img/user/'.$profile->subscriber_id.'.jpg', 'alt', array('width' => 60, 'height' => 46))}}
			              @else
			            	  {{HTML::image('img/user/0.jpg', 'alt', array('width' => 60, 'height' => 46))}}
			              @endif
										&nbsp;

										<a href="{{route('view.users.channel')}}"><span><b>{{$profile->channel_name}}</b></span></a>&nbsp;
										<br/>&nbsp;
										<span>w/ <b>{{$profile->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
										<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
									</div>
								</div><!--subscibersDiv-->
								@endforeach
								@endif
							</div>
						</div>
					</div>
			
					<div class="col-md-6">
						<div class="well2 Div-channelSubSection">
							<div class="subscibersDiv">
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
			                	{{HTML::image('img/user/'.$profile1->user_id.'.jpg', 'alt', array('width' => 60, 'height' => 46))}}
			                @else
			                	{{HTML::image('img/user/0.jpg', 'alt', array('width' => 60, 'height' => 46))}}
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
										<td class="text-center"><button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button></td>
									</tr>
									@endforeach
									@endif
								</table>
							</div>
						</div><!--subscriptions-->
					</div>
				</div><!--/.row-->
			</div>
		</div><!--/.shadow Div-channel-border-->
		<br/>
	</div><!--container-->
</div><!--/.row-->
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

