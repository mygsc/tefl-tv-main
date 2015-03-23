
<div class="row">
	<br/>
	<div class="col-md-6">
		 <img src="/img/thumbnails/v1.jpg" class="img-responsive" width="100%">
	</div>
	<div class="col-md-6">
		@if(empty($recentUpload))
			<p style="margin-left:30px;">No recent Activity</p>
		@else
		<h3><b>Title: {{$recentUpload->title}}</b></h3>
		<p>Uploaded: {{$recentUpload->created_at}}</p>
		<br/>
		<video controls>
			<source src=""/>
		</video>
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
						<img src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}" alt="">
					</a>
					<a href="{{route('homes.watch-video',$usersVideo->file_name)}}">
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
					<img src="/img/thumbnails/v1.jpg" class="h-video">
				</div>

				<div class="v-Info">
					<span class="fa fa-globe"></span> | {{$playlists->name}}
				</div>

				<div class="count">
					{{$playlists->updated_at}}
				</div>
				@endforeach
				@else
					<p style="margin-left:30px;">No Playlists yet</p>
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

							<a href="{{route('view.users.channel')}}">

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
							
								<a href="{{route('view.users.channel')}}">
								<img src="/img/user/u1.png" class="userRep2">&nbsp;
								<span><b>{{$profile1->first_name}} {{$profile1->last_name}}</b></span>
								</a>&nbsp;
								<br/>&nbsp;
								<span>w/ <b></b> Subscribers</span>&nbsp;
								<button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button>
							</div>
						</div>
						@endforeach					
					@endif
			</div><!--subscription /.row-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>