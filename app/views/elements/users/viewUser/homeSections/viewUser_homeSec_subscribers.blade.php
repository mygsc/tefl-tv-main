<!--Subscribers-->
<div class="col-md-6 col-md-height grey">
	<div class="row">
		<div class="h-title greyDark orangeC">
			<span><b>Subscribers</b></span>&nbsp;|&nbsp; <small class="ch-link"><a href="#Subscribers" class="text-center" aria-controls="Subscribers" role="tab" data-toggle="tab">Show All</a></small>
		</div>
		<br/>
		<div class="">
			@if(empty($subscribers))
				<p class="text-center fs-12">No Subscriber yet</p>
			@else
				@foreach($subscribers as $subscriber)
					<div class="col-md-6">
						<div class="row user-padding">
							<a href="{{route('view.users.channel', $subscriber->channel_name)}}">
								@if(file_exists(public_path('img/user/'.$subscriber->subscriber_id.'.jpg')))
								{{HTML::image('img/user/'.$subscriber->subscriber_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
								@else
								{{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
								@endif
								&nbsp;
								<span><b>{{$subscriber->channel_name}}</b></span>
							</a>&nbsp;
							<br/>&nbsp;
							<span>w/ <b>{{$subscriber->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
							<!-- <button class="btn btn-primary btn-xs pull-right">Subscribe</button> -->
							@if(isset(Auth::User()->id))

								@if(isset($subscriber->id))

									@if((Auth::User()->id) AND (Auth::User()->id != $subscriber->id))

										<?php
										$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscriber->id, 'subscriber_id' => Auth::User()->id))->first();
										?>
										{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
										{{Form::hidden('user_id', $subscriber->id)}}
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
		</div>
	</div>
</div>