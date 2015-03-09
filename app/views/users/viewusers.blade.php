@extends('layouts.default')

@section('content')


<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<div class="crop-square">
						{{HTML::image('img/user/'.Auth::User()->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
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
 	
									<button class="btn btn-primary" style="margin-top:5px;">Subscribe</button>
								</span>	
							</div>
						</div>	
					</div>
				</div>
			</div>



			
			<div class="c-about" style="padding:10px 10px;margin-top:0;">
				<div class="labelThis">
					User Channel Name
				</div>
				<ul class="nav nav-tabs" role="tablist inline">
			    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
			    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
				</ul>
				<div class="tab-content inline">
			  		<div role="tabpanel" class="tab-pane active" id="about">
						<div class="" style="margin-top:20px;">
							<p class="text-justify">
								User Interests
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="learn">
						<div class="" style="margin-top:20px;">
							<h4>Basic Information</h4>
							<ul class="ch-infoList">
								<li><small><label>Name:</label></small> Mark Zuckerburg</li>
								<li><small><label>Birthdate:</label></small> March 6, 3045</li>
								<li><small><label>Organizations:</label></small> Mafia</li>
								<li><small><label>Work:</label></small> CEO of Facebook </li>
							</ul>
							
							<h4>Contact Information</h4>
							<ul class="ch-infoList">
								<li><small><label>Email:</label></small></li>
								<li><small><label>Websites:</label></small>facebook.com/mark</li>
								<li><small><label>Contact Number:</label></small>1315464</li>
								<li><small><label>Address:</label></small>Chicago Illinoise</li>
								<li><small><label>City:</label></small>New York</li>
								<li><small><label>State:</label></small>State</li>
								<li><small><label>Zip Code:</label></small>1243</li>
								<li><small><label>Country:</label></small>America</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br/>
		<div class="shadow Div-channel-border">

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
						@include('elements/users/myChannelTabs/tab-Home')
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
					    				<span>w/ <b>2k</b> Subscribers</span>&nbsp;
					    				<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
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

@stop
