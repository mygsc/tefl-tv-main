
<div class="row">
	<br/>
	<div class="col-md-6">
		<img src="/img/thumbnails/vp.png">
	</div>
	<div class="col-md-6">
	@foreach($recentUpload as $upload)
		<h3><b>{{$upload->title}}</b></h3>
		<p>Uploded: {{$upload->created_at}}</p>
		<br/>
		<video controls>
			<source src=""/>
		</video>
		<p class="text-justify">
			{{$upload->description}}
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
		@endforeach
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
			@if(isset($usersVideos))

				@foreach($usersVideos as $usersVideo)
				<div class="col-md-4">
					<a href="{{route('homes.watch-video',$usersVideo->id.'%'.$usersVideo->title)}}">
						<div class="">
							<video controls height="auto" width="100%" class="h-video">
								<source src="/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}" type="video/mp4"/>
							</video>
						</div>
					</a>
					<a href="{{route('homes.watch-video',$usersVideo->id.'%'.$usersVideo->title)}}">
						<div class="v-Info">
							{{$usersVideo->title}}
						</div>
					</a>
					
					<div class="count">
						{{$usersVideo->views}} Views, {{$usersVideo->likes}} Likes
					</div>
				
				</div>
				@endforeach
				@else
				No Videos Uploaded yet..
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
			<div class="col-md-3">
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
					No Playlists yet
				@endif
			</div>
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
			@if(isset($subscribers))
					@foreach($subscribers as $subscriber)
					<div class="col-md-6" >
						<div class="row user-padding" id="subscriberLists">
							<?php
								$subscriberProfile = UserProfile::where('user_id',$subscriber->subscriber_id)->first();
								$subscriberCount = DB::table('subscribes')->where('user_id', $subscriber->subscriber_id)->get();
							?>
							<a href="{{route('view.users.channel', $subscriberProfile->user->channel_name)}}">
							<img src="/img/user/u1.png" class="userRep2"/>&nbsp;
								<span><b>{{$subscriberProfile->first_name}} {{$subscriberProfile->last_name}}</b></span>
							</a>&nbsp;
							<br/>&nbsp;
							<span>w/ <b>{{count($subscriberCount)}}</b> Subscribers</span>&nbsp;
							<button class="btn btn-primary btn-xs pull-right" id="subscribe{{$increment++}}">Subscribe</button>
						</div>
					</div>
					@endforeach	
					@else
						No subscribers yet.
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
			@if(isset($subscriptions))
					@foreach($subscriptions as $subscription)
						<div class="col-md-6">
							<div class="row user-padding">
							<?php
									$subscriptionProfile = UserProfile::where('user_id', $subscription->user_id)->first();
									$subscriptionCount = DB::table('subscribes')->where('subscriber_id', $subscription->user_id)->get();
								?>
								<a href="{{route('view.users.channel', $subscriberProfile->user->channel_name)}}">
								<img src="/img/user/u1.png" class="userRep2">&nbsp;
								<span><b>{{$subscriptionProfile->first_name}} {{$subscriptionProfile->last_name}}</b></span>
								</a>&nbsp;
								<br/>&nbsp;
								<span>w/ <b>{{count($subscriptionCount)}}</b> Subscribers</span>&nbsp;
								<button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button>
							</div>
						</div>
					@endforeach
					@else
						No Subscriptions yet
					@endif
			</div><!--subscription /.row-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>