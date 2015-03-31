
<div class="row">
	<br/>
	<div class="col-md-6">
		<img src="/img/thumbnails/vp.png">
	</div>
	<div class="col-md-6">
		@if(empty($recentUpload))
			<p style="margin-left:30px;">No recent Activity</p>
		@else
		<h3><b>Title: {{$recentUpload->title}}</b></h3>
		<p>Uploaded: {{date('M d Y',strtotime($recentUpload->created_at))}}</p>
		<br/>
		<a href="{{route('homes.watch-video', array($recentUpload->file_name))}}" target="_blank">
									@if(file_exists(public_path('/videos/'.$recentUpload->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name.'.jpg')) )
									<video poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.jpg'}}"  width="100%" >
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.mp4'}}" type="video/mp4" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.webm'}}" type="video/webm" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.ogg'}}" type="video/ogg" />


									</video>
									@else
										{{HTML::image('img/thumbnails/video.png')}}
									@endif								
							</a>
		<p class="text-justify">
			Description: {{$recentUpload->description}}
		</p>
		<br/>
		<span class=""><!--/counts and share link-->
			1,800,753 Views &nbsp;&nbsp;|&nbsp;&nbsp;
			1,800,753 Likes&nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;|&nbsp;&nbsp;

			<span class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					<h4 style="display:inline;">Share&nbsp;&nbsp;<i class="fa fa-share-alt hand"></i></h4>
				</a>
				<span class="dropdown-menu pull-right White" style="padding:5px 5px;text-align:center;">
					<!--facebook-->
					<span style="background:#3d5a98;" class="snBg">
						<img src="/img/icons/fb_i.png" class="hand" title="Share on Facebook">&nbsp;Share
					</span>
					<span class="snCount" style="border:1px solid #3d5a98;">
						100,000
					</span><!--/facebook-->
					<br/><br/>
					<!--google-->
					<span style="background:#dd6b6b;" class="snBg">
						<img src="/img/icons/gp_i.png" class="hand" title="Share on Google +">&nbsp;Share
					</span>
					<span style="border:1px solid #dd6b6b;" class="snCount">
						100,000
					</span><!--/google-->
				</span>
			</span><!--/.dropdown-->
		</span><!--/counts and share link-->
		@endif
	</div><!--/.col-md-6-->
</div>
<br/>

<div class="row">
	<!--videos-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			
			<div class="subLabelThis">
				<span>Videos</span>&nbsp;|&nbsp; <small class="ch-link" style="font-size:1.0em!Important;"><a href="#Videos" class="text-center" aria-controls="Videos" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>

			
			@foreach($findVideos as $findVideo)
			<div class="col-md-4">
				<div class="row">
					<div class="">
						<video controls height="auto" width="100%" class="h-video">
							<source src="/videos/{{$findVideo->file_name}}.{{$findVideo->extension}}" type="video/mp4"/>
						</video>
					</div>
					<div class="v-Info">
						{{$findVideo->title}}
					</div>
					<div class="count">
						{{$findVideo->views}} Views, {{$findVideo->likes}} Likes
					</div>
				</div>
			</div>
			@endforeach

		</div><!--well-->
	</div><!--1st 6 column Videos-->

	<!--Playlists-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Playlists</span>&nbsp;|&nbsp; <small class="ch-link" style="font-size:1.0em!Important;"><a href="#Playlists" class="text-center" aria-controls="Playlists" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>

			<div class="col-md-4">
			@if(empty($usersPlaylists))
				@foreach($usersPlaylists as $playlists)
				<div class="" style="position:relative;">
					<div class="playlist-info" >
						11
						<br/>
						Videos
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
					<img src="/img/thumbnails/v3.png" class="h-video">
				</div>

				<div class="v-Info">
					<span class="fa fa-globe"></span> | {{$playlists->name}}
				</div>

				<div class="count">
					{{$playlists->updated_at}}
				</div>
				@endforeach
				@else
					<p style="margin-left:20px;">No Playlists yet</p>
				@endif
			</div>
		</div>
	</div><!--/.2nd 6 column Playlists-->
	<br/>
	<!--Subscribers-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Subscribers</span>&nbsp;|&nbsp; <small class="ch-link" style="font-size:1.0em!Important;"><a href="#Subscribers" class="text-center" aria-controls="Subscribers" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>
			<div class="row">
			@if(empty($subscribers))
				<p style="margin-left:50px;">No Subscriber yet</p>
			@else
				@foreach($subscribers as $subscriber)
				<div class="col-md-6">
					<div class="row user-padding">
						<a href="{{route('view.users.channel', $subscriber->channel_name)}}">
						<img src="/img/user/u1.png" class="userRep2">&nbsp;
						<span><b>{{$subscriber->channel_name}}</b></span>
						</a>&nbsp;
						<br/>&nbsp;
						<span>w/ <b>{{$subscriber->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
						<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
					</div>
				</div>
				@endforeach					
				@endif				
			</div>
		</div>
	</div><!--/.3rd column 6 Subscribers-->

	<!--Subscriptions-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Subscriptions</span>&nbsp;|&nbsp; <small class="ch-link" style="font-size:1.0em!Important;"><a href="#Subscriptions" class="text-center" aria-controls="Subscriptions" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>
			<div class="row">
				@if(empty($subscriptions))
					<p style="margin-left:50px;">No subscription yet</p>
				@else
					@foreach($subscriptions as $subscription)
						<div class="col-md-6">
							<div class="row user-padding">
								<a href="{{route('view.users.channel', $subscription->channel_name)}}">
								<img src="/img/user/u1.png" class="userRep2">&nbsp;
								<span><b>{{$subscription->channel_name}}</b></span>
								</a>&nbsp;
								<br/>&nbsp;
								<span>w/ <b>{{$subscription->numberOfSubscribers}}</b> Subscribers</span>&nbsp;
								<button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button>
							</div>
							
						</div>
					@endforeach
				@endif
			</div><!--subscription /.row-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>