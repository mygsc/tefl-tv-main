<div class="col-md-6 col-md-height col-top" style="padding-right:20px;">
	<div class="row">
		<div class="top-div_t whiteC">
			<h3 class="text-center">SUBSCRIBERS</h3>
		</div>
		<div class="Div-channelSubSection White same-H " id="subscriberWrapper">
			<br/><br/>
			<div class="row-same-height">
				@if($subscriberProfile->isEmpty())
					<p class="text-center">No subscribers yet.</p>
				@else
					@foreach($subscriberProfile as $profile)
					<div class="col-md-6" >
						<div class="row user-padding" id="subscriberLists">
							<a href="{{route('view.users.channel', $profile->channel_name)}}">
								{{HTML::image($profile['profile_picture'], 'alt', array('class' => 'userRep2'))}}
								&nbsp;<span><b>{{$profile->channel_name}}</b></span>
							</a>
							<br/>
							&nbsp;<span>w/ <b>{{$profile->numberOfSubscribers}}</b>&nbsp;
							Subscribers</span>&nbsp;
							@if(isset(Auth::User()->id))
								<?php
								$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile->subscriber_id, 'subscriber_id' => Auth::User()->id))->first();
								?>

								@if(isset($profile->subscriber_id))
									@if(Auth::User()->id != $profile->subscriber_id)
										{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
										{{Form::hidden('user_id', $profile->subscriber_id)}}
										{{Form::hidden('subscriber_id', Auth::User()->id)}}
										
										@if(!$ifAlreadySubscribe)
											{{Form::hidden('status','subscribeOn')}}
											{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										@else
											{{Form::hidden('status','subscribeOff')}}
											{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										{{Form::close()}}
										@endif
									@endif
								@endif
							@endif
							</div>
						</div>
					@endforeach						
				@endif			
			</div>
		</div>
	</div>
</div><!--/.3rd column 6 Subscribers-->