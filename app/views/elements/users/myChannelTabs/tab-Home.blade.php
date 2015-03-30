
<div class="row">
	<br/>
	<div class="col-md-7">
		@if(empty($recentUpload))
			<p style="margin-left:30px;">No recent Activity</p>
		@else
			
		<div class="embed-responsive embed-responsive-16by9">
			<video preload="auto" id="media-video" poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.jpg'}}"  width="100%">
				<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.mp4'}}" type="video/mp4" />
				<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.webm'}}" type="video/webm" />
				<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload->file_name.'/'.$recentUpload->file_name. '.ogg'}}" type="video/ogg" />
			</video>
		</div><!--/embed-responsive-->
		@include('elements/videoPlayer')

	
	</div>
	<div class="col-md-5">
		<h3><b>Title: {{$recentUpload->title}}</b></h3>
		<p>Uploaded: {{date('M d Y',strtotime($recentUpload->created_at))}}</p>
		<br/>
		<p class="text-justify">
			Description: {{$recentUpload->description}}
		</p>
		<br/>
		<span class=""><!--/counts and share link-->
			{{$recentUpload->views}} Views &nbsp;&nbsp;|&nbsp;&nbsp;
			{{$recentUpload->likes}} &nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;
			
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
				<span>Videos</span>&nbsp;|&nbsp;
				<small class="ch-link" style="font-size:1.0em!Important;">{{link_to_route('users.myvideos', 'Show All')}}</small>
			</div>
			<br/><br/>

			<div class="row">
			@if($usersVideos->isEmpty())
				<p style="margin-left:30px;">No Videos Uploaded yet..</p>
			@else
				@foreach($usersVideos as $usersVideo)
				<div class="col-md-4 col-sm-6">
					<a href="{{route('homes.watch-video', array($usersVideo->file_name))}}" target="_blank">
						@if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name.'.jpg')) )
									<video poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}"  width="100%" >
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.mp4'}}" type="video/mp4" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.webm'}}" type="video/webm" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.ogg'}}" type="video/ogg" />
									</video>
									@else
										{{HTML::image('img/thumbnails/video.png')}}
									@endif
					</a>
					
					<a href="{{route('homes.watch-video',$usersVideo->file_name)}}" target="_blank">
						<div class="v-Info">
							{{$usersVideo->title}}
						</div>
					</a>
					<div class="count">
						{{$usersVideo->views}} Views, {{$usersVideo->likes}} Likes
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div><!--well-->
	</div><!--1st 6 column Videos-->

	<!--Playlists-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Playlists</span>&nbsp;|&nbsp; 
				<small class="ch-link" style="font-size:1.0em!Important;">{{link_to_route('users.playlists', 'Show All')}}</small>
			</div>
			<br/>
			<br/>
			<div class="row">
			<div class="col-md-4 col-sm-2">
			@if($usersPlaylists->isEmpty())
				<p style="margin-left:30px;">No Playlists yet</p>
			@else
				@foreach($usersPlaylists as $playlists)
				<div class="" style="position:relative;">
					<div class="playlist-info" >
						11
						<br/>
						Videos
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
					<img src="/img/thumbnails/v1.jpg" class="h-video">
				</div>

				<div class="v-Info">
					<span class="fa fa-globe"></span> | {{$playlists->name}}
				</div>

				<div class="count">
					{{$playlists->updated_at}}
				</div>
				@endforeach
				@endif
			</div>
			</div>
		</div>

	</div><!--/.2nd 6 column Playlists-->
	<br/>
	<!--Subscribers-->
	
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection" id="subscriberWrapper">
			<div class="subLabelThis">
				<span>Subscribers</span>&nbsp;

			</div>
			<br/><br/>
			<div class="row">
			@if(empty($subscriberProfile))
				<p style="margin-left:30px;">No subscribers yet.</p>
			@else
					@foreach($subscriberProfile as $key => $profile)
					<div class="col-md-6" >
						<div class="row user-padding" id="subscriberLists">

							<a href="{{route('view.users.channel', $profile->user->channel_name)}}">

							<img src="/img/user/u1.png" class="userRep2"/>&nbsp;
								<span><b>{{$profile->first_name}} {{$profile->last_name}}</b></span>
							</a>&nbsp;
							<br/>&nbsp;
							<span>w/ <b>{{count($subscriberCount)}}</b> Subscribers</span>&nbsp;
							<button class="btn btn-primary btn-xs pull-right" id="subscribe{{$increment++}}">Subscribe</button>
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
				<span>Subscriptions</span>&nbsp;
			</div>
			<br/><br/>
			<div class="row">
			@if(empty($subscriptionProfile))
					<p style="margin-left:30px;">No Subscriptions yet</p>
				@else
					@foreach($subscriptionProfile as $key => $profile1)
						<div class="col-md-6">
							<div class="row user-padding">
							
								<a href="{{route('view.users.channel', $profile1->user->channel_name)}}">
								<img src="/img/user/u1.png" class="userRep2">&nbsp;
								<span><b>{{$profile1->first_name}} {{$profile1->last_name}}</b></span>
								</a>&nbsp;
								<br/>&nbsp;
								<span>w/ <b>{{count($subscriptionCount)}}</b> Subscribers</span>&nbsp;
								<button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button>
							</div>
						</div>
						@endforeach					
					@endif
			</div><!--subscription /.row-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>