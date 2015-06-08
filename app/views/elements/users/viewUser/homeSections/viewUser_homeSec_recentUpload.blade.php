<div class="row">
	<br/>
	<div class="content-padding">
		@if(empty($recentUpload))
		<div class="row">
			<div class="text-center alert alert-info noA">
				<h3>No Video</h3>
			</div>
		</div>
		@else
		@if(isset($recentUpload->id))
		<div class="col-md-6">
			<div id="vid-wrapper">
				<div id="vid-controls" class="p-relative">
					<div class="embed-responsive embed-responsive-16by9 h-video">
						<a href="{{route('homes.watch-video', array($recentUpload->file_name))}}" target="_blank">
							@if(file_exists(public_path('/videos/'.$recentUpload->id.'-'.$recentUpload->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name.'.jpg')) )
							<video poster="/videos/{{$recentUpload->id.'-'.$recentUpload->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.jpg'}}"  width="100%" >
								<source src="/videos/{{$recentUpload->id.'-'.$recentUpload->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.mp4'}}" type="video/mp4" />
								<source src="/videos/{{$recentUpload->id.'-'.$recentUpload->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.webm'}}" type="video/webm" />
								<source src="/videos/{{$recentUpload->id.'-'.$recentUpload->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.ogg'}}" type="video/ogg" />
							</video>
							@else
									{{HTML::image('img/thumbnails/video.png','alt' ,array('style' => 'width:100%;'))}}
							@endif
						</a>
							@endif			
						</div>
							@include('elements/videoPlayer')
				</div>		
			</div>					
		</div>

					<div class="col-md-6">
						
						<h3><b>Title: {{$recentUpload->title}}</b></h3>
						<p>Uploaded: {{date('M d Y',strtotime($recentUpload->created_at))}}</p>
						<br/>
						
						<p class="text-justify">
							Description: {{ Str::limit($recentUpload->description, 300) }}
						</p>
						<br/>
						<span class=""><!--/counts and share link-->
							{{$recentUpload->views}} Views &nbsp;&nbsp;|&nbsp;&nbsp;
							{{$recentUpload->likes}} Likes&nbsp;&nbsp;|&nbsp;&nbsp;
							<span class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<p class="inline"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>
								</a>
								<span class="dropdown-menu drop pull-right White snBg span-share">
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
			<br/>