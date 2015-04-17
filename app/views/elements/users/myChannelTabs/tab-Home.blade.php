
<div class="row">
		<div class="mg-20">
	<br/>
	@if(empty($recentUpload))
	<div class="row">
		<div class="text-center alert alert-info noA">
			<h3>
				{{ link_to_route('get.upload', 'Upload Video', null) }} now to make your channel more appealing to subscribers.
			</h3>
		</div>
	</div>
	@else

	<div class="col-md-6">

		 <!-- <img src="/img/thumbnails/v1.jpg" class="img-responsive" width="100%"> -->
		 <div id="vid-wrapper">
			 <div id="vid-controls">
				 <div class="embed-responsive embed-responsive-16by9">
				 	@if(file_exists(public_path('/videos/'.Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name.'.jpg')))
					 	<video id="media-video" poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.jpg'}}"  width="100%" >
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.mp4'}}" type="video/mp4" />
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.webm'}}" type="video/webm" />
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.ogg'}}" type="video/ogg" />
						</video>
				 	@else
				 		{{HTML::image('img/thumbnails/video.png','alt' ,array('style' => 'width:100%;'))}}
				 		<video id="media-video" poster="/img/thumbnails/video.png"  width="100%" >
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.mp4'}}" type="video/mp4" />
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.webm'}}" type="video/webm" />
					 		<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.ogg'}}" type="video/ogg" />
						</video>
				 	@endif	
					
				</div>
				@include('elements/videoPlayer')
			</div>
		</div>

	</div>
	@endif
	<div class="col-md-6">
		@if(empty($recentUpload))
			<p style="margin-left:30px;">No recent Activity</p>
		@else
		<h3><b>Title: {{$recentUpload[0]->title}}</b></h3>
		<p>Uploaded: {{date('M d Y',strtotime($recentUpload[0]->created_at))}}</p>
		<br/>
		
		<p class="text-justify">
			Description: {{$recentUpload[0]->description}}
		</p>
		<br/>
		<span class=""><!--/counts and share link-->
			{{$recentUpload[0]->views}} Views &nbsp;&nbsp;|&nbsp;&nbsp;

			{{$recentUpload[0]->numberOfLikes}} Likes&nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;|&nbsp;&nbsp;

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
<br/>

