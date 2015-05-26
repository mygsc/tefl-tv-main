videos-->
	<div class="col-md-12 grey">
		<br/>
		<div class="orangeC text-center">
			<h2>VIDEOS 
				<small class="">({{link_to_route('users.myvideos', 'Show All')}})</small>
			</h2>
		</div>
		<br/>
		<div class="">
			@if(empty($usersVideos))
				<p class="text-center">No Videos Uploaded yet..</p>
			@else
				@foreach($usersVideos as $usersVideo)
				<div class="col-lg-3 col-md-3 col-sm-6">
					<div class="thumbnail-2">
						<a href="{{route('homes.watch-video', array($usersVideo->file_name))}}" target="_blank">
							
							@if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name.'.jpg')) )

								{{-- <video id='media-video' poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}"  width="100%" class="hvr-grow-rotate" >
									<source id="mp4" src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.mp4'}}" type="video/mp4" />
									<source id="webm" src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.webm'}}" type="video/webm" />
									<source id="ogg" src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.ogg'}}" type="video/ogg" />
								</video> --}}

								<img src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}"  width="100%" class="hvr-grow-rotate" />
								
							@else
								{{HTML::image('img/thumbnails/video-sm.jpg','alt', array('class' => 'hvr-grow-rotate', 'width' => '100%'))}}
							@endif
							<div class="play-hover mg-t--20"><img src="/img/icons/play-btn.png" /> </div>
						</a>
					</div>
						
							<a href="{{route('homes.watch-video',$usersVideo->file_name)}}" target="_blank">
								<div class="v-Info">
									{{$usersVideo->title}}
								</div>
							</a>
							<div class="count">
								<i class="fa fa-eye"></i> {{$usersVideo->views}} | <i class="fa fa-thumbs-up"></i>  {{$usersVideo->likes}} | {{date('F d, Y',strtotime($usersVideo->created_at))}}
							</div>

					
				
					<BR/>
				</div>
				@endforeach
				@endif
			</div>
		</div><!--well-->
	</div><!--1st 6 column Videos