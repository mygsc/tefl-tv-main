@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container pageH">

		<br/>
		<div class="row">
			@include('elements/users/profileTop')
			<br/>
			<div class="Div-channel-border">
				<ul class="nav nav-tabs" role="tablist inline">
					
			    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
			    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
				</ul>
				<div class="tab-content inline">
			  		<div role="tabpanel" class="tab-pane active" id="about">
						<div class="" style="margin-top:20px;">
							<p class="text-justify">
								{{$usersChannel->interests}}
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="learn">
						<div class="row" style="margin-top:20px;">
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>Name</label></small> </td>
										<td><b>:</b></td>
										<td>{{$usersChannel->first_name}} {{$usersChannel->last_name}}</td>
									</tr>
									<tr>
										<td><small><label>Birthdate</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->birthdate}}</td>
									</tr>
									<tr>
										<td><small><label>Organizations</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->organization}}</td>
									</tr>
									<tr>
										<td><small><label>Work</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->work}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>Email</label></small> </td>
										<td><b>:</b></td>
										<td>{{Auth::User()->email}}</td>
									</tr>
									<tr>
										<td><small><label>Website</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->website}}</td>
									</tr>
									<tr>
										<td><small><label>Contact Number</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->contact_number}}</td>
									</tr>
									<tr>
										<td><small><label>Address</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->address}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>City</label></small> </td>
										<td><b>:</b></td>
										<td>{{$usersChannel->city}}</td>
									</tr>
									<tr>
										<td><small><label>State</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->state}}</td>
									</tr>
									<tr>
										<td><small><label>Zip Code</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->zip_code}}</td>
									</tr>
									<tr>
										<td><small><label>Country</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->country_id}}</td>
									</tr>
								</table>
							</div>
						</div>
					</div><!--/.tabpanel-->
				</div><!--/.tab-content-->
			</div>
			<br/>
			<div class="Div-channel-border White">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation" class="active">{{link_to_route('users.channel', 'Home', Auth::User()->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-Home')
					  	</div>				    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->
			<br/>
		</div><!--/.contentpadding-->
	</div><!--/.container page-->
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
