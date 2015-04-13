
<div class="row">
	<div class="content-padding">
		<br/>
			@if(empty($recentUpload))
				<p class="mg-l--30">No recent Activity</p>
			@else
			@if(isset($recentUpload[0]->id))
				<div class="col-md-6">
				 	<div id="vid-wrapper">
				 		<div id="vid-controls">
					 		<div class="embed-responsive embed-responsive-16by9 h-video">
								@if(file_exists(public_path('/videos/'.$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name.'.jpg')) )
									<video poster="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.jpg'}}"  width="100%" >
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.mp4'}}" type="video/mp4" />
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.webm'}}" type="video/webm" />
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.ogg'}}" type="video/ogg" />
									</video>
								@else
									{HTML::image('img/thumbnails/video.png','alt' ,array('style' => 'width:100%;'))}}
					 				<video id="media-video" poster="/img/thumbnails/video.png"  width="100%" >
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.mp4'}}" type="video/mp4" />
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.webm'}}" type="video/webm" />
										<source src="/videos/{{$recentUpload[0]->id.'-'.$recentUpload[0]->channel_name.'/'.$recentUpload[0]->file_name.'/'.$recentUpload[0]->file_name. '.ogg'}}" type="video/ogg" />
									</video>
								@endif
										
							</div>
							@include('elements/videoPlayer')
						</div>		
					</div>					
				</div>

				<div class="col-md-6">
				
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

<div class="row">
	<!--videos-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			
			<div class="subLabelThis">
				<span>Videos</span>&nbsp;|&nbsp; <small class="ch-link"><a href="#Videos" class="text-center" aria-controls="Videos" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>
					<div class="col-md-4">
						@if($findVideos->isEmpty())
							No videos yet..
						@else
							@foreach($findVideos as $findVideo)
								@if(isset($findVideo[0]->id))
								<a href="{{route('homes.watch-video', array($findVideo->file_name))}}" target="_blank">	
								<div id="findVid">
										@if(file_exists(public_path('/videos/'.$findVideo[0]->id.'-'.$findVideo[0]->channel_name.'/'.$findVideo[0]->file_name.'/'.$findVideo[0]->file_name.'.jpg')) )
											<video poster="/videos/{{$findVideo->id.'-'.$findVideo->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.jpg'}}"  width="100%" >
											<source src="/videos/{{$findVideo->id.'-'.$findVideo->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.mp4'}}" type="video/mp4" />
											<source src="/videos/{{$findVideo->id.'-'.$findVideo->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.webm'}}" type="video/webm" />
											<source src="/videos/{{$findVideo->id.'-'.$findVideo->channel_name.'/'.$findVideo->file_name.'/'.$findVideo->file_name. '.ogg'}}" type="video/ogg" />
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
					@endif
				@endforeach
			@endif
			</div>
		</div><!--well-->
	</div><!--1st 6 column Videos-->

	<!--Playlists-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Playlists</span>&nbsp;|&nbsp; <small class="ch-link"><a href="#Playlists" class="text-center" aria-controls="Playlists" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>

			<div class="col-md-4">
			@if(empty($usersPlaylists))
				@foreach($usersPlaylists as $playlists)
				<div class="p-relative">
					<div class="playlist-info" >
						11
						<br/>
						Videos
						<br/>
						<span class="glyphicon glyphicon-list fs-24"></span>
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
					<p class="mg-l-20">No Playlists yet</p>
				@endif
			</div>
		</div>
	</div><!--/.2nd 6 column Playlists-->
	<br/>
	<!--Subscribers-->
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Subscribers</span>&nbsp;|&nbsp; <small class="ch-link"><a href="#Subscribers" class="text-center" aria-controls="Subscribers" role="tab" data-toggle="tab">Show All</a></small>
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
						<!-- <button class="btn btn-primary btn-xs pull-right">Subscribe</button> -->
						@if(isset(Auth::User()->id))
							@if(isset($subscriber->id))
								@if((Auth::User()->id) AND (Auth::User()->id != $subscriber->id))
									<?php
										$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscriber->id, 'subscriber_id' => Auth::User()->id))->first();
									?>
									{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
						    			{{Form::hidden('user_id', $subscriber->id)}}
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
	<div class="col-md-6">
		<div class="well2 Div-channelSubSection">
			<div class="subLabelThis">
				<span>Subscriptions</span>&nbsp;|&nbsp; <small class="ch-link"><a href="#Subscriptions" class="text-center" aria-controls="Subscriptions" role="tab" data-toggle="tab">Show All</a></small>
			</div>
			<br/>
			<div class="row">
				@if(empty($subscriptions))
					<p class="mg-l-20">No subscription yet</p>
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
								<!-- <button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button> -->
								@if(isset(Auth::User()->id))
									@if(isset($subscription->id))
										@if((Auth::User()->id) AND (Auth::User()->id != $subscription->id))
											<?php
												$ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $subscription->id, 'subscriber_id' => Auth::User()->id))->first();
											?>
											{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								    			{{Form::hidden('user_id', $subscription->id)}}
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
			</div><!--subscription /.row-->
		</div><!--/.well2 Div-channelSubSection-->
	</div><!--/.4th column 6 Subscription-->
</div>