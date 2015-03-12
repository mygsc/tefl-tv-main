@extends('layouts.default')

@section('content')

<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
		
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<div class="crop-square">
						{{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="" style="background-image:url(/img/user/cover.jpg); height:224px;">
						<div class="">
							<div class="overlay-cover">
								This channel does not exist.
							</div>
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

@stop
@section('script')
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	{{HTML::script('js/subscribe.js')}}
@stop