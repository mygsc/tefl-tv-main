
<div class="row">
	<div class="top-div_t whiteC">
		<h3 class="text-center">SUBSCRIBERS</h3>
	</div>
	<div class="Div-channelSubSection" id="subscriberWrapper">
		<br/><br/>
		<div class="content-padding">
			@if($subscriberProfile->isEmpty())
			<p class="text-center">No subscribers yet.</p>
			@else
			@foreach($subscriberProfile as $profile)
			<div class="col-md-12" >
				<div class="row user-padding subs-wrap">
					<a href="{{route('view.users.channel', $profile->channel_name)}}">
						{{HTML::image($profile['profile_picture'], 'alt', array('class' => 'userRep2'))}}
						<span><b>{{$profile->channel_name}}</b></span>
					</a>&nbsp;
					<br/>&nbsp;
					<span>w/ <b>{{$profile->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
					<!-- <button class="btn btn-primary btn-xs pull-right">Subscribe</button> -->
					@if(isset(Auth::User()->id))
					<?php
						$ifAlreadySubscribe = Subscribe::where('user_id', $profile->subscriber_id)->where('subscriber_id', Auth::User()->id)->first();
						?>

						@if(isset($profile->id))
							@if(Auth::User()->id != $profile->subscriber_id)
								{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								{{Form::hidden('user_id', $profile->subscriber_id)}}
								{{Form::hidden('subscriber_id', Auth::User()->id)}}
								@if(!$ifAlreadySubscribe)
									{{Form::hidden('status','subscribeOn')}}
									{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right  subs-btn-size', 'id'=>'subscribebutton'))}}
								@else
									{{Form::hidden('status','subscribeOff')}}
									{{Form::submit('Unsubscribe', array('class'=> 'btn btn-info btn-xs pull-right', 'id'=>'subscribebutton'))}}
								@endif
								{{Form::close()}}
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
