<!--videos-->
<div class="whiteC text-center top-div_t mg-t-10">
	<div class="row">
		<h2>VIDEOS</h2>
	</div>
</div>
<div class="col-md-12 White same-H">
	<br/><br/>
	<div class="row">
		@if($findVideos->isEmpty())
			<p class="text-center">No videos yet..</p>
		@else
			@foreach($findVideos as $key => $findVideo)
				<div class="col-md-3 col-sm-6">
					<a href="{{route('homes.watch-video', array('v='. $findVideo->file_name))}}" target="_blank">	
						<div id="findVid">
							<div class="thumbnail-2"> 
								@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name.'.jpg')) )
									<img src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.jpg'}}" width="100%" class="hvr-grow-rotate" />
								
								@else
									{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('class' => 'hvr-grow-rotate', 'width' => '100%'))}}
								@endif
								<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
							</div>
						</div>
					</a>
						<div class="inlineInfo ">
							<div class="video-info-2">
								<div class="v-Info">
									<a href="{{route('homes.watch-video', array('v='.$findVideo->file_name))}}" target="_blank">
										<span class="visible-lg">{{ Str::limit($findVideo['title'],65)}}</span>
										<span class="visible-md">{{ Str::limit($findVideo['title'],45)}}</span>
										<span class="visible-xs visible-sm">{{ Str::limit($findVideo['title'],30)}}</span>
									</a>
								</div>
								<div class="count">
									{{$findVideo->views}} Views, {{$findVideo->likes}} Likes | {{date('F d, Y',strtotime($findVideo->created_at))}}
								</div>
							</div>
						</div>
					
					
				</div>
			@endforeach
		@endif
	</div>
</div>