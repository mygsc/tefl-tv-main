	<br/>
	<div class="row">
	@foreach($datas as $channel)

	<div class="col-md-6">
		<div class="well">
			<div class="row">
				<div class="col-md-4">
				@if(file_exists(public_path('img/user/') . $channel->id . '.jpg'))

					{{HTML::image('img/user/'. $channel->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
					@else
					{{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
					@endif

					

				</div>
				<div class="col-md-8">
					<a href="channels/{{$channel->channel_name}}"><h3>{{$channel->channel_name}}</h3></a>
					<p><b>Org:</b> TEFL Educators</p>
					<p class="text-justify">
						Interest: {{$channel->interests}}
					</p>
				
					@if($auth)
					{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
					{{Form::hidden('user_id',$channel->id)}}
					{{Form::hidden('subscriber_id', $auth->id)}}
					@if(empty($datas->ifsubscribe))
					{{Form::hidden('status','subscribeOn')}}
					{{Form::submit('Subscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
					@else
					{{Form::hidden('status','subscribeOff')}}
					{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
					@endif
					{{Form::close()}}
					@else
					{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary plull-right')); }}
					@endif
				</div>	
			</div><!--/.row-->
			<hr/>
			<div class="Subscribers">
				<div class="row">
					<h3 class="inline">{{count($channel->subscribers)}} Subscribers &nbsp;|&nbsp; {{$channel->total}} Views</h3>
					<br/>
					@foreach($channel->subscribers as $subscriber)
						@if(file_exists('public/img/user/'.$subscriber->subscriber_id.'.jpg'))
						<img src="/img/user/{{$subscriber->subscriber_id}}.jpg" class="userRep">
						@else
						<img src="/img/user/0.png" class="userRep">
						@endif
					@endforeach
					<a href="/channels/{{$channel->channel_name}}"><img src="/img/user/more.png" class="userRep hvr-glow hand"></a>
				</div>
			</div><!--/.subscribers-->
		</div><!--/.well-->
	</div><!--/.col-md-6-->
	@endforeach
	</div>

	<br>
	<br>
	<div class="text-center row" style="">
		<a href="{{route('homes.more-top-channels')}}"><b>Click here to view all top channels</b></a>

	</div>
	<br/>