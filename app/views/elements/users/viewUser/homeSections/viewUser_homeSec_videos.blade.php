<!--videos-->
<div class="col-md-12 grey">
	<br/>
	<div class="row">
		<br/>
		<div class="orangeC text-center">
			<h2 class="inline"><b>VIDEOS</b></h2>
		</div>
		<br/>
	</div>
	<br/>

	@if(empty($findVideos))
		No videos yet..
	@else
		@foreach($findVideos as $key => $findVideo)
			<div class="col-md-3">
				<a href="{{route('homes.watch-video', array($findVideo->file_name))}}" target="_blank">	
					<div id="findVid">
						@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name.'.jpg')) )
							<video poster="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.jpg'}}" width="100%" />
								<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.mp4'}}" type="video/mp4" />
								<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.webm'}}" type="video/webm" />
									<source src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.ogg'}}" type="video/ogg" />
							</video>
						@else
							{{HTML::image('img/thumbnails/video.png')}}
						@endif
					</div>
					<div class="v-Info">
						{{$findVideo->title}}
					</div>
				</a>
				<div class="count">
					{{$findVideo->views}} Views, {{$findVideo->likes}} Likes
				</div>
			</div>
		@endforeach
	@endif
</div>