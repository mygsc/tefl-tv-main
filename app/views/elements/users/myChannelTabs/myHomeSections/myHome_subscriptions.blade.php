<!--Subscriptions-->

<div class="col-md-6 col-md-height col-top">
	<div class="row grey">
		<div class="h-title greyDark orangeC">
			<span><b>SUBSCRIPTIONS</b></span>&nbsp;
		</div>
		<div class="Div-channelSubSection" id="subscriberWrapper">
			<br/><br/>
			<div class="row-same-height">
				@if($subscriptionProfile->isEmpty())
					<p class="text-center">No Subscriptions yet</p>	
				@else
				@foreach($subscriptionProfile as $profile1)
				<div class="col-md-6" >
					<div class="user-padding" id="subscriberLists">

						<a href="{{route('view.users.channel', $profile1->channel_name)}}">
							{{HTML::image($profile1['profile_picture'], 'alt', array('class' => 'userRep2'))}}
							&nbsp;
							<span><b>{{$profile1->channel_name}}</b></span>
						</a>
						<br/>
						&nbsp;<span>w/ <b>{{$profile1->numberOfSubscribers}}</b>&nbsp;
						Subscribers</span>&nbsp;

						@if(isset($profile1->user_id))
							@if(isset(Auth::User()->id))
								<?php
									$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->user_id, 'subscriber_id' => Auth::User()->id))->first();
								?>
								{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								{{Form::hidden('user_id', $profile1->user_id)}}
								{{Form::hidden('subscriber_id', Auth::User()->id)}}
									@if(!$ifAlreadySubscribe)
										{{Form::hidden('status','subscribeOn')}}
										{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
									@else
										{{Form::hidden('status','subscribeOff')}}
										{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
									@endif
								{{Form::close()}}
							@endif
						@endif
					</div>
				</div>
				@endforeach						
				@endif			
			</div>
		</div>
	</div>
</div><!--/.3rd column 6 Subscription-->