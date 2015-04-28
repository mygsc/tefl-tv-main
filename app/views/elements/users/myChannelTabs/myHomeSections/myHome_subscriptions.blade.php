<!--Subscriptions-->
<div class="col-md-6 col-md-height col-top">
	<div class="row grey">
		<div class="h-title greyDark orangeC">
			<span><b>SUBSCRIPTIONS</b></span>&nbsp;
		</div>
		<div class="Div-channelSubSection" id="subscriberWrapper">
			<br/><br/>
			<div class="row-same-height">
				@if(empty($subscriptionProfile))
				<p class="text-center">No Subscriptions yet</p>
				@else
				@foreach($subscriptionProfile as $profile1)
				<div class="col-md-6" >
					<div class="user-padding" id="subscriberLists">

						<a href="{{route('view.users.channel', $profile1->channel_name)}}">
							@if(file_exists(public_path('img/user/'.$profile1->user_id.'.jpg')))
								{{HTML::image('img/user/'.$profile1->user_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
							@else
								{{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
							@endif
							&nbsp;
							<span><b>{{$profile1->channel_name}}</b></span>
						</a>
						<br/>
						&nbsp;<span>w/ <b>{{$profile1->numberOfSubscribers}}</b>&nbsp;
						Subscribers</span>&nbsp;

						@if(isset($profile1->id))
							
							@if(isset(Auth::User()->id))
								<?php
								$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->id, 'subscriber_id' => Auth::User()->id))->first();
								?>
								{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								{{Form::hidden('user_id', $profile1->id)}}
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