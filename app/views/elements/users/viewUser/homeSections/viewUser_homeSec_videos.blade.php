<!--videos-->
<div class="whiteC text-center top-div_t mg-t-10">
	<div class="row">
		<h2>VIDEOS</h2>
	</div>
</div>
<div class="col-md-12 White same-H">
	<br/><br/>
	<div class="">
		@if($findVideos->isEmpty())
			<p class="text-center">No videos yet..</p>
		@else
			@foreach($findVideos as $key => $findVideo)
				<div class="col-md-3">
					<a href="{{route('homes.watch-video', array('v='. $findVideo->file_name))}}" target="_blank">	
						<div id="findVid">
							<div class="thumbnail-2"> 
								@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name.'.jpg')) )
									<img src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.jpg'}}" width="100%" class="hvr-grow-rotate" />
								
								@else
									{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('class' => 'hvr-grow-rotate', 'width' => '100%'))}}
								@endif
								<div class="play-hover mg-t--20"><img src="/img/icons/play-btn.png" /> </div>
							</div>
						</div>
						<div class="v-Info">
							<a href="{{route('homes.watch-video', array('v='.$findVideo->file_name))}}" target="_blank">{{$findVideo->title}}</a>
						</div>
					</a>
					<div class="count">
						{{$findVideo->views}} Views, {{$findVideo->likes}} Likes
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>