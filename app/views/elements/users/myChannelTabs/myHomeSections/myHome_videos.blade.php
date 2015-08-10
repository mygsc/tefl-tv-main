<!--videos-->

	<div class="whiteC text-center top-div_t mg-t-10">
		<div class="row">
			<h2>VIDEOS</h2>
		</div>
	</div>
	<div class="col-md-12 White same-H">
		<br/><br/>
		<div class="row">
			@if($usersVideos->isEmpty())
				<p class="text-center">No Videos Uploaded yet..</p>
			@else
				@foreach($usersVideos as $usersVideo)
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="thumbnail-2">
							<a href="{{route('homes.watch-video', array('v='.$usersVideo->file_name))}}" target="_blank">
								@if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name.'.jpg')) )
									<img src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg' . '?' . rand(0,99)}}"  width="100%" class="hvr-grow-rotate" />
								@else
									{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('class' => 'hvr-grow-rotate', 'width' => '100%'))}}
								@endif
								<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
							</a>
						</div>
						<div class="inlineInfo ">	
								
									<div class="video-info-2">
										<a href="{{route('homes.watch-video','v='.$usersVideo->file_name)}}" target="_blank">
										<div class="v-Info">
											<span class="visible-lg">{{ Str::limit($usersVideo['title'],65)}}</span>
											<span class="visible-md">{{ Str::limit($usersVideo['title'],45)}}</span>
											<span class="visible-xs visible-sm">{{ Str::limit($usersVideo['title'],30)}}</span>
										</div>
										</a>
								
								<div class="count">
									</i> {{$usersVideo->views}} Views | {{$usersVideo->likes}} Likes | {{date('F d, Y',strtotime($usersVideo->created_at))}}
								</div>
							</div>
						</div>
						<br/>
					</div>
				@endforeach
			@endif
		</div>
	</div><!--well-->
</div><!--1st 6 column Videos-->
<br/>