	<br/>
	<div class="row ">
	@foreach($datas as $channel)

	<div class="col-md-12" >
		<div class="grey mg-b-10">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-xs-4">
						{{HTML::image($channel['profile_picture'], 'alt', array('class' => 'user-Dp'))}}
				</div>
				<div class="col-lg-10 col-md-9 col-xs-8">
					<div class="row">
						<div class="col-md-8">
							<a href="channels/{{$channel->channel_name}}"><h2>{{$channel->channel_name}}</h2></a>
						</div>
						<div class="col-md-4 text-right">
							<div class="mg-r-10 mg-t-20">
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
						</div>
					</div>
					<div class="mg-r-10">
						<p class="text-justify">{{ Str::limit($channel->interests, 150) }}</p>
					</div>
						
				</div>	
			</div><!--/.row-->
			<div class="Subscribers greyDark">
				<div class="row">
					<h4 class="inline orangeC">{{count($channel->subscribers)}} Subscribers &nbsp;|&nbsp; {{number_format($channel->views)}} Views</h4>
					<br/>
					@foreach($channel->subscribers as $subscriber)
						{{HTML::image($subscriber->profile_picture, 'alt', array('class' => 'userRep'))}}
					@endforeach
					
				</div>
			</div><!--/.subscribers-->
		</div><!--/.well-->
	</div><!--/.col-md-6-->
	@endforeach
	</div>