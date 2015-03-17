@extends('layouts.default')


@section('content')
<div class="container page">
	<br/>
	@foreach($topChannels as $topChannel)

	<div class="col-md-6">
		<div class="well">
			<div class="row">
				<div class="col-md-4">
					{{HTML::image($topChannel->image_src, 'alt')}}<br />
				</div>
				<div class="col-md-8">
					<a href="channels/{{$topChannel->channel_name}}"><h3>{{$topChannel->channel_name}}</h3></a>
					<p><b>Org:</b> TEFL Educators</p>
					<p class="text-justify">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit,
						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</p>
				
					@if($auth)
					{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
					{{Form::hidden('user_id',$topChannel->id)}}
					{{Form::hidden('subscriber_id', $auth->id)}}
					@if(empty($topChannel->ifsubscribe))
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
					<h3 class="inline">{{count($topChannel->subscribers)}} Subscribers &nbsp;|&nbsp; {{$topChannel->total}} Views</h3>
					<br/>
					<img src="/img/user/u1.png" class="userRep">
					<img src="/img/user/u4.png" class="userRep">
					<img src="/img/user/u3.png" class="userRep">
					<img src="/img/user/u7.png" class="userRep">
					<img src="/img/user/u5.png" class="userRep">
					<img src="/img/user/u6.png" class="userRep">
					<img src="/img/user/u7.png" class="userRep">
					<img src="/img/user/u2.png" class="userRep">
					<img src="/img/user/u3.png" class="userRep">
					<img src="/img/user/u6.png" class="userRep">
					<a href="" data-toggle="modal" data-target="#followersModal"><img src="/img/user/more.png" class="userRep hvr-glow hand"></a>
				</div>
			</div><!--/.subscribers-->
		</div><!--/.well-->
	</div><!--/.col-md-6-->



	@endforeach

	<br>
	<br>
	<div class="text-center">
		<a href="{{route('homes.more-top-channels')}}">Click here to view all top channels</a>
	</div>
</div>
@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
@stop