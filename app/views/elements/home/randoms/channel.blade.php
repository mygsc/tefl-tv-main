	<br/>
	<div class="row">
	@foreach($datas as $channel)

	<div class="col-md-6" >
		<div class="well ch h-hide">
			<div class="row">
				<div class="col-md-4 col-xs-4">
					@if(file_exists(public_path('img/user/') . $channel->id . '.jpg'))

					{{HTML::image('img/user/'. $channel->id . '.jpg', 'alt', array('class' => 'user-Dp'))}}
					@else
					{{HTML::image('/img/user/0.jpg', 'alt', array('class' => 'user-Dp)))}}
					@endif

				</div>
				<div class="col-md-8 col-xs-8">
					<a href="channels/{{$channel->channel_name}}"><h3>{{$channel->channel_name}}</h3></a>
					<p><b>Org:</b>TEFL Educators</p>
						<p class="text-justify">
						{{ Str::limit($channel->interests, 120) }}
			
						</p>
					
						@if($auth)
							@if($auth->id != $channel->id)
							{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
							{{Form::hidden('user_id',$channel->id)}}
							{{Form::hidden('subscriber_id', $auth->id)}}
								@if(isset($datas->ifsubscribe))
								{{Form::hidden('status','subscribeOn')}}
								{{Form::submit('Subscribe', array('class'=> 'btn btn-primary', 'id'=>'subscribebutton'))}}
								@else
								{{Form::hidden('status','subscribeOff')}}
								{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
								@endif
							{{Form::close()}}
							@else
							{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary plull-right')); }}
						@endif
					@endif
				</div>	
			</div><!--/.row-->
			<hr/>
			<div class="Subscribers">
				<div class="row">
					<h3 class="inline">{{count($channel->subscribers)}} Subscribers &nbsp;|&nbsp; {{$channel->total}} Views</h3>
					<br/>
					@foreach($channel->subscribers as $subscriber)
						@if(file_exists(public_path('img/user/'.$subscriber->subscriber_id.'.jpg')))
						<img src="/img/user/{{$subscriber->subscriber_id}}.jpg" class="userRep">
						@else
						<img src="/img/user/0.jpg" class="userRep">
						@endif
					@endforeach
					<a href="/channels/{{$channel->channel_name}}"><img src="/img/user/more.png" class="userRep hvr-glow hand"></a>
				</div>
			</div><!--/.subscribers-->
		</div><!--/.well-->
	</div><!--/.col-md-6-->
	@endforeach
	</div>
	<br/>