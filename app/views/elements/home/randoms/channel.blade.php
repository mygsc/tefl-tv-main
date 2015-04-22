	<br/>
	<div class="row">
	@foreach($datas as $channel)

	<div class="col-md-12" >
		<div class="grey mg-b-10">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-xs-4">
					@if(file_exists(public_path('img/user/') . $channel->id . '.jpg'))
						{{HTML::image('img/user/'. $channel->id . '.jpg', 'alt', array('class' => 'user-Dp'))}}
					@else
						{{HTML::image('/img/user/0.jpg', 'alt', array('class' => 'user-Dp'))}}
					@endif

				</div>
				<div class="col-lg-10 col-md-9 col-xs-8">
					<a href="channels/{{$channel->channel_name}}"><h2>{{$channel->channel_name}}</h2></a>
						<p class="text-justify">{{ Str::limit($channel->interests, 100) }}</p>
					
						@if(Auth::check())
							@if(Auth::user()->id != $channel->id)
							{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
							{{Form::hidden('user_id',$channel->id)}}
							{{Form::hidden('subscriber_id', Auth::user()->id)}}
								@if($channel->ifsubscribe == 'No')
								{{Form::hidden('status','subscribeOn')}}
								{{Form::submit('Subscribe', array('class'=> 'btn btn-primary', 'id'=>'subscribebutton'))}}
								@else
								{{Form::hidden('status','subscribeOff')}}
								{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary', 'id'=>'subscribebutton'))}}
								@endif
							{{Form::close()}}
							@endif
						@else
							{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary plull-right')); }}
						@endif
				</div>	
			</div><!--/.row-->
			<div class="Subscribers greyDark">
				<div class="row">
					<h4 class="inline orangeC">{{count($channel->subscribers)}} Subscribers &nbsp;|&nbsp; {{$channel->total}} Views</h4>
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