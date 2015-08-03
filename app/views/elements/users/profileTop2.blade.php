<div class="White mg-b-20 same-H">
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
					<div class="overlay-wrap">
						<div class="container">
							<div class="col-md-6 col-sm-6">
								<div class="labelThis">
									{{$userChannel->channel_name}}
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								
							</div>
						</div>
						<div class="overlay-cover container">
							<div class="col-md-6">
								<div class="text-left chaCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{$countVideos}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
								</div>
							</div>
							<div class="col-md-6">
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
	
									@if(isset(Auth::User()->id))
										<?php
											$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $userChannel->id, 'subscriber_id' => Auth::User()->id))->first();
										?>
										@if(Auth::User()->id != $userChannel->id)
											{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
											{{Form::hidden('user_id', $userChannel->id)}}
											{{Form::hidden('subscriber_id', Auth::User()->id)}}
											@if(!$ifAlreadySubscribe)
												{{Form::hidden('status','subscribeOn')}}
												{{Form::submit('Subscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											@else
												{{Form::hidden('status','subscribeOff')}}
												{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											@endif
											{{Form::close()}}
										@endif
									@endif
								</span> 
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="user-info container">
		<br/>
		@if(empty($usersChannel->interests))
			<p class="black italic text-center fs-12 mg-t-20">
			</p>
			<br/>
		@else
			<br/><br/>
			<p class="black center-block italic text-center fs-12">
				<i class="fa fa-quote-left"></i>
				{{ Str::limit($usersChannel->interests,300) }}
				<i class="fa fa-quote-right"></i>
			</p>
			<br/>
		@endif
	</div>
</div>

@section('script')
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/subscribe.js')}}
@stop