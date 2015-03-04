
<div class="row">
	<br/>
	<div class="col-md-6">
		<img src="/img/thumbnails/vp.png">
	</div>
	<div class="col-md-6">
		<h3><b>Word and Sentence Stress (Part 1)</b></h3>
		<p>Uploded: February 27, 2015</p>
		<br/>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
	</div><!--/.col-md-6-->
</div>
<br/>

<div class="row">
	<!--videos-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				Videos
			</div>
			<br/>

			<div class="col-md-4">
			@foreach($usersVideos as $usersVideo)
				<video controls src="public/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}"></video>
				<div class="v-Info">
					5 Ways to improve your English
				</div>
				<div class="count">
					55 Views, 40 Likes
				</div>
			@endforeach
			</div>
			
			<div class="text-right">
				<a href="" class="btn btn-info">SEE ALL VIDEOS</a>
			</div>
		</div><!--well-->
	</div><!--1st 6 column Videos-->

	<!--Playlists-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				PlayLists
			</div>
			<br/>

			<div class="col-md-4">
				<div class="" style="position:relative;">
					<div class="playlist-info" >
						18
						<br/>
						Videos
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
					<img src="/img/thumbnails/v1.png" class="h-video">
				</div>
				<div class="v-Info">
					<span class="fa fa-globe"></span> | All About Grammar
				</div>
				<div class="count">
					Update: February 12, 2015
				</div>
			</div>
			<div class="col-md-4">
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
					<span class="fa fa-globe"></span> | All About Grammar
				</div>
				<div class="count">
					Update: February 12, 2015
				</div>
			</div>
			<div class="col-md-4">
				<div class="" style="position:relative;">
					<div class="playlist-info" >
						200
						<br/>
						Videos
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
					<img src="/img/thumbnails/v8.png" class="h-video">
				</div>
				<div class="v-Info">
					<span class="fa fa-globe"></span> | All About Grammar
				</div>
				<div class="count">
					Update: February 12, 2015
				</div>
			</div>

			<div class="text-right">
				
				<a href="" class="btn btn-info">SEE ALL PlAYLISTS</a>
			</div>
		</div>
	</div><!--/.2nd 6 column Playlists-->
	<br/>
	<!--Subscribers-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				Subscribers
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
						@foreach($subscriberLists as $subscriberList)
					<div class="row user-padding">
						<img src="/img/user/u1.png" class="userRep2">&nbsp;
						<span><b>{{$subscriberList->first_name}} {{$subscriberList->last_name}}</b></span>&nbsp;
						<br/>&nbsp;
						<span>w/ <b>2k</b> Subscribers</span>&nbsp;
						<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
					</div>
						@endforeach
				</div>
			</div>
			<div class="text-right">
				<a href="" class="btn btn-info">SEE ALL SUBSCRIBERS</a>
			</div>
		</div>
	</div><!--/.3rd column 6 Subscribers-->

	<!--Subscriptions-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				Subscriptions
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
				@foreach($subscriptionLists as $SubscriptionList)
					<div class="row user-padding">
						<img src="/img/user/u1.png" class="userRep2">&nbsp;
						<span><b>{{$SubscriptionList[0]['first_name']}} {{$SubscriptionList[0]['last_name']}}</b></span>&nbsp;
						<br/>&nbsp;
						<span>w/ <b>2k</b> Subscribers</span>&nbsp;
						<button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button>
					</div>
					@endforeach
				</div>
			</div><!--subscription /.row-->
			<div class="text-right">
					<a href="" class="btn btn-info">SEE ALL SUBSCRIPTIONS</a>
			</div>
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>