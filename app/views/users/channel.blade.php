@extends('layouts.default')

@section('content')


<div class="container page">
	<br/>
	<div class="row">
		@include('elements/users/profileTop')

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
				  			@foreach($usersVideos as $usersVideo)
				  			<div class="videos">
				  				<div class="col-md-3">
				  					&nbsp;
				  					<video height="auto" width="100%" class="h-video controls>
				  						<source src="/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}" type="video/mp4" />		 
				  					</video>
				  						<div class="v-Info">
				  							{{$usersVideo->title}}
				  						</div>
				  						<div class="count">
				  							{{$usersVideo->views}} Views, {{$usersVideo->likes}} Likes
				  						</div>
				  				</div>
				  			</div>
				  			@endforeach	
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
									
				    			@foreach($subscriberLists as $subscriberList)
				    			<div class="subscribers">
					    			<div class="col-md-6">
					    				<img src="/img/user/u1.png" class="userRep2">&nbsp;
					    				<a href="{{route('view.users.channel',$subscriberList->user->channel_name)}}"><span><b>{{$subscriberList->first_name}} {{$subscriberList->last_name}}</b></span></a>&nbsp;
					    				<br/>&nbsp;
					    				<span>w/ <b>2k</b> Subscribers</span>&nbsp;
					    				<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
					    			</div>
					    		</div>
				    			@endforeach
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
											@foreach($subscriptionLists as $SubscriptionList)
												<tr>
													<td>{{ Form::checkbox(false)}}</td>
													<td>
														<img src="/img/user/u1.png" class="userRep2">&nbsp;
														<a href="{{route('view.users.channel')}}"><span><b>{{$SubscriptionList[0]['first_name']}} {{$SubscriptionList->last_name}}</b></span></a>&nbsp;
													</td>
													<td class="text-center">{{ Form::checkbox(false)}}</li></td>
													<td class="text-center">
														<select>
															<option>All Activities</option>
														</select>
													</td>
													<td class="text-center"><button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button></td>
												</tr>
												@endforeach
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
	{{HTML::script('js/media.player.js')}}
@stop