<!--videos-->
	<div class="whiteC text-center top-div_t mg-t-10">
		<div class="row">
			<h2>VIDEOS</h2>
		</div>
	</div>
	<div class="col-md-12 White same-H">
		<br/><br/>
		<div class="">
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
								<div class="play-hover mg-t--20"><img src="/img/icons/play-btn.png" /> </div>
							</a>
						</div>
							
						<a href="{{route('homes.watch-video','v='.$usersVideo->file_name)}}" target="_blank">
							<div class="v-Info">
								{{$usersVideo->title}}
							</div>
						</a>
						<div class="count">
							<i class="fa fa-eye"></i> {{$usersVideo->views}} | <i class="fa fa-thumbs-up"></i>  {{$usersVideo->likes}} | {{date('F d, Y',strtotime($usersVideo->created_at))}}
						</div>
						<br/>
					</div>
				@endforeach
			@endif
		</div>
	</div><!--well-->
</div><!--1st 6 column Videos-->
<br/>