<div class="row">
	<!--videos-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Videos</span>&nbsp;|&nbsp;
				<small class="ch-link">{{link_to_route('users.myvideos', 'Show All')}}</small>
			</div>
			<br/><br/>

			<div class="row">
			@if($usersVideos->isEmpty())
				<p class="text-center">No Videos Uploaded yet..</p>
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
							{{$usersVideo->views}} Views | {{$usersVideo->numberOfLikes}} Likes
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
				<small class="ch-link">{{link_to_route('users.playlists', 'Show All')}}</small>
			</div>
			<br/>
			<br/>
			<div class="row">
			
			@if($usersPlaylists->isEmpty())
				<p class="text-center">No Playlists yet</p>
			@else
			@foreach($usersPlaylists as $key=>$playlist)
			<div class="col-md-4 col-sm-2">
			<div class="p-relative">
				@if(isset($thumbnail_playlists[$key][0]))	
					@if(file_exists(public_path('/videos/'.$thumbnail_playlists[$key][0]->user_id.'-'.$thumbnail_playlists[$key][0]->channel_name.'/'.$thumbnail_playlists[$key][0]->file_name.'/'.$thumbnail_playlists[$key][0]->file_name.'.jpg')))
					<div class="playlist-info" >
						{{count($thumbnail_playlists[$key])}}
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list" style="font-size:24px;"></span>
					</div>
						<img src="/videos/{{$thumbnail_playlists[$key][0]->user_id}}-{{$thumbnail_playlists[$key][0]->channel_name}}/{{$thumbnail_playlists[$key][0]->file_name}}/{{$thumbnail_playlists[$key][0]->file_name}}.jpg">
					@else	
					<div class="playlist-info" >
						{{count($thumbnail_playlists[$key])}}
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list fs-24"></span>
					</div>
						<img src="/img/thumbnails/video.png">
					@endif
				@else
					<div class="playlist-info" >
						0
						<br/>
						Video(s)
						<br/>
						<span class="glyphicon glyphicon-list fs-24"></span>
					</div>
					<img src="/img/thumbnails/video.png">
				@endif
					</div>
				<div class="v-Info">
					<span class="fa fa-globe"></span> | {{$playlist->name}}
				</div>
					
				<div class="count">
					{{$playlist->updated_at}}
				</div>
			</div>
			@endforeach
			@endif
			
			</div>
		</div>

	</div><!--/.2nd 6 column Playlists-->
	<br/>
	<!--Subscribers-->
	
	<div class="col-md-6 col-lg-height col-md-height">
		<div class="well2 Div-channelSubSection" id="subscriberWrapper">
			<div class="subLabelThis">
				<span>Subscribers</span>&nbsp;

			</div>
			<br/><br/>
			<div class="row-same-height">
			@if(empty($subscriberProfile))
				<p class="text-center">No subscribers yet.</p>
			@else
				@foreach($subscriberProfile as $profile)
					<div class="col-md-6" >
						<div class="row user-padding" id="subscriberLists">

							<a href="{{route('view.users.channel', $profile->channel_name)}}">
									@if(file_exists(public_path('img/user/'.$profile->subscriber_id.'.jpg')))
						             	{{HTML::image('img/user/'.$profile->subscriber_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
						            @else
						             	{{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
						            @endif
						            &nbsp;<span><b>{{$profile->channel_name}}</b></span>
							</a>
							<br/>
							&nbsp;<span>w/ <b>{{$profile->numberOfSubscribers}}</b>&nbsp;
							Subscribers</span>&nbsp;

							@if(isset(Auth::User()->id))
								<?php
									$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile->id, 'subscriber_id' => Auth::User()->id))->first();
								?>
								@if(isset($profile->id))
									@if(Auth::User()->id != $profile->id)
										{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
							    			{{Form::hidden('user_id', $profile->id)}}
							    			{{Form::hidden('subscriber_id', Auth::User()->id)}}
							    			@if(!$ifAlreadySubscribe)
							    				{{Form::hidden('status','subscribeOn')}}
										    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										    @else
										    	{{Form::hidden('status','subscribeOff')}}
										    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										    @endif
										{{Form::close()}}
									@endif
								@endif
							@endif
						</div>
					</div>
				@endforeach						
			@endif			
			</div>
		</div>
	</div><!--/.3rd column 6 Subscribers-->

	<!--Subscriptions-->
	<div class="col-md-6 col-lg-height col-md-height">
		<div class="well2 Div-channelSubSection" id="subscriberWrapper">
			<div class="subLabelThis">
				<span>Subscriptions</span>&nbsp;

			</div>
			<br/><br/>
			<div class="row-same-height">
			@if(empty($subscriptionProfile))
				<p class="text-center">No Subscriptions yet</p>
			@else
				@foreach($subscriptionProfile as $profile1)
					<div class="col-md-6" >
						<div class="user-padding" id="subscriberLists">

							<a href="{{route('view.users.channel', $profile1->channel_name)}}">
								@if(file_exists(public_path('img/user/'.$profile1->user_id.'.jpg')))
						            {{HTML::image('img/user/'.$profile1->user_id.'.jpg', 'alt', array('class' => 'userRep2'))}}
						        @else
						            {{HTML::image('img/user/0.jpg', 'alt', array('class' => 'userRep2'))}}
						        @endif
								&nbsp;
								<span><b>{{$profile1->channel_name}}</b></span>
							</a>
							<br/>
							&nbsp;<span>w/ <b>{{$profile1->numberOfSubscribers}}</b>&nbsp;
							Subscribers</span>&nbsp;

							@if(isset($profile1->id))
									@if(isset(Auth::User()->id))
										<?php
											$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $profile1->id, 'subscriber_id' => Auth::User()->id))->first();
										?>
										{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
							    			{{Form::hidden('user_id', $profile1->id)}}
							    			{{Form::hidden('subscriber_id', Auth::User()->id)}}
							    			@if(!$ifAlreadySubscribe)
							    				{{Form::hidden('status','subscribeOn')}}
										    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										    @else
										    	{{Form::hidden('status','subscribeOff')}}
										    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-xs pull-right', 'id'=>'subscribebutton'))}}
										    @endif
										{{Form::close()}}
									@endif
								@endif
						</div>
					</div>
				@endforeach						
			@endif			
			</div>
		</div>
	</div><!--/.3rd column 6 Subscription-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>