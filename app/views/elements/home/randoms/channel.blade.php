<h1>Channels</h1>
	@foreach($randomResults as $randomResult)
		<div class="col-md-6">
    		<div class="well">
    			<div class="row">
    				<div class="col-md-4">

						@if(file_exists('public/img/user/'.$randomResult->id.'.jpg'))
						<img src ="{{asset('img/user/'.$randomResult->id.'.jpg')}}">
						@else
						<img src ="{{asset('img/user/0.jpg')}}">
						@endif
					</div>
					<div class="col-md-8">
						<a href="#"><h3>{{$randomResult->channel_name}}</h3></a>
						<p><b>Org:</b> TEFL Educators</p>
    					<p class="text-justify">
    						Lorem ipsum dolor sit amet, consectetur adipiscing elit,
    						sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
   						</p>
    					<a href="/channels/{{$randomResult->channel_name}}"><button class="btn btn-info btn-xs">Learn More</button></a>&nbsp;
    					<!--<button class="btn btn-primary btn-xs">Subscribe</button>-->
    				</div>	
				</div><!--/.row-->
				<hr/>
				<div class="Subscribers">
		    		<div class="row">
		                <h3 class="inline">32k+ Subscribers &nbsp;|&nbsp; 42k Views</h3>
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

