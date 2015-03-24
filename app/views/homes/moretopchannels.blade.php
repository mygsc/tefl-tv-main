@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container page">
	<h1> TOP 50 Channels</h1>
	@foreach($topChannels as $topChannel)
	<div class="col-md-6">
    		<div class="well">
    			<div class="row">
    				<div class="col-md-4">
    					{{HTML::image($topChannel->image_src, 'alt')}}<br />
					</div>
					<div class="col-md-8">
						<a href="#"><h3>{{$topChannel->channel_name}}</h3></a>
						<p><b>Org:</b> TEFL Educators</p>
    					<p class="text-justify">
    						Lorem ipsum dolor sit amet, consectetur adipiscing elit,
    						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
   						</p>
    					<a href="viewchannel"><button class="btn btn-info btn-xs">Learn More</button></a>&nbsp;
    					<button class="btn btn-primary btn-xs">Subscribe</button>
    				</div>	
				</div><!--/.row-->
				<hr/>
				<div class="Subscribers">
		    		<div class="row">
		                <h3 class="inline">{{count($topChannel->subscribers)}} Subscribers &nbsp;|&nbsp; {{$topChannel->total}} Views</h3>
		                <br/>
		                @foreach($topChannel->subscribers as $subscriber)
						@if(file_exists('public/img/user/'.$subscriber->subscriber_id.'.jpg'))
						<img src="/img/user/{{$subscriber->subscriber_id}}.jpg" class="userRep">
						@else
						<img src="/img/user/0.png" class="userRep">
						@endif
					@endforeach
		                <a href="/channels/{{$topChannel->channel_name}}"><img src="/img/user/more.png" class="userRep hvr-glow hand"></a>
		            </div>
		        </div><!--/.subscribers-->
			</div><!--/.well-->
		</div><!--/.col-md-6-->

	@endforeach

	<br>
	<br>
</div>
@stop