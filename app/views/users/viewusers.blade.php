@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container pageH">
		<br/>
		<div class="row">
			<div style="border:5px solid #e3e3e3;background:#fff;">
			
				<div class="col-md-2 hidden-xs">
					<div class="row">
						<div class="crop-square">
							{{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
							<!-- {{HTML::image('img/user/'. '.jpg', 'alt', array('class' => 'pic-Dp'))}} -->
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="" style="background-image:url(/img/user/cover.jpg); height:224px;">
							<div class="">
								<div class="overlay-cover">
									<span class="infoCounts">
										<label>12k Subscribers</label>
										<label>100 Videos</label> &nbsp;
										<label>13k Views</label>
									</span>
									<span class="pull-right" >
										<a href=""><img src="/img/icons/fb.png"></a>
										<a href=""><img src="/img/icons/tr.png"></a>
										<a href=""><img src="/img/icons/gp.png"></a>
										<a href=""><img src="/img/icons/yt.png"></a>
										<a href=""><img src="/img/icons/wl.png"></a>
	 									&nbsp;
	 									@if($user_id)
											{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
							    				{{Form::hidden('user_id',$userChannel->id)}}
							    				{{Form::hidden('subscriber_id', $user_id)}}
							    				{{Form::hidden('status','subscribeOn')}}
							    				@if(!empty($ifAlreadySubscribe))
										    		{{Form::submit('Subscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
										    	@else
										    		{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
										    	@endif
										    {{Form::close()}}
										@else
											{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary pull-right')); }}
									    @endif
									</span>	
								</div>
							</div>	
						</div>

					</div>
				</div>


				<div class="c-about" style="">
					<div class="labelThis" style="margin-top:-25px;">
						{{$userChannel->channel_name}}
					</div>
					<ul class="nav nav-tabs" role="tablist inline">
				    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
				    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
					</ul>
					<div class="tab-content inline">
				  		<div role="tabpanel" class="tab-pane active" id="about">
							<div class="" style="margin-top:20px;">
								<p class="text-justify">
									{{$userChannel->userprofile->interests}}
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
										<td>{{$userChannel->first_name}} {{$userChannel->last_name}}</td>
									</tr>
									<tr>
										<td><small><label>Birthdate</label></small></td>
										<td><b>:</b></td>
										<td>{{$userChannel->birthdate}}</td>
									</tr>
									<tr>
										<td><small><label>Organizations</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->organiztion}}</td>
									</tr>
									<tr>
										<td><small><label>Work</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->organiztion}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>Email</label></small> </td>
										<td><b>:</b></td>
										<td></td>
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
										<td><small><label>Address</label></small></td>
										<td><b>:</b></td>
										<td>{{$userChannel->address}}</td>
									</tr>
								</table>

							</div>
							<div class="col-md-4">
								<table class="tableLayout">
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
										<td><small><label>Zip Code</label></small></td>
										<td><b>:</b></td>
										<td>{{$userChannel->zip_code}}</td>
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
					</div>
				</div>
			</div>

			<br/>
			<div class="Div-channel-border White">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
				    	<li role="presentation"><a href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab">Videos</a></li>
				    	<li role="presentation"><a href="#MyFavorites" aria-controls="MyFavorites" role="tab" data-toggle="tab">My Favorites</a></li>
				    	<li role="presentation"><a href="#WatchLater" aria-controls="WatchLater" role="tab" data-toggle="tab">Watch Later</a></li>
				  		<li role="presentation"><a href="#Playlists" aria-controls="Playlists" role="tab" data-toggle="tab">Playlists</a></li>
				  		<li role="presentation"><a href="#Feedbacks" aria-controls="Feedbacks" role="tab" data-toggle="tab">Feedbacks</a></li>
				  		<li role="presentation"><a href="#Subscribers" aria-controls="Subscribers" role="tab" data-toggle="tab">Subscribers</a></li>
				  		<li role="presentation"><a href="#Subscriptions" aria-controls="Subscriptions" role="tab" data-toggle="tab">Subscriptions</a></li>
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-HomeViewUsers')
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
						    				<button class="">Subscribe</button>
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
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	{{HTML::script('js/subscribe.js')}}
@stop