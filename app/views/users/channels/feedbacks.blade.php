@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container page White">
		<br/>
		<div class="row">
			@include('elements/users/profileTop2')
			<br/>
			<div class=" channel-content">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
						<!-- <li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li> -->
						<!-- <li role="presentation">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li> -->
						<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
						<li role="presentation" class="active">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
						<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
					</ul><!--tabNav-->
				</div>

				<div class="feedbackSection content-padding">
					@if(empty($userFeedbacks))
					<br/><br/>
					<textarea id='feedback' class="form-control v-feedback" placeholder="Write your feedback.."></textarea>
					<span id='errorlabel' class='input-error'></span>
					<br/>
					<div class="text-right">
						@if(!Auth::check())
						{{link_to_route('homes.signin', 'Sign-in to leave a feedback')}}
						@else
						<button id='btnfeedback' class="btn btn-info mg-t-10">Post</button>
						{{Form::hidden('feedbackUser', Auth::User()->id, array('id' => 'feedbackUser'))}}
						{{Form::hidden('feedbackOwner', $userChannel->id, array('id' => 'feedbackOwner'))}}

						@endif
					</div>
					<h3 class="text-center">No feedbacks yet..</h3>

					@else

					<div class="feedbacks row">
						<textarea id='feedback' class="form-control v-feedback" placeholder="Write your feedback.."></textarea>
						<span id='errorlabel' class='input-error'></span>
						<br/>
						<div class="text-right">
							@if(!Auth::check())
							{{link_to_route('homes.signin', 'Sign-in to leave a feedback')}}
							@else
							<button id='btnfeedback' class="btn btn-info">Post</button>
							{{Form::hidden('feedbackUser', Auth::User()->id, array('id' => 'feedbackUser'))}}
							{{Form::hidden('feedbackOwner', $userChannel->id, array('id' => 'feedbackOwner'))}}

							@endif
						</div>

						<div class="col-md-12 feedbacksarea">
							<div id="appendNewFeedbackHere"></div>
							@foreach($userFeedbacks as $userFeedback)
							@if($userFeedback->spamCounts < 5)
							<div class="feedbacks_section row" id="feedback{{$userFeedback->id}}">
								@if(Auth::check())
								@if(Auth::User()->id == $userFeedback->user_id)
								<div class="nav_div">
									<button class="spam fa fa-flag pull-right" id="{{$userFeedback->id}}">
										{{Form::hidden('channel_id', $userFeedback->channel_id, array('id' => 'spam_channel_id'))}}
										{{Form::hidden('user_id', Auth::User()->id, array('id' => 'spam_user_id'))}}
										{{Form::hidden('feedback_id', $userFeedback->id, array('id' => 'spam_feedback_id'))}}
									</button>
									<button class="delete pull-right" id="feedback{{$userFeedback->id}}">x	
										{{Form::hidden('channel_id', $userFeedback->channel_id, array('id' => 'channel_id'))}}
										{{Form::hidden('user_id', Auth::User()->id, array('id' => 'user_id'))}}
										{{Form::hidden('feedback_id', $userFeedback->id, array('id' => 'feedback_id'))}}
									</button>
								</div>
								@endif
								@endif
								<div class="feedbackProfilePic col-md-1">
									{{HTML::image($userFeedback->img, 'alt', array('class' => 'img-responsive inline', 'height' => '48px', 'width' => '48px'))}}
								</div>
								<div class="col-md-11">
									<div class="row">
										{{ link_to_route('view.users.channel', $userFeedback->channel_name, $parameters = array($userFeedback->channel_name), $attributes = array('id' => 'channel_name')) }}
										| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($userFeedback->created_at)); ?></small> 
										<br/>
										<p class="text-justify">
											{{$userFeedback->feedback}}
										</p>


										@if(isset(Auth::User()->id))

										<div class='fa likedup'>
											@if(!$userFeedback->ifAlreadyLiked)
											<span class='fa-thumbs-up'></span>
											<input type="hidden" value="liked" name="status">
											@else
											<span class='fa-thumbs-up blueC'></span>
											<input type="hidden" value="unliked" name="status">
											@endif
											<input type="hidden" value="{{$userFeedback->id}}" name="likeFeedbackId">
											<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">

											<span class="likescount" id="likescount">{{$userFeedback->likesCount}}</span>
										</div>
										&nbsp;
										<div class='fa dislikedup'>
											<input type="hidden" value="{{$userFeedback->id}}" name="dislikeFeedbackId">
											<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">

											@if(!$userFeedback->ifAlreadyDisliked)
											<input type="hidden" value="disliked" name="status">
											<span class='fa-thumbs-down'></span>
											@else
											<input type="hidden" value="undisliked" name="status">
											<span class='fa-thumbs-down redC'></span>
											@endif
											<span class="dislikescount" id="dislikescounts">{{$userFeedback->dislikeCount}}</span> &nbsp;
										</div>
										&nbsp;

										<span class="repLink hand">{{$userFeedback->countFeedbackReplies}}<i class="fa fa-reply"></i></span>
										@else

										<span class="likescount" id="likescount">{{$userFeedback->likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
										<span class="dislikescount" id="dislikescounts">{{$userFeedback->dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;

										<span class="repLink hand">{{$userFeedback->countFeedbackReplies}}<i class="fa fa-reply"></i></span>
										<!--end updated by cess 3/26/15-->
										@endif<!--auth user-->
										<div id="replysection" class="panelReply">

											@foreach($userFeedback->getFeedbackReplies as $getFeedbackReply)
											<div class="col-md-11">
												<div class="row" id="reply{{$getFeedbackReply->id}}">
													<div class="feedbackProfilePic col-md-1">
														@if(file_exists(public_path('img/user/'.$getFeedbackReply->user_id . '.jpg')))
														{{HTML::image('img/user/'.$getFeedbackReply->user_id . '.jpg', 'alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
														@else
														{{HTML::image('img/user/0.jpg','alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
														@endif
												</div>
													@if(Auth::check())
													@if(Auth::User()->id == $getFeedbackReply->user_id)
													<div class="nav_div" >
														<button class="reportReply fa fa-flag pull-right" id="{{$getFeedbackReply->id}}">
															{{Form::hidden('report_user_id', Auth::User()->id, array('id' => 'report_user_id'))}}
															{{Form::hidden('report_feedback_id', $getFeedbackReply->feedback_id, array('id' => 'report_feedback_id'))}}
														</button>
														<button class="replyDelete pull-right" id="reply{{$getFeedbackReply->id}}" value="{{$getFeedbackReply->id}}">x	
															{{Form::hidden('deleteReply_user_id', Auth::User()->id, array('id' => 'deleteReply_user_id'))}}
															{{Form::hidden('deleteReply_feedback_id', $getFeedbackReply->feedback_id, array('id' => 'deleteReply_feedback_id'))}}
														</button>
													</div>
													@endif
													@endif
													{{link_to_route('view.users.channel', $getFeedbackReply->channel_name, $parameters = array($getFeedbackReply->channel_name), $attributes = array('id' => 'channel_name'))."&nbsp;|&nbsp;"}}
													<small>{{date('M m, Y h:i A',strtotime($getFeedbackReply->created_at))}}</small><br/>
													<p class='text-justify'>{{$getFeedbackReply->reply}}<br/></p></hr><br/>
												</div>
											</div>	
											@endforeach

											@if(!Auth::check())
											{{link_to_route('homes.signin', 'Sign-in to reply to a feedback')}}
											@else
											{{Form::open(array('route'=>'post.viewusers.addreply-feedback','id' => 'addReplyFeedback', 'class' => 'inline'))}}
											@if(Auth::check())
											{{Form::hidden('feedback_id', $userFeedback->id)}}
											{{Form::hidden('user_id', Auth::User()->id)}}
											@endif
											{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply', 'placeholder' => 'Leave a reply...'))}}
											{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}

											<span class='replyError inputError'></span>
											{{Form::close()}}
											@endif
										</div><!--/.reply section-->
									</div><!--/.col-md-10-->
								</div><!--/.row-->
							</div><!--/.feedbacksrowarea-->
							<hr/>
							@endif
							@endforeach
						</div>
					</div>
					{{HTML::script('js/jquery.min.js')}}
					{{HTML::script('js/showHideToggle.js')}}
					{{HTML::script('js/user/reply.js')}}
					@endif

				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>	
@stop


@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/channel_comments.js')}}
{{HTML::script('js/mention.js')}}
@stop