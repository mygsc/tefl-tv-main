@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container pageH">
		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop2')
		
			<div class="Div-channel-border White">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation"><a href="#About" aria-controls="About" role="tab" data-toggle="tab">About</a></li>
				    	<li role="presentation"><a href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab">Videos</a></li>
				    	<li role="presentation"><a href="#MyFavorites" aria-controls="MyFavorites" role="tab" data-toggle="tab">My Favorites</a></li>
				    	<li role="presentation"><a href="#WatchLater" aria-controls="WatchLater" role="tab" data-toggle="tab">Watch Later</a></li>
				  		<li role="presentation"><a href="#Playlists" aria-controls="Playlists" role="tab" data-toggle="tab">Playlists</a></li>
				  	  <li role="presentation">{{link_to_route('view.users.feedbacks2','Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation"><a href="#Subscribers" aria-controls="Subscribers" role="tab" data-toggle="tab">Subscribers</a></li>
				  		<li role="presentation"><a href="#Subscriptions" aria-controls="Subscriptions" role="tab" data-toggle="tab">Subscriptions</a></li>
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-HomeViewUsers')
					  	</div>	

					  	<div role="tabpanel" class="tab-pane" id="About">
							<div class="row">
								<div class="col-md-12">
									<div class="" id="about">
										<div class="col-md-12 LighterBlue">
										<h3 class="tBlue text-center">-Interests-</h3>
										<div class="well2">
											<p class="text-justify">
												{{$userChannel->userprofile->interests}}
											</p>
											</div>
										</div>
									</div>
								
									<div class="col-md-12 LightestBlue">
										<h3 class="tBlue text-center">-Personal Information-</h3>
										<div class="well2">
											<table class="tableLayout">
												<tr class="">
													<td width="20%"><small><label>Name</label></small> </td>
													<td width="5%"><b>:</b></td>
													<td width="75%">{{$userChannel->first_name}} {{$userChannel->last_name}}</td>
												</tr>
												<tr>
													<td><small><label>Birthdate</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->birthdate}}</td>
												</tr>
												<tr>
													<td><small><label>Organizations</label></small></td>
													<td><b>:</b></td>
													<td>{{Auth::User()->organization}}</td>
												</tr>
												<tr>
													<td><small><label>Work</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->work}}</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="col-md-12 LighterBlue">
										<h3 class="tBlue text-center">-Contact Information-</h3>
										<div class="well2">
											<table class="tableLayout">
												
												<tr>
													<td width="20%"><small><label>Email</label></small> </td>
													<td width="5%"><b>:</b></td>
													<td width="75%">{{Auth::User()->email}}</td>
												</tr>
												<tr>
													<td><small><label>Website</label></small></td>
													<td><b>:</b></td>
													<td>{{Auth::User()->website}}</td>
												</tr>
												<tr>
													<td><small><label>Contact Number</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->contact_number}}</td>
												</tr>
												<tr>
													<td><small><label>Zip Code</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->zip_code}}</td>
												</tr>
												
											</table>
										</div>
									</div>
									<div class="col-md-12 LightestBlue">
										<h3 class="tBlue text-center">-Address-</h3>
										<div class="well2">
											<table class="tableLayout">
												<tr>
													<td width="20%"><small><label>Address</label></small></td>
													<td width="5%"><b>:</b></td>
													<td width="75%">{{$userChannel->address}}</td>
												</tr>
												<tr>
													<td><small><label>City</label></small> </td>
													<td><b>:</b></td>
													<td>{{$userChannel->city}}</td>
												</tr>
												<tr>
													<td><small><label>State</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->state}}</td>
												</tr>
												
												<tr>
													<td><small><label>Country</label></small></td>
													<td><b>:</b></td>
													<td>{{$userChannel->country_id}}</td>
												</tr>
											</table>
										</div>
									</div>
									


									</div><!--/.tabpanel-->
								</div><!--/.tab-content-->
					  	</div>					    
					    		
					  	<div role="tabpanel" class="tab-pane" id="Videos">
					  		<div class="row">
					  			<br/>
					  			<div class="col-md-6 pull-right">
					  				<div class="input-group">
					  					{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
					  					<span class="input-group-btn">
					  						{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
					  					</span>
					  				</div>
					  			</div>
					  			<br/>
					  			
					  			<div class="videos">
					  				<div class="col-md-3">
					  					&nbsp;
					  					<video height="auto" width="100%" class="h-video" controls>
					  						<source src="" type="video/mp4" />		 
					  					</video>
				  						<div class="v-Info">
				  							Video Title
				  						</div>
				  						<div class="count">
				  							123123 Views, 100 Likes
				  						</div>
					  				</div>
					  			</div>
					  			
					  		</div>
					  	</div>

					    <div role="tabpanel" class="tab-pane" id="MyFavorites">
					    	My Favorites
					    </div>

					    <div role="tabpanel" class="tab-pane" id="WatchLater">
					    	Watch Later
					    </div>

					    <div role="tabpanel" class="tab-pane" id="Playlists">
					    	Playlists
					    </div>

					    <div role="tabpanel" class="tab-pane" id="Feedbacks">
					    	Feedbacks
					    </div>

					    <div role="tabpanel" class="tab-pane" id="Subscribers">
					    	<br/>
					    	<div class="row">
						    	<div class="col-md-10 col-md-offset-1">
						    		<div class="col-md-6 pull-right">
						    			<div class="input-group">
						    				{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
						    				<span class="input-group-btn">
						    					{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
						    				</span>
						    			</div>

						    		</div>
					    			<br/>
					    			<hr/>
										
					    			
					    			<div class="subscribers">
						    			<div class="col-md-6">
						    				<img src="/img/user/u1.png" class="userRep2">&nbsp;
						    				<a href="{{route('view.users.channel')}}"><span><b>Mark Zuckerburg</b></span></a>&nbsp;
						    				<br/>&nbsp;
						    				<span>w/ <b>69k</b> Subscribers</span>&nbsp;
						    				<button class="btn btn-info btn-xs">Subscribe</button>
						    			</div>
						    		</div>
								</div>	
					   		</div>
					   	</div>

					    <div role="tabpanel" class="tab-pane" id="Subscriptions">
					    		<br/>
					    		<div class="row">
					    			<div class="col-md-10 col-md-offset-1">
						    			<div class="col-md-6 pull-right">
							    			<div class="input-group">
					                              {{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
					                              <span class="input-group-btn">
					                                {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
					                              </span>
				                        	 </div>
			                        	 </div>
			                        	 <br/>
									
										<div class="subscriptions">
											<div class="row">
												<br/>	
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
												
													<tr>
														<td>{{ Form::checkbox(false)}}</td>
														<td>
															<img src="/img/user/u1.png" class="userRep2">&nbsp;
															<span><b>Mark Zuckerburg</b></span>&nbsp;
														</td>
														<td class="text-center">{{ Form::checkbox(false)}}</li></td>
														<td class="text-center">
															<select>
																<option>All Activities</option>
															</select>
														</td>
														<td class="text-center"><button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button></td>
													</tr>
													
												</table>

											
											
											</div>
											<hr/>
										</div>
										
									
								</div>
								</div>
								
					    </div>

				  </div><!--/.tab-content-->

				</div><!--/.tabpanel-->
					
			</div>
		</div><!--/.contentpadding-->
		<br/>
	</div><!--/.container page-->
</div>

@stop
@section('script')
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/subscribe.js')}}
@stop