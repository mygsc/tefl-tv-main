@extends('layouts.default')

@section('content')

<br/>
<div class="row">
	<div class="container pageH White">
		<div class="row same-H">
			@include('elements.users.profileTop2')
			<div class="White channel-content">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs visible-lg visible-md" role="tablist">
				  		<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
							<li role="presentation" class="active">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
							<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
							<li role="presentation">{{link_to_route('view.users.playlists2', 'Playlists', $userChannel->channel_name)}}</li>
							<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
							<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
				  	</ul><!--tabNav-->

				  	<nav class="navbar navbar-default visible-sm visible-xs">
					  <div class="container-fluid">
					    <div class="navbar-header">
					      
					      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					      <h4 class="inline mg-t-20">About</h4>	
					        <span class="fa fa-bars"></span>
					      </button>
			
					    </div>
					    <div class="collapse navbar-collapse" id="myNavbar">
					      <ul class="nav navbar-nav">
					        <li>{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
					    	<li>{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
					    	<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
					  		<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
					  		<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
					      </ul>
					    </div>
					  </div>
					</nav>
				  	<!-- Tab panes -->
				  	<br/>
				    <div class="tab-content">
					  <br/>
						<div class="">
							<div class="col-md-12">
								<div class="" id="about">
									<div class="col-md-12 grey">
									@if(!empty($usersChannel->interests))
										<h3 class="orangeC text-center">-Interests-</h3>
										<div class="well2">
											<p class="text-justify">
												{{$usersChannel->interests}}
									@endif
											</p>
										</div>
									</div>
								</div>
							
								<div class="col-md-12 ">
									<h3 class="orangeC text-center">-Personal Information-</h3>
									<div class="well2">
										<table class="tableLayout">
											<tr class="">
												<td width="20%"><small><label>Name</label></small> </td>
												<td width="5%"><b>:</b></td>
												<td width="75%">{{$usersProfile->first_name}} {{$usersProfile->last_name}}</td>
											</tr>
											<tr>
												@if(!empty($usersProfile->birthdate))
													<td><small><label>Birthdate</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->birthdate}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->organization))
													<td><small><label>Organizations</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->organization}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->work))
													<td><small><label>Work</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->work}}</td>
												@endif
											</tr>
										</table>
									</div>
								</div>
								<div class="col-md-12 grey">
									<h3 class="orangeC text-center">-Contact Information-</h3>
									<div class="well2">
										<table class="tableLayout">
											<tr>
												@if(!empty($userChannel->email))
													<td width="20%"><small><label>Email</label></small> </td>
													<td width="5%"><b>:</b></td>
													<td width="75%">{{$userChannel->email}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersChannel->website))
													<td><small><label>Website</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersChannel->website}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->contact_number))
													<td><small><label>Contact Number</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->contact_number}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->zip_code))
													<td><small><label>Zip Code</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->zip_code}}</td>
												@endif
											</tr>
										</table>
									</div>
								</div>
								<div class="col-md-12">
								@if(empty($usersProfile->address))

								@else
									<h3 class="orangeC text-center">-Address-</h3>
									<div class="well2">
										<table class="tableLayout">
											<tr>
													<td width="20%"><small><label>Address</label></small></td>
													<td width="5%"><b>:</b></td>
													<td width="75%">{{$usersProfile->address}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->city))
													<td><small><label>City</label></small> </td>
													<td><b>:</b></td>
													<td>{{$usersProfile->city}}</td>
												@endif
											</tr>
											<tr>
												@if(!empty($usersProfile->state))
													<td><small><label>State</label></small></td>
													<td><b>:</b></td>
													<td>{{$usersProfile->state}}</td>
												@endif
											</tr>
											
											<tr>
												@if(!empty($usersProfile->country_id))
												<td><small><label>Country</label></small></td>
												<td><b>:</b></td>
												<td>{{$usersProfile->country_id}}</td>
												@endif
											</tr>
										</table>
									</div>
								</div>

								</div><!--/.tabpanel-->
							</div><!--/.tab-content-->
						</div>			    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->

		</div><!--/.contentpadding-->
	</div><!--/.container page-->
	<br/>
</div>

@stop

