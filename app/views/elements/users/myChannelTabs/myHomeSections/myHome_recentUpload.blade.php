<div class="White same-H mg-t-10">

	<div class="row mg-20">
		<br/>
		@if(empty($recentUpload))
		<div class="row">
			<div class="text-center alert alert-info noA">
				<h3>
					{{ link_to_route('get.upload', 'Upload a Video', null) }} now to make your channel more appealing to subscribers.
				</h3>
			</div>
		</div>
		@else

		<div class="col-md-6">

			 <!-- <img src="/img/thumbnails/v1.jpg" class="img-responsive" width="100%"> -->
			 <div id="vid-wrapper">
				 <div id="vid-controls" class="p-relative mg-b-20">
					 <div class="embed-responsive embed-responsive-16by9">
					 <a href="{{route('homes.watch-video', array('v='.$recentUpload->file_name))}}" target="_blank">
					 	@if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name.'.jpg')))
						 	<video id="media-video" poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '_600x338.jpg'}}"  width="100%" >
						 		<source id= 'mp4' src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.mp4'}}" type="video/mp4" />
						 		<source id= 'webm' src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.webm'}}" type="video/webm" />
							</video>
					 	@else
					 		{{HTML::image('img/thumbnails/video.png','alt' ,array('style' => 'width:100%;'))}}
					 		<video id="media-video" poster="/img/thumbnails/video.png"  width="100%" >
						 		<source id= 'mp4' src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.mp4'}}" type="video/mp4" />
						 		<source id= 'webm' src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.webm'}}" type="video/webm" />
							</video>
					 	@endif	
						</a>

					</div>
				</div>
				
			</div>
		</div>
		@endif
		<div class="col-md-6">
			@if(empty($recentUpload))
				<p style="margin-left:30px;">No recent Activity</p>
			@else
			<a href="{{route('homes.watch-video', array('v='.$recentUpload->file_name))}}" target="_blank"><h3><b>Title: {{$recentUpload->title}}</b></h3></a>
			<p>Uploaded: {{date('M d Y',strtotime($recentUpload->created_at))}}</p>
			<br/>
			
			<p class="text-justify">
				Description: {{ Str::limit($recentUpload->description, 400) }}
			</p>
			<br/>
			<span class=""><!--/counts and share link-->
				{{$recentUpload->views}} Views &nbsp;&nbsp;|&nbsp;&nbsp;

				{{$recentUpload->likes}} Likes&nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;|&nbsp;&nbsp;

				<span class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>
					</a>
					<span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">
						<a href=""><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
						<a href=""><i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
						<a href=""><i class="socialMedia socialMedia-instagram" title="Share on Instagram"></i></a>
	                </span><!--/.dropdown-menu pull-right White-->
	            </span><!--/.dropdown share-->
			</span><!--/counts and share link-->
			@endif
		</div><!--/.col-md-6-->
	</div>
</div>