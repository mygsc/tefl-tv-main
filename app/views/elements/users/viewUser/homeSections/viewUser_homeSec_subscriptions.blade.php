<!--Subscriptions-->
<div class="col-md-6 col-md-height col-top" >
	<div class="row " style="padding-left:20px!important;">
		<div class="top-div_t whiteC">
			<h3 class="text-center">SUBSCRIPTIONS</h3>
		</div>
		<div class="Div-channelSubSection White same-H " id="subscriberWrapper" >
			<br/><br/>
			<div class="row-same-height">
			@if(empty($subscriptions))
				<p class="text-center fs-12">No subscription yet</p>
			@else
				@foreach($subscriptions as $subscription)
					<div class="col-md-6">
						<div class="row user-padding">
							<a href="{{route('view.users.channel', $subscription->channel_name)}}">

								{{HTML::image($subscription['profile_picture'], array('class' => 'userRep2'))}}
								&nbsp;
								<span><b>{{$subscription->channel_name}}</b></span>
							</a>&nbsp;
							<br/>&nbsp;
							<span>w/ <b>{{$subscription->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
							<!-- <button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button> -->
							@if(isset(Auth::User()->id))

								@if(isset($subscription->id))

									@if((Auth::User()->id) AND (Auth::User()->id != $subscription->id))

									<?php
									$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscription->id, 'subscriber_id' => Auth::User()->id))->first();
									?>
									{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
									{{Form::hidden('user_id', $subscription->id)}}
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
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div><!--subscription /.row-->
	</div><!--/.well2 Div-channelSubSection-->
</div><!--/.4th column 6 Subscription-->
</div>