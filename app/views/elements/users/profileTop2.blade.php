		<div class="White Div-channel-border">
			<div class="col-md-12">
				<div class="row">
					<div class="div-coverDp">
						<div class="uploaded_img pic-Dp">
					{{HTML::image($usersImages['profile_picture'], 'alt', array('data-toggle' => 'modal', 'data-target' => '#change_profile_picture', 'class' => 'pic-Dp'))}}

					

				</div>
				<div>
					{{HTML::image($usersImages['cover_photo'], 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}

				</div>
						<div class="div-coverP">
							<div class="overlay-cover">
								<span class="infoCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{$countVideos}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
								</span>
								<span class="pull-right" >
									<span class="pull-right" >
										@if(empty($usersWebsite))
											No social media sites connected..
										@else
											@if(empty($usersWebsite->facebook))
											@else
											<a href="https://www.facebook.com/{{$usersWebsite->facebook}}" target="_blank"><i class="socialMedia socialMedia-facebook"></i></a>
											@endif

											@if(empty($usersWebsite->twitter))
											@else
											<a href="{{$usersWebsite->twitter}}" target="_blank"><i class="socialMedia socialMedia-twitter"></i></a>
											@endif

											@if(empty($usersWebsite->google))
											@else
											<a href="{{$usersWebsite->google}}" target="_blank"><i class="socialMedia socialMedia-googlePlus"></i></a>
											@endif

											@if(empty($usersWebsite->others))
											@else
											<a href="http://{{$usersWebsite->others}}" target="_blank"><i class="socialMedia socialMedia-site"></i></a>
											@endif
										@endif
										&nbsp;
		 								@if($user_id)
											{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								    			{{Form::hidden('user_id',$userChannel->id)}}
								    			{{Form::hidden('subscriber_id', $user_id)}}
								    			@if(!$ifAlreadySubscribe)
								    				{{Form::hidden('status','subscribeOn')}}
											    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											    @else
											    	{{Form::hidden('status','subscribeOff')}}
											    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											    @endif
								    		{{Form::close()}}
										@else
											{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary pull-right')); }}
									    @endif
									</span> 
								</span>	
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="user-info" >
				<div class="labelThis">
					{{$userChannel->channel_name}}
				</div>
				@if(empty($userChannel->interests))
					<br/><br/>
					<p class="text-justify notes center-block"></p>
				@else
					<p class="black center-block italic text-center fs-12">
						<i class="fa fa-quote-left"></i>
							{{ Str::limit($userChannel->interests, 200) }}
						<i class="fa fa-quote-right"></i>
					</p>
				@endif
			</div>
		</div>